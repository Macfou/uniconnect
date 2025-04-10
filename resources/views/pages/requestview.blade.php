<x-layout>
   
    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">

        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-bold text-gray-800">My Equipment Requests</h2>
        
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded-md mt-2">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="w-full mt-4 text-left border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 border-b">Equipment</th>
                    <th class="p-4 border-b">Quantity</th>
                    <th class="p-4 border-b">Status</th>
                    <th class="p-4 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 border-b">{{ $request->equipment->name }}</td>
                        <td class="p-4 border-b">{{ $request->quantity }}</td>
                        <td class="p-4 border-b">
                            <span class="px-2 py-1 text-white rounded {{ $request->status == 'approved' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td class="p-4 border-b">
                            @if($request->status == 'pending')
                            <form action="{{ route('pages.requestview.cancel', ['id' => $request->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this request?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                                    Cancel Request
                                </button>
                            </form>
                            
                            @else
                                <span class="text-black">Ready for Pick Up</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    @include('partials._footer')
</x-layout>