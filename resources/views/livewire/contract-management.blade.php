<div class="space-y-6">
    <!-- Flash Message -->
    @if(session()->has('message'))
        <div class="bg-orange-500 text-white p-3 rounded-md shadow-lg transform transition-all duration-300 ease-in-out">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-orange-800">Manage Contracts</h2>
        <input type="text" wire:model.live="search" id="salary" class="px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" placeholder="Search...">
        <!-- Add Contract Button -->
        <button wire:click="create" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg shadow-md transition-all duration-300 ease-in-out flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Contract
        </button>
    </div>

    <!-- Contracts Table -->
    <div class="bg-orange-50 shadow-lg rounded-lg overflow-hidden border border-orange-200">
        <div class="p-6 border-b border-orange-200">
            <h3 class="text-xl font-semibold text-orange-900 flex items-center">
                <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Contracts
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-orange-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Contract Type</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Start Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">End Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Salary</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-orange-200">
                    @foreach($contracts as $contract)
                        <tr class="hover:bg-orange-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-orange-900">{{ $contract->employee->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $contract->type->type }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $contract->startDate }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $contract->endDate }}</td>
                            <td class="px-6 py-4 text-sm text-orange-700">{{ $contract->salary }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-600 text-white">
                                    {{ $contract->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-3">
                                    <button wire:click="edit({{ $contract->id }})" class="px-3 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $contract->id }})" class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
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
        <div class="@if(!$isOpen) hidden @endif fixed inset-0 bg-orange-900 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6 border border-orange-200">
                <h3 class="text-xl font-semibold text-orange-900 mb-4">Contract Details</h3>
    
                <!-- User Selection -->
                <label for="user" class="block text-sm font-medium text-orange-700">User</label>
                <select wire:model="employee_id" id="user" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900">
                    <option value="">Select User</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                    @endforeach 
                </select>
                @error('employee_id') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
    
                <!-- Contract Type Selection -->
                <label for="contractType" class="block text-sm font-medium text-orange-700 mt-4">Contract Type</label>
                <select wire:model="contractType" id="contractType" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900">
                    <option value="">Select Type</option>
                    @foreach($contractTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
                @error('contractType') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
    
                <!-- Start Date -->
                <label for="startDate" class="block text-sm font-medium text-orange-700 mt-4">Start Date</label>
                <input type="date" wire:model="startDate" id="startDate" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900">
                @error('startDate') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror

                <!-- End Date -->
                <label for="endDate" class="block text-sm font-medium text-orange-700 mt-4">End Date</label>
                <input type="date" wire:model="endDate" id="endDate" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900">
                @error('endDate') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror

                <!-- Salary -->
                <label for="salary" class="block text-sm font-medium text-orange-700 mt-4">Salary ($)</label>
                <input type="number" wire:model="salary" id="salary" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" placeholder="50000">
                @error('salary') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror

                <!-- Status Selection -->
                <label for="status" class="block text-sm font-medium text-orange-700 mt-4">Status</label>
                <select wire:model="status" id="status" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900">
                    <option value="">Select Status</option>
                    <option value="active">Active</option>
                    <option value="finished">Finished</option>
                </select>
                @error('status') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
    
                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button wire:click="closeModal" class="px-4 py-2 bg-orange-200 text-orange-800 rounded-md hover:bg-orange-300">Cancel</button>
                    <button wire:click="store" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>