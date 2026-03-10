<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Program') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <form method="POST" action="{{ route('programs.store') }}">
                        @csrf

                        <!-- Program Name -->
                        <div class="mt-4">
                            <x-input-label for="program_name" :value="__('Program Name')" />
                            <x-text-input id="program_name" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" type="text" name="program_name" :value="old('program_name')" required autofocus />
                            <x-input-error :messages="$errors->get('program_name')" class="mt-2" />
                        </div>

                        <!-- Faculty -->
                        <div class="mt-4">
                            <x-input-label for="faculty" :value="__('Faculty')" />
                            <x-text-input id="faculty" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" type="text" name="faculty" :value="old('faculty')" required />
                            <x-input-error :messages="$errors->get('faculty')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('programs.index') }}">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-chalimbana-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-chalimbana-gold focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
