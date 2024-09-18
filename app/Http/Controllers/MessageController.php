<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $socketId=$request->input('socket_id');

        // Trigger the event
        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }
}
