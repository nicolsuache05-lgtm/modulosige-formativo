# 🎓 SIGE — Módulo de Egresados: Usuarios y Credenciales de Acceso

Este documento contiene las credenciales de acceso para los tres roles configurados en el módulo de **Egresados (SIGE)** de **SENA Empresa ERP**.

> [!NOTE]
> El inicio de sesión se realiza a través del login principal del ERP en la ruta: **[`/login`](http://localhost/login)**.
> Al ingresar con cualquiera de estos correos o nombres de usuario, el sistema te redirigirá **automáticamente** al módulo que le corresponde a tu perfil.

---

## 📋 Tabla de Credenciales y Módulos Asignados

| Rol | Correo Institucional | Usuario (Nickname) | Contraseña | Módulo y URL de Destino |
| :--- | :--- | :--- | :--- | :--- |
| 🛡️ **Super Administrador** | `superadmin.egresados@sena.edu.co` | `superadmin_egresados` | `12345678` | **Dashboard Superadmin**<br>[`/egresados/dashboard`](http://localhost/egresados/dashboard) |
| 👨‍🏫 **Instructor Egresados** | `instructor.egresados@sena.edu.co` | `instructor_egresados` | `12345678` | **Dashboard Instructor**<br>[`/egresados/dashboard-instructor`](http://localhost/egresados/dashboard-instructor) |
| 🎓 **Egresado(a)** | `egresado.sige@sena.edu.co` | `egresado_sige` | `12345678` | **Portal del Egresado**<br>[`/egresados/dashboard-egresado`](http://localhost/egresados/dashboard-egresado) |

---

## 🚀 Descripción de Cada Módulo

### 1. 🛡️ Super Administrador (`superadmin_egresados`)
- **Destino:** [`/egresados/dashboard`](http://localhost/egresados/dashboard)
- **Funcionalidades:**
  - Métricas globales de egresados (empleados, emprendedores, en formación continua).
  - Tasa de empleabilidad y gráficos de seguimiento institucional.
  - Gestión general y directorio de aprendices egresados.

### 2. 👨‍🏫 Instructor (`instructor_egresados`)
- **Destino:** [`/egresados/dashboard-instructor`](http://localhost/egresados/dashboard-instructor)
- **Funcionalidades:**
  - Panel especializado de seguimiento a aprendices egresados.
  - Filtros por programa de formación y código de ficha.
  - Monitoreo del estado ocupacional y registro de observaciones de seguimiento.

### 3. 🎓 Egresado (`egresado_sige`)
- **Destino:** [`/egresados/dashboard-egresado`](http://localhost/egresados/dashboard-egresado)
- **Funcionalidades:**
  - Portal personal con resumen de encuestas pendientes y oportunidades laborales.
  - Acceso a encuestas de seguimiento a egresados ([`/egresados/encuestas-egresado`](http://localhost/egresados/encuestas-egresado)).
  - Consulta y postulación a vacantes y ofertas de empleo ([`/egresados/oportunidades-egresado`](http://localhost/egresados/oportunidades-egresado)).

---

## 🔄 Cómo Restablecer o Volver a Cargar los Usuarios

Si en algún momento necesitas restablecer estas cuentas o volver a crearlas en una base de datos limpia, ejecuta en la terminal:

```bash
php artisan db:seed --class="Modules\Egresados\Database\Seeders\EgresadosDatabaseSeeder"
```

> [!IMPORTANT]
> - No se crean tablas nuevas en la base de datos; se utilizan exclusivamente las tablas nativas del ERP (`users`, `people`, `roles`, `role_user`, `apprentices`, `apps`, `courses`).
> - El módulo **SICA** permanece completamente aislado e intacto.
