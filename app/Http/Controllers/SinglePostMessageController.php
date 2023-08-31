<?php

namespace App\Http\Controllers;

use App\Models\SinglePostMessage;
use Illuminate\Http\Request;

class SinglePostMessageController extends Controller
{
    public static function setSinglePostMessage($user_id, $sended){
        $singlePostMessage = new SinglePostMessage();

        $singlePostMessage->user_id = $user_id;
        $singlePostMessage->sended = $sended;

        $singlePostMessage->save();
    }


    public static function getNotSendedFollowers(){
        return SinglePostMessage::all()->where('sended', '=', 0);
    }
}
