<?php

namespace Modules\Egresados\app\Imports;

use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InstructoresImport
{
    /**
     * Procesa una fila individual de instructor.
     *
     * @param array $row
     * @return \App\Models\User|null
     */
    public function model(array $row)
    {
        $values = array_values($row);

        $normalized = [];
        foreach ($row as $k => $v) {
            $key = (string) $k;
            $key = str_replace(
                ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'],
                ['a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'n'],
                $key
            );
            $cleanKey = strtolower(trim(preg_replace('/[^a-zA-Z0-9_]/', '_', $key)));
            $cleanKey = trim(preg_replace('/_+/', '_', $cleanKey), '_');
            $normalized[$cleanKey] = is_string($v) ? trim($v) : $v;
        }

        $docRaw = $normalized['identificacion'] ?? $normalized['numero_de_documento'] ?? $normalized['documento'] ?? $normalized['no_documento'] ?? $values[0] ?? null;
        $nombre = $normalized['nombre_del_instructor'] ?? $normalized['nombre_completo'] ?? $normalized['nombre'] ?? $normalized['instructor'] ?? $values[1] ?? 'Instructor SENA';
        $correo = $normalized['correo'] ?? $normalized['correo_electronico'] ?? $normalized['email'] ?? $values[2] ?? null;

        if (empty($docRaw)) {
            return null;
        }

        $docNum = (int) preg_replace('/[^0-9]/', '', (string)$docRaw);
        if ($docNum <= 0) {
            return null;
        }

        $partes = explode(' ', trim((string)$nombre));
        $firstName = $partes[0] ?? 'Instructor';
        $firstLastName = $partes[1] ?? 'SENA';
        $secondLastName = isset($partes[2]) ? implode(' ', array_slice($partes, 2)) : null;

        // 1. Crear o Actualizar Persona
        $person = Person::firstOrNew(['document_number' => $docNum]);
        $person->document_type = $person->document_type ?: 'Cédula de ciudadanía';
        $person->first_name = $firstName;
        $person->first_last_name = $firstLastName;
        if ($secondLastName) {
            $person->second_last_name = $secondLastName;
        }

        if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $cleanEmail = filter_var($correo, FILTER_SANITIZE_EMAIL);
            $person->personal_email = $cleanEmail;
            $person->misena_email = $cleanEmail;
        } else {
            $person->personal_email = null;
            $person->misena_email = null;
        }

        if (!$person->exists) {
            $person->eps_id = $person->eps_id ?: (DB::table('e_p_s')->value('id') ?? 1);
            $person->population_group_id = $person->population_group_id ?: (DB::table('population_groups')->value('id') ?? 1);
            $person->pension_entity_id = $person->pension_entity_id ?: (DB::table('pension_entities')->value('id') ?? 1);
        }
        $person->save();

        // 2. Crear o Actualizar Usuario si tiene correo
        if (!empty($person->personal_email)) {
            $user = User::firstOrNew(['email' => $person->personal_email]);
            if (!$user->exists) {
                $user->nickname = strtolower(str_replace(' ', '.', $firstName . '.' . $firstLastName));
                $user->person_id = $person->id;
                $user->password = bcrypt('Sena12345*');
                $user->save();
            }

            // Asignar rol de instructor
            $role = Role::where('slug', 'like', '%instructor%')->first();
            if ($role && !$user->roles()->where('role_id', $role->id)->exists()) {
                $user->roles()->attach($role->id);
            }

            return $user;
        }

        return null;
    }

    /**
     * Importa directamente un archivo CSV o Excel (.xlsx) subido.
     *
     * @param \Illuminate\Http\UploadedFile|string $file
     * @return int Cantidad de registros procesados
     */
    public function import($file): int
    {
        $path = is_string($file) ? $file : $file->getRealPath();
        $rows = SimpleXlsxReader::read($path);

        if (empty($rows)) {
            throw new \Exception("El archivo está vacío o no contiene registros procesables.");
        }

        $header = array_shift($rows);
        if (isset($header[0])) {
            $header[0] = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', (string)$header[0]);
        }

        $processedCount = 0;
        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                if (empty(array_filter($row, fn($val) => trim((string)$val) !== ''))) {
                    continue;
                }

                if (count($header) === count($row)) {
                    $rowData = array_combine($header, $row);
                } else {
                    $rowData = $row;
                }

                $this->model($rowData);
                $processedCount++;
            }

            DB::commit();
            return $processedCount;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en InstructoresImport: ' . $e->getMessage());
            throw $e;
        }
    }
}
