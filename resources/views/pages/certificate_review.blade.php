<x-layout>

    <div class="bg-gray-100 py-10">
        <div class="max-w-4xl mx-auto bg-white shadow-lg p-6 rounded-lg">
            <h1 class="text-2xl font-bold mb-4">{{ $certificate->title }}</h1>
    
            @if ($certificate->background_image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $certificate->background_image) }}" 
                         alt="Certificate Background" class="w-full rounded shadow">
                </div>
            @endif
    
            <div class="border rounded p-6 bg-gray-50">
                {!! json_decode($certificate->content)->html !!}
            </div>
    
            <div class="mt-6">
                <a href="{{ route('certificates.create') }}" 
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Create Another Certificate
                </a>
            </div>
        </div>
    </div>
</x-layout>