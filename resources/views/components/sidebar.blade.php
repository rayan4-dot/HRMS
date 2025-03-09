<div class="px-4 py-6">
    <h2 class="text-2xl font-bold text-orange-600 mb-6">My Dashboard</h2>
    <nav>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </div>
                </a>
            </li>
            @can('Manage Departments')
                <li>
                    <a href="{{ route('departments.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Departments
                        </div>
                    </a>
                </li>
            @endcan
            @can('Manage Employees')
                <li>
                    <a href="{{ route('employees.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Employees
                        </div>
                    </a>
                </li>
            @endcan
            @can('Manage Contracts')
                <li>
                    <a href="{{ route('contracts.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Contracts
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('formations.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                            </svg>
                            Formations
                        </div>
                    </a>
                </li>
            @endcan
            @can('Manage Jobs')
                <li>
                    <a href="{{ route('jobs.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Jobs
                        </div>
                    </a>
                </li>
            @endcan
            @can('Manage Profile')
                <li>
                    <a href="{{ route('employees.profile', auth()->user()) }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile
                        </div>
                    </a>
                </li>
            @endcan
            @can('make vacation request')
                <li>
                    <a href="{{ route('vacations.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Vacation Request
                        </div>
                    </a>
                </li>
            @endcan
            @can('approve vacation request')
                <li>
                    <a href="{{ route('vacation.approvals') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Manage Vacations
                        </div>
                    </a>
                </li>
            @endcan
            @can('make recover day request')
                <li>
                    <a href="{{ route('recovery-days.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Recovery Request
                        </div>
                    </a>
                </li>
            @endcan
            @can('approve recover days')
                <li>
                    <a href="{{ route('recovery-days.approvals') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Recover Days Management
                        </div>
                    </a>
                </li>
            @endcan
            @can('see profile')
                <li>
                    <a href="{{ route('employees.profile', auth()->user()->id) }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile
                        </div>
                    </a>
                </li>
            @endcan
            <!-- New link accessible to everyone -->
            <li>
                <a href="{{ route('organigram.hierarchy') }}" class="block px-4 py-2.5 rounded-lg hover:bg-orange-100 text-gray-700 hover:text-orange-600 transition-colors font-medium">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7h18M3 4h18M4 4v17m4-7v7m4-10v10m4-13v13"></path>
                        </svg>
                        Organigram
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>