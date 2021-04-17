<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailModel extends Mailable
{
    use Queueable, SerializesModels;
    public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contenido)
    {
        $this->content  = $contenido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('messageEmail')
        ->attach(public_path('/Files').'/SolicitudDeCotizacion.pdf', [
            'as' => 'Solicitud de contización.pdf',
            'mime' => 'application/pdf',
        ]);;
    }
}
