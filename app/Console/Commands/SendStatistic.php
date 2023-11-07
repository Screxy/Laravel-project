<?php

namespace App\Console\Commands;

use App\Mail\StatMail;
use App\Models\Comment;
use App\Models\Path;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SendStatistic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendStatistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $countShowArticle = Path::all()->count();
        Path::whereNotNull('id')->delete();
        $countComment = Comment::whereDate('created_at', Carbon::today())->count();
        Mail::to('vladisdvb@gmail.com')->send(new StatMail($countShowArticle, $countComment));
        return 0;
    }
}
