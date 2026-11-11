<?php

namespace Modules\Egresados\Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class EgresadosModuleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (config('database.connections.mysql.database') === 'testing') {
            $envDb = 'bderpsenaempresa';
            $envFile = base_path('.env');
            if (file_exists($envFile)) {
                $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    if (str_starts_with(trim($line), 'DB_DATABASE=')) {
                        $envDb = trim(explode('=', $line, 2)[1]);
                        break;
                    }
                }
            }
            config(['database.connections.mysql.database' => $envDb]);
            \Illuminate\Support\Facades\DB::purge('mysql');
            \Illuminate\Support\Facades\DB::reconnect('mysql');
        }
    }

    /**
     * Prueba que las rutas públicas del módulo cargan correctamente (200 OK).
     */
    public function test_public_routes_status_ok(): void
    {
        $response = $this->get('/egresados');
        $response->assertStatus(200);

        $response = $this->get('/egresados/registro');
        $response->assertStatus(200);

        $response = $this->get('/egresados/create');
        $response->assertStatus(200);
    }

    /**
     * Prueba el acceso a las rutas de Superadmin con usuario autenticado.
     */
    public function test_superadmin_routes(): void
    {
        $user = User::where('email', 'superadmin.egresados@sena.edu.co')->first();
        if (!$user) {
            $user = User::first();
        }

        $this->actingAs($user);

        $response = $this->get('/egresados/dashboard');
        $response->assertStatus(200);

        $response = $this->get('/egresados/directorio');
        $response->assertStatus(200);

        $response = $this->get('/egresados/instructores');
        $response->assertStatus(200);

        $response = $this->get('/egresados/encuestas');
        $response->assertStatus(200);

        $response = $this->get('/egresados/reportes');
        $response->assertStatus(200);

        $response = $this->get('/egresados/eventos');
        $response->assertStatus(200);
    }

    /**
     * Prueba el acceso al panel del instructor.
     */
    public function test_instructor_routes(): void
    {
        $user = User::where('email', 'instructor.egresados@sena.edu.co')->first();
        if (!$user) {
            $user = User::first();
        }

        $this->actingAs($user);

        $response = $this->get('/egresados/dashboard-instructor');
        $response->assertStatus(200);

        $response = $this->get('/egresados/instructor/directorio');
        $response->assertStatus(200);

        $response = $this->get('/egresados/instructor/encuestas');
        $response->assertStatus(200);
    }

    /**
     * Prueba el acceso al panel del egresado.
     */
    public function test_egresado_routes(): void
    {
        $user = User::where('email', 'egresado.sige@sena.edu.co')->first();
        if (!$user) {
            $user = User::first();
        }

        $this->actingAs($user);

        $response = $this->get('/egresados/dashboard-egresado');
        $response->assertStatus(200);

        $response = $this->get('/egresados/encuestas-egresado');
        $response->assertStatus(200);

        $response = $this->get('/egresados/oportunidades-egresado');
        $response->assertStatus(200);
    }
}
