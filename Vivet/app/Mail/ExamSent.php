<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class ExamSent extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $recipient;
    public $filePath;

    /**
     * Create a new message instance.
     */
    public function __construct(User $sender, User $recipient, $filePath)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->filePath = $filePath;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Has recibido un nuevo examen')
            ->view('tenant.emails.exams.sent')
            ->attach(storage_path('app/' . $this->filePath));
    }
}
