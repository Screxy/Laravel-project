<?php

namespace App\Jobs;

use App\Mail\AdminComment;
use App\Mail\ArticleMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Models\Article;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $article;
    protected $comment;
    // public function __construct(string $comment, string $article)
    // {
    //     $this->article = $article;
    //     $this->comment = $comment;
    // }
    public function __construct(Article $article)
    {
        $this->article = $article;
        // $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Mail::to('vladisdvb@gmail.ru')->send(new AdminComment($this->comment, $this->article));
        Mail::to('vladisdvb@gmail.com')->send(new ArticleMail($this->article));
    }
}