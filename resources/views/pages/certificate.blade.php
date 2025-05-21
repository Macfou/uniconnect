<x-layout>
    @include('partials._myevents')

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-6">View Feedbacks</h2>

        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-4">
            <div class="mb-4">
                <form method="GET" action="{{ route('certificate.feedback') }}" class="flex items-center space-x-2">
                    <select name="listing_id" id="listing_id" class="border p-2 rounded w-full text-sm">
                       @foreach($events as $event)
    <option value="{{ $event->id }}" {{ request('listing_id') == $event->id ? 'selected' : '' }}>
        {{ $event->tags }} ({{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }})
    </option>
@endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition duration-200">
                        View
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-700">
                            <th class="border px-4 py-2">User</th>
                            <th class="border px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($feedbacks) && count($feedbacks) > 0)
                            @foreach($feedbacks as $feedback)
                                <tr class="border-b">
                                    <td class="border px-4 py-2">
                                        <span class="font-medium">{{ $feedback->user->fname }} {{ $feedback->user->lname }}</span>
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        @php
                                            $certificateSent = \App\Models\SentCertificate::where('user_id', $feedback->user->id)
                                                ->where('listing_id', request('listing_id'))
                                                ->exists();
                                        @endphp
                                        
                                        @if($certificateSent)
                                            <span class="text-green-500 font-medium">Certificate Already Sent</span>
                                        @else
                                            <form method="POST" action="{{ route('certificate.send') }}" enctype="multipart/form-data" class="flex flex-col items-center space-y-2">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $feedback->user->id }}">
                                                <input type="hidden" name="listing_id" value="{{ request('listing_id') }}">
                                                <input type="file" name="certificate" accept="image/*" required class="text-sm border rounded p-1">
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition duration-200">
                                                    Send Certificate
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="border px-4 py-2 text-center text-gray-500" colspan="2">No feedbacks available for the selected event.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
