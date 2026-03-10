<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Dashboard Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Programs Card -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-chalimbana-gold">
                    <div class="text-sm font-medium text-gray-500 mb-1">Total Programs</div>
                    <div class="text-3xl font-bold text-chalimbana-blue">
                        {{ \App\Models\Program::count() ?? 0 }}
                    </div>
                </div>

                <!-- Courses Card -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-chalimbana-gold">
                    <div class="text-sm font-medium text-gray-500 mb-1">Total Courses</div>
                    <div class="text-3xl font-bold text-chalimbana-blue">
                        {{ \App\Models\Course::count() ?? 0 }}
                    </div>
                </div>

                <!-- Lecturers Card -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-chalimbana-gold">
                    <div class="text-sm font-medium text-gray-500 mb-1">Total Lecturers</div>
                    <div class="text-3xl font-bold text-chalimbana-blue">
                        {{ \App\Models\Lecturer::count() ?? 0 }}
                    </div>
                </div>

                <!-- Timetables Card -->
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-chalimbana-gold">
                    <div class="text-sm font-medium text-gray-500 mb-1">Timetables Generated</div>
                    <div class="text-3xl font-bold text-chalimbana-blue">
                        {{ \App\Models\Timetable::count() ?? 0 }}
                    </div>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Welcome to Chalimbana Smart Timetable System</h3>
                    <p class="text-gray-600">You are logged in as {{ Auth::user()->role }}. Please use the sidebar to navigate through the system.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
