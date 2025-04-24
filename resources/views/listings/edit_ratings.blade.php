<x-layout>

    <div class="pt-28 pb-32 px-6 max-w-6xl mx-auto">

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

        {{-- Success Message --}}
        @if(session('success'))
            <p class="text-green-600 font-semibold mb-4">{{ session('success') }}</p>
        @endif

        <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded">
            <h2 class="text-2xl font-semibold mb-4">Edit Feedback Questions for: {{ $event->title }}</h2>

            <form method="POST" action="{{ route('feedback.update', $feedback->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="listings_id" value="{{ $event->id }}">

                {{-- Default Question Section --}}
                <button type="button" onclick="useDefaultQuestions()" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Use Default Questions</button>

                <div class="mt-6">
                    <div class="mb-4">
                        <label class="block font-medium">Overall quality of the event</label>
                        <input type="text" name="q_one" class="w-full border p-2 rounded" value="{{ old('q_one', $feedback->q_one) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Engagement of the event from start to finish</label>
                        <input type="text" name="q_two" class="w-full border p-2 rounded" value="{{ old('q_two', $feedback->q_two) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Satisfaction with the event’s organization</label>
                        <input type="text" name="q_three" class="w-full border p-2 rounded" value="{{ old('q_three', $feedback->q_three) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Relevance of the event content to your interests</label>
                        <input type="text" name="q_four" class="w-full border p-2 rounded" value="{{ old('q_four', $feedback->q_four) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Likelihood of attending a similar event in the future</label>
                        <input type="text" name="q_five" class="w-full border p-2 rounded" value="{{ old('q_five', $feedback->q_five) }}">
                    </div>

                    {{-- Additional Questions --}}
                    @for ($i = 6; $i <= 20; $i++)
                        <div class="mb-4">
                            <label class="block font-medium">Question {{ $i }}</label>
                            <input type="text" name="q_{{ $i }}" class="w-full border p-2 rounded" value="{{ old("q_$i", $feedback->{'q_' . $i}) }}">
                        </div>
                    @endfor
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Update Feedback Questions</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function useDefaultQuestions() {
            const defaultQuestions = {
                q_one: 'Overall quality of the event',
                q_two: 'Engagement of the event from start to finish',
                q_three: 'Satisfaction with the event’s organization',
                q_four: 'Relevance of the event content to your interests',
                q_five: 'Likelihood of attending a similar event in the future',
                q_six: 'Comfort of the seating and space',
                q_seven: 'Accessibility of the venue location',
                q_eight: 'Suitability of the venue for the event',
                q_nine: 'Cleanliness and maintenance of the venue',
                q_ten: 'Audio/Visual setup of the venue',
                q_eleven: 'Clarity and understandability of presenters',
                q_twelve: 'Effectiveness of visual aids (slides, videos)',
                q_thirteen: 'Organization of the presentations',
                q_fourteen: 'Speaker knowledge and expertise',
                q_fifteen: 'Engagement and interactivity of the presentations',
                q_sixteen: 'Timeliness of event start and end',
                q_seventeen: 'Pacing of each session or activity',
                q_eighteen: 'Reasonableness of break durations',
                q_nineteen: 'Efficiency of time allocation per speaker/topic',
                q_twenty: 'Management of the overall event schedule'
            };

            for (let i = 1; i <= 20; i++) {
                document.querySelector(`input[name="q_${i}"]`).value = defaultQuestions[`q_${i}`];
            }
        }
    </script>

</x-layout>
