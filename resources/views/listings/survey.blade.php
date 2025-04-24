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


    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold mb-4">Survey for: {{ $event->title }}</h2>

    @if ($existingSurvey)

    @if (session('success'))
    <div class="mb-4 text-green-700 bg-green-100 border border-green-300 px-4 py-3 rounded">
        {{ session('success') }}
    </div>
@endif
        <p class="text-green-600 font-semibold mb-4">You have already created a survey for this event.</p>

        <div class="space-y-2">
            <p><strong>Overall:</strong> {{ $existingSurvey->overall }}</p>
            <p><strong>Venue:</strong> {{ $existingSurvey->venue }}</p>
            <p><strong>Time Management:</strong> {{ $existingSurvey->time }}</p>
            @for ($i = 1; $i <= 5; $i++)
                @php $field = 'speaker' . $i; @endphp
                @if (!empty($existingSurvey->$field))
                    <p><strong>Speaker {{ $i }}:</strong> {{ $existingSurvey->$field }}</p>
                @endif
            @endfor
        </div>

        <div class="mt-6">
            <a href="{{ route('survey.edit', $existingSurvey->id) }}"
               class="bg-yellow-500 text-white px-6 py-2 rounded inline-block">
               Edit Survey
            </a>
        </div>
    @else

        <form method="POST" action="{{ route('survey.store') }}">
            @csrf
            <input type="hidden" name="listings_id" value="{{ $event->id }}">

            <div class="mb-4">
                <label class="block font-medium">Overall</label>
                <input type="text" name="overall" id="overall" class="w-full border p-2 rounded" value="What do you think about the event?">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Venue</label>
                <input type="text" name="venue" id="venue" class="w-full border p-2 rounded" value="What can you say about the venue?">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Time Management</label>
                <input type="text" name="time" id="time" class="w-full border p-2 rounded" value="What can you say about the event Time Management?">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Number of Speakers</label>
                <select id="speaker-count" class="w-full border p-2 rounded">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3" selected>3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div id="speakers-section">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="mb-4 speaker-input" id="speaker-input-{{ $i }}">
                        <label class="block font-medium">Speaker {{ $i }}</label>
                        <input type="text" name="speaker{{ $i }}" id="speaker{{ $i }}" class="w-full border p-2 rounded" value="What can you say about the Presentation?">
                    </div>
                @endfor
            </div>

            <button type="button" onclick="useDefault()" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Use Default Questions</button>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Create</button>
            </div>
        </form>
    </div>
    @endif
</div>

    <script>
        const defaultQuestion = "What can you say about the Presentation?";

        document.getElementById('speaker-count').addEventListener('change', function () {
            const count = parseInt(this.value);
            for (let i = 1; i <= 5; i++) {
                document.getElementById(`speaker-input-${i}`).style.display = i <= count ? 'block' : 'none';
            }
        });

        function useDefault() {
            document.getElementById('overall').value = "What do you think about the event?";
            document.getElementById('venue').value = "What can you say about the venue?";
            document.getElementById('time').value = "What can you say about the event Time Management?";
            for (let i = 1; i <= 5; i++) {
                document.getElementById(`speaker${i}`).value = defaultQuestion;
            }
        }

        document.getElementById('speaker-count').dispatchEvent(new Event('change'));
    </script>
    </div>
</x-layout>
