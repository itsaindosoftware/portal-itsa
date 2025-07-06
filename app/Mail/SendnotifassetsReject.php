<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendnotifassetsReject extends Mailable
{
    use Queueable, SerializesModels;
    public $transferData;
    public $remarks;
    public $approverName;
    public $users;

    public $roleName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transferData, $remarks, $approverName, $users, $roleName)
    {
        $this->transferData = $transferData;
        $this->remarks = $remarks;
        $this->approverName = $approverName;
        $this->users = $users;
        $this->roleName = $roleName;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Digital Asset Transfer Notification Rejected - RFA #' . $this->transferData->rfa_number,
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
            view: 'email.sendnotiftransfer.digital-assets-transfer-reject-sendnotif',
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
