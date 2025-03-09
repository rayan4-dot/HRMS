<div class="p-6 bg-gray-50 rounded-lg shadowing-sm border border-gray-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        {{ $userRole === 'hr' ? 'HR' : 'Manager' }} Vacation Approvals
    </h2>

    <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employee</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dates</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Days</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reason</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pendingRequests as $request)
                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-gray-700">{{ $request->employee->user->name }}</td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ \Carbon\Carbon::parse($request->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($request->end_date)->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $request->total_days }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $request->reason }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $request->status === 'manager_approved' ? 'bg-green-100 text-green-700' : 
                                   ($request->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                                   'bg-red-100 text-red-700') }}">
                                @if($userRole === 'hr')
                                    {{ $request->manager_validated_at ? 'Manager Approved' : 'Pending Manager' }}
                                @else
                                    {{ ucfirst($request->status) }}
                                @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 space-x-2">
                            @if($userRole === 'manager')
                                @if($request->status === 'pending')
                                    <button wire:click="approve({{ $request->id }})" 
                                            class="px-3 py-1.5 bg-green-100 text-green-700 rounded-md hover:bg-green-200 border border-green-200 transition-all duration-200">
                                        Approve
                                    </button>
                                    <button wire:click="openRejectModal({{ $request->id }})" 
                                            class="px-3 py-1.5 bg-red-100 text-red-700 rounded-md hover:bg-red-200 border border-red-200 transition-all duration-200">
                                        Reject
                                    </button>
                                @else
                                    <span class="text-gray-600">
                                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                @endif
                            @else
                                @if($request->status === 'manager_approved')
                                    <button wire:click="approve({{ $request->id }})" 
                                            class="px-3 py-1.5 bg-green-100 text-green-700 rounded-md hover:bg-green-200 border border-green-200 transition-all duration-200">
                                        Approve
                                    </button>
                                    <button wire:click="openRejectModal({{ $request->id }})" 
                                            class="px-3 py-1.5 bg-red-100 text-red-700 rounded-md hover:bg-red-200 border border-red-200 transition-all duration-200">
                                        Reject
                                    </button>
                                @else
                                    <span class="text-gray-600">
                                        {{ $request->status === 'pending' ? 'Awaiting Manager Approval' : ucfirst(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                @endif
                            @endif
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

    <!-- History Table -->
    <div class="mt-10 bg-white shadow-sm rounded-lg border border-gray-200">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Request History
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employee</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dates</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Days</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Final Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Comments</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($historyRequests as $request)
                            <tr class="hover:bg-orange-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-gray-700">{{ $request->employee->user->name }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Carbon\Carbon::parse($request->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($request->end_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $request->total_days }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $request->reason }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : 
                                        ($request->status === 'hr_rejected' || $request->status === 'manager_rejected' ? 'bg-red-100 text-red-700' : 
                                        'bg-gray-100 text-gray-700') }}">
                                        {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    @if($request->manager_comments)
                                        <div class="text-sm">
                                            <span class="text-gray-600">Manager:</span> {{ $request->manager_comments }}
                                        </div>
                                    @endif
                                    @if($request->hr_comments)
                                        <div class="text-sm">
                                            <span class="text-gray-600">HR:</span> {{ $request->hr_comments }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No request history available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div x-data="{ open: @entangle('showRejectModal') }"
         x-show="open"
         class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm z-50 flex items-center justify-center"
         style="display: none;">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Reject Vacation Request</h3>
            <textarea wire:model.defer="rejectReason"
                      class="w-full bg-white border border-gray-300 text-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none"
                      rows="3"
                      placeholder="Enter reason for rejection..."></textarea>
            <div class="mt-6 flex justify-end space-x-3">
                <button @click="open = false" 
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 border border-gray-300 transition-all duration-200">
                    Cancel
                </button>
                <button wire:click="reject" 
                        class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 shadow-sm transition-all duration-200">
                    Confirm Reject
                </button>
            </div>
        </div>
    </div>
</div>