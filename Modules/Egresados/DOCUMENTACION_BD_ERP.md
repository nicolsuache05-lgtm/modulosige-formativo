# Documentación de Integración con Base de Datos ERP (`bderpsenaempresa`)

Este documento detalla la estructura, restricciones y mecanismos de normalización aplicados en el módulo de **Egresados (SIGE)** para interactuar de forma 100% compatible con la base de datos centralizada del ERP (`bderpsenaempresa`).

---

## 1. Conexión y Arquitectura de Datos
- **Motor**: MySQL / MariaDB (Modo Estricto Activo).
- **Base de Datos**: `bderpsenaempresa`.
- **Enfoque**: Se emplean directamente las tablas maestras del ERP para evitar redundancias, sincronizando usuarios, personas, aprendices y roles institucionales.
- **Ámbito de Modificaciones**: Todos los cambios y adaptaciones se limitan exclusivamente al directorio `Modules/Egresados/`.

---

## 2. Tablas del ERP Utilizadas

### A. Tabla `people` (Personas / Datos Básicos)
Almacena la identidad de egresados, aprendices, instructores y funcionarios.

| Columna | Tipo de Dato | Restricción / ENUM Válido | Normalización Aplicada |
| :--- | :--- | :--- | :--- |
| `id` | `BIGINT UNSIGNED` | Clave primaria autoincremental | Gestionada por Eloquent. |
| `document_type` | `ENUM` | `'Cédula de ciudadanía'`, `'Tarjeta de identidad'`, `'Cédula de extranjería'`, `'Pasaporte'`, `'Documento nacional de identidad'`, `'Registro civil'`, `'Permiso de Protección Temporal'` | `EgresadosController::normalizeDocumentType()` mapea `'CC'`, `'TI'`, `'CE'`, `'PEP'`, `'PPT'`, `'DNI'`, `'PAS'` y variantes con/sin tilde al enum exacto para evitar el error `1265 Data truncated for column 'document_type'`. |
| `document_number` | `BIGINT UNSIGNED` | Único, No nulo | Se sanean caracteres no numéricos con `preg_replace('/\D/', '', $doc)` para garantizar enteros válidos. |
| `first_name` | `VARCHAR(255)` | No nulo | Nombres limpios sin etiquetas HTML. |
| `first_last_name` | `VARCHAR(255)` | No nulo | Primer apellido obligatorio. |
| `second_last_name` | `VARCHAR(255)` | Nulo permitido | Segundo apellido opcional. |
| `telephone1` | `BIGINT UNSIGNED` | Nulo permitido | Se extraen únicamente los dígitos numéricos. Si no contiene dígitos, se persiste como `NULL` (nunca cadena vacía `""`, lo cual provoca fallo en modo estricto). |
| `personal_email` | `VARCHAR(255)` | Nulo permitido | Saneado mediante `FILTER_SANITIZE_EMAIL`. |
| `misena_email` | `VARCHAR(255)` | Nulo permitido | Saneado para cuentas `@misena.edu.co` o `@sena.edu.co`. |
| `eps_id` | `BIGINT UNSIGNED` | No nulo (FK a `e_p_s`) | Si no se especifica, toma por defecto `0` ("NO REGISTRA") o el primer ID de `e_p_s`. |
| `population_group_id` | `BIGINT UNSIGNED` | No nulo (FK a `population_groups`) | Toma por defecto `1` ("ADOLESCENTE EN CONFLICTO CON LA LEY PENAL") o el primer ID disponible. |
| `pension_entity_id` | `BIGINT UNSIGNED` | No nulo (FK a `pension_entities`) | Toma por defecto `1` ("NO REGISTRA") o el primer ID disponible. |

### B. Tabla `apprentices` (Aprendices / Egresados)
Asocia una persona con su trayectoria formativa en el CEFA.

| Columna | Tipo de Dato | Restricción / ENUM Válido | Normalización Aplicada |
| :--- | :--- | :--- | :--- |
| `id` | `BIGINT UNSIGNED` | Clave primaria | Autoincremental. |
| `person_id` | `BIGINT UNSIGNED` | Foránea a `people.id` | No nulo. |
| `course_id` | `BIGINT UNSIGNED` | Foránea a `courses.id` | Ficha o curso de formación asociado. Si no coincide, asocia la primera ficha activa disponible sin romper la integridad. |
| `apprentice_status` | `ENUM` | `'NO REGISTRA'`, `'CERTIFICADO'`, `'EN FORMACIÓN'`, `'RETIRO VOLUNTARIO'`, `'CANCELADO'`, `'TRASLADADO'`, `'APLAZADO'`, `'INDUCCIÓN'`, `'CONDICIONADO'` | `EgresadosController::normalizeApprenticeStatus()` mapea cadenas como `'EN_FORMACION'`, `'EMPLEADO'`, `'INDUCCION'` a los literales exactos con tildes y mayúsculas requeridos por MySQL. |

### C. Tabla `users` (Cuentas de Acceso)
Gestiona credenciales y autenticación unificada.

| Columna | Restricción | Manejo en el Módulo |
| :--- | :--- | :--- |
| `person_id` | `UNIQUE` | Se verifica antes de crear para no duplicar cuentas asociadas a la misma persona. |
| `email` | `UNIQUE` | Se valida contra otros registros para prevenir `Integrity constraint violation (1062 Duplicate entry)`. |
| `nickname` | `UNIQUE` | Se calcula a partir del nombre y, en caso de colisión, se le añade un contador numérico correlativo. |
| `password` | No nulo | Encriptado con `Hash::make()` / `bcrypt()`. |

### D. Tablas `roles` y `role_user` (Permisos y Roles)
Asigna el acceso a las vistas y funciones del módulo:
- `egresados.admin` / `superadmin_egresados`: Administrador del módulo.
- `egresados.instructor`: Instructor / Evaluador de seguimiento.
- `egresados.egresado`: Aprendiz graduado con acceso a su portal personal.

---

## 3. Resoluciones Implementadas
1. **Error 1265 (Data truncated for column 'document_type')**:
   - Resuelto al implementar `normalizeDocumentType()`. Ahora la vista puede enviar tanto siglas (`CC`, `TI`, `CE`, `PEP`, `PPT`) como nombres completos, y el controlador garantiza el valor ENUM exacto antes del `save()`.
2. **Error al Crear o Actualizar Instructores**:
   - `instructoresStore` ahora asigna claves foráneas requeridas (`eps_id`, `population_group_id`, `pension_entity_id`), sanea teléfonos a `BIGINT` o `NULL`, y previene colisiones en `users`.
   - Se implementó `instructoresUpdate` junto a sus rutas y modal dinámico interactivo en la vista `instructores.blade.php`.
3. **Error al Crear o Actualizar Egresados**:
   - `store`, `update` y `processRegistro` sanitizan y normalizan automáticamente `document_type`, `telephone1`, `apprentice_status` y validan el número de documento antes de interactuar con la base de datos.
