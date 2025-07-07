<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendnotifrejectDar extends Mailable
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
    public $users;

    public $roleName;

    public $approvalDate;
    public function __construct($dataDar, $remarks, $approverName, $users, $roleName, $approvalDate)
    {
        $this->dataDar = $dataDar;
        $this->remarks = $remarks;
        $this->approverName = $approverName;
        $this->users = $users;
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
            subject: 'Request Document Action No.Dar - #' . $this->dataDar->number_dar,
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
            view: 'email.reqdar.request-dar-action-notif-reject',
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
