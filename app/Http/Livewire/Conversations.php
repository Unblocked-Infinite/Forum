<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Conversation;
use App\Models\PrivateMessage;
use Illuminate\Support\Facades\Validator;

class Conversations extends Component
{
    public $conversations;
    public $selectedConversation;
    public $messages = [];
    public $receiverId;
    public $receiver;

    public function mount($receiverId = null)
    {
        $this->conversations = auth()->user()->conversations;

        if ($receiverId) {
            $this->receiver = User::find($receiverId);
        }
    }

    public function selectConversation($conversationId)
    {
        $this->selectedConversation = Conversation::findOrFail($conversationId);
        $this->messages = $this->selectedConversation->messages;
    }

    public function sendMessage($messageContent)
    {
        // Validate message content
        $validator = Validator::make(
            ['messageContent' => $messageContent],
            [
                'messageContent' => 'required|min:1|max:1000',
            ]
        );

        if ($validator->fails()) {
            return $this->setErrorBag($validator->getMessageBag());
        }

        $validatedData = $validator->validated();

        // Find or create a conversation between the sender and receiver
        $sender = auth()->user();

        $conversation = Conversation::firstOrNew([
            'sender_id' => $sender->id,
            'receiver_id' => $this->receiver->id,
        ]);

        if (!$conversation->exists) {
            $conversation->sender_id = $sender->id;
            $conversation->receiver_id = $this->receiver->id;
            $conversation->save();
        }

        // // Associate the conversation with the sender and receiver
        // $conversation->sender()->associate($sender);

        // Save the message with the conversation_id
        $message = new PrivateMessage([
            'content' => $validatedData['messageContent'],
        ]);
        $message->conversation()->associate($conversation);
        $message->user()->associate($sender);
        $message->save();

        // Update $this->messages with the new message
        $this->messages = $conversation->messages;
    }

    public function render()
    {
        return view('livewire.conversations');
    }
}
