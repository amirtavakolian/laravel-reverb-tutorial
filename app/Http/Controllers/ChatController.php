<?php

namespace App\Http\Controllers;

use App\Events\Chat\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function send(Request $request)
    {
        broadcast(new MessageSent(
            $request->message,
            $request->user()?->name ?? 'Anonymous'
        ));

        return response()->json(['status' => 'Message sent']);
    }
}
