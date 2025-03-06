<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <!-- Session messages -->
    @if (session('success'))
        <div class="bg-orange-500 text-white p-4 rounded-lg mb-4 shadow-md flex items-center justify-between transition-all duration-500 ease-in-out">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
            <button type="button" class="text-white hover:text-orange-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @elseif (session('failed'))
        <div class="bg-red-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between transition-all duration-500 ease-in-out">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('failed') }}
            </div>
            <button type="button" class="text-white hover:text-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Add Employee -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-orange-900">Manage Employees</h2>
        <input type="text" wire:model.live="search" id="search" class="px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" placeholder="Search...">
        <a href="{{ route('employees.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg shadow transition duration-300 ease-in-out flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Employee
        </a>
    </div>

    <!-- Employees Table -->
    <div class="bg-orange-50 shadow-lg rounded-lg overflow-hidden border border-orange-200 mt-6">
        <div class="p-6 border-b border-orange-200">
            <h3 class="text-xl font-semibold text-orange-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Employees
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-orange-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Position</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Department</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Grade</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-orange-200">
                    @foreach($employees as $employee)
                        <tr class="hover:bg-orange-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-orange-900">{{ $employee->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $employee->user->email }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $employee->position->title }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $employee->department->name }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $employee->position->title }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $employee->user->getRoleNames()->implode(',') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('employees.show', $employee) }}" class="px-3 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                    <a href="{{ route('employees.edit', $employee) }}" class="px-3 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                                        Edit
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>