<?php

namespace App\Http\Controllers;
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
    public function submit(PostRequest $req) {

        $posts = new Posts();
        $posts->title = $req->title;
        $posts->post_message = $req->post_message;
        $posts->website_id = $req->website_id;
        $posts->save();

        $subscribers = WebsiteController::getInfo($req->website_id);
        $info = [
            'website_id' => $req->website_id,
            'title' => $req->title,
            'post_message' => $req->post_message,
        ];
        $res=[];
        // Send emails to subscribers
        foreach ($subscribers as $subscriber) {
           if(!Mail::to($subscriber->email)->send(new SendMail($info))){
               array_push($res, $subscriber);
           };
        }

        Artisan::call('mail:send', [
            'subscriptions' => $res,
            'info' => $info
        ]);
    }
}
