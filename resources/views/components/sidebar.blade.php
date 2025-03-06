<div class="px-4 py-6 bg-orange-50 rounded-lg shadow-sm">
    <h2 class="text-2xl font-extrabold text-orange-900 tracking-tight mb-6">My Dashboard</h2>
    <nav>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-orange-100 text-orange-900' : 'text-orange-700 hover:bg-orange-50' }} group flex items-center px-4 py-2 rounded-lg transition-all duration-200 
                    text-orange-700 hover:text-orange-900 
                    hover:bg-orange-200/50 
                    hover:shadow-md 
                    focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>
            @can('Manage Departments')
                <li>
                    <a href="{{ route('departments.index') }}" class="group flex items-center px-4 py-2 rounded-lg transition-all duration-200 
                        text-orange-700 hover:text-orange-900 
                        hover:bg-orange-200/50 
                        hover:shadow-md 
                        focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Departments
                    </a>
                </li>
            @endcan

                <li>
                    <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees') ? 'bg-orange-100 text-orange-900' : 'text-orange-700 hover:bg-orange-50' }} group flex items-center px-4 py-2 rounded-lg transition-all duration-200 
                        text-orange-700 hover:text-orange-900 
                        hover:bg-orange-200/50 
                        hover:shadow-md 
                        focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Employees
                    </a>
                </li>

            @can('Manage Contracts')
                <li>
                    <a href="{{ route('contracts.index') }}" class="group flex items-center px-4 py-2 rounded-lg transition-all duration-200 
                        text-orange-700 hover:text-orange-900 
                        hover:bg-orange-200/50 
                        hover:shadow-md 
                        focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        Contracts
                    </a>
                </li>
                <li>
                    <a href="{{ route('formations.index') }}" class="group flex items-center px-4 py-2 rounded-lg transition-all duration-200 
                        text-orange-700 hover:text-orange-900 
                        hover:bg-orange-200/50 
                        hover:shadow-md 
                        focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Formations
                    </a>
                </li>
            @endcan
            @can('Manage Jobs')
                <li>
                    <a href="{{ route('jobs.index') }}" class="group flex items-center px-4 py-2 rounded-lg transition-all duration-200 
                        text-orange-700 hover:text-orange-900 
                        hover:bg-orange-200/50 
                        hover:shadow-md 
                        focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Jobs
                    </a>
                </li>
            @endcan
        </ul>
    </nav>
</div>