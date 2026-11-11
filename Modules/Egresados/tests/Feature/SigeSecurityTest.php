<?php

namespace Modules\Egresados\Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Role;
use Tests\TestCase;

class SigeSecurityTest extends TestCase
{
    protected ?User $superadminUser = null;
    protected ?User $instructorUser = null;
    protected ?User $egresadoUser = null;

    protected function setUp(): void
    {
        parent::setUp();

        // Desactivar middleware de validación CSRF para pruebas automatizadas de endpoints POST
        $this->withoutMiddleware([
            \Illuminate\Foundation\Http\Middleware\PreventRequestForgery::class,
        ]);

        // 1. Obtener o inicializar Superadministrador legítimo
        $this->superadminUser = User::where('email', config('egresados.security.superadmin_email', 'superadmin.egresados@sena.edu.co'))->first();
        if (!$this->superadminUser) {
            $this->superadminUser = User::where('nickname', 'superadmin_egresados')->first();
        }

        // 2. Obtener o inicializar Instructor legítimo
        $this->instructorUser = User::where('email', 'instructor.egresados@sena.edu.co')->first();
        if (!$this->instructorUser) {
            $this->instructorUser = User::where('nickname', 'instructor_egresados')->first();
        }

        // 3. Obtener o inicializar Egresado legítimo
        $this->egresadoUser = User::where('email', 'egresado.sige@sena.edu.co')->first();
        if (!$this->egresadoUser) {
            $this->egresadoUser = User::where('nickname', 'egresado_sige')->first();
        }
    }

    /**
     * Prueba 1: Un egresado no puede ingresar como instructor ni como superadministrador.
     */
    public function test_1_egresado_cannot_access_instructor_or_superadmin_routes(): void
    {
        $this->actingAs($this->egresadoUser);

        // Intento de acceso a rutas de Superadministrador
        $response = $this->get('/egresados/dashboard');
        $response->assertRedirect(route('egresados.dashboard_egresado'));
        $response->assertSessionHas('warning');

        $response = $this->get('/egresados/directorio');
        $response->assertRedirect(route('egresados.dashboard_egresado'));

        $response = $this->get('/egresados/instructores');
        $response->assertRedirect(route('egresados.dashboard_egresado'));

        // Intento de acceso a rutas de Instructor
        $response = $this->get('/egresados/dashboard-instructor');
        $response->assertRedirect(route('egresados.dashboard_egresado'));
        $response->assertSessionHas('warning');

        $response = $this->get('/egresados/instructor/directorio');
        $response->assertRedirect(route('egresados.dashboard_egresado'));
    }

    /**
     * Prueba 2: Un instructor no puede ingresar al módulo administrativo de superadministrador.
     */
    public function test_2_instructor_cannot_access_superadmin_routes(): void
    {
        $this->actingAs($this->instructorUser);

        // Intento de acceso a rutas exclusivas de Superadministrador
        $response = $this->get('/egresados/dashboard');
        $response->assertRedirect(route('egresados.dashboard_instructor'));
        $response->assertSessionHas('warning');

        $response = $this->get('/egresados/directorio');
        $response->assertRedirect(route('egresados.dashboard_instructor'));

        $response = $this->get('/egresados/instructores');
        $response->assertRedirect(route('egresados.dashboard_instructor'));
    }

    /**
     * Prueba 3: Un usuario sin autenticar no puede abrir rutas protegidas y es redirigido al login.
     */
    public function test_3_unauthenticated_user_cannot_access_protected_routes(): void
    {
        Auth::logout();
        $this->assertGuest();

        // Ruta de Superadmin sin autenticar
        $response = $this->get('/egresados/dashboard');
        $response->assertRedirect(route('egresados.login', ['redirect' => url('/egresados/dashboard')]));
        $this->assertGuest();

        // Ruta de Instructor sin autenticar
        $response = $this->get('/egresados/dashboard-instructor');
        $response->assertRedirect(route('egresados.login', ['redirect' => url('/egresados/dashboard-instructor')]));
        $this->assertGuest();

        // Ruta de Egresado sin autenticar
        $response = $this->get('/egresados/dashboard-egresado');
        $response->assertRedirect(route('egresados.login', ['redirect' => url('/egresados/dashboard-egresado')]));
        $this->assertGuest();
    }

    /**
     * Prueba 4: Después del acceso o logout, el contenido protegido incluye encabezados no-cache para impedir recuperación con la flecha Atrás.
     */
    public function test_4_back_button_and_history_protection_headers(): void
    {
        $this->actingAs($this->superadminUser);

        $response = $this->get('/egresados/dashboard');
        $response->assertStatus(200);

        // Verificar encabezados estrictos de prevención de caché
        $response->assertHeader('Cache-Control');
        $cacheControl = $response->headers->get('Cache-Control');
        $this->assertStringContainsString('no-cache', $cacheControl);
        $this->assertStringContainsString('no-store', $cacheControl);
        $this->assertStringContainsString('must-revalidate', $cacheControl);

        $response->assertHeader('Pragma', 'no-cache');
        $response->assertHeader('Expires');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
    }

    /**
     * Prueba 5: Una URL copiada no concede acceso después de cerrar sesión.
     */
    public function test_5_copied_url_denies_access_after_logout(): void
    {
        $this->actingAs($this->superadminUser);
        $savedUrl = '/egresados/dashboard';

        // Ejecutar cierre de sesión seguro
        $response = $this->post('/egresados/logout');
        $response->assertRedirect();
        $this->assertGuest();

        // Intentar abrir la URL guardada tras el logout
        $response = $this->get($savedUrl);
        $response->assertRedirect(route('egresados.login', ['redirect' => url($savedUrl)]));
        $this->assertGuest();
    }

    /**
     * Prueba 6: Una sesión inactiva durante 5 minutos pierde su validez y redirige al login con el mensaje requerido.
     */
    public function test_6_inactive_session_after_5_minutes_is_invalidated(): void
    {
        $this->actingAs($this->egresadoUser);

        // Simular 5 minutos y 5 segundos de inactividad (305 segundos)
        $pastTimestamp = now()->subSeconds(305)->timestamp;
        session(['sige_last_activity' => $pastTimestamp]);

        $response = $this->get('/egresados/dashboard-egresado');

        // Debe invalidar la sesión y redirigir con el mensaje exacto
        $response->assertRedirect(route('egresados.login', ['inactivity' => 1]));
        $response->assertSessionHas('warning', 'Tu sesión ha expirado por inactividad. Inicia sesión nuevamente.');
        $this->assertGuest();
    }

    /**
     * Prueba 7: La actividad normal humana evita un cierre de sesión prematuro (keep-alive).
     */
    public function test_7_human_activity_within_5_minutes_maintains_session_active(): void
    {
        $this->actingAs($this->egresadoUser);

        // Simular 2 minutos de inactividad (dentro de los 5 minutos permitidos)
        $twoMinutesAgo = now()->subMinutes(2)->timestamp;
        session(['sige_last_activity' => $twoMinutesAgo]);

        // Enviar keep-alive de actividad humana
        $response = $this->postJson('/egresados/session/keep-alive', ['human' => true]);
        $response->assertStatus(200);
        $response->assertJson([
            'authenticated' => true,
            'success'       => true,
        ]);

        // Verificar que el timestamp fue renovado
        $this->assertGreaterThan($twoMinutesAgo, session('sige_last_activity'));

        // El usuario puede seguir consultando su panel normalmente
        $response = $this->get('/egresados/dashboard-egresado');
        $response->assertStatus(200);
    }

    /**
     * Prueba 8: Los cambios manuales en las URL no permiten consultar registros confidenciales ajenos (Protección IDOR).
     */
    public function test_8_idor_url_tampering_prevented_for_egresados(): void
    {
        $this->actingAs($this->egresadoUser);

        // Buscar un aprendiz que pertenezca a otra persona
        $otherApprentice = Apprentice::where('person_id', '!=', $this->egresadoUser->person_id)->first();
        if (!$otherApprentice) {
            $otherPerson = Person::create([
                'document_type'   => 'CC',
                'document_number' => 99998888,
                'first_name'      => 'Prueba',
                'first_last_name' => 'Ajena',
            ]);
            $course = Course::first();
            $otherApprentice = Apprentice::create([
                'person_id'         => $otherPerson->id,
                'course_id'         => $course ? $course->id : 1,
                'apprentice_status' => 'CERTIFICADO',
            ]);
        }

        // El egresado intenta abrir el perfil de otro egresado cambiando el ID en la URL
        $response = $this->get('/egresados/' . $otherApprentice->id . '/perfil');

        // Debe ser bloqueado por el middleware de superadmin o por la política IDOR
        $this->assertTrue(
            $response->status() === 403 || $response->isRedirect(route('egresados.dashboard_egresado'))
        );
    }

    /**
     * Prueba 9: Los endpoints de API rechazan solicitudes no autorizadas.
     */
    public function test_9_api_endpoints_reject_unauthorized_requests(): void
    {
        Auth::logout();
        $this->assertGuest();

        // Petición a endpoint de API sin token de autenticación
        $response = $this->getJson('/api/v1/egresados');

        // La API debe responder 401 Unauthorized
        $response->assertStatus(401);
    }

    /**
     * Prueba 10: Las solicitudes automáticas del sistema no mantienen una sesión activa indefinidamente.
     */
    public function test_10_passive_system_requests_do_not_extend_inactivity_timer(): void
    {
        $this->actingAs($this->egresadoUser);

        // Simular actividad registrada hace 4 minutos
        $fourMinutesAgo = now()->subMinutes(4)->timestamp;
        session(['sige_last_activity' => $fourMinutesAgo]);

        // Solicitud pasiva de comprobación con encabezado de petición en segundo plano
        $response = $this->getJson('/egresados/session/check', ['X-Background-Ping' => 'true']);
        $response->assertStatus(200);
        $response->assertJson([
            'authenticated' => true,
            'warning'       => true, // Faltan 60s
        ]);

        // Verificar que la petición pasiva NO actualizó el timestamp de actividad
        $this->assertEquals($fourMinutesAgo, session('sige_last_activity'));

        // Al pasar a 5 minutos y 1 segundo (301s):
        session(['sige_last_activity' => now()->subSeconds(301)->timestamp]);

        $response = $this->getJson('/egresados/session/check', ['X-Background-Ping' => 'true']);
        $response->assertStatus(401);
        $response->assertJson([
            'authenticated' => false,
            'expired'       => true,
            'message'       => 'Tu sesión ha expirado por inactividad. Inicia sesión nuevamente.',
        ]);
        $this->assertGuest();
    }
}
