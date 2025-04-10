<x-ufmo-layout>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Verify Email</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('ufmo.verifyotp') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Enter OTP sent to your email</label>
                <input type="text" name="otp" required class="w-full px-3 py-2 border rounded-lg">
            </div>
            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                Verify and Create User
            </button>
        </form>
    </div>
</x-ufmo-layout>
