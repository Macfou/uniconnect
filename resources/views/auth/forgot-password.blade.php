<x-layout>

    <div 
        class="fixed inset-0 bg-cover bg-center -z-10"
        style="background-image: url('{{ asset('images/umakadmin.jpg') }}');">
    </div>  
    <div class="flex items-center justify-center min-h-screen">
        <x-card class="p-8 rounded-lg max-w-md mx-auto shadow-lg bg-laravel">
            <h2 class="text-2xl font-bold text-white text-center mb-4">Forgot Password</h2>

            @if(session('otp_sent'))
                <p class="text-green-500 text-center">{{ session('otp_sent') }}</p>
            @endif

            <!-- Step 1: Request OTP -->
            <form action="{{ route('forgot.password.sendOtp') }}" method="POST" id="requestOtpForm" class="{{ session('otp_sent') ? 'hidden' : '' }}">
                @csrf
                <label class="block text-white font-medium mb-1">Enter your email:</label>
                <input type="email" name="email" class="w-full p-2 bg-laravel text-white border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <button type="submit" class="mt-3 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Send OTP
                </button>
            </form>

            <!-- Step 2: Enter OTP & Reset Password (Hidden initially) -->
            <form action="{{ route('forgot.password.verifyOtp') }}" method="POST" id="verifyOtpForm" class="{{ session('otp_sent') ? '' : 'hidden' }}">
                @csrf
            
                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
                @endif
            
                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            
                <label class="block text-white font-medium mt-3">Enter OTP:</label>
                <input type="text" name="otp" id="otp" class="w-full p-2 border bg-laravel text-white rounded-lg focus:ring-2 focus:ring-blue-500" required>
            
                <label class="block text-white font-medium mt-3">New Password:</label>
                <input type="password" name="new_password" id="new_password" class="w-full p-2 bg-laravel text-white border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            
                <!-- Password Requirement Info (hidden by default) -->
                <div id="passwordHelp" class="text-sm mt-2 text-gray-200 space-y-1 hidden">
                    <p id="length" class="text-red-400">• At least 8 characters</p>
                    <p id="lowercase" class="text-red-400">• At least one lowercase letter</p>
                    <p id="uppercase" class="text-red-400">• At least one uppercase letter</p>
                    <p id="number" class="text-red-400">• At least one number</p>
                    <p id="special" class="text-red-400">• At least one special character (@$!%*#?&)</p>
                </div>
            
                <label class="block text-white font-medium mt-3">Confirm Password:</label>
                <input type="password" name="new_password_confirmation" id="confirm_password" class="w-full p-2 bg-laravel text-white border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <p id="matchError" class="text-red-400 mt-1 hidden">Passwords do not match.</p>
            
                <button type="submit" class="mt-3 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-200">
                    Reset Password
                </button>
            </form>
            
            <script>
                const form = document.getElementById('verifyOtpForm');
                const password = document.getElementById('new_password');
                const confirmPassword = document.getElementById('confirm_password');
                const otpField = document.getElementById('otp');
                const matchError = document.getElementById('matchError');
                const passwordHelp = document.getElementById('passwordHelp');
            
                const rules = {
                    length: document.getElementById('length'),
                    lowercase: document.getElementById('lowercase'),
                    uppercase: document.getElementById('uppercase'),
                    number: document.getElementById('number'),
                    special: document.getElementById('special'),
                };
            
                password.addEventListener('input', () => {
                    passwordHelp.classList.remove('hidden');
            
                    const val = password.value;
            
                    rules.length.classList.toggle('text-green-400', val.length >= 8);
                    rules.lowercase.classList.toggle('text-green-400', /[a-z]/.test(val));
                    rules.uppercase.classList.toggle('text-green-400', /[A-Z]/.test(val));
                    rules.number.classList.toggle('text-green-400', /\d/.test(val));
                    rules.special.classList.toggle('text-green-400', /[@$!%*#?&]/.test(val));
            
                    for (let key in rules) {
                        if (rules[key].classList.contains('text-green-400')) {
                            rules[key].classList.remove('text-red-400');
                        } else {
                            rules[key].classList.add('text-red-400');
                        }
                    }
                });
            
                confirmPassword.addEventListener('input', () => {
                    matchError.classList.toggle('hidden', password.value === confirmPassword.value);
                });
            
                form.addEventListener('submit', function (e) {
                    let valid = true;
            
                    const otp = otpField.value.trim();
                    const pw = password.value;
            
                    // Basic OTP format validation (optional client-side check)
                    if (otp.length < 4 || isNaN(otp)) {
                        alert('Please enter a valid OTP.');
                        valid = false;
                    }
            
                    // Password rules validation
                    if (
                        pw.length < 8 ||
                        !/[a-z]/.test(pw) ||
                        !/[A-Z]/.test(pw) ||
                        !/\d/.test(pw) ||
                        !/[@$!%*#?&]/.test(pw)
                    ) {
                        alert('Password does not meet all the required criteria.');
                        valid = false;
                    }
            
                    // Password confirmation
                    if (pw !== confirmPassword.value) {
                        matchError.classList.remove('hidden');
                        valid = false;
                    }
            
                    if (!valid) {
                        e.preventDefault(); // Stop form submission
                    }
                });
            </script>
            
        </x-card>
    </div>
</x-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if ("{{ session('otp_sent') }}" !== "") {
            document.getElementById('requestOtpForm').classList.add('hidden');
            document.getElementById('verifyOtpForm').classList.remove('hidden');
        }
    });
</script>
