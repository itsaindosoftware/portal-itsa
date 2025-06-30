<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendingnotifRejected extends Mailable
{
    use Queueable, SerializesModels;
    public $digitalAsset;
    public $remarks;
    public $approverName;
    public $users;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($digitalAsset, $remarks, $approverName, $users)
    {
        $this->digitalAsset = $digitalAsset;
        $this->remarks = $remarks;
        $this->approverName = $approverName;
        $this->users = $users;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Digital Asset Rejected - RFA #' . $this->digitalAsset->rfa_number,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        if ($this->users === 'user-acct-digassets') {
            return new Content(
                view: 'email.digital-assets-rejected',
            );
        } elseif ($this->users === 'user-mgr-dept-head') {
            return new Content(
                view: 'email.digital-assets-rejected-mgr',
            );
        }

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
