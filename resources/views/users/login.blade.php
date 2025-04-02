<x-layout>
    <!-- Background Image -->
    <div 
        class="fixed inset-0 bg-cover bg-center -z-10"
        style="background-image: url('{{ asset('images/umakadmin.jpg') }}');">
    </div>

    <!-- Black Overlay -->
    <div class="fixed inset-0 bg-black opacity-50 -z-10"></div>

    <!-- Content -->
    <div class="flex items-center justify-center min-h-screen">
        <x-card class="p-10 rounded-xl max-w-lg mx-auto border-2 bg-laravel fixed bg-clip-border">
            <header class="text-center">
                <div class="flex items-center justify-center space-x-2">
                    <img src="{{ asset('images/uniconnect_logo.png') }}" class="h-16" alt="Umak Logo">
                </div>
                <h3 class="text-xl font-bold uppercase mb-1 text-white">
                    Login
                </h3>
            </header>

            <form method="POST" action="/users/authenticate">
                @csrf
                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2 text-white">
                        <i class="fa-solid fa-envelope pr-4"></i>Email
                    </label>
                    <input
                        type="email"
                        class="border bg-laravel border-gray-200 rounded p-2 w-full text-white"
                        autocomplete="off"
                        name="email" value="{{ old('email') }}"/>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div x-data="{ show: false }" class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2 text-white">
                        <i class="fa-solid fa-lock pr-2"></i> Password
                    </label>
                    <div class="relative">
                        <input
                            :type="show ? 'text' : 'password'"
                            class="border border-gray-200 rounded p-2 w-full text-white bg-laravel"
                            name="password"
                            value="{{ old('password') }}"/>
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-white">
                            <i :class="show ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <button
                        type="submit"
                        class="border bg-gray-800 text-white rounded py-2 px-4 hover:underline">
                        Sign In
                    </button>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <a href="{{ route('forgot.password.form') }}" class="text-blue-400 hover:underline text-sm">
                        Forgot Password?
                    </a>
                </div>
                <div class="mt-8">
                    <p class="text-white">
                        Create Account?
                        <a href="/register" class="text-white hover:underline">Register</a>
                    </p>
                </div>
            </form>
        </x-card>
    </div>
</x-layout>
