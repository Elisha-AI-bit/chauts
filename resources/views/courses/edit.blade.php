<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <form method="POST" action="{{ route('courses.update', $course->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Course Code -->
                        <div class="mt-4">
                            <x-input-label for="course_code" :value="__('Course Code')" />
                            <x-text-input id="course_code" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" type="text" name="course_code" :value="old('course_code', $course->course_code)" required autofocus />
                            <x-input-error :messages="$errors->get('course_code')" class="mt-2" />
                        </div>

                        <!-- Course Name -->
                        <div class="mt-4">
                            <x-input-label for="course_name" :value="__('Course Name')" />
                            <x-text-input id="course_name" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" type="text" name="course_name" :value="old('course_name', $course->course_name)" required />
                            <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                        </div>

                        <!-- Program Select -->
                        <div class="mt-4">
                            <x-input-label for="program_id" :value="__('Program')" />
                            <select id="program_id" name="program_id" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" required>
                                <option value="" disabled>Select a Program</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ (old('program_id') ?? $course->program_id) == $program->id ? 'selected' : '' }}>
                                        {{ $program->program_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('program_id')" class="mt-2" />
                        </div>

                        <div class="flex space-x-4 mt-4">
                            <!-- Year -->
                            <div class="w-1/2">
                                <x-input-label for="year" :value="__('Year (1-7)')" />
                                <x-text-input id="year" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" type="number" min="1" max="7" name="year" :value="old('year', $course->year)" required />
                                <x-input-error :messages="$errors->get('year')" class="mt-2" />
                            </div>

                            <!-- Semester -->
                            <div class="w-1/2">
                                <x-input-label for="semester" :value="__('Semester (1-3)')" />
                                <x-text-input id="semester" class="block mt-1 w-full border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm" type="number" min="1" max="3" name="semester" :value="old('semester', $course->semester)" required />
                                <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('courses.index') }}">
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
