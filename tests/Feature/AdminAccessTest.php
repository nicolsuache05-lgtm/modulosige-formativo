<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Modules\Admin\Http\Middleware\CheckAdminRole;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    public function test_guest_is_redirected_to_login_with_admin_destination(): void
    {
        Auth::shouldReceive('check')->once()->andReturn(false);
        $request = Request::create('/admin', 'GET');

        $response = (new CheckAdminRole())->handle($request, fn () => response('ok'));

        $this->assertSame(
            route('login', ['redirect' => $request->fullUrl()]),
            $response->headers->get('Location')
        );
    }

    public function test_authenticated_user_without_admin_role_is_forbidden(): void
    {
        $user = Mockery::mock(User::class);
        Auth::shouldReceive('check')->once()->andReturn(true);
        Auth::shouldReceive('user')->once()->andReturn($user);
        $user->shouldReceive('hasAnyRole')->once()
            ->with(['superadmin', 'sica.admin'])
            ->andReturn(false);

        $this->expectException(HttpException::class);

        (new CheckAdminRole())->handle(
            Request::create('/admin', 'GET'),
            fn () => response('ok')
        );
    }

    public function test_admin_role_can_open_admin_routes(): void
    {
        $user = Mockery::mock(User::class);
        Auth::shouldReceive('check')->once()->andReturn(true);
        Auth::shouldReceive('user')->once()->andReturn($user);
        $user->shouldReceive('hasAnyRole')->once()
            ->with(['superadmin', 'sica.admin'])
            ->andReturn(true);

        $response = (new CheckAdminRole())->handle(
            Request::create('/admin', 'GET'),
            fn () => response('ok')
        );

        $this->assertSame(200, $response->getStatusCode());
    }
}