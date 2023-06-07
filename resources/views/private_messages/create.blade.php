<x-app-layout>
    <div class="bg-[#242424] shadow-md py-2 px-4 rounded-md mt-4 mb-4 text-gray-400 uppercase font-bold">
        <div class="flex space-x-2 items-center">
            <a href="{{ route('home') }}">Home</a>
            @if ($user)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-4 h-4 text-neutral-500">
                    <path fill-rule="evenodd"
                        d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
                <span class="">{{ $user->username }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-4 h-4 text-neutral-500">
                    <path fill-rule="evenodd"
                        d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                        clip-rule="evenodd" />
                </svg>
                <span class="">Send message</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-[#202020] px-4 py-4 rounded-md shadow-md">
            <h1 class="text-neutral-200 font-bold text-xl mb-2">Send Message to {{ $user->username }}</h1>

            @livewire('conversations', ['receiverId' => $user->id])

            {{-- <form method="POST" action="{{ route('messages.store', $user) }}">
                @csrf
                <div class="form-group mb-2">
                    <x-input-label for="subject" class="text-neutral-300" :value="__('Subject')" />
                    <x-text-input id="subject" class="block mt-1 w-full text-neutral-300" type="text" name="subject" :value="old('subject')" required autofocus />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>
                <div class="form-group">
                    <x-input-label for="subject" class="text-neutral-300" :value="__('Message')" />
                    <textarea class="w-full mb-4 mt-1 block text-neutral-400 bg-[#252525] border border-[#303030] rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#353535] focus:border-[#353535] sm:text-sm" name="message" id="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="inline-flex items-center md:px-4 px-3 md:py-2 py-1 bg-[#252525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#191919] focus:bg-[#191919] active:bg-[#222222] focus:outline-none transition ease-in-out duration-150">Send Message</button>
            </form> --}}
        </div>
        <div class="bg-[#202020] px-4 py-4 rounded-md shadow-md">
            <h2 class="text-xl text-neutral-200 font-bold">Information</h2>
            <p class="text-neutral-400 font-bold mt-2">Please keep in mind that these messages are not encrypted in any given way, and that you should be careful with what you write to other people...</p>
        </div>
    </div>

</x-app-layout>
