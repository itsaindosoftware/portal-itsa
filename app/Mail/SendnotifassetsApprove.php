<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendnotifassetsApprove extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $transferData;
    public $remarks;
    public $approverName;
    public $users;
    public function __construct($transferData, $remarks, $approverName, $users)
    {
        $this->transferData = $transferData;
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
            subject: 'Digital Asset Transfer Notification Approved - RFA #' . $this->transferData->rfa_number,
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
                view: 'email.sendnotiftransfer.digital-assets-transfer-acct-approved',
            );
        } elseif ($this->users === 'user-mgr-dept-head') {
            return new Content(
                view: 'email.sendnotiftransfer.digital-assets-transfer-approved-depthead',
            );
        } elseif ($this->users === 'manager-directur') {
            return new Content(
                view: 'email.sendnotiftransfer.digital-assets-transfer-md-approved',
            );
        } elseif ($this->users === 'user-receive-sendnotif-dept') {
            return new Content(
                view: 'email.sendnotiftransfer.digital-assets-transfer-receivedept-approved',
            );
        } elseif ($this->users === 'user-mgr-receive-send-notif-dept') {
            return new Content(
                view: 'email.sendnotiftransfer.digital-assets-transfer-receivedept-depthead-approved',
            );
        } elseif ($this->users === 'user-gm-accfinn-sendnotif') {
            return new Content(
                view: 'email.sendnotiftransfer.digital-assets-transfer-gm-acctfin-approved',
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
