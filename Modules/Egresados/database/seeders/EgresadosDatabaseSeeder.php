<?php

namespace Modules\Egresados\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;
use Modules\SICA\Entities\PensionEntity;
use Modules\SICA\Entities\Course;

class EgresadosDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Solo utiliza las tablas existentes del ERP, sin crear tablas nuevas.
     */
    public function run(): void
    {
        // 1. Obtener la App de Egresados
        $app = DB::table('apps')->where('name', 'like', '%Egresados%')->orWhere('url', 'like', '%egresados%')->first();
        $appId = $app ? $app->id : 30;

        // 2. Obtener IDs de tablas maestras para las Personas
        $epsId = DB::table('e_p_s')->value('id') ?? 1;
        $populationGroupId = DB::table('population_groups')->value('id') ?? 1;
        $pensionEntityId = DB::table('pension_entities')->value('id') ?? 1;
        $courseId = DB::table('courses')->value('id') ?? 1;

        // 3. Crear / Asegurar los Roles de Egresados en la tabla `roles`
        $roleSuperAdmin = Role::firstOrCreate(
            ['slug' => 'superadmin'],
            [
                'name' => 'Super Administrador',
                'description' => 'Acceso total al sistema y módulos',
                'description_english' => 'Full access to the system and modules',
                'full_access' => 'Si',
                'app_id' => 1,
            ]
        );

        $roleEgresadosAdmin = Role::firstOrCreate(
            ['slug' => 'egresados.admin'],
            [
                'name' => 'Administrador Egresados',
                'description' => 'Administrador general del módulo de egresados SIGE',
                'description_english' => 'General administrator of the SIGE alumni module',
                'full_access' => 'No',
                'app_id' => $appId,
            ]
        );

        $roleInstructor = Role::firstOrCreate(
            ['slug' => 'egresados.instructor'],
            [
                'name' => 'Instructor Egresados',
                'description' => 'Instructor encargado del seguimiento y evaluación de egresados CEFA',
                'description_english' => 'Instructor in charge of tracking and evaluating CEFA alumni',
                'full_access' => 'No',
                'app_id' => $appId,
            ]
        );

        $roleEgresado = Role::firstOrCreate(
            ['slug' => 'egresados.egresado'],
            [
                'name' => 'Egresado',
                'description' => 'Graduado / Egresado de formación profesional del CEFA',
                'description_english' => 'Graduate / Alumni of vocational training at CEFA',
                'full_access' => 'No',
                'app_id' => $appId,
            ]
        );

        // -------------------------------------------------------------
        // 4. PERSONA & USUARIO 1: SUPERADMINISTRADOR
        // -------------------------------------------------------------
        $superadminDoc = 10000001;
        $personSuperadmin = Person::where('document_number', $superadminDoc)->first();
        if (!$personSuperadmin) {
            $personSuperadmin = Person::create([
                'document_type' => 'Cédula de ciudadanía',
                'document_number' => $superadminDoc,
                'first_name' => 'Super',
                'first_last_name' => 'Admin',
                'second_last_name' => 'SIGE',
                'eps_id' => $epsId,
                'population_group_id' => $populationGroupId,
                'pension_entity_id' => $pensionEntityId,
                'misena_email' => 'superadmin.egresados@sena.edu.co',
                'personal_email' => 'superadmin.egresados@sena.edu.co',
                'sena_email' => 'superadmin.egresados@sena.edu.co',
            ]);
        }

        $userSuperadmin = User::where('email', 'superadmin.egresados@sena.edu.co')
            ->orWhere('nickname', 'superadmin_egresados')
            ->first();

        if (!$userSuperadmin) {
            $userSuperadmin = User::create([
                'nickname' => 'superadmin_egresados',
                'person_id' => $personSuperadmin->id,
                'email' => 'superadmin.egresados@sena.edu.co',
                'password' => Hash::make('12345678'),
            ]);
        } else {
            $userSuperadmin->update([
                'person_id' => $personSuperadmin->id,
                'password' => Hash::make('12345678'),
            ]);
        }

        $userSuperadmin->roles()->syncWithoutDetaching([$roleSuperAdmin->id, $roleEgresadosAdmin->id]);

        // -------------------------------------------------------------
        // 5. PERSONA & USUARIO 2: INSTRUCTOR
        // -------------------------------------------------------------
        $instructorDoc = 10000002;
        $personInstructor = Person::where('document_number', $instructorDoc)->first();
        if (!$personInstructor) {
            $personInstructor = Person::create([
                'document_type' => 'Cédula de ciudadanía',
                'document_number' => $instructorDoc,
                'first_name' => 'Carlos',
                'first_last_name' => 'Mendoza',
                'second_last_name' => 'Instructor',
                'eps_id' => $epsId,
                'population_group_id' => $populationGroupId,
                'pension_entity_id' => $pensionEntityId,
                'misena_email' => 'instructor.egresados@sena.edu.co',
                'personal_email' => 'instructor.egresados@sena.edu.co',
                'sena_email' => 'instructor.egresados@sena.edu.co',
            ]);
        }

        $userInstructor = User::where('email', 'instructor.egresados@sena.edu.co')
            ->orWhere('nickname', 'instructor_egresados')
            ->first();

        if (!$userInstructor) {
            $userInstructor = User::create([
                'nickname' => 'instructor_egresados',
                'person_id' => $personInstructor->id,
                'email' => 'instructor.egresados@sena.edu.co',
                'password' => Hash::make('12345678'),
            ]);
        } else {
            $userInstructor->update([
                'person_id' => $personInstructor->id,
                'password' => Hash::make('12345678'),
            ]);
        }

        $userInstructor->roles()->syncWithoutDetaching([$roleInstructor->id]);

        // -------------------------------------------------------------
        // 6. PERSONA & USUARIO 3: EGRESADO
        // -------------------------------------------------------------
        $egresadoDoc = 10000003;
        $personEgresado = Person::where('document_number', $egresadoDoc)->first();
        if (!$personEgresado) {
            $personEgresado = Person::create([
                'document_type' => 'Cédula de ciudadanía',
                'document_number' => $egresadoDoc,
                'first_name' => 'Valentina',
                'first_last_name' => 'Ríos',
                'second_last_name' => 'Egresada',
                'eps_id' => $epsId,
                'population_group_id' => $populationGroupId,
                'pension_entity_id' => $pensionEntityId,
                'misena_email' => 'egresado.sige@sena.edu.co',
                'personal_email' => 'egresado.sige@sena.edu.co',
                'sena_email' => 'egresado.sige@sena.edu.co',
            ]);
        }

        $userEgresado = User::where('email', 'egresado.sige@sena.edu.co')
            ->orWhere('nickname', 'egresado_sige')
            ->first();

        if (!$userEgresado) {
            $userEgresado = User::create([
                'nickname' => 'egresado_sige',
                'person_id' => $personEgresado->id,
                'email' => 'egresado.sige@sena.edu.co',
                'password' => Hash::make('12345678'),
            ]);
        } else {
            $userEgresado->update([
                'person_id' => $personEgresado->id,
                'password' => Hash::make('12345678'),
            ]);
        }

        $userEgresado->roles()->syncWithoutDetaching([$roleEgresado->id]);

        // Asegurar registro de Aprendiz Egresado en la tabla `apprentices` existente
        $apprentice = Apprentice::where('person_id', $personEgresado->id)->first();
        if (!$apprentice && $courseId) {
            Apprentice::create([
                'person_id' => $personEgresado->id,
                'course_id' => $courseId,
                'apprentice_status' => 'CERTIFICADO',
            ]);
        }

        $this->command->info('¡Roles y Usuarios de Egresados creados/actualizados exitosamente!');
        $this->command->info('1. Superadmin: superadmin.egresados@sena.edu.co | 12345678');
        $this->command->info('2. Instructor: instructor.egresados@sena.edu.co | 12345678');
        $this->command->info('3. Egresado:   egresado.sige@sena.edu.co   | 12345678');
    }
}
