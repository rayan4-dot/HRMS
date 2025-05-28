<div class="space-y-6 p-6 bg-gray-50 min-h-screen">
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

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Manage Formations</h2>
        <div class="flex items-center gap-4">
            <div class="relative">
                <input type="text" 
                       wire:model.live="search" 
                       id="salary" 
                       class="pl-10 pr-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none text-sm" 
                       placeholder="Search...">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <button wire:click="create" 
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2.5 rounded-lg shadow-sm transition-all duration-300 ease-in-out flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Formation
            </button>
        </div>
    </div>

    <!-- Formations Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Formations
            </h3>
            <p class="text-sm text-gray-500 mt-1">Manage your training programs and courses</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($formations as $formation)
                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-700">{{ $formation->title }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $formation->description }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-700">
                                {{ $formation->duration }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-3">
                                <button wire:click="edit({{ $formation->id }})"
                                        class="group flex items-center px-3 py-1.5 bg-orange-100 text-orange-700 rounded-md hover:bg-orange-200 transition-all duration-200 ease-in-out border border-orange-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </button>
                                <button wire:click="delete({{ $formation->id }})"
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
                @if(count($formations) === 0)
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p>No formations found</p>
                                <button wire:click="create" class="mt-3 text-orange-600 hover:text-orange-700 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add your first formation
                                </button>
                            </div>
                        </td>
                    </tr>
                @endif
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
                        <h2 class="text-xl font-bold text-gray-800">{{ $isEdit ? 'Edit Formation' : 'Add Formation' }}</h2>
                        <button wire:click="$set('isOpen', false)" class="text-gray-400 hover:text-gray-600 focus:outline-none transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Formation Title</label>
                            <input type="text" 
                                   id="name" 
                                   wire:model="title" 
                                   placeholder="Enter formation title"
                                   class="bg-white border border-gray-300 text-gray-700 placeholder-gray-400 rounded-md shadow-sm w-full px-4 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                            @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" 
                                      wire:model="description" 
                                      placeholder="Enter formation description" 
                                      rows="4"
                                      class="bg-white border border-gray-300 text-gray-700 placeholder-gray-400 rounded-md shadow-sm w-full px-4 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none"></textarea>
                            @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                            <input type="text" 
                                   id="duration" 
                                   wire:model="duration" 
                                   placeholder="e.g. 3 months, 2 weeks"
                                   class="bg-white border border-gray-300 text-gray-700 placeholder-gray-400 rounded-md shadow-sm w-full px-4 py-2 focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                            @error('duration') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <button wire:click="$set('isOpen', false)" 
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-md transition-colors duration-200 border border-gray-300">
                            Cancel
                        </button>
                        <button wire:click="store"
                                class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-md shadow-sm transition-colors duration-200">
                            {{ $isEdit ? 'Update Formation' : 'Save Formation' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>