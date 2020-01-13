<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\DemoPusherEvent as DemoPusherEvent;

class DemoPusherController extends Controller
{
    public function getPusher(){
        // gọi ra trang view demo-pusher.blade.php
        return view("demo-pusher");
    }
    public function fireEvent(){
        // Truyền message lên server Pusher
        event(new DemoPusherEvent("Test realtime message!"));
        return "Message has been sent.";
    }
}
