<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <form method="POST" action="{{ route('rooms.update', $room->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Room Name -->
                        <div class="mt-4">
                            <x-input-label for="room_name" :value="__('Room Name')" />
                            <x-text-input id="room_name" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" type="text" name="room_name" :value="old('room_name', $room->room_name)" required autofocus />
                            <x-input-error :messages="$errors->get('room_name')" class="mt-2" />
                        </div>

                        <!-- Capacity -->
                        <div class="mt-4">
                            <x-input-label for="capacity" :value="__('Capacity')" />
                            <x-text-input id="capacity" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" type="number" name="capacity" :value="old('capacity', $room->capacity)" required />
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('rooms.index') }}">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-chalimbana-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-chalimbana-gold focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
