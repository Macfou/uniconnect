<x-layout>
    <div class="pt-28 pb-32 px-6 max-w-6xl mx-auto">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('create.survey', $survey->listings_id) }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded">
            <h2 class="text-2xl font-semibold mb-4">Edit Survey</h2>

            <form method="POST" action="{{ route('survey.update', $survey->id) }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium">Overall</label>
                    <input type="text" name="overall" class="w-full border p-2 rounded" value="{{ $survey->overall }}">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Venue</label>
                    <input type="text" name="venue" class="w-full border p-2 rounded" value="{{ $survey->venue }}">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Time Management</label>
                    <input type="text" name="time" class="w-full border p-2 rounded" value="{{ $survey->time }}">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Number of Speakers</label>
                    <select id="speaker-count" class="w-full border p-2 rounded">
                        @php
                            $count = 0;
                            for ($i = 1; $i <= 5; $i++) {
                                $field = 'speaker' . $i;
                                if (!empty($survey->$field)) $count++;
                            }
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @if($count == $i) selected @endif>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div id="speakers-section">
                    @for ($i = 1; $i <= 5; $i++)
                        @php $field = 'speaker' . $i; @endphp
                        <div class="mb-4 speaker-input" id="speaker-input-{{ $i }}">
                            <label class="block font-medium">Speaker {{ $i }}</label>
                            <input type="text" name="speaker{{ $i }}" id="speaker{{ $i }}"
                                   class="w-full border p-2 rounded"
                                   value="{{ $survey->$field }}">
                        </div>
                    @endfor
                </div>

                <button type="button" onclick="useDefault()" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Use Default Questions</button>

                <div class="mt-6">
                    <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded">Update</button>
                </div>
            </form>
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
                document.querySelector('[name="overall"]').value = "What do you think about the event?";
                document.querySelector('[name="venue"]').value = "What can you say about the venue?";
                document.querySelector('[name="time"]').value = "What can you say about the event Time Management?";
                for (let i = 1; i <= 5; i++) {
                    document.querySelector(`[name="speaker${i}"]`).value = defaultQuestion;
                }
            }

            document.getElementById('speaker-count').dispatchEvent(new Event('change'));
        </script>
    </div>
</x-layout>
