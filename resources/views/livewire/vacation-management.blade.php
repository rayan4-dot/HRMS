<div class="p-8 bg-gray-50 rounded-xl shadow-md border border-gray-200 w-full max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left Section: Vacation Balance and Request Form -->
        <div class="space-y-8">
            <!-- Vacation Balance -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h2 class="text-3xl font-bold mb-4 text-gray-800">Vacation Balance</h2>
                <p class="text-xl text-gray-700">
                    Available Days: 
                    <span class="font-bold text-orange-500">
                        {{ number_format($vacationBalance->available_days, 1) }}
                    </span>
                </p>
                <p class="text-lg text-gray-600">
                    Years of Service: {{ $employee->years_of_service }}
                </p>
            </div>

            <!-- Request Form -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Request Vacation</h2>

                @if (session()->has('message'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm text-lg">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm text-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-lg font-medium text-gray-700">Start Date</label>
                            <input type="date" 
                                   wire:model="start_date"
                                   class="mt-2 w-full rounded-lg border border-gray-300 text-gray-700 text-lg p-3 shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-500 focus:outline-none">
                            @error('start_date') 
                                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-700">End Date</label>
                            <input type="date" 
                                   wire:model="end_date"
                                   class="mt-2 w-full rounded-lg border border-gray-300 text-gray-700 text-lg p-3 shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-500 focus:outline-none">
                            @error('end_date') 
                                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if($totalDays > 0)
                        <div class="bg-gray-50 p-4 rounded-lg text-gray-700 border border-gray-200 text-lg">
                            Total Working Days: <span class="font-bold text-orange-500">{{ $totalDays }}</span>
                        </div>
                    @endif

                    <div>
                        <label class="block text-lg font-medium text-gray-700">Reason</label>
                        <textarea wire:model="reason"
                                  rows="3"
                                  class="mt-2 w-full rounded-lg border border-gray-300 text-gray-700 text-lg p-3 shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-500 focus:outline-none"
                                  placeholder="Enter your vacation reason..."></textarea>
                        @error('reason') 
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

<!-- Above the submit button in your form -->
<div class="bg-gray-50 p-4 rounded-lg text-gray-700 border border-gray-200 text-lg mb-6">
    Available Days: <span class="font-bold text-orange-500">{{ number_format($vacationBalance->current_balance, 1) }}</span>
</div>
                    <button type="submit"
                            class="w-full py-4 px-6 rounded-lg text-lg font-semibold text-white bg-orange-500 hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 transition-all duration-300">
                        Submit Request
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Section: Pending Requests -->
        <div>
            <h2 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                My Requests
            </h2>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full divide-y divide-gray-200 text-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left font-medium text-gray-600 uppercase tracking-wider">Dates</th>
                            <th class="px-6 py-4 text-left font-medium text-gray-600 uppercase tracking-wider">Days</th>
                            <th class="px-6 py-4 text-left font-medium text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left font-medium text-gray-600 uppercase tracking-wider">Submitted</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pendingRequests as $request)
                            <tr class="hover:bg-orange-50 transition-colors duration-300">
                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Carbon\Carbon::parse($request->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($request->end_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $request->total_days }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                        {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : 
                                           ($request->status === 'rejected' || $request->status === 'manager_rejected' || $request->status === 'hr_rejected' ? 'bg-red-100 text-red-700' : 
                                           'bg-yellow-100 text-yellow-700') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $request->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 text-lg">
                                    No vacation requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>