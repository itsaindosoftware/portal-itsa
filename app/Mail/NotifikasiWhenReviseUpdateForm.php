<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiWhenReviseUpdateForm extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $remarks;
    public $approverName;
    public $getUserReq;

    public $getDataDar;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $remarks, $approverName, $getUserReq, $getDataDar)
    {
        $this->data = $data;
        $this->remarks = $remarks;
        $this->approverName = $approverName;
        $this->getUserReq = $getUserReq;
        $this->getDataDar = $getDataDar;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notifkasi Perubahan Formulir DAR Berhasil Direvisi',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.reqdar.notif-when-updaterevise-form',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
