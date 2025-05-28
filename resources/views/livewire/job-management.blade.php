<div class="space-y-6 p-6 bg-gray-50">
    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded-md shadow-sm transform transition-all duration-300 ease-in-out">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('message') }}
                </div>
                <button type="button" class="text-green-700 hover:text-green-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Add Job Button -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Manage Jobs</h2>
        <button wire:click="create" 
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2.5 rounded-lg shadow-sm transition-all duration-300 ease-in-out flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Job
        </button>
    </div>

    <!-- Jobs Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Jobs
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($jobs as $job)
                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">{{ $job->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">{{ $job->department->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $job->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-3">
                                <button wire:click="edit({{ $job->id }})"
                                        class="group flex items-center px-3 py-1.5 bg-orange-100 text-orange-700 rounded-md hover:bg-orange-200 transition-all duration-200 ease-in-out border border-orange-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                                <button wire:click="delete({{ $job->id }})"
                                        class="group flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-md hover:bg-red-100 transition-all duration-200 ease-in-out border border-red-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
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
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 backdrop-blur-sm z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md border border-gray-200 transform transition-all duration-300 ease-in-out">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-800">{{ $isEdit ? 'Edit Job' : 'Add Job' }}</h2>
                        <button wire:click="$set('isOpen', false)" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Job Name</label>
                            <input type="text" 
                                   id="name" 
                                   wire:model="title" 
                                   placeholder="Enter job title"
                                   class="bg-white border border-gray-300 text-gray-700 placeholder-gray-400 rounded-md shadow-sm w-full px-4 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                            @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select id="department_id" 
                                    wire:model="department_id" 
                                    class="bg-white border border-gray-300 text-gray-700 rounded-md shadow-sm w-full px-4 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" 
                                      wire:model="description" 
                                      placeholder="Enter job description" 
                                      rows="4"
                                      class="bg-white border border-gray-300 text-gray-700 placeholder-gray-400 rounded-md shadow-sm w-full px-4 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none"></textarea>
                            @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <button wire:click="$set('isOpen', false)" 
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-md transition-colors duration-200 border border-gray-300">
                            Cancel
                        </button>
                        <button wire:click="store"
                                class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-md shadow-sm transition-colors duration-200">
                            {{ $isEdit ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>