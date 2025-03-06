<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-orange-50 shadow-lg rounded-lg overflow-hidden border border-orange-200 p-6">
        <form method="POST" action="{{ $employee ?? null ? route('employees.update', $employee->id) : route('employees.store') }}" enctype="multipart/form-data">
            @csrf
            @if($employee ?? null)
                @method('PUT')
            @endif
            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-orange-700">Name</label>
                <input type="text" value="{{ old('name', $employee->user->name ?? '') }}" name="name" id="name" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" required>
                @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-orange-700">Email</label>
                <input type="email" value="{{ old('email', $employee->user->email ?? '')}}" name="email" id="email" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" required>
                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>


            <!-- Department -->
            <div class="mb-4">
                <label for="department" class="block text-sm font-medium text-orange-700">Department</label>
                <select name="department" wire:model="selectedDepartment" wire:change="jobsByDepartment($event.target.value)" id="department" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" required>
                    <option value="" disabled>Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department', $employee->department_id ?? '') ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('selectedDepartment') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Position -->
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-orange-700">Position</label>
                <select name="job_title_id" id="position" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" required>
                    <option value="" disabled>Select Grade</option>
                    @foreach($jobs as $job)
                        <option value="{{ $job->id }}" {{ old('job_title_id', $employees->job_title_id ?? '') == $job->id ? 'selected' : '' }}>{{ $job->title }}</option>
                    @endforeach
                </select>
                @error('position') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Role Selection -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-orange-700">Role</label>
                <select name="role" id="role" class="w-full px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" required>
                    <option value="" disabled selected>Select Role</option>
                    @foreach($roles as $role)
                            <option value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Salary -->
            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-orange-700">Salary</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-orange-600">$</span>
                    <input type="number" value="{{ old('salary', $employee->salary ?? '') }}" name="salary" id="salary" class="w-full pl-8 px-3 py-2 bg-orange-100 border border-orange-200 rounded-md text-orange-900" placeholder="0.00" required>
                </div>
                @error('salary') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('employees.index') }}" class="px-4 py-2 bg-orange-200 text-orange-800 rounded-md hover:bg-orange-300">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">
                    {{ $employee ?? null ? 'Update Employee' : 'Insert Employee'}}
                </button>
            </div>
        </form>
    </div>
</div>