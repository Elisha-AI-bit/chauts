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
                    <h3 class="text-lg font-bold text-chalimbana-blue mb-4">Import Programs</h3>
                    <p class="text-sm text-gray-600 mb-4">Upload CSV with columns: <code>program_name, faculty</code></p>
                    <form action="{{ route('import.programs') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="block w-full text-sm text-gray-500 mb-4" required>
                        <button type="submit" class="bg-chalimbana-gold text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Upload Programs</button>
                    </form>
                </div>

                <!-- Courses Import -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-chalimbana-blue mb-4">Import Courses</h3>
                    <p class="text-sm text-gray-600 mb-4">Upload CSV with columns: <code>course_code, course_name, program_id, year, semester</code></p>
                    <form action="{{ route('import.courses') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="block w-full text-sm text-gray-500 mb-4" required>
                        <button type="submit" class="bg-chalimbana-gold text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Upload Courses</button>
                    </form>
                </div>

                <!-- Lecturers Import -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-chalimbana-blue mb-4">Import Lecturers</h3>
                    <p class="text-sm text-gray-600 mb-4">Upload CSV with columns: <code>name, email, department</code></p>
                    <form action="{{ route('import.lecturers') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="block w-full text-sm text-gray-500 mb-4" required>
                        <button type="submit" class="bg-chalimbana-gold text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Upload Lecturers</button>
                    </form>
                </div>

                <!-- Rooms Import -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-chalimbana-blue mb-4">Import Rooms</h3>
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
