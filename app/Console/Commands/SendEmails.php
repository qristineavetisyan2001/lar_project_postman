<?php

namespace App\Console\Commands;

use App\Http\Controllers\SinglePostMessageController;
use App\Mail\SendMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-mail {subscribers} {info}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach ($this->argument('subscribers') as $subscriber) {
            if (Mail::queue($subscriber->email)->send(new SendMail($this->argument('info')))) {
                SinglePostMessageController::setSinglePostMessage($this->argument('subscribers')->user_id, 1);
            } else {
                SinglePostMessageController::setSinglePostMessage($this->argument('subscribers')->user_id, 0);
            }
        }
    }
}
