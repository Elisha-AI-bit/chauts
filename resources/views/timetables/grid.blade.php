<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Timetable Grid') }}
            </h2>
            <div class="flex space-x-2">
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                <form action="{{ route('timetables.generate') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-chalimbana-blue text-white rounded-md hover:bg-blue-800 transition shadow-sm">
                        Generate Timetable
                    </button>
                </form>
                @endif
                <button onclick="window.print()" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition shadow-sm">
                    Print / PDF
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filters (Admin Only) -->
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
            <div class="bg-white p-4 rounded-lg shadow-sm mb-6 flex items-center justify-between">
                <form action="{{ route('timetables.index') }}" method="GET" class="flex items-center space-x-4">
                    <div>
                        <label for="program_id" class="block text-sm font-medium text-gray-700">Filter by Program</label>
                        <select name="program_id" onchange="this.form.submit()" class="mt-1 block w-64 border-gray-300 focus:border-chalimbana-gold focus:ring-chalimbana-gold rounded-md shadow-sm">
                            <option value="">All Programs</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ $selected_program == $program->id ? 'selected' : '' }}>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="text-sm text-gray-500 italic">
                    * Showing 1-hour slots from 08:00 to 18:00
                </div>
            </div>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Timetable Grid -->
            <div x-data="{ open: false, selected: null }" class="bg-white overflow-hidden shadow-sm rounded-lg overflow-x-auto">
                <table class="w-full border-collapse table-fixed min-w-[1000px]">
                    <thead>
                        <tr class="bg-chalimbana-blue text-white">
                            <th class="p-3 border text-center w-32">Time / Day</th>
                            @foreach($days as $day)
                                <th class="p-3 border text-center">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slots as $slot_time)
                            <tr>
                                <td class="p-3 border font-semibold bg-chalimbana-light text-chalimbana-blue text-center">
                                    {{ \Carbon\Carbon::parse($slot_time)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($slot_time)->addHours(1)->format('H:i') }}
                                </td>
                                @foreach($days as $day)
                                    @php
                                        $entry = $timetables->get($day)?->first(function($t) use ($slot_time) {
                                            return $t->start_time == $slot_time;
                                        });
                                    @endphp
                                    <td class="p-2 border h-32 align-top text-xs relative group hover:bg-chalimbana-light transition">
                                        @if($entry)
                                            <div @click="selected = {{ json_encode($entry->load(['course', 'lecturer.user', 'room'])) }}; open = true" 
                                                 class="bg-blue-50 border-l-4 border-chalimbana-gold p-2 h-full rounded shadow-xs overflow-hidden cursor-pointer hover:bg-blue-100 transition">
                                                <div class="font-bold text-chalimbana-blue mb-1">{{ $entry->course->course_code }}</div>
                                                <div class="text-gray-700 truncate" title="{{ $entry->course->course_name }}">{{ $entry->course->course_name }}</div>
                                                <div class="mt-2 text-gray-500 font-medium">📍 {{ $entry->room->room_name }}</div>
                                                <div class="text-gray-500">👨‍🏫 {{ $entry->lecturer->user->name }}</div>
                                            </div>
                                        @else
                                            <div class="h-full flex items-center justify-center text-gray-200">
                                                -
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal Overlay -->
                <div x-show="open" 
                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
                     x-cloak
                     @keydown.escape.window="open = false">
                    
                    <!-- Modal Content -->
                    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full overflow-hidden" 
                         @click.away="open = false">
                        <div class="bg-chalimbana-blue p-4 flex justify-between items-center">
                            <h3 class="text-white font-bold text-lg" x-text="selected?.course.course_code + ' - Summary'"></h3>
                            <button @click="open = false" class="text-white hover:text-chalimbana-gold">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="text-xs text-gray-500 uppercase font-bold tracking-wider">Course Name</label>
                                <div class="text-lg text-chalimbana-blue font-semibold" x-text="selected?.course.course_name"></div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold tracking-wider">Lecturer</label>
                                    <div class="text-gray-900" x-text="selected?.lecturer.user.name"></div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold tracking-wider">Room</label>
                                    <div class="text-gray-900" x-text="selected?.room.room_name + ' (' + selected?.room.capacity + ' Seats)'"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold tracking-wider">Day</label>
                                    <div class="text-gray-900" x-text="selected?.day"></div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold tracking-wider">Time Slot</label>
                                    <div class="text-gray-900" x-text="selected?.start_time + ' - ' + selected?.end_time"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 text-right">
                            <button @click="open = false" class="px-4 py-2 bg-chalimbana-blue text-white rounded hover:bg-blue-800 transition">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
