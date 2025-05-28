<div class="mt-8">
    <!-- Formations Section -->
    <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Formations & Training
            </h2>
            <button wire:click="openModal" 
                    class="inline-flex items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-orange-600 shadow-sm transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Assign Formation
            </button>
        </div>

        <!-- Formations List -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Formation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($employeeFormations as $formation)
                        <tr class="hover:bg-orange-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $formation->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($formation->pivot->start_date)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($formation->pivot->end_date)->format('d/m/Y')}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $formation->pivot->status === 'completed' ? 'bg-green-100 text-green-700' : 
                                       ($formation->pivot->status === 'in_progress' ? 'bg-orange-100 text-orange-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($formation->pivot->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No formations assigned yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div x-data="{ show: @entangle('showModal') }"
         x-show="show"
         x-cloak
         class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm z-50 flex items-center justify-center"
         style="display: none;">
        <div class="relative bg-white rounded-lg shadow-lg p-6 max-w-lg w-full border border-gray-200">
            <div class="absolute right-0 top-0 pr-4 pt-4">
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="assignFormation">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Assign Formation</h3>
                <!-- Formation Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Formation</label>
                    <select wire:model="selectedFormation" 
                            class="mt-1 block w-full rounded-md bg-white border border-gray-300 text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                        <option value="">Select Formation</option>
                        @foreach($formations as $formation)
                            <option value="{{ $formation->id }}">{{ $formation->title }}</option>
                        @endforeach
                    </select>
                    @error('selectedFormation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Start Date -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" 
                           wire:model="startDate" 
                           class="mt-1 block w-full rounded-md bg-white border border-gray-300 text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                    @error('startDate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- End Date -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" 
                           wire:model="endDate" 
                           class="mt-1 block w-full rounded-md bg-white border border-gray-300 text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                    @error('endDate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="status" 
                            class="mt-1 block w-full rounded-md bg-white border border-gray-300 text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" 
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-500 text-base font-medium text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-300 transition-all duration-200">
                        Assign Formation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>