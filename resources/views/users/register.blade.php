<x-layout>

    <x-card class="p-10 rounded-xl max-w-lg mx-auto mt-24 bg-laravel border-2">
    <header class="text-center">
        <div class="flex items-center justify-center space-x-2">
            <img src="{{ asset('images/uniconnect_logo.png') }}" class="h-16" alt="Umak Logo">
            
        </div>

        <h2 class="mb-4 text-2xl text-semi-bold text-white">Register</h2>
    </header>

    <form method="POST" action="/users">

        @csrf
        {{--- last name-----}}
        <div class="mb-6">
            <label for="lname" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-user pr-4"></i>Last Name
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                name="lname" value="{{old('lname')}}"/>

                @error('lname')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>
        
        {{--- First Name -----}}

        <div class="mb-6 flex items-center">
            <div class="flex-1 mr-2">
                <label for="fname" class="inline-block text-lg mb-2 text-white">
                    <i class="fa-solid fa-user pr-4"></i>First Name
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                    name="fname" value="{{old('fname')}}"/>
        
                @error('fname')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            {{--- Middle Initial -----}}
        
            <div class="flex-none w-16"> 
                <label for="miname" class="inline-block text-lg mb-2 text-white">
                    M.I
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                    name="miname" value="{{old('miname')}}"/>
        
                @error('miname')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
        </div>

         {{--- organization -----}}
         <div class="mb-6">
            <label for="org" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-building pr-4"></i>Organization
            </label>
            <select name="org" class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white">
                <option class="text-white" value="" disabled {{ old('org') ? '' : 'selected' }}>Select Organization</option>
                @foreach($organizations as $organization)
                    <option value="{{ $organization->orgNameAbbv }}" {{ old('org') == $organization->orgNameAbbv ? 'selected' : '' }}>
                        {{ strtoupper($organization->orgNameAbbv) }} <!-- Display in uppercase -->
                    </option>
                @endforeach
            </select>
        
            @error('org')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{--- status -----}}
        <div class="mb-6">
            <label for="status" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-id-card pr-4"></i>Status
            </label>
            <select
                id="status"
                name="status"
                class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                onchange="toggleYearLevel()">
                <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select Status</option>
                <option value="student" {{ old('status') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="faculty" {{ old('status') == 'faculty' ? 'selected' : '' }}>Faculty</option>
            </select>
        
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        
        <!-- Year Level Dropdown (hidden by default) -->
        <div id="yearLevelContainer" class="mb-6 hidden">
            <label for="yearlevel" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-graduation-cap pr-4"></i>Year Level
            </label>
            <select
                id="yearlevel"
                name="yearlevel"
                class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white">
                <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select year level</option>
                <option value="first-year" {{ old('yearLevel') == 'first-year' ? 'selected' : '' }}>First Year</option>
                <option value="second-year" {{ old('yearLevel') == 'second-year' ? 'selected' : '' }}>Second Year</option>
                <option value="third-year" {{ old('yearLevel') == 'third-year' ? 'selected' : '' }}>Third Year</option>
                <option value="fourth-year" {{ old('yearLevel') == 'fourth-year' ? 'selected' : '' }}>Fourth Year</option>
            </select>
        
            @error('yearlevel')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        
        <script>
            function toggleYearLevel() {
                const status = document.getElementById('status').value;
                const yearLevelContainer = document.getElementById('yearLevelContainer');
                
                // Show year level dropdown only if "Student" is selected
                if (status === 'student') {
                    yearLevelContainer.classList.remove('hidden');
                } else {
                    yearLevelContainer.classList.add('hidden');
                }
            }
        
            // Call the function on page load to handle form validation with old values
            document.addEventListener('DOMContentLoaded', function () {
                toggleYearLevel();
            });
        </script>

        {{--- section -----}}

        <div class="mb-6">
            <label for="section" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-list pr-4"></i>Section
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                name="section" value="{{old('section')}}"/>

                @error('section')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
        </div>
        
        

        



        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-envelope pr-4"></i>Email</label>
            <input
                type="email"
                class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                name="email" value="{{old('email')}}"/>

                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </p>
        </div>





        <div x-data="{ showPassword: false, showConfirmPassword: false }">
            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="inline-block text-lg mb-2 text-white">
                    <i class="fa-solid fa-lock pr-4"></i>Password
                </label>
                <div class="relative">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                        name="password" value="{{ old('password') }}"
                    />
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-white">
                        <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                    </button>
                </div>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <!-- Confirm Password Field -->
            <div class="mb-6">
                <label for="password_confirmation" class="inline-block text-lg mb-2 text-white">
                    <i class="fa-solid fa-lock pr-4"></i>Confirm Password
                </label>
                <div class="relative">
                    <input
                        :type="showConfirmPassword ? 'text' : 'password'"
                        class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                        name="password_confirmation" value="{{ old('password_confirmation') }}"
                    />
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-white">
                        <i :class="showConfirmPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                    </button>
                </div>
                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        

        <div class="mb-6">
            <button
                type="submit"
                class="border bg-gray-800 text-white rounded py-2 px-4 hover:underline">
                Sign Up
            </button>
        </div>

        <div class="mt-8">
            <p class="text-white">
                Already have an account?
                <a href="/login" class="text-white hover:underline"
                    >Login</a>
            </p>
        </div>
    </form>


</x-card>  
</x-layout>