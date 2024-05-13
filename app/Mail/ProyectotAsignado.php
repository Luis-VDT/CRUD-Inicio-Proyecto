<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Proyecto;
use App\Models\Empleados;

class ProyectotAsignado extends Mailable
{
    use Queueable, SerializesModels;
    public $proyecto;
    public $empleado;

    public function __construct(Proyecto $proyecto, Empleados $empleado)
    {
        $this->proyecto = $proyecto;
        $this->empleado = $empleado;
    }

    public function build()
    {
        return $this->markdown('emails.proyecto_asignado')
                    ->with([
                        'proyecto' => $this->proyecto,
                        'empleado' => $this->empleado,
                    ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Proyectot Asignado',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

