<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyReportMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $articles;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $articles)
    {
        $this->user = $user;
        $this->articles = $articles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.template', [
            'user' => $this->user,
            'articles' => $this->articles,
        ]);
    }
}
