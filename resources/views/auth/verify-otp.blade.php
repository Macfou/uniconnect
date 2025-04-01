<x-layout>
    <div class="max-w-lg mx-auto mt-24 p-8 bg-white rounded shadow-md">
        <h2 class="text-center text-2xl font-bold mb-6">Verify Your OTP</h2>

        @if(session('message'))
            <p class="text-green-500 text-center">{{ session('message') }}</p>
        @endif

        <form method="POST" action="{{ route('verify.otp') }}">
            @csrf
            <div class="mb-4">
                <label for="otp" class="block text-lg">Enter OTP</label>
                <input type="text" name="otp" class="w-full p-2 border border-gray-300 rounded" required>
                @error('otp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Verify OTP</button>
        </form>
    </div>
</x-layout>
