<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNotifikasiApplyDar extends Mailable
{
    use Queueable, SerializesModels;
    public $dataDar;
    public $remarks;
    public $approverName;
    public $usersReq;

    public $roleName;

    public $approvalDate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataDar, $remarks, $approverName, $usersReq, $roleName, $approvalDate)
    {
        $this->dataDar = $dataDar;
        $this->remarks = $remarks;
        $this->approverName = $approverName;
        $this->usersReq = $usersReq;
        $this->roleName = $roleName;
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
            subject: 'Notifikasi Pengajuan Dokumen Action No.Dar - #' . $this->dataDar->number_dar,
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
            view: 'email.reqdar.applydar.apply-dar-action-notif',
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
