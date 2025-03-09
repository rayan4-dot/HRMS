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
                                    {{ $department['name'] }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Department Employees -->
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
                                                    {{ $employee['position'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>