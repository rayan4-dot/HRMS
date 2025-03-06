<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-orange-50 shadow-lg rounded-lg p-6 border border-orange-200">
            <div class="flex items-center mb-8">
                <div class="w-24 h-24 rounded-full overflow-hidden bg-orange-100 flex items-center justify-center mr-6 border border-orange-200 shadow">
                    @if(auth()->user()->profile_photo_path)
                        <img src="{{ Storage::url(auth()->user()->profile_photo_path) }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-3xl text-orange-700 font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    @endif
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-orange-900">{{ auth()->user()->name }}</h3>
                    <h4 class="text-lg font-medium text-orange-700">{{ auth()->user()->email }}</h4>
                    <h5 class="text-orange-600">{{ auth()->user()->phone_number ?? '' }}</h5>
                    <span class="text-orange-500 font-medium">{{ auth()->user()->employee->status ?? 'Actif' }}</span>
                </div>
            </div>
            <div class="bg-white p-6 rounded-md border border-orange-200 mb-6">
                <h4 class="text-lg font-semibold text-orange-900 mb-4">Personal Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-orange-700">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Department: {{ auth()->user()->employee->department->name ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Position: {{ auth()->user()->employee->position->title ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            <div class="mb-10 py-4 px-2">
                <h4 class="text-lg font-semibold text-orange-900 mb-4">Contract History</h4>
                <div class="relative">
                    <div class="absolute left-0 top-1/2 w-full border-t border-gray-300 transform -translate-y-1/2"></div>
                    <div class="flex items-center justify-between relative z-10">
                        @foreach(auth()->user()->employee->contracts ?? [] as $index => $contract)
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-orange-500 text-white font-semibold shadow-md">
                                    {{ $index + 1 }}
                                </div>
                                <div class="mt-2 text-center">
                                    <p class="text-sm text-orange-700 font-medium">
                                        {{ \Carbon\Carbon::parse($contract->startDate)->format('d/m/Y') ?? '' }}
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
            </div>
            @php
                $currentContract = auth()->user()->employee->contracts->last() ?? null;
            @endphp
            @if($currentContract)
                <div class="bg-white p-6 rounded-md border border-orange-200">
                    <h4 class="text-xl font-bold text-orange-900 mb-4">
                        Current Contract ({{ $currentContract->type->type ?? 'Full Time' }})
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-orange-700">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a2 2 0 012-2h3.5a1 1 0 010 2H6v14h12V7h-3.5a1 1 0 010-2H18a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"/>
                            </svg>
                            <span>Start Date: {{ \Carbon\Carbon::parse($currentContract->startDate)->toFormattedDayDateString() ?? '' }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-6 8h6m-6 4h6M5 21h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z"/>
                            </svg>
                            <span>End Date: {{ $currentContract->endDate ? \Carbon\Carbon::parse($currentContract->endDate)->toFormattedDayDateString() : 'Indefinite' }}</span>
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
            <div class="mt-6">
                <a href="{{ route('employees.edit', auth()->user()->employee->id) }}" class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-md font-semibold text-sm hover:bg-orange-700 transition-colors duration-200">
                    Update Profile
                </a>
            </div>
        </div>
    </div>
</x-app-layout>