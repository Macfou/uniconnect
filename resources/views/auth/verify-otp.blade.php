<x-layout>

    <div 
        class="fixed inset-0 bg-cover bg-center -z-10"
        style="background-image: url('{{ asset('images/umakadmin.jpg') }}');">
    </div>
    <div class="max-w-lg mx-auto mt-64 p-8 bg-laravel rounded shadow-md border-2 rounded-lg">
        <h2 class="text-center text-white text-2xl font-bold mb-6">Verify Your OTP</h2>

        @if(session('message'))
            <p class="text-green-500 text-center">{{ session('message') }}</p>
        @endif

        <form method="POST" action="{{ route('verify.otp') }}">
            @csrf
            <div class="mb-4">
                <label for="otp" class="block text-white text-lg">Enter OTP</label>
                <input type="text" name="otp" class="w-full p-2 bg-laravel border border-white text-white rounded-lg" required>
                @error('otp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Verify OTP</button>
        </form>
    </div>
</x-layout>
