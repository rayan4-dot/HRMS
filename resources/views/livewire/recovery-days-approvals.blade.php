<div class="p-6 bg-gray-50 space-y-8">
    @if (session()->has('message'))
        <div class="mb-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded-md shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <!-- Pending Requests Table -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Pending Requests
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">End Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Days</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pendingRequests as $request)
                            <tr class="hover:bg-orange-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-gray-700">{{ $request->employee->user->name }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ Carbon\Carbon::parse($request->start_date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ Carbon\Carbon::parse($request->end_date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $request->days }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <button wire:click="approve({{ $request->id }})"
                                            class="px-3 py-1.5 bg-green-500 text-white rounded-md hover:bg-green-600 shadow-sm transition-all duration-200">
                                        Approve
                                    </button>
                                    <button wire:click="openRejectModal({{ $request->id }})"
                                            class="px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 shadow-sm transition-all duration-200">
                                        Reject
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No pending requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Request History
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dates</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Days</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Processed At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($processedRequests as $request)
                            <tr class="hover:bg-orange-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-gray-700">{{ $request->employee->user->name }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ Carbon\Carbon::parse($request->start_date)->format('M d') }} - 
                                    {{ Carbon\Carbon::parse($request->end_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $request->days }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $request->hr_validated_at ? $request->hr_validated_at->format('M d, Y H:i') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No processed requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div x-data="{ show: @entangle('showRejectModal') }"
         x-show="show"
         class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm flex items-center justify-center z-50"
         style="display: none;">
        <div class="bg-white rounded-lg p-6 max-w-md w-full shadow-lg border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Reject Recovery Request</h3>
            <div class="mb-4">
                <label for="rejectReason" class="block text-sm font-medium text-gray-700">Reason for Rejection</label>
                <textarea wire:model="rejectReason"
                          id="rejectReason"
                          rows="3"
                          class="mt-1 block w-full rounded-md bg-white border border-gray-300 text-gray-700 shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none"></textarea>
                @error('rejectReason') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end space-x-3">
                <button wire:click="$set('showRejectModal', false)"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 border border-gray-300 transition-all duration-200">
                    Cancel
                </button>
                <button wire:click="reject"
                        class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 shadow-sm transition-all duration-200">
                    Reject
                </button>
            </div>
        </div>
    </div>
</div>