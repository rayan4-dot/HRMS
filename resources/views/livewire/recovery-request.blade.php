<div class="p-8 bg-gray-50 rounded-xl shadow-md border border-gray-200 w-full max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left Section: Form -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Recovery Days Request</h2>

            @if (session()->has('message'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm text-lg">
                    {{ session('message') }}
                </div>
            @elseif(session()->has('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm text-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="submitRequest" class="space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-lg font-medium text-gray-700">Start Date</label>
                        <input type="date" 
                               wire:model="start_date"
                               id="start_date"
                               class="mt-2 w-full rounded-lg border border-gray-300 text-gray-700 text-lg p-3 shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-500 focus:outline-none">
                        @error('start_date') 
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date" class="block text-lg font-medium text-gray-700">End Date</label>
                        <input type="date" 
                               wire:model="end_date"
                               id="end_date"
                               class="mt-2 w-full rounded-lg border border-gray-300 text-gray-700 text-lg p-3 shadow-sm focus:ring-2 focus:ring-orange-400 focus:border-orange-500 focus:outline-none">
                        @error('end_date') 
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                        class="w-full py-4 px-6 rounded-lg text-lg font-semibold text-white bg-orange-500 hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 transition-all duration-300">
                    Submit Request
                </button>
            </form>
        </div>

        <!-- Right Section: Recovery Requests List -->
        <div>
            <h3 class="text-2xl font-semibold mb-6 text-gray-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                My Recovery Requests
            </h3>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full divide-y divide-gray-200 text-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left font-medium text-gray-600 uppercase tracking-wider">Start Date</th>
                            <th class="px-6 py-4 text-left font-medium text-gray-600 uppercase tracking-wider">End Date</th>
                            <th class="px-6 py-4 text-left font-medium text-gray-600 uppercase tracking-wider">Days</th>
                            <th class="px-6 py-4 text-left font-medium text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recoveryRequests as $request)
                            <tr class="hover:bg-orange-50 transition-colors duration-300">
                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Carbon\Carbon::parse($request->start_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ \Carbon\Carbon::parse($request->end_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $request->days }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                        {{ $request->status === 'approved' ? 'bg-green-100 text-green-700' : 
                                           ($request->status === 'rejected' ? 'bg-red-100 text-red-700' : 
                                           'bg-yellow-100 text-yellow-700') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 text-lg">
                                    No recovery requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>