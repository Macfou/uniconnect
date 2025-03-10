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
                <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Inventory</h6>
            </li>
          </ol>
        </nav>
        
      </div>

      <div class="min-h-screen p-8">
        <div class="bg-white p-10 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-6">Inventory List</h1>

            <!-- Success message -->
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Category Form -->
            <form action="{{ route('gso.gso_pages.gso_category.store') }}" method="POST" class="mb-6">
                @csrf
                <div class="flex space-x-4">
                    <input type="text" name="name" placeholder="Supply Name" class="px-4 py-2 border rounded-md w-full" required>
                    <input type="number" name="quantity" placeholder="Quantity" class="px-4 py-2 border rounded-md w-24" min="0" required>
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Add Supply
                    </button>
                </div>
            </form>
            

            <!-- Categories Table -->
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="px-4 py-2 text-left">quantity</th>
                        <th class="px-4 py-2 text-left">Supply Name</th>
                        <th class="px-4 py-2 text-left">Availability</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{$category->quantity}}</td>
                            <td class="px-4 py-2">{{ $category->name }}</td>
                            <td class="px-4 py-2">
                                
                                 <button  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                   Available 
                                </button>          
                                <button  class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 ml-2">
                                    Unavailable
                                </button>
                            </td>
                            <td class="px-4 py-2">
                                <!-- Update Button -->
                                <button  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Update
                                </button>
                            
                                <!-- Hide Button -->
                                <button  class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 ml-2">
                                    delete
                                </button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-gso-layout>