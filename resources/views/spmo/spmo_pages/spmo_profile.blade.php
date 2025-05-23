<x-spmo_layout>
    <div class="capitalize">
        <nav aria-label="breadcrumb" class="w-max">
          <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
            <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
              <a href="#">
                <p class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">SPMO</p>
              </a>
              <span class="text-gray-500 text-sm antialiased font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
            </li>
            <li class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Profile</h6>
            </li>
          </ol>
        </nav>
        
      </div>

      

    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-bold text-gray-800 mb-4">My Profile</h2>

        <!-- Display spmo User Information -->
        <p class="text-gray-700"><strong>First Name:</strong> {{ $spmoUser->fname }} {{ $spmoUser->lname }}</p>
        <p class="text-gray-700"><strong>Email: </strong> {{ $spmoUser->email }}</p>

        <!-- Change Password Form -->
        <h3 class="text-lg font-semibold text-gray-800 mt-6">Change Password</h3>

        @if(session('success'))
            <p class="text-green-500">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="text-red-500">{{ $error }}</p>
            @endforeach
        @endif

        <form action="{{ route('spmo.updatePassword') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Current Password</label>
                <input type="password" name="current_password" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">New Password</label>
                <input type="password" name="new_password" class="w-full p-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="w-full p-2 border rounded-lg" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Password
            </button>
        </form>
    </div>
</x-spmo_layout>