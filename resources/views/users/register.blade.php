<x-layout>

    <div 
        class="fixed inset-0 bg-cover bg-center -z-10"
        style="background-image: url('{{ asset('images/umakadmin.jpg') }}');">
    </div>

    <!-- Black Overlay -->
    <div class="fixed inset-0 bg-black opacity-50 -z-10"></div>

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

         {{--- status -----}}
         <div class="mb-6">
            <label for="status" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-id-card pr-4"></i>Account Type
            </label>
            <select
                id="status"
                name="status"
                class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white" onchange="toggleFields()"
                onchange="toggleYearLevel()">
                <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select Account Type</option>
                <option value="student" {{ old('status') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="faculty" {{ old('status') == 'faculty' ? 'selected' : '' }}>Faculty</option>
            </select>
        
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <script>
            function toggleFields() {
                const status = document.getElementById('status').value;
                const yearLevelContainer = document.getElementById('yearLevelContainer');
                const idNumberField = document.querySelector('[name="idnumber"]').parentElement;
                const sectionField = document.querySelector('[name="section"]').parentElement;
        
                if (status === 'student') {
                    yearLevelContainer.classList.remove('hidden');
                    idNumberField.classList.remove('hidden');
                    sectionField.classList.remove('hidden');
                } else {
                    yearLevelContainer.classList.add('hidden');
                    idNumberField.classList.add('hidden');
                    sectionField.classList.add('hidden');
                }
            }
        
            // Call the function on page load to handle form validation with old values
            document.addEventListener('DOMContentLoaded', function () {
                toggleFields();
            });
        </script>
        

         {{--- organization -----}}
        <!-- Organization Dropdown -->
<div class="mb-6">
    <label for="org" class="inline-block text-lg mb-2 text-white">
        <i class="fa-solid fa-building pr-4"></i>College
    </label>
    <select id="org" name="org" class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white">
        <option value="" disabled selected>Select College</option>
        @foreach($organizations as $organization)
            <option value="{{ $organization->id }}">{{ strtoupper($organization->orgNameAbbv) }}</option>
        @endforeach
    </select>
</div>

<!-- Year Level Dropdown -->
<div class="mb-6">
    <label for="yearlevel" class="inline-block text-lg mb-2 text-white">
        <i class="fa-solid fa-graduation-cap pr-4"></i>Year Level
    </label>
    <select id="yearlevel" name="yearlevel" class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white">
        <option value="" disabled selected>Select Year Level</option>
        <option value="1st Year">1st Year</option>
        <option value="2nd Year">2nd Year</option>
        <option value="3rd Year">3rd Year</option>
        <option value="4th Year">4th Year</option>
        <option value="5th Year">5th Year</option>
    </select>
</div>

<!-- Section Dropdown (Populated Dynamically) -->
<div class="mb-6">
    <label for="section" class="inline-block text-lg mb-2 text-white">
        <i class="fa-solid fa-list pr-4"></i> Section
    </label>
    <select id="section" name="section" class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white">
        <option value="">Select Section</option>
    </select>
</div>

<script>
    document.getElementById('org').addEventListener('change', fetchSections);
    document.getElementById('yearlevel').addEventListener('change', fetchSections);

    function fetchSections() {
        let orgId = document.getElementById('org').value;
        let yearLevel = document.getElementById('yearlevel').value;

        if (orgId && yearLevel) {
            fetch(`/sections/filter?organization_id=${orgId}&year_level=${yearLevel}`)
                .then(response => response.json())
                .then(data => {
                    let sectionDropdown = document.getElementById('section');
                    sectionDropdown.innerHTML = '<option value="">Select Section</option>';

                    if (data.length > 0) {
                        data.forEach(section => {
                            let option = `<option value="${section.section_name}">${section.section_name}</option>`;
                            sectionDropdown.innerHTML += option;
                        });
                    } else {
                        sectionDropdown.innerHTML = '<option value="">No sections available</option>';
                    }
                })
                .catch(error => console.error('Error fetching sections:', error));
        } else {
            document.getElementById('section').innerHTML = '<option value="">Select Section</option>';
        }
    }
</script>

       

       

         {{--- idnumber-----}}
         <div class="mb-6">
            <label for="idnumber" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-user pr-4"></i> ID Number
            </label>
            <input type="text" name="idnumber"
                class="border border-gray-200 rounded p-2 w-full bg-laravel opacity-80 text-white"
                value="{{ old('idnumber') }}" />
            @error('idnumber')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
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
            <label for="email" class="inline-block text-lg mb-2 text-white">
                <i class="fa-solid fa-envelope pr-4"></i>Email
            </label>
            <input
                type="email"
                class="border bg-laravel border-gray-200 rounded p-2 w-full text-white"
                autocomplete="off"
                name="email"
                value="{{ old('email') }}" />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
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
            <!-- Data Privacy Agreement -->
            <div class="flex items-center">
                <input type="checkbox" id="dataPrivacyCheckbox" class="mr-2 bg-white" disabled>
                <label for="dataPrivacyCheckbox" class="text-white font-semibold cursor-pointer underline" onclick="openPrivacyModal()">
                    I agree to the Data Privacy Policy
                </label>
            </div>
        
            <!-- Data Privacy Modal -->
            <div id="privacyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg">
                    <h2 class="text-xl font-semibold mb-4">Data Privacy Policy</h2>
                    <p class="text-gray-700 text-sm mb-4">
                        In compliance with the Data Privacy Act of 2012 (RA 10173) of the Philippines, we ensure that your personal data is collected, processed, and protected with the highest security standards. Your data will only be used for the intended purposes and will not be shared without your consent.
                    </p>
                    <div class="flex justify-end space-x-4">
                        <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700" onclick="closePrivacyModal()">Disagree</button>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="agreePrivacy()">Agree</button>
                    </div>
                </div>
            </div>
        
            <!-- Warning Modal (If checkbox is not checked) -->
            <div id="warningModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg">
                    <h2 class="text-xl font-semibold mb-4">Warning</h2>
                    <p class="text-gray-700 text-sm mb-4">
                        Please agree to the Data Privacy Policy before signing up.
                    </p>
                    <div class="flex justify-end">
                        <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700" onclick="closeWarningModal()">Close</button>
                    </div>
                </div>
            </div>
        
            <!-- Submit Button -->
            <button
                type="button"
                id="signUpButton"
                class="border bg-gray-800 text-white rounded py-2 px-4 hover:underline mt-4"
                onclick="validateSignUp()">
                Sign Up
            </button>
        </div>

        
        
        <script>
            function openPrivacyModal() {
                document.getElementById("privacyModal").classList.remove("hidden");
            }
        
            function closePrivacyModal() {
                document.getElementById("privacyModal").classList.add("hidden");
            }
        
            function agreePrivacy() {
                document.getElementById("dataPrivacyCheckbox").checked = true;
                document.getElementById("dataPrivacyCheckbox").disabled = false;
                closePrivacyModal();
            }
        
            function openWarningModal() {
                document.getElementById("warningModal").classList.remove("hidden");
            }
        
            function closeWarningModal() {
                document.getElementById("warningModal").classList.add("hidden");
            }
        
            function validateSignUp() { 
                if (!document.getElementById("dataPrivacyCheckbox").checked) {
                    openWarningModal();
                } else {
                    // Submit the form (Replace with actual form submission if needed)
                    alert("Form submitted successfully!");
                }
            }
        </script>
        
            <!-- OTP Modal -->
<<!-- OTP Modal -->




        
        

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