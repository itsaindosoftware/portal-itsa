<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendnotiftoMgrSysdev extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $dataDar;
    public $remarks;
    public $approverName;

    public $approvalDate;
    public function __construct($dataDar, $remarks, $approverName, $approvalDate)
    {
        $this->dataDar = $dataDar;
        $this->remarks = $remarks;
        $this->approverName = $approverName;
        $this->approvalDate = $approvalDate;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notifikasi Pengajuan Dokumen Action No.Dar - #' . $this->dataDar->number_dar
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
            view: 'email.reqdar.notif-to-mgr-sysdev',
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
