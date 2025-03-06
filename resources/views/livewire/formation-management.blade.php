<div class="space-y-6 p-6 bg-orange-50 min-h-screen">
    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-orange-500 text-white p-4 rounded-lg shadow-md flex items-center justify-between transition-all duration-500 ease-in-out">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('message') }}
            </div>
            <button type="button" class="text-white hover:text-orange-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    @endif

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-orange-900">Manage Formations</h2>
        <input type="text" wire:model.live="search" id="salary" class="px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" placeholder="Search...">
        <button wire:click="create" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg shadow transition duration-300 ease-in-out flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Formation
        </button>
    </div>

    <!-- Formations Table -->
    <div class="bg-orange-50 shadow-lg rounded-xl overflow-hidden border border-orange-200">
        <div class="p-6 border-b border-orange-200">
            <h3 class="text-lg font-semibold text-orange-900">Formations</h3>
            <p class="text-sm text-orange-700 mt-1">Assign programs</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-orange-200">
                <thead class="bg-orange-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-orange-200">
                @foreach ($formations as $formation)
                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-orange-900">{{ $formation->title }}</td>
                        <td class="px-6 py-4 text-sm text-orange-700">{{ $formation->description }}</td>
                        <td class="px-6 py-4 text-sm text-orange-700">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                {{ $formation->duration }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $formation->id }})"
                                        class="bg-orange-600 hover:bg-orange-700 text-white px-3 py-1 rounded-md shadow-sm transition duration-200 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Edit
                                </button>
                                <button wire:click="delete({{ $formation->id }})"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md shadow-sm transition duration-200 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if(count($formations) === 0)
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-sm text-orange-700">
                            <div class="flex flex-col items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p>No formations found</p>
                                <button wire:click="create" class="mt-3 text-orange-600 hover:text-orange-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
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

    <!-- Light Modal -->
    @if ($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-orange-900 bg-opacity-75 z-50 transition-opacity duration-300">
            <div class="bg-white text-orange-900 p-6 rounded-xl w-full max-w-md shadow-2xl transform transition-all duration-300 border border-orange-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-orange-900">{{ $isEdit ? 'Edit Formation' : 'Add Formation' }}</h2>
                    <button wire:click="$set('isOpen', false)" class="text-orange-500 hover:text-orange-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-orange-700 mb-1">Formation Title</label>
                        <input type="text" id="name" wire:model="title" placeholder="Enter formation title"
                               class="w-full py-2 px-3 bg-orange-100 border border-orange-200 rounded-lg shadow-sm text-orange-900 placeholder-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200">
                        @error('title') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-orange-700 mb-1">Description</label>
                        <textarea id="description" wire:model="description" placeholder="Enter formation description" rows="4"
                                  class="w-full py-2 px-3 bg-orange-100 border border-orange-200 rounded-lg shadow-sm text-orange-900 placeholder-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"></textarea>
                        @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-orange-700 mb-1">Duration</label>
                        <input type="text" id="duration" wire:model="duration" placeholder="e.g. 3 months, 2 weeks"
                               class="w-full py-2 px-3 bg-orange-100 border border-orange-200 rounded-lg shadow-sm text-orange-900 placeholder-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200">
                        @error('duration') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <button wire:click="$set('isOpen', false)"
                            class="px-4 py-2 bg-orange-200 hover:bg-orange-300 text-orange-800 rounded-lg shadow-sm transition duration-200">
                        Cancel
                    </button>
                    <button wire:click="store"
                            class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow-sm transition duration-200">
                        {{ $isEdit ? 'Update Formation' : 'Save Formation' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>