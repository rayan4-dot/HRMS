<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-800 leading-tight">
            {{ __('Employee Career') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-orange-50 shadow-lg rounded-lg p-6 border border-orange-200">
            <!-- Employee Header -->
            <div class="flex items-center mb-8">
                <!-- Profile Picture -->
                <div class="w-24 h-24 rounded-full overflow-hidden bg-orange-100 flex items-center justify-center mr-6 border border-orange-200 shadow">
                    @if($employee->user->profile_photo_path)
                        <img src="{{ Storage::url($employee->user->profile_photo_path) }}"
                             alt="{{ $employee->user->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-3xl text-orange-700 font-bold">
                            {{ strtoupper(substr($employee->user->name, 0, 1)) }}
                        </span>
                    @endif
                </div>
                <!-- Basic Info -->
                <div>
                    <h3 class="text-2xl font-bold text-orange-900">{{ $employee->user->name }}</h3>
                    <h4 class="text-lg font-medium text-orange-700">{{ $employee->user->email }}</h4>
                    <h5 class="text-orange-600">{{ $employee->user->phone_number ?? '' }}</h5>
                    <span class="text-orange-500 font-medium">{{ $employee->status ?? 'Actif' }}</span>
                </div>
            </div>

            <!-- Horizontal Timeline -->
            @php
                $contracts = $employee->contracts ?? [];
            @endphp

            <div class="relative mb-10 py-4 px-2">
                <div class="absolute left-0 top-1/2 w-full border-t border-gray-300 transform -translate-y-1/2"></div>
                <div class="flex items-center justify-between relative z-10">
                    @foreach($contracts as $index => $contract)
                        <div class="flex flex-col items-center">
                            <!-- Step Circle -->
                            <div class="w-8 h-8 flex items-center justify-center rounded-full bg-orange-500 text-white font-semibold shadow-md">
                                {{ $index + 1 }}
                            </div>
                            <!-- Date / Info -->
                            <div class="mt-2 text-center">
                                <p class="text-sm text-orange-700 font-medium">
                                    {{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') ?? '' }}
                                </p>
                                <p class="text-sm text-orange-900 font-medium">
                                    {{ $contract->type->type ?? '' }}
                                </p>
                                <p class="text-xs text-emerald-600 font-medium">
                                    {{ ucfirst($contract->status ?? '') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @php
                $currentContract = $contracts->last() ?? null;
            @endphp

            @if($currentContract)
                <div class="bg-white p-6 rounded-md border border-orange-200">
                    <h4 class="text-xl font-bold text-orange-900 mb-4">
                        Contract Details ({{ $currentContract->type->type ?? 'Full Time' }})
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-orange-700">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a2 2 0 012-2h3.5a1 1 0 010 2H6v14h12V7h-3.5a1 1 0 010-2H18a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"/>
                            </svg>
                            <span>Start Date: {{ \Carbon\Carbon::parse($currentContract->start_date)->toFormattedDayDateString() ?? '' }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 8h6m-6 4h6M5 21h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z"/>
                            </svg>
                            <span>End Date: {{ $currentContract->end_date ? \Carbon\Carbon::parse($currentContract->end_date)->toFormattedDayDateString() : 'Indefinite' }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.66 0-3 .895-3 2 0 1.105 1.34 2 3 2s3 .895 3 2c0 1.105-1.34 2-3 2m0-8c1.66 0 3 .895 3 2 0 1.105-1.34 2-3 2s-3 .895-3 2c0 1.105 1.34 2 3 2m0-8c1.66 0 3 .895 3 2 0 1.105-1.34 2-3 2s-3 .895-3 2"/>
                            </svg>
                            <span>Salary: ${{ number_format($currentContract->salary ?? 0, 2) }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h6m2 8V7a2 2 0 00-2-2h-5.172a2 2 0 01-1.414-.586L9 2.414A2 2 0 007.586 2H5a2 2 0 00-2 2v11a2 2 0 002 2h4"/>
                            </svg>
                            <span>Status: {{ $currentContract->status ?? 'Finished' }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Additional Details -->
            <div class="bg-white p-6 rounded-md border border-orange-200 mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-orange-700">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h6m2 8V7a2 2 0 00-2-2h-5.172a2 2 0 01-1.414-.586L9 2.414A2 2 0 007.586 2H5a2 2 0 00-2 2v11a2 2 0 002 2h4"/>
                        </svg>
                        <span>Département: <input type="text" class="ml-2 bg-orange-100 border border-orange-200 rounded-md p-1 text-orange-900" value="" readonly></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.66 0-3 .895-3 2 0 1.105 1.34 2 3 2s3 .895 3 2c0 1.105-1.34 2-3 2m0-8c1.66 0 3 .895 3 2 0 1.105-1.34 2-3 2s-3 .895-3 2c0 1.105 1.34 2 3 2m0-8c1.66 0 3 .895 3 2 0 1.105-1.34 2-3 2s-3 .895-3 2"/>
                        </svg>
                        <span>Grade: <input type="text" class="ml-2 bg-orange-100 border border-orange-200 rounded-md p-1 text-orange-900" value="" readonly></span>
                    </div>
                </div>
            </div>
            <!-- Back Button -->
            <div class="mt-6">
                <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 bg-orange-200 border border-orange-300 rounded-md font-semibold text-xs text-orange-800 uppercase tracking-widest hover:bg-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-300 disabled:opacity-25 transition">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Employees
                </a>
            </div>
        </div>
    </div>
</x-app-layout>