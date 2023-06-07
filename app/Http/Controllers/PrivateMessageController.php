<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PrivateMessage;

class PrivateMessageController extends Controller
{
    public function create(User $user)
    {
        return view('private_messages.create', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        // $request->validate([
        //     'subject' => 'required|max:255',
        //     'message' => 'required|min:10|max:1000',
        // ]);

        $privateMessage = new PrivateMessage([
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);

        // $request->user()->sentMessages()->save($privateMessage);
        // $user->receivedMessages()->save($privateMessage);

        // associate
        $privateMessage->sender()->associate($request->user());
        $privateMessage->receiver()->associate($user);

        // save the message to the database
        $privateMessage->save();

        return redirect()->route('user.inbox')->with('success', 'Message sent successfully.');
    }

    public function inbox(Request $request)
    {
        $messages = $request->user()->receivedMessages()->orderBy('created_at', 'desc')->get();
        return view('private_messages.inbox', compact('messages'));
    }

    public function sent(Request $request)
    {
        $messages = $request->user()->sentMessages()->orderBy('created_at', 'desc')->get();
        return view('private_messages.sent', compact('messages'));
    }

    public function show(PrivateMessage $privateMessage)
    {
        return view('private_messages.show', compact('privateMessage'));
    }
}
