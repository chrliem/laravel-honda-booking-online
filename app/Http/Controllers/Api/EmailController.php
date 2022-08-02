<?php

namespace App\Http\Controllers\Api;

use App\Mail\NotificationEmail;
use App\Models\User;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function send(Request $request){
        $newBooking = $request->all();
    }
}
