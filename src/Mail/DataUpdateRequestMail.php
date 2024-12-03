<?php

namespace Webkul\GDPR\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DataUpdateRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataUpdateRequest;

    public function __construct($dataUpdateRequest)
    {
        $this->dataUpdateRequest = $dataUpdateRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [
                new Address(
                    $this->dataUpdateRequest['email'],
                ),
            ],
            subject: trans('gdpr::app.mail.new-data-request.new-request-for-data-update'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'gdpr::emails.customers.new-data-request',
            with: [
                'dataRequest' => $this->dataUpdateRequest,
            ],
        );
    }
}
