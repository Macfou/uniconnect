<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-3xl mx-auto">
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
            <h2 class="text-xl font-semibold text-gray-800 mb-6">
                Upload Adviser Approval PDF for: <span class="text-blue-600">{{ $event->tags ?? 'Untitled Event' }}</span>
            </h2>

            {{-- Alerts --}}
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

            {{-- Check if file exists and show view button --}}
            {{-- Show "View PDF" button if user already uploaded --}}
@if($uploadedFilePath)
    <div class="mb-6">
        <a href="{{ asset('storage/' . $uploadedFilePath) }}" target="_blank"
           class="inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
            View Uploaded PDF
        </a>
    </div>
@endif


            {{-- Upload Form --}}
            <form action="{{ route('adviser.approval.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="listings_id" value="{{ $event->id }}">

                <div class="mb-4">
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">Upload PDF File:</label>
                    <input type="file" name="pdf_file" accept="application/pdf" required
                        class="block w-full border border-gray-300 rounded-lg shadow-sm p-2">
                </div>

                <button type="submit"
                    class="w-full py-3 bg-blue-600 text-white text-lg font-medium rounded-lg hover:bg-blue-700 transition">
                    Submit Approval PDF
                </button>
            </form>
        </div>
    </div>
</x-layout>
