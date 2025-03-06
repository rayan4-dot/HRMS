<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-6 p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Users Stat Card (Excluding Admins) -->
            <div class="bg-white shadow-lg rounded-lg border border-orange-200 hover:shadow-xl transition-shadow duration-300">
                <div class="p-6 flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <div class="text-sm font-medium text-orange-700">Total Users (Excl. Admins)</div>
                        <div class="text-2xl font-bold text-orange-900">{{ App\Models\User::whereDoesntHave('roles', function ($query) { $query->where('name', 'admin'); })->count() }}</div>
                    </div>
                </div>
                <div class="bg-orange-50 px-6 py-4">
                    <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm transition-colors duration-200">View all</a>
                </div>
            </div>

          <!-- Total Departments Stat Card -->
          <div class="bg-white shadow-lg rounded-lg border border-orange-200 hover:shadow-xl transition-shadow duration-300">
                <div class="p-6 flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <div class="text-sm font-medium text-orange-700">Total Departments</div>
                        <div class="text-2xl font-bold text-orange-900">{{ App\Models\Department::count() }}</div>
                    </div>
                </div>
                <div class="bg-orange-50 px-6 py-4">
                    <a href="#" class="text-orange-600 hover:text-orange-800 font-medium text-sm transition-colors duration-200">View report</a>
                </div>
            </div>

            <!-- Total Jobs Stat Card -->
            <div class="bg-white shadow-lg rounded-lg border border-orange-200 hover:shadow-xl transition-shadow duration-300">
                <div class="p-6 flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.66 0 3 .895 3 2 0 1.105-1.34 2-3 2s-3 .895-3 2c0 1.105 1.34 2 3 2m-4-8h8m-4 0v8" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <div class="text-sm font-medium text-orange-700">Total Jobs</div>
                        <div class="text-2xl font-bold text-orange-900">{{ App\Models\Job::count() }}</div>
                    </div>
                </div>
                <div class="bg-orange-50 px-6 py-4">
                    <a href="{{ route('jobs.index') }}" class="text-orange-600 hover:text-orange-800 font-medium text-sm transition-colors duration-200">View all</a>
                </div>
            </div>

            <!-- Total Positions Stat Card -->
            <div class="bg-white shadow-lg rounded-lg border border-orange-200 hover:shadow-xl transition-shadow duration-300">
                <div class="p-6 flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 114 0 2 2 0 01-4 0z" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <div class="text-sm font-medium text-orange-700">Total Grades</div>
                        <div class="text-2xl font-bold text-orange-900">{{ App\Models\Job::count() }}</div>
                    </div>
                </div>
                <div class="bg-orange-50 px-6 py-4">
                    <a href="{{ route('jobs.index') }}" class="text-orange-600 hover:text-orange-800 font-medium text-sm transition-colors duration-200">View all</a>
                </div>
            </div>
        </div>
        

        <!-- Employees Table -->
        <div class="mt-8">
            <div class="bg-white shadow-lg rounded-lg border border-orange-200 p-6">
                <h3 class="text-lg font-semibold text-orange-900 mb-4">Employees</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-orange-200">
                        <thead class="bg-orange-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Department</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-orange-700 uppercase tracking-wider">Status</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-orange-200">
                        @foreach ($employees as $employee)
                            <tr class="hover:bg-orange-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-orange-900">{{ $employee->user->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-700">{{ $employee->user->email ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-700">{{ $employee->position->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-700">{{ $employee->department->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                        {{ $employee->status ?? 'Active' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('employees.index') }}" class="text-orange-600 hover:text-orange-800 font-medium text-sm transition-colors duration-200">View all</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>