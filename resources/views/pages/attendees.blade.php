<x-layout>
    <div class="container mx-auto pt-28 p-4">
        <h2 class="text-2xl font-bold mb-4">Attendees for Event: {{ $event->title }}</h2>

        @if($attendees->isEmpty())
            <p>No attendees found for this event.</p>
        @else
            <table class="min-w-full text-sm text-left bg-white shadow-md rounded">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-2">First Name</th>
                        <th class="px-4 py-2">Last Name</th>
                        
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($attendees as $attendee)
                        <tr>
                            <td class="px-4 py-2">{{ $attendee->fname }}</td>
                            <td class="px-4 py-2">{{ $attendee->lname }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout>
