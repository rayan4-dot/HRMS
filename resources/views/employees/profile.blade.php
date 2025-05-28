<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employee Profile
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Header -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $employee->user->name }}</h3>
                            <div class="mt-1 flex items-center space-x-2 text-gray-600">
                                <span>{{ $employee->position->title }}</span>
                                <span class="text-gray-400">•</span>
                                <span>{{ $employee->department->name }}</span>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-700">
                            Active
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column: Personal & Professional Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Personal Information -->
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Personal Information
                            </h4>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Email</span>
                                    <span class="text-gray-800 font-medium">{{ $employee->user->email }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Role</span>
                                    <span class="text-gray-800 font-medium">{{ $employee->user->getRoleNames()->implode(', ') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Professional Information
                            </h4>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Department</span>
                                    <span class="text-gray-800 font-medium">{{ $employee->department->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Position</span>
                                    <span class="text-gray-800 font-medium">{{ $employee->position->title }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Hire Date</span>
                                    <span class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($employee->created_at)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Stats & Career Timeline -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <div class="text-gray-600 text-sm">Total Contracts</div>
                            <div class="text-xl font-bold text-gray-800">{{ $stats['totalContracts'] }}</div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <div class="text-gray-600 text-sm">Active Formations</div>
                            <div class="text-xl font-bold text-gray-800">{{ $stats['formations'] }}</div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <div class="text-gray-600 text-sm">Period of Service</div>
                            <div class="text-xl font-bold text-gray-800">{{ $employee->created_at->diffForHumans(now()) }}</div>
                        </div>
                    </div>

                    <!-- Career Timeline -->
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Career Timeline
                            </h4>
                            <div class="relative">
                                <!-- Timeline Line -->
                                <div class="absolute w-full border-t-2 border-gray-300 top-6"></div>
                                <!-- Timeline Items -->
                                <div class="flex items-start justify-between relative space-x-4 overflow-x-auto pb-4">
                                    @foreach($employee->contracts as $contract)
                                        <div class="relative flex flex-col items-center flex-shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center z-10 shadow-sm">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </div>
                                            <div class="mt-2 text-center">
                                                <p class="text-xs text-gray-600">{{ $contract->startDate }}</p>
                                                <p class="text-sm font-medium text-gray-800">{{ $contract->type->type }}</p>
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                    Active
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Current Contract Details -->
                            @if($stats['current_contract'])
                                <div class="bg-gray-50 p-4 rounded-lg mt-6 border border-gray-200">
                                    <h5 class="text-md font-semibold text-gray-800 mb-3">Current Contract Details</h5>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <p class="text-gray-600">Contract Type</p>
                                            <p class="text-gray-800 font-medium">{{ $stats['current_contract']->type->type }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Start Date</p>
                                            <p class="text-gray-800 font-medium">{{ $stats['current_contract']->startDate }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Duration</p>
                                            <p class="text-gray-800 font-medium">Unlimited</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Status</p>
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                Active
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>