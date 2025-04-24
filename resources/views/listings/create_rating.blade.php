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
            <h2 class="text-2xl font-semibold mb-4">Create Feedback Questions for: {{ $event->title }}</h2>

            <form method="POST" action="{{ route('feedback.store') }}">
                @csrf
                <input type="hidden" name="listings_id" value="{{ $event->id }}">

                {{-- Default Questions Button --}}
                <button type="button" onclick="useDefaultQuestions()" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Use Default Questions</button>

                <div class="mt-6 space-y-4">
                    @for ($i = 1; $i <= 20; $i++)
                        @php
                            $field = 'q_' . ($i < 11 ? \Illuminate\Support\Str::lower(\Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::replaceArray('_', ['_'], \Illuminate\Support\Str::snake(\Illuminate\Support\Str::words($i, 1))))) : ['eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty'][$i - 11]);
                        @endphp
                        <div>
                            <label class="block font-medium capitalize" for="{{ $field }}">Question {{ $i }}</label>
                            <input type="text" name="{{ $field }}" id="{{ $field }}" class="w-full border p-2 rounded" value="Likelihood of attending a similar event in the future">
                        </div>
                    @endfor
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Create Feedback Questions</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function useDefaultQuestions() {
            const questions = {
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

            Object.entries(questions).forEach(([key, value]) => {
                const input = document.querySelector(`input[name="${key}"]`);
                if (input) input.value = value;
            });
        }
    </script>
</x-layout>
