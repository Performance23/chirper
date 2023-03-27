<div class="mt-6 shadow-sm rounded-lg">
    @foreach ($chirps as $chirp)
        <div class="p-6 flex space-x-2 mb-3 bg-white shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-800">{{ $chirp->user->name }}</span>
                        <small
                            class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                        @unless($chirp->created_at->eq($chirp->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('modifié') }}</small>
                        @endunless
                    </div>
                    @if ($chirp->user->is(auth()->user()))
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                    {{ __('Modifier') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                    @csrf
                                    @method('delete')
                                    <x-dropdown-link :href="route('chirps.destroy', $chirp)"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Supprimer') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>
                <p class="mt-4 text-lg text-gray-900 break-all">{{ $chirp->message }}</p>
                <x-actions :chirp="$chirp"></x-actions>
            </div>
        </div>
        <div x-data="{ openResponse: false }" @click.outside="openResponse = false" @close.stop="openResponse = false"
            class="mb-5">
            <div class="flex justify-end">
                <button @click="openResponse = !openResponse" class="bg-gray-900 text-white py-2 px-3 rounded-md  mb-5">
                    Repondre
                </button>
            </div>

            <div class="flex flex-col items-end" x-show="openResponse">
                <form method="POST" action="{{ route('replies.store') }}" class="w-11/12 mb-5 flex flex-col items-end">
                    @csrf
                    <textarea name="message" placeholder="{{ __('Reponse...') }}"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    <x-text-input id="password" name="chirp_id" :value="$chirp->id" type="password" class="hidden" />
                    <x-primary-button class="mt-4">{{ __('Repondre') }}</x-primary-button>
                </form>
                @foreach ($chirp->replies as $chirp)
                    <div class="p-6  space-x-2 mb-3 bg-white shadow-sm flex w-11/12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $chirp->user->name }}</span>
                                    <small
                                        class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                                    @unless($chirp->created_at->eq($chirp->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('modifié') }}</small>
                                    @endunless
                                </div>
                                @if ($chirp->user->is(auth()->user()))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                                {{ __('Modifier') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('chirps.destroy', $chirp)"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Supprimer') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                            </div>
                            <p class="mt-4 text-lg text-gray-900 break-all">{{ $chirp->message }}</p>
                        </div>
                        <div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
