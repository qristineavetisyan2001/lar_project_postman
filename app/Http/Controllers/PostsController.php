<?php

namespace App\Http\Controllers;
use App\Http\Controllers\SinglePostMessageController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\AssignOp\Concat;
use App\Models\Posts;
use App\Mail\SendMail;
use App\Http\Controllers\WebsiteController;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Artisan;

class PostsController extends Controller
{
    public function submit(PostRequest $req, Schedule $schedule) {

        $post = new Posts();
        $post->title = $req->title;
        $post->post_message = $req->post_message;
        $post->website_id = $req->website_id;
        $post->save();

        $subscribers = WebsiteController::getInfo($req->website_id);
        $info = [
            'website_id' => $req->website_id,
            'title' => $req->title,
            'post_message' => $req->post_message,
        ];

        // Send emails to subscribers

        $date = date("Y-m-d");
        $time = date("h:i:s");

        $date = str_replace("-", "_", $date);
        $time = str_replace(":", "", $time);

        $currentTime = $date."_".$time;

        $tableName = "SinglePostMessage_".$currentTime;

        Artisan::call('make:migration', [
            'name' => 'create'.$tableName,
            '--create' => $tableName,
        ]);

        sleep(10);

        Artisan::call('migrate', [
            '--path' => 'database/migrations/'.$currentTime.'_create_single_post_message_'.$currentTime.'.php',
        ]);

        Artisan::call('mail:send', [
            'subscribers' => $subscribers,
            'info' => $info
        ]);

        SinglePostMessageController::getNotSendedFollowers()?Artisan::call('mail:resend', [
            'users' => SinglePostMessageController::getNotSendedFollowers(),
            'info' => $info
        ]):"";
    }
}
