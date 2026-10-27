<?php

namespace Modules\Egresados\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class TestCorreoInstitucionalCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'egresados:test-mail {email? : Correo electrónico personal para recibir el mensaje de prueba}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Valida la configuración de correo institucional @soy.sena.edu.co en .env y prueba el envío mediante SMTP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('===========================================================');
        $this->info('  Diagnóstico y Prueba de Correo Institucional SENA (SIGE)  ');
        $this->info('===========================================================');
        $this->newLine();

        $mailer = config('mail.default');
        $host = config('mail.mailers.smtp.host');
        $port = config('mail.mailers.smtp.port');
        $username = config('mail.mailers.smtp.username');
        $password = config('mail.mailers.smtp.password');
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name');

        $this->comment('Configuración actual detectada en Laravel:');
        $this->table(
            ['Variable', 'Valor Detectado', 'Estado'],
            [
                ['MAIL_MAILER', $mailer, $mailer === 'smtp' ? '✅ Correcto' : '⚠️ Debe ser "smtp"'],
                ['MAIL_HOST', $host, $host === 'smtp.office365.com' ? '✅ Correcto' : '⚠️ Debe ser "smtp.office365.com"'],
                ['MAIL_PORT', $port, ($port == 587 || $port == 465) ? '✅ Correcto' : '⚠️ Recomendado: 587'],
                ['MAIL_USERNAME', $username ?: '(Vacío)', !empty($username) ? '✅ Configurado' : '❌ Falta en .env'],
                ['MAIL_PASSWORD', !empty($password) ? '******** (' . strlen($password) . ' caracteres)' : '(Vacío)', !empty($password) ? '✅ Configurado' : '❌ Falta en .env'],
                ['MAIL_FROM_ADDRESS', $fromAddress, ($fromAddress === $username && !empty($fromAddress)) ? '✅ Coincide con username' : '⚠️ Debe ser idéntico a MAIL_USERNAME'],
                ['MAIL_FROM_NAME', $fromName, !empty($fromName) ? '✅ Configurado' : '⚠️ Opcional'],
            ]
        );

        $this->newLine();

        // Validaciones previas
        if ($mailer !== 'smtp') {
            $this->error('Error: MAIL_MAILER debe ser "smtp" en el archivo .env. Actualmente está en "' . $mailer . '".');
            $this->line('Por favor edita tu archivo .env y luego ejecuta "php artisan config:clear".');
            return Command::FAILURE;
        }

        if (empty($username) || empty($password)) {
            $this->error('Error: MAIL_USERNAME o MAIL_PASSWORD no están configurados en el archivo .env.');
            $this->line('Agrega tu correo @soy.sena.edu.co y tu contraseña de aplicación en el archivo .env.');
            return Command::FAILURE;
        }

        if (str_contains($username, 'tu_usuario') || str_contains($password, 'tu_contraseña')) {
            $this->error('Error: Las credenciales en .env aún contienen los textos de ejemplo ("tu_usuario...", "tu_contraseña...").');
            $this->line('Reemplázalos por tus credenciales reales del SENA.');
            return Command::FAILURE;
        }

        $destinatario = $this->argument('email');
        if (empty($destinatario)) {
            $destinatario = $this->ask('Ingresa tu correo personal (ejemplo: tu_correo@gmail.com) para enviar la prueba');
        }

        if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)) {
            $this->error('El correo de destino ingresado no es válido: ' . $destinatario);
            return Command::FAILURE;
        }

        // Test de conectividad por socket
        $this->comment("1. Verificando conectividad de red con {$host}:{$port}...");
        $socket = @fsockopen($host, (int) $port, $errno, $errstr, 5);
        if ($socket) {
            $this->info("   ✅ Conexión TCP exitosa a {$host}:{$port}.");
            fclose($socket);
        } else {
            $this->warn("   ⚠️ No se pudo abrir conexión directa al socket ({$errstr}). Podría haber un firewall o proxy bloqueando el puerto {$port}.");
        }

        // Enviar correo de prueba
        $this->newLine();
        $this->comment("2. Intentando enviar correo de prueba desde <{$username}> hacia <{$destinatario}>...");

        try {
            Mail::raw(
                "¡Prueba exitosa de conexión SMTP!\n\n" .
                "Este correo confirma que el módulo SIGE Egresados de SENA Empresa ERP está correctamente conectado a los servidores de Microsoft 365 / Office 365 con la cuenta institucional: {$username}.\n\n" .
                "Fecha y hora: " . now()->toDateTimeString() . "\n" .
                "Centro Agroindustrial La Angostura - CEFA",
                function ($message) use ($destinatario, $username, $fromName) {
                    $message->to($destinatario)
                            ->subject('✅ Prueba Exitosa SMTP - SIGE Egresados SENA');
                }
            );

            $this->newLine();
            $this->info('🎉 ¡ENVÍO EXITOSO!');
            $this->info("El correo fue despachado correctamente a: {$destinatario}");
            $this->line('Por favor revisa tu bandeja de entrada (y la carpeta de Spam / Correo no deseado si no aparece de inmediato).');
            return Command::SUCCESS;

        } catch (\Throwable $e) {
            $this->newLine();
            $this->error('❌ Ocurrió un error al enviar el correo:');
            $this->line($e->getMessage());
            $this->newLine();

            $errorMsg = $e->getMessage();

            if (str_contains($errorMsg, '535 5.7.139') || str_contains($errorMsg, 'Authentication unsuccessful')) {
                $this->alert('BLOQUEO DE AUTENTICACIÓN SMTP EN MICROSOFT 365 (SENA)');
                $this->warn('El servidor de Microsoft 365 rechazó la autenticación con error 535 5.7.139.');
                $this->line('Causas posibles y soluciones:');
                $this->line('1. La cuenta institucional tiene activada la autenticación en dos pasos (MFA) y estás usando la contraseña normal en vez de una "Contraseña de Aplicación" (App Password de 16 caracteres).');
                $this->line('2. Los administradores de TI del SENA tienen bloqueado el protocolo "SMTP AUTH" por políticas de seguridad para cuentas educativas @soy.sena.edu.co.');
                $this->line('   En este caso, la autenticación SMTP directa con contraseña no está permitida por el arrendatario (tenant) del SENA.');
                $this->line('3. Alternativa recomendada para entornos de desarrollo/pruebas:');
                $this->line('   - Usar Mailtrap (sandbox) configurando MAILTRAP_API_TOKEN en .env, o');
                $this->line('   - Solicitar un buzón de servicio del centro de formación con SMTP habilitado.');
            } elseif (str_contains($errorMsg, 'Connection refused') || str_contains($errorMsg, 'timed out')) {
                $this->warn('El servidor no respondió a tiempo. Verifica tu conexión a internet o si un firewall local / antivirus bloquea la salida por el puerto ' . $port . '.');
            } elseif (str_contains($errorMsg, '554 5.2.0') || str_contains($errorMsg, 'SendAsDenied')) {
                $this->warn('Error de remitente no autorizado: MAIL_FROM_ADDRESS debe ser idéntico al correo de inicio de sesión (' . $username . ').');
            }

            return Command::FAILURE;
        }
    }
}
