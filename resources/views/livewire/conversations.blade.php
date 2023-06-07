<div>
    <div>
        @if ($conversations->isEmpty())
            <p>No conversations found.</p>
        @else
            @foreach ($conversations as $conversation)
                <button wire:click="selectConversation({{ $conversation->id }})">
                    Conversation #{{ $conversation->id }}
                </button>
            @endforeach
        @endif
    </div>


    <div x-data="{ message: '' }" x-show="selectedConversation">
        <div>
            @foreach ($messages as $message)
                <div>
                    {{ $message->content }}
                </div>
            @endforeach
        </div>

        <form x-on:submit.prevent="$wire.sendMessage(message).then(() => { message = '' })">
            <input x-model="message" type="text" placeholder="Type your message">
            <button type="submit">Send</button>
        </form>
    </div>
</div>
