<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">
                Request Dean Approval for: <span class="text-blue-600">{{ $event->tags ?? 'Untitled Event' }}</span>
            </h2>
            <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Search for Dean by Email</h2>
            @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif


            <form id="searchForm" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Enter Email:</label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-3 mt-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>

                <div>
                    <button type="submit" class="w-full py-3 bg-blue-600 text-white text-lg font-medium rounded-lg hover:bg-blue-700 transition ease-in-out duration-300">
                        Search
                    </button>
                </div>
                
            </form>

            <div id="userInfo" class="mt-6 hidden">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Dean Information:</h3>
                <p id="fname" class="text-gray-700 text-lg"></p>
                <p id="lname" class="text-gray-700 text-lg"></p>
                <p id="org" class="text-gray-700 text-lg"></p>
            </div>

            <div id="errorMessage" class="mt-6 hidden text-red-600">
                <p class="text-lg font-semibold">User not found.</p>
            </div>

            <!-- Form to submit the dean -->
            <form id="approveForm" action="{{ route('dean.approval.store') }}" method="POST" class="mt-6 space-y-6 hidden">
                @csrf
                <input type="hidden" name="dean_id" id="dean_id">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="listings_id" value="{{ $event->id }}">

                <button type="submit" class="w-full py-3 bg-blue-600 text-white text-lg font-medium rounded-lg hover:bg-blue-700 transition ease-in-out duration-300">
                    Request Dean
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;

            fetch('{{ route('searchdean.user') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('userInfo').style.display = 'none';
                    document.getElementById('errorMessage').style.display = 'block';
                    document.getElementById('approveForm').style.display = 'none';
                } else {
                    document.getElementById('userInfo').style.display = 'block';
                    document.getElementById('fname').textContent = 'First Name: ' + data.fname;
                    document.getElementById('lname').textContent = 'Last Name: ' + data.lname;
                    document.getElementById('org').textContent = 'Organization: ' + data.org;
                    document.getElementById('errorMessage').style.display = 'none';

                    // Set dean_id in the hidden input and show the form
                    document.getElementById('dean_id').value = data.id;
                    document.getElementById('approveForm').style.display = 'block';
                }
            });
        });
    </script>

</x-layout>
