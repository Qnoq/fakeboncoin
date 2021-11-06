<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $messages = Message::where('seller_id', "=", auth()->user()->id)->get();

        $seller_id = $request['seller_id'];
        $ad_id = $request['ad_id'];

        return view('message', compact('seller_id', 'ad_id', 'messages'));
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->content = $request['content'];
        $message->seller_id = $request['seller_id'];
        $message->buyer_id = $request['buyer_id'];
        $message->ad_id = $request['ad_id'];
        $message->save();

        return back()->with('success', 'Votre message a bien été envoyé');
    }
}
