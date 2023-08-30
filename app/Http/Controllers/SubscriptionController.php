<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;
class SubscriptionController extends Controller
{
    public static function subscribe(SubscriptionRequest $req){
        $newSubscription =  new Subscription();

        $newSubscription->user_id = $req->user_id;
        $newSubscription->website_id = $req->website_id;

        $newSubscription->save();

        return 200;
    }
}
