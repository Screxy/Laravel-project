<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $countArticleView;
    protected $countComment;
    public function __construct(int $countArticleView, int $countComment)
    {
        $this->countArticleView = $countArticleView;
        $this->countComment = $countComment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dvbvladis@mail.ru')->
            view('mail.stat', ['countArticleView' => $this->countArticleView, 'countComment' => $this->countComment]);
    }
}
