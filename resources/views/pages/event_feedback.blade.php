<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">
    
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>
    
        <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
            <h2 class="text-2xl font-semibold mb-6 text-center">Event Feedback Form</h2>
            <form action="{{ route('submit.feedback', ['listings_id' => $event_id]) }}" method="POST">
            @csrf

            <input type="hidden" name="listings_id" value="{{ $event_id }}">


            <p class="text-sm text-gray-600 mb-1">
                <strong>Legend:</strong> 1 - Very Good, 2 - Good, 3 - Neutral, 4 - Bad, 5 - Very Bad
            </p>

            {{-- Section A: Event --}}
            <h3 class="text-xl font-bold mt-6 mb-2">A. What do you think about the event?</h3>
            @foreach([
                'Overall quality of the event',
                'Engagement of the event from start to finish',
                'Satisfaction with the event\'s organization',
                'Relevance of the event content to your interests',
                'Likelihood of attending a similar event in the future'
            ] as $index => $question)
                <div class="mb-4">
                    <label class="block mb-1 font-medium">{{ $question }}</label>
                    <div class="flex gap-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <label>
                                <input type="radio" name="event_rating[{{ $index }}]" value="{{ $i }}" required>
                                {{ $i }}
                            </label>
                        @endfor
                    </div>
                </div>
            @endforeach

            <div class="flex  px-6 py-4 border-t border-black">
            </div>
            {{-- Section B: Venue --}}
            <h3 class="text-xl font-bold mt-6 mb-2">B. What can you say about the venue?</h3>
            @foreach([
                'Comfort of the seating and space',
                'Accessibility of the venue location',
                'Suitability of the venue for the event',
                'Cleanliness and maintenance of the venue',
                'Audio/Visual setup of the venue'
            ] as $index => $question)
                <div class="mb-4">
                    <label class="block mb-1 font-medium">{{ $question }}</label>
                    <div class="flex gap-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <label>
                                <input type="radio" name="venue_rating[{{ $index }}]" value="{{ $i }}" required>
                                {{ $i }}
                            </label>
                        @endfor
                    </div>
                </div>
            @endforeach

            <div class="flex  px-6 py-4 border-t border-black">
            </div>
            {{-- Section C: Presentation --}}
            <h3 class="text-xl font-bold mt-6 mb-2">C. What can you say about the Presentation?</h3>
            @foreach([
                'Clarity and understandability of presenters',
                'Effectiveness of visual aids (slides, videos)',
                'Organization of the presentations',
                'Speaker knowledge and expertise',
                'Engagement and interactivity of the presentations'
            ] as $index => $question)
                <div class="mb-4">
                    <label class="block mb-1 font-medium">{{ $question }}</label>
                    <div class="flex gap-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <label>
                                <input type="radio" name="presentation_rating[{{ $index }}]" value="{{ $i }}" required>
                                {{ $i }}
                            </label>
                        @endfor
                    </div>
                </div>
            @endforeach

            <div class="flex  px-6 py-4 border-t border-black">
            </div>
            {{-- Section D: Time Management --}}
            <h3 class="text-xl font-bold mt-6 mb-2">D. What can you say about the event Time Management?</h3>
            @foreach([
                'Timeliness of event start and end',
                'Pacing of each session or activity',
                'Reasonableness of break durations',
                'Efficiency of time allocation per speaker/topic',
                'Management of the overall event schedule'
            ] as $index => $question)
                <div class="mb-4">
                    <label class="block mb-1 font-medium">{{ $question }}</label>
                    <div class="flex gap-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <label>
                                <input type="radio" name="time_rating[{{ $index }}]" value="{{ $i }}" required>
                                {{ $i }}
                            </label>
                        @endfor
                    </div>
                </div>
            @endforeach

            {{-- Submit Button --}}
            <div class="mt-8 text-center">
                <button type="submit" class="px-4 py-2 text-white bg-laravel rounded-lg hover:bg-gray-700">
                    Next
                </button>
            </div>
        </form>
        </div>
    </div>
    </x-layout>
    