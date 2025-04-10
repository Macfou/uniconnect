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
                <label class="block text-white font-medium mt-3">Enter OTP:</label>
                <input type="text" name="otp" class="w-full p-2 border bg-laravel text-white rounded-lg focus:ring-2 focus:ring-blue-500" required>

                <label class="block text-white font-medium mt-3">New Password:</label>
                <input type="password" name="new_password" class="w-full p-2 bg-laravel text-white border rounded-lg focus:ring-2 focus:ring-blue-500" required>

                <label class="block text-white font-medium mt-3">Confirm Password:</label>
                <input type="password" name="new_password_confirmation" class="w-full p-2 bg-laravel text-white border rounded-lg focus:ring-2 focus:ring-blue-500" required>

                <button type="submit" class="mt-3 w-full bg-blue-600 text-white  py-2 rounded-lg hover:bg-green-700 transition duration-200">
                    Reset Password
                </button>
            </form>
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
