<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lecturers') }}
            </h2>
            <a href="{{ route('lecturers.create') }}" class="px-4 py-2 bg-chalimbana-gold text-white rounded-md hover:bg-yellow-600 transition">
                Add Lecturer Profile
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-chalimbana-light text-chalimbana-blue">
                                <th class="py-3 px-4 font-semibold border-b">Name</th>
                                <th class="py-3 px-4 font-semibold border-b">Email</th>
                                <th class="py-3 px-4 font-semibold border-b">Department</th>
                                <th class="py-3 px-4 font-semibold border-b text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lecturers as $lecturer)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $lecturer->user->name }}</td>
                                    <td class="py-3 px-4">{{ $lecturer->user->email }}</td>
                                    <td class="py-3 px-4">{{ $lecturer->department }}</td>
                                    <td class="py-3 px-4 text-right">
                                        <a href="{{ route('lecturers.edit', $lecturer->id) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                                        <form action="{{ route('lecturers.destroy', $lecturer->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this lecturer profile?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-500">No lecturers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $lecturers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
