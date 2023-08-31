<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\WebsiteController;
use App\Mail\SendMail;
class ResendFailedEmails extends Command
{
    protected $signature = 'mail:resend {users} {info}';
    protected $description = 'Resend emails to users who did not receive them';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach ($this->argument('users') as $subscriber) {
            Mail::to($subscriber->email)->send(new SendMail($this->argument('info')));
        }
    }
}
