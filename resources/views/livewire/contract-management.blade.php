<div class="space-y-6 bg-gray-50">
    <!-- Flash Message -->
    @if(session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-sm">
            {{ session('error') }}
        </div>
    @elseif(session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded-md shadow-sm transform transition-all duration-300 ease-in-out">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Manage Contracts</h2>
        <div class="flex items-center gap-4">
            <div class="relative">
                <input type="text" wire:model.live="search" id="salary" class="pl-10 pr-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" placeholder="Search...">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <!-- Add Contract Button -->
            <button wire:click="create" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2.5 rounded-lg shadow-sm transition-all duration-300 ease-in-out flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Contract
            </button>
        </div>
    </div>

    <!-- Contracts Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <div class="p-5 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Contracts
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contract Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($contracts as $contract)
                        <tr class="hover:bg-orange-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">{{ $contract->employee->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $contract->type->type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $contract->startDate }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $contract->endDate }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $contract->salary }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $contract->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $contract->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <button wire:click="edit({{ $contract->id }})" class="px-3 py-1.5 bg-orange-100 text-orange-700 rounded-md hover:bg-orange-200 transition-colors duration-200 border border-orange-200">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $contract->id }})" class="px-3 py-1.5 bg-red-50 text-red-600 rounded-md hover:bg-red-100 transition-colors duration-200 border border-red-200">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    
        <!-- Contract Modal -->
        <div class="@if(!$isOpen) hidden @endif fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center backdrop-blur-sm">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6 border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Contract Details</h3>
    
                <!-- User Selection -->
                <label for="user" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                <select wire:model="employee_id" id="user" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                    <option value="">Select User</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                    @endforeach 
                </select>
                @error('employee_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
    
                <!-- Contract Type Selection -->
                <label for="contractType" class="block text-sm font-medium text-gray-700 mt-4 mb-1">Contract Type</label>
                <select wire:model="contractType" id="contractType" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                    <option value="">Select Type</option>
                    @foreach($contractTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
                @error('contractType') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
    
                <!-- Start Date -->
                <label for="startDate" class="block text-sm font-medium text-gray-700 mt-4 mb-1">Start Date</label>
                <input type="date" wire:model="startDate" id="startDate" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                @error('startDate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

                <!-- End Date -->
                <label for="endDate" class="block text-sm font-medium text-gray-700 mt-4 mb-1">End Date</label>
                <input type="date" wire:model="endDate" id="endDate" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                @error('endDate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

                <!-- Salary -->
                <label for="salary" class="block text-sm font-medium text-gray-700 mt-4 mb-1">Salary ($)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" wire:model="salary" id="salary" class="w-full pl-8 pr-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" placeholder="50000">
                </div>
                @error('salary') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

                <!-- Status Selection -->
                <label for="status" class="block text-sm font-medium text-gray-700 mt-4 mb-1">Status</label>
                <select wire:model="status" id="status" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none">
                    <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="finished">Finished</option>
                </select>
                @error('status') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
    
                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button wire:click="closeModal" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 border border-gray-300 transition-colors duration-200">Cancel</button>
                    <button wire:click="store" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 shadow-sm transition-colors duration-200">Save</button>
                </div>
            </div>
        </div>
    
    </div>
</div>