<<<<<<< HEAD
<div class="p-8 bg-white rounded-2xl shadow-lg border border-gray-100 transition-all duration-500">
    <h2 class="text-4xl font-extrabold mb-12 text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-500 via-teal-400 to-green-500 animate-pulse">Organizational Structure</h2>

    <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-teal-500 scrollbar-track-gray-100">
        <div class="min-w-full flex flex-col items-center">
            <!-- CEO Level -->
            <div class="relative group">
                <div class="p-6 bg-gradient-to-r from-blue-500 to-teal-500 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 w-72 transform hover:scale-105">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white tracking-tight">Chief Executive Officer</div>
                        <div class="text-lg text-blue-100 mt-2 font-medium">Kudo</div>
                    </div>
                </div>
                <!-- Tooltip -->
                <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 hidden group-hover:block bg-gray-700 text-white text-sm rounded-lg px-3 py-1 shadow-md z-20">CEO - Leads the organization</div>
                <!-- Main vertical line -->
                <div class="absolute left-1/2 top-full w-1 h-20 bg-gradient-to-b from-teal-500 to-green-400 transform -translate-x-1/2"></div>
            </div>
            
            <!-- Central connector -->
            <div class="relative w-5/6 h-1 bg-gradient-to-r from-teal-500 via-green-400 to-teal-500 mt-20 mb-12 rounded-full shadow-sm"></div>
            
            <!-- Departments Level -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-16 gap-y-20 w-full max-w-6xl">
                @foreach($hierarchy as $index => $department)
                    <!-- Department Column -->
                    <div class="flex flex-col items-center relative group">
                        <!-- Vertical connector to main line -->
                        <div class="absolute -top-12 left-1/2 w-1 h-12 bg-green-400 transform -translate-x-1/2 group-hover:bg-green-300 transition-colors duration-300"></div>
                        
                        <!-- Department Header -->
                        <div class="p-5 bg-gradient-to-br from-green-400 to-teal-500 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 w-full mb-10 transform hover:scale-105 hover:-rotate-1">
                            <div class="text-center">
                                <div class="text-xl font-bold text-white tracking-wide">
=======
<div class="p-8 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 rounded-xl shadow-2xl">
    <h2 class="text-3xl font-extrabold mb-10 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-blue-500">Organizational Structure</h2>

    <div class="overflow-x-auto">
        <div class="min-w-full flex flex-col items-center">
            <!-- CEO Level -->
            <div class="relative">
                <div class="p-5 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 w-64">
                    <div class="text-center">
                        <div class="text-xl font-bold text-white">Chief Executive Officer</div>
                        <div class="text-md text-purple-100 mt-1">Kudo</div>
                    </div>
                </div>
                
                <!-- Main vertical line -->
                <div class="absolute left-1/2 top-full w-1 h-16 bg-gradient-to-b from-indigo-500 to-teal-400 transform -translate-x-1/2"></div>
            </div>
            
            <!-- Central connector -->
            <div class="relative w-3/4 h-1 bg-gradient-to-r from-indigo-500 via-teal-400 to-indigo-500 mt-16 mb-8"></div>
            
            <!-- Departments Level -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-12 gap-y-16 w-full max-w-6xl">
                @foreach($hierarchy as $index => $department)
                    <!-- Department Column -->
                    <div class="flex flex-col items-center relative">
                        <!-- Vertical connector to main line -->
                        <div class="absolute -top-8 left-1/2 w-1 h-8 bg-teal-400 transform -translate-x-1/2"></div>
                        
                        <!-- Department Header -->
                        <div class="p-4 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 w-full mb-8 transform hover:scale-105">
                            <div class="text-center">
                                <div class="text-lg font-bold text-white">
>>>>>>> 37450748 (Save changes before switching branches)
                                    {{ $department['name'] }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Department Employees -->
<<<<<<< HEAD
                        <div class="space-y-8 w-full relative">
                            <!-- Vertical department line -->
                            <div class="absolute top-0 bottom-0 left-1/2 w-0.5 h-full bg-green-300 transform -translate-x-1/2 -z-10"></div>
                            
                            @foreach($department['employees'] as $employeeIndex => $employee)
                                <!-- Employee card with horizontal connector -->
                                <div class="relative flex items-center group/employee">
                                    <!-- Horizontal connector to vertical line -->
                                    <div class="absolute top-1/2 left-0 right-1/2 h-0.5 bg-green-300 transform translate-x-6 -translate-y-1/2 group-hover/employee:bg-green-400 transition-colors duration-300"></div>
                                    
                                    <!-- Employee card -->
                                    <div class="ml-12 p-5 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 w-full border-l-4 border-green-400 transform hover:translate-x-2">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-300 to-teal-400 flex items-center justify-center text-white font-bold text-lg overflow-hidden shadow-sm">
                                                @if($employee['image'])
                                                    <img src="{{ $employee['image'] }}" alt="{{ $employee['name'] }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ strtoupper(substr($employee['name'], 0, 1)) }}
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-base font-semibold text-gray-800">
                                                    {{ $employee['name'] }}
                                                </div>
                                                <div class="text-sm text-gray-500">
=======
                        <div class="space-y-6 w-full relative">
                            <!-- Vertical department line -->
                            <div class="absolute top-0 bottom-0 left-1/2 w-0.5 h-full bg-emerald-300 dark:bg-emerald-700 transform -translate-x-1/2 -z-10"></div>
                            
                            @foreach($department['employees'] as $employeeIndex => $employee)
                                <!-- Employee card with horizontal connector -->
                                <div class="relative flex items-center">
                                    <!-- Horizontal connector to vertical line -->
                                    <div class="absolute top-1/2 left-0 right-1/2 h-0.5 bg-emerald-300 dark:bg-emerald-700 transform translate-x-6 -translate-y-1/2"></div>
                                    
                                    <!-- Employee card -->
                                    <div class="ml-12 p-4 bg-white dark:bg-slate-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 w-full border-l-4 border-emerald-500 transform hover:translate-x-2">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold text-lg overflow-hidden">
                                                @if($employee['image'])
                                                    <img src="{{ $employee['image'] }}" alt="{{ $employee['name'] }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ substr($employee['name'], 0, 1) }}
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-base font-semibold text-slate-800 dark:text-white">
                                                    {{ $employee['name'] }}
                                                </div>
                                                <div class="text-sm text-slate-600 dark:text-slate-300">
>>>>>>> 37450748 (Save changes before switching branches)
                                                    {{ $employee['position'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<<<<<<< HEAD
                                    <!-- Tooltip -->
                                    <div class="absolute top-full left-12 mt-2 hidden group-hover/employee:block bg-gray-700 text-white text-xs rounded-md px-2 py-1 shadow-md z-20">
                                        {{ $employee['position'] }}
                                    </div>
=======
>>>>>>> 37450748 (Save changes before switching branches)
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
<<<<<<< HEAD

    <!-- Inline styles -->
    <style>
        /* Custom Scrollbar */
        .scrollbar-thin {
            scrollbar-width: thin;
        }
        .scrollbar-thumb-teal-500::-webkit-scrollbar-thumb {
            background: #14b8a6;
            border-radius: 9999px;
        }
        .scrollbar-track-gray-100::-webkit-scrollbar-track {
            background: #f3f4f6;
        }
    </style>
=======
>>>>>>> 37450748 (Save changes before switching branches)
</div>