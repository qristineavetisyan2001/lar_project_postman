<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public static function getInfo($website_id){
        $subscribers = DB::table('users')
            ->join('subscription', 'subscription.user_id', '=', 'users.id')
            ->where('subscription.website_id', $website_id)
            ->get();

        return $subscribers ;
    }
}
