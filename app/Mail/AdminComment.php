<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class AdminComment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $article;
    protected $comment;
    public function __construct(string $comment, string $article)
    {
        $this->article = $article;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('postmaster@sandbox2e470e7155ba4eebb05be8969d3a731f.mailgun.org')->
            view('mail.comment', ['article' => $this->article, 'comment'=>$this->comment]);
    }
}
