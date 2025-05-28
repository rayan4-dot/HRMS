<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="space-y-6 bg-gray-50 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Employee Management</h2>
            <button wire:click="exportToExcel" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Export to Excel
            </button>
        </div>
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
            <form method="POST" action="{{ $employee ?? null ? route('employees.update', $employee->id) : route('employees.store') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @if($employee ?? null)
                    @method('PUT')
                @endif

                <h2 class="text-xl font-bold text-gray-800 mb-6">
                    {{ $employee ?? null ? 'Edit Employee' : 'Add Employee' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name and Email -->
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" 
                                   value="{{ old('name', $employee->user->name ?? '') }}" 
                                   name="name" 
                                   id="name" 
                                   class="w-full px-3 py-1.5 text-sm bg-gray-50 border border-gray-300 text-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" 
                                   required>
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" 
                                   value="{{ old('email', $employee->user->email ?? '')}}" 
                                   name="email" 
                                   id="email" 
                                   class="w-full px-3 py-1.5 text-sm bg-gray-50 border border-gray-300 text-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" 
                                   required>
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Department and Position -->
                    <div class="space-y-4">
                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select name="department" 
                                    wire:model="selectedDepartment" 
                                    wire:change="jobsByDepartment($event.target.value)" 
                                    id="department" 
                                    class="w-full px-3 py-1.5 text-sm bg-gray-50 border border-gray-300 text-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" 
                                    required>
                                <option value="" disabled>Select</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department', $employee->department_id ?? '') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedDepartment') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                            <select name="job_title_id" 
                                    id="position" 
                                    class="w-full px-3 py-1.5 text-sm bg-gray-50 border border-gray-300 text-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" 
                                    required>
                                <option value="" disabled>Select</option>
                                @foreach($jobs as $job)
                                    <option value="{{ $job->id }}" {{ old('job_title_id', $employee->job_title_id ?? '') == $job->id ? 'selected' : '' }}>{{ $job->title }}</option>
                                @endforeach
                            </select>
                            @error('position') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Role and Salary -->
                    <div class="space-y-4">
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <select name="role" 
                                    id="role" 
                                    class="w-full px-3 py-1.5 text-sm bg-gray-50 border border-gray-300 text-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" 
                                    required>
                                <option value="" disabled selected>Select</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-2 flex items-center text-gray-400 text-sm">$</span>
                                <input type="number" 
                                       value="{{ old('salary', $employee->salary ?? '') }}" 
                                       name="salary" 
                                       id="salary" 
                                       class="w-full pl-6 pr-3 py-1.5 text-sm bg-gray-50 border border-gray-300 text-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" 
                                       placeholder="0.00" 
                                       required>
                            </div>
                            @error('salary') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Hire Date and Profile Picture -->
                    <div class="space-y-4">
                        <div>
                            <label for="hire_date" class="block text-sm font-medium text-gray-700 mb-1">Hire Date</label>
                            <input type="date" 
                                   name="hire_date" 
                                   id="hire_date" 
                                   value="{{ old('hire_date', $employee->hire_date ?? '') }}"
                                   class="w-full px-3 py-1.5 text-sm bg-gray-50 border border-gray-300 text-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-orange-300 focus:border-orange-400 focus:outline-none" 
                                   required>
                            @error('hire_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>



                <!-- Submit Button -->
                <div class="flex justify-end space-x-3 mt-8">
                    <a href="{{ route('employees.index') }}" 
                       class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md transition-colors duration-200 border border-gray-300 text-sm">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md shadow-sm transition-colors duration-200 text-sm">
                        {{ $employee ?? null ? 'Update Employee' : 'Save Employee' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>