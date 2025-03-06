<div class="space-y-6">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-800 leading-tight">
            {{ __('Departments Management') }}
        </h2>
    </x-slot>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-orange-500 text-white p-3 rounded-md shadow-lg transform transition-all duration-300 ease-in-out">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    <!-- Add Department Button -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-orange-800">Manage Departments</h2>
        <input type="text" wire:model.live="search" id="search" class="px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" placeholder="Search...">
        <button wire:click="create" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg shadow-md transition-all duration-300 ease-in-out flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Department
        </button>
    </div>

    <!-- Departments Table -->
    <div class="bg-orange-50 shadow-lg rounded-lg overflow-hidden border border-orange-200">
        <div class="p-6 border-b border-orange-200">
            <h3 class="text-xl font-semibold text-orange-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Departments
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-orange-200">
                <thead class="bg-orange-100">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Description</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-orange-200">
                @foreach ($departments as $department)
                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-orange-900">{{ $department->name }}</td>
                        <td class="px-6 py-4 text-sm text-orange-700">{{ $department->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-3">
                                <button wire:click="edit({{ $department->id }})" 
                                        class="px-3 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $department->id }})" 
                                        class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    @if ($isOpen)
        <div class="fixed inset-0 bg-orange-900 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6 border border-orange-200">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-orange-900">{{ $isEdit ? 'Edit Department' : 'Add Department' }}</h2>
                    <button wire:click="$set('isOpen', false)" 
                            class="text-orange-500 hover:text-orange-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-orange-700 mb-1">Department Name</label>
                        <input type="text" id="name" wire:model="name" placeholder="Department Name"
                               class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900">
                        @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-orange-700 mb-1">Description</label>
                        <textarea id="description" wire:model="description" placeholder="Description" rows="4"
                                  class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900"></textarea>
                        @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <button wire:click="$set('isOpen', false)" 
                            class="px-4 py-2 bg-orange-200 text-orange-800 rounded-md hover:bg-orange-300">
                        Cancel
                    </button>
                    <button wire:click="store"
                            class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                        {{ $isEdit ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>