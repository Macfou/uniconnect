<x-gso-layout>
  <div class="capitalize">
      <nav aria-label="breadcrumb" class="w-max">
          <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0">
              <li class="text-blue-gray-900 text-sm font-normal">
                  <a href="#" class="hover:text-light-blue-500">GSO</a>
                  <span class="mx-2">/</span>
              </li>
              <li class="text-gray-900 text-base font-semibold">Inventory</li>
          </ol>
      </nav>
  </div>

  <div class="min-h-screen p-8">
      <div class="bg-white p-10 rounded-lg shadow-lg">
          <h1 class="text-3xl font-bold mb-6">Inventory</h1>

          <!-- Category Dropdown -->
          <form method="GET" action="{{ route('gso.inventory') }}">
              <label for="category" class="block text-lg font-medium mb-2">Category</label>
              <select id="category" name="category" class="w-full p-3 border rounded-lg">
                  <option value="" disabled selected>Select a category</option>
                  @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
          </form>

          <!-- Success Message -->
          @if (session('success'))
              <div class="bg-green-100 text-green-700 p-4 my-4 rounded-md">
                  {{ session('success') }}
              </div>
          @endif

          <!-- Add Supply Form -->
          <form action="{{ route('gso.inventory.add') }}" method="POST" class="my-6">
              @csrf
              <div class="flex space-x-4">
                  <input type="text" name="name" placeholder="Supply Name" class="px-4 py-2 border rounded-md w-full" required>
                  <input type="number" name="quantity" placeholder="Quantity" class="px-4 py-2 border rounded-md w-24" required>
                  <select name="gso_category_id" class="px-4 py-2 border rounded-md w-48">
                      <option value="" disabled selected>Select Category</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                  </select>
                  <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                      Add Supply
                  </button>
              </div>
          </form>

          <!-- Inventory Table -->
          <table class="min-w-full table-auto border-collapse border border-gray-200">
              <thead>
                  <tr class="bg-gray-200 text-gray-700">
                      <th class="px-4 py-2 border">#</th>
                      <th class="px-4 py-2 border">Supply Name</th>
                      <th class="px-4 py-2 border">Quantity</th>
                      <th class="px-4 py-2 border">Status</th>
                      <th class="px-4 py-2 border">Category</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($inventories as $inventory)
                      <tr class="border-t">
                          <td class="px-4 py-2 border">{{ $inventory->id }}</td>
                          <td class="px-4 py-2 border">{{ $inventory->name }}</td>
                          <td class="px-4 py-2 border">{{ $inventory->quantity }}</td>
                          <td class="px-4 py-2 border">{{ $inventory->status }}</td>
                          <td class="px-4 py-2 border">{{ $inventory->category->name ?? 'Uncategorized' }}</td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="5" class="px-4 py-2 text-center">No items available.</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>
</x-gso-layout>
