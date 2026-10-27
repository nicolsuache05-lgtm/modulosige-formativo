<?php

namespace Modules\Egresados\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Mailtrap\Mime\MailtrapEmail;
use Symfony\Component\Mime\Address;

class EnviarInvitacionMasivaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $evento;
    protected $egresados;

    public function __construct($evento, $egresados)
    {
        $this->evento = $evento;
        $this->egresados = $egresados;
    }

    public function handle()
    {
        $apiToken = env('MAILTRAP_API_TOKEN');
        $fromAddress = env('MAILTRAP_FROM_ADDRESS') ?: (env('MAIL_FROM_ADDRESS') ?: 'eventos@cefa.sena.edu.co');
        $fromName = env('MAILTRAP_FROM_NAME') ?: (env('MAIL_FROM_NAME') ?: 'Eventos CEFA');

        // Determinar si usamos la API oficial del SDK o el transporte SMTP de Laravel
        $useApi = !empty($apiToken) && $apiToken !== '<YOUR_API_TOKEN>' && !str_starts_with($apiToken, '<');

        $mailtrapClient = null;
        $remitente = null;

        if ($useApi) {
            try {
                $mailtrapClient = MailtrapClient::initSendingEmails(apiKey: $apiToken);
                $remitente = new Address($fromAddress, $fromName);
            } catch (\Throwable $e) {
                Log::warning('No se pudo inicializar MailtrapClient SDK, alternando a Mailer de Laravel: ' . $e->getMessage());
                $useApi = false;
            }
        }

        // Procesar envíos para cada egresado
        foreach ($this->egresados as $egresado) {
            $correo = is_object($egresado) ? ($egresado->correo ?? null) : ($egresado['correo'] ?? null);
            $nombre = is_object($egresado) ? ($egresado->nombre ?? 'Egresado') : ($egresado['nombre'] ?? 'Egresado');

            if (empty($correo)) {
                continue;
            }

            $eventoNombre = is_object($this->evento) ? ($this->evento->nombre ?? $this->evento->title ?? 'Evento Institucional') : ($this->evento['nombre'] ?? $this->evento['title'] ?? 'Evento Institucional');
            $eventoLugar = is_object($this->evento) ? ($this->evento->lugar ?? $this->evento->location ?? 'Sede Principal') : ($this->evento['lugar'] ?? $this->evento['location'] ?? 'Sede Principal');
            $eventoFecha = is_object($this->evento) ? ($this->evento->fecha_inicio ?? $this->evento->date ?? 'Próximamente') : ($this->evento['fecha_inicio'] ?? $this->evento['date'] ?? 'Próximamente');
            $eventoDesc = is_object($this->evento) ? ($this->evento->descripcion ?? $this->evento->description ?? '') : ($this->evento['descripcion'] ?? $this->evento['description'] ?? '');

            $textoMensaje = "¡Hola {$nombre}!\n\nEl CEFA La Angostura te invita al evento institucional: {$eventoNombre}.\n\n" .
                "📌 Lugar: {$eventoLugar}\n" .
                "📅 Fecha: {$eventoFecha}\n\n" .
                "Detalles del evento:\n{$eventoDesc}\n\n" .
                "Te esperamos para compartir esta gran experiencia formativa e institucional.\n\n" .
                "Atentamente,\nEquipo de Egresados - Centro Agroindustrial La Angostura (CEFA)";

            try {
                if ($useApi && $mailtrapClient && $remitente) {
                    // Enviar por API oficial de Mailtrap
                    $email = (new MailtrapEmail())
                        ->from($remitente)
                        ->to(new Address($correo, $nombre))
                        ->subject('Invitación: ' . $eventoNombre)
                        ->category('Invitacion_Evento')
                        ->text($textoMensaje);

                    $response = $mailtrapClient->send($email);
                    Log::info('Correo enviado exitosamente vía Mailtrap API a ' . $correo);
                } else {
                    // Enviar por SMTP de Laravel (Sandbox / Mailtrap SMTP)
                    Mail::raw($textoMensaje, function ($message) use ($correo, $nombre, $fromAddress, $fromName, $eventoNombre) {
                        $message->from($fromAddress, $fromName)
                            ->to($correo, $nombre)
                            ->subject('Invitación: ' . $eventoNombre);
                    });
                    Log::info('Correo enviado exitosamente vía SMTP/Laravel a ' . $correo);
                }
            } catch (\Throwable $e) {
                Log::error('Fallo al enviar correo a ' . $correo . ': ' . $e->getMessage());
            }
        }
    }
}

