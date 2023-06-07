<div>
    <h2>Messages</h2>
    <ul>
        @foreach ($messages as $message)
            <li>
                <strong>{{ $message->user->name }}:</strong> {{ $message->content }}
            </li>
        @endforeach
    </ul>

    <form wire:submit.prevent="sendMessage">
        <input type="text" wire:model="content" placeholder="Type your message...">
        @error('content')
            <span>{{ $message }}</span>
        @enderror
        <button type="submit">Send</button>
    </form>
</div>
