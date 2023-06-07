<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Conversation;

class Messages extends Component
{
    public $messages;
    public $content;
    public $conversation;

    protected $rules = [
        'content' => 'required',
    ];

    public function mount(User $user)
    {
        $this->conversation = Conversation::findOrCreate(auth()->id(), $user->id);
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = $this->conversation->messages()->with('user')->get();
    }

    public function sendMessage()
    {
        $this->validate();
        $this->conversation->messages()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->content = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.messages');
    }
}
