<?php

namespace Webkul\GDPR\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminUpdateDataRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminUpdateRequest;

    public function __construct($adminUpdateRequest) {
        $this->adminUpdateRequest = $adminUpdateRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [
                new Address(
                    $this->adminUpdateRequest['email'],
                ),
            ],
            subject: "Request Status",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'gdpr::emails.customers.admin-update-data-request',
            with: [
                'adminUpdateRequest' => $this->adminUpdateRequest,
            ],
        );
    }
}
