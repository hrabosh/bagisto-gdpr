<?php

namespace Webkul\GDPR\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DataDeleteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataDeleteRequest;

    public function __construct($dataDeleteRequest)
    {
        $this->dataDeleteRequest = $dataDeleteRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [
                new Address(
                    $this->dataDeleteRequest['email'],
                ),
            ],
            subject: trans('gdpr::app.mail.new-data-request.new-request-for-data-delete'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'gdpr::emails.customers.new-data-request',
            with: [
                'dataRequest' => $this->dataDeleteRequest,
            ],
        );
    }
}
