<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScheduleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private $data)  //phương thức send(new ScheduleMail($data)) trong AgentPropertyController
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Schedule Is Confirm',   //message hiển thị ở tiêu đề của gmail
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $schedule=$this->data;   //trả về  trang schedule_mail trong thư mục mail với dữ liệu $schedule
        return new Content(
            view: 'mail.schedule_mail',
            with: ['schedule'=>$schedule],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
