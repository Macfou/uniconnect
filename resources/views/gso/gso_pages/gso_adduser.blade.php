<x-gso-layout>

    <div class="capitalize">
        <nav aria-label="breadcrumb" class="w-max">
          <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
            <li class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
              <a href="#">
                <p class="block antialiased font-sans text-sm leading-normal text-blue-900 font-normal opacity-50 transition-all hover:text-blue-500 hover:opacity-100">GSO</p>
              </a>
              <span class="text-gray-500 text-sm antialiased font-sans font-normal leading-normal mx-2 pointer-events-none select-none">/</span>
            </li>
            <li class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Borrowed</h6>
            </li>
          </ol>
        </nav>       
      </div>


    <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Add GSO User</h2>
        
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('gso.adduser.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">First Name</label>
                <input type="text" name="fname" required class="w-full px-3 py-2 border rounded-lg">
            </div>
        
            <div class="mb-4">
                <label class="block text-gray-700">Last Name</label>
                <input type="text" name="lname" required class="w-full px-3 py-2 border rounded-lg">
            </div>
        
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg">
            </div>
        
            <div class="mb-4">
                <label class="block text-gray-700">Temporary Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border rounded-lg">
            </div>
        
            <div class="mb-4">
                <label class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border rounded-lg">
            </div>
        
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save User
            </button>
        </form>
        
    </div>
</x-gso-layout>
