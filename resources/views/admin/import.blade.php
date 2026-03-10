<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bulk Import Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Programs Import -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-chalimbana-blue">Import Programs</h3>
                        <a href="{{ route('import.template', 'programs') }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-2 py-1 rounded border transition">
                            Download Template
                        </a>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Upload CSV with columns: <code>program_name, faculty</code></p>
                    <form action="{{ route('import.programs') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="block w-full text-sm text-gray-500 mb-4" required>
                        <button type="submit" class="bg-chalimbana-gold text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Upload Programs</button>
                    </form>
                </div>

                <!-- Courses Import -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-chalimbana-blue">Import Courses</h3>
                        <a href="{{ route('import.template', 'courses') }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-2 py-1 rounded border transition">
                            Download Template
                        </a>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Upload CSV with columns: <code>course_code, course_name, program_name, year, semester</code></p>
                    <form action="{{ route('import.courses') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="block w-full text-sm text-gray-500 mb-4" required>
                        <button type="submit" class="bg-chalimbana-gold text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Upload Courses</button>
                    </form>
                </div>

                <!-- Lecturers Import -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-chalimbana-blue">Import Lecturers</h3>
                        <a href="{{ route('import.template', 'lecturers') }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-2 py-1 rounded border transition">
                            Download Template
                        </a>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Upload CSV with columns: <code>name, email, department</code></p>
                    <form action="{{ route('import.lecturers') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="block w-full text-sm text-gray-500 mb-4" required>
                        <button type="submit" class="bg-chalimbana-gold text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Upload Lecturers</button>
                    </form>
                </div>

                <!-- Rooms Import -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-chalimbana-blue">Import Rooms</h3>
                        <a href="{{ route('import.template', 'rooms') }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-2 py-1 rounded border transition">
                            Download Template
                        </a>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Upload CSV with columns: <code>room_name, capacity</code></p>
                    <form action="{{ route('import.rooms') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="block w-full text-sm text-gray-500 mb-4" required>
                        <button type="submit" class="bg-chalimbana-gold text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Upload Rooms</button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="mt-6 p-4 bg-green-100 text-green-700 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mt-6 p-4 bg-red-100 text-red-700 rounded-lg shadow-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
