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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded">
            @if(isset($existingFeedback))
                {{-- Display existing feedback questions --}}
                <h2 class="text-2xl font-semibold mb-4">Feedback Questions for: {{ $event->tags }}</h2>
                <div class="mb-6">
                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                        <p class="text-blue-800 font-medium mb-2">Feedback questions already exist for this event.</p>
                        <p class="text-sm text-blue-600">You can view them below or update them using the button.</p>
                    </div>
                </div>

                {{-- Display existing questions --}}
                <div class="space-y-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-lg font-bold block mb-3">Overall Event</label>
                        <hr class="my-2 border-gray-400">
                        <div class="space-y-3">
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 1</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_one }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 2</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_two }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 3</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_three }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 4</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_four }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 5</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_five }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-lg font-bold block mb-3">Venue</label>
                        <hr class="my-2 border-gray-400">
                        <div class="space-y-3">
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 6</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_six }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 7</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_seven }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 8</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_eight }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 9</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_nine }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 10</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_ten }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-lg font-bold block mb-3">Time Management</label>
                        <hr class="my-2 border-gray-400">
                        <div class="space-y-3">
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 11</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_eleven }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 12</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_twelve }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 13</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_thirteen }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 14</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_fourteen }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 15</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_fifteen }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="text-lg font-bold block mb-3">Speaker</label>
                        <hr class="my-2 border-gray-400">
                        <div class="space-y-3">
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 16</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_sixteen }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 17</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_seventeen }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 18</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_eighteen }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 19</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_nineteen }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-600">Question 20</label>
                                <p class="bg-white p-2 border rounded">{{ $existingFeedback->q_twenty }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Update Survey Button --}}
                <div class="mt-6">
                    <a href="{{ route('feedback.edit', $event->id) }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Update Survey
                    </a>
                </div>
            @else
                {{-- Create new feedback form --}}
                <h2 class="text-2xl font-semibold mb-4">Create Feedback Questions for: {{ $event->tags }}</h2>

                <form method="POST" action="{{ route('feedback.store') }}" id="feedback-form">
                    @csrf
                    <input type="hidden" name="listings_id" value="{{ $event->id }}">

                    {{-- Default Questions Button --}}
                    <button type="button" onclick="useDefaultQuestions()" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 hover:bg-blue-600 transition">
                        Use Default Questions
                    </button>

                    <div class="mt-6 space-y-4">
                        <label class="text-lg font-bold">Overall event </label>
                        <hr class="my-2 border-gray-400">
                        
                        <div>
                            <label class="block font-medium capitalize" for="q_one">Question 1</label>
                            <input type="text" name="q_one" id="q_one" 
                                   class="w-full border p-2 rounded @error('q_one') border-red-500 @enderror" 
                                   value="{{ old('q_one', 'Overall quality of the event') }}" required>
                            @error('q_one')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_two">Question 2</label>
                            <input type="text" name="q_two" id="q_two" 
                                   class="w-full border p-2 rounded @error('q_two') border-red-500 @enderror" 
                                   value="{{ old('q_two', 'Engagement of the event from start to finish') }}" required>
                            @error('q_two')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_three">Question 3</label>
                            <input type="text" name="q_three" id="q_three" 
                                   class="w-full border p-2 rounded @error('q_three') border-red-500 @enderror" 
                                   value="{{ old('q_three', 'Satisfaction with the event\'s organization') }}" required>
                            @error('q_three')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_four">Question 4</label>
                            <input type="text" name="q_four" id="q_four" 
                                   class="w-full border p-2 rounded @error('q_four') border-red-500 @enderror" 
                                   value="{{ old('q_four', 'Relevance of the event content to your interests') }}" required>
                            @error('q_four')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_five">Question 5</label>
                            <input type="text" name="q_five" id="q_five" 
                                   class="w-full border p-2 rounded @error('q_five') border-red-500 @enderror" 
                                   value="{{ old('q_five', 'Likelihood of attending a similar event in the future') }}" required>
                            @error('q_five')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="text-lg font-bold">Venue</label>
                        <hr class="my-2 border-gray-400">
                        
                        <div>
                            <label class="block font-medium capitalize" for="q_six">Question 6</label>
                            <input type="text" name="q_six" id="q_six" 
                                   class="w-full border p-2 rounded @error('q_six') border-red-500 @enderror" 
                                   value="{{ old('q_six', 'Comfort of the seating and space') }}" required>
                            @error('q_six')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_seven">Question 7</label>
                            <input type="text" name="q_seven" id="q_seven" 
                                   class="w-full border p-2 rounded @error('q_seven') border-red-500 @enderror" 
                                   value="{{ old('q_seven', 'Accessibility of the venue location') }}" required>
                            @error('q_seven')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_eight">Question 8</label>
                            <input type="text" name="q_eight" id="q_eight" 
                                   class="w-full border p-2 rounded @error('q_eight') border-red-500 @enderror" 
                                   value="{{ old('q_eight', 'Suitability of the venue for the event') }}" required>
                            @error('q_eight')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_nine">Question 9</label>
                            <input type="text" name="q_nine" id="q_nine" 
                                   class="w-full border p-2 rounded @error('q_nine') border-red-500 @enderror" 
                                   value="{{ old('q_nine', 'Cleanliness and maintenance of the venue') }}" required>
                            @error('q_nine')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_ten">Question 10</label>
                            <input type="text" name="q_ten" id="q_ten" 
                                   class="w-full border p-2 rounded @error('q_ten') border-red-500 @enderror" 
                                   value="{{ old('q_ten', 'Audio/Visual setup of the venue') }}" required>
                            @error('q_ten')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="text-lg font-bold">Time Management</label>
                        <hr class="my-2 border-gray-400">
                        
                        <div>
                            <label class="block font-medium capitalize" for="q_eleven">Question 11</label>
                            <input type="text" name="q_eleven" id="q_eleven" 
                                   class="w-full border p-2 rounded @error('q_eleven') border-red-500 @enderror" 
                                   value="{{ old('q_eleven', 'Clarity and understandability of presenters') }}" required>
                            @error('q_eleven')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_twelve">Question 12</label>
                            <input type="text" name="q_twelve" id="q_twelve" 
                                   class="w-full border p-2 rounded @error('q_twelve') border-red-500 @enderror" 
                                   value="{{ old('q_twelve', 'Effectiveness of visual aids (slides, videos)') }}" required>
                            @error('q_twelve')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_thirteen">Question 13</label>
                            <input type="text" name="q_thirteen" id="q_thirteen" 
                                   class="w-full border p-2 rounded @error('q_thirteen') border-red-500 @enderror" 
                                   value="{{ old('q_thirteen', 'Organization of the presentations') }}" required>
                            @error('q_thirteen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_fourteen">Question 14</label>
                            <input type="text" name="q_fourteen" id="q_fourteen" 
                                   class="w-full border p-2 rounded @error('q_fourteen') border-red-500 @enderror" 
                                   value="{{ old('q_fourteen', 'Speaker knowledge and expertise') }}" required>
                            @error('q_fourteen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_fifteen">Question 15</label>
                            <input type="text" name="q_fifteen" id="q_fifteen" 
                                   class="w-full border p-2 rounded @error('q_fifteen') border-red-500 @enderror" 
                                   value="{{ old('q_fifteen', 'Engagement and interactivity of the presentations') }}" required>
                            @error('q_fifteen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="text-lg font-bold">Speaker</label>
                        <hr class="my-2 border-gray-400">
                        
                        <div>
                            <label class="block font-medium capitalize" for="q_sixteen">Question 16</label>
                            <input type="text" name="q_sixteen" id="q_sixteen" 
                                   class="w-full border p-2 rounded @error('q_sixteen') border-red-500 @enderror" 
                                   value="{{ old('q_sixteen', 'Timeliness of event start and end') }}" required>
                            @error('q_sixteen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_seventeen">Question 17</label>
                            <input type="text" name="q_seventeen" id="q_seventeen" 
                                   class="w-full border p-2 rounded @error('q_seventeen') border-red-500 @enderror" 
                                   value="{{ old('q_seventeen', 'Pacing of each session or activity') }}" required>
                            @error('q_seventeen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_eighteen">Question 18</label>
                            <input type="text" name="q_eighteen" id="q_eighteen" 
                                   class="w-full border p-2 rounded @error('q_eighteen') border-red-500 @enderror" 
                                   value="{{ old('q_eighteen', 'Reasonableness of break durations') }}" required>
                            @error('q_eighteen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_nineteen">Question 19</label>
                            <input type="text" name="q_nineteen" id="q_nineteen" 
                                   class="w-full border p-2 rounded @error('q_nineteen') border-red-500 @enderror" 
                                   value="{{ old('q_nineteen', 'Efficiency of time allocation per speaker/topic') }}" required>
                            @error('q_nineteen')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium capitalize" for="q_twenty">Question 20</label>
                            <input type="text" name="q_twenty" id="q_twenty" 
                                   class="w-full border p-2 rounded @error('q_twenty') border-red-500 @enderror" 
                                   value="{{ old('q_twenty', 'Management of the overall event schedule') }}" required>
                            @error('q_twenty')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                            Create Feedback Questions
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <script>
        function useDefaultQuestions() {
            const questions = {
                q_one: 'Overall quality of the event',
                q_two: 'Engagement of the event from start to finish',
                q_three: 'Satisfaction with the event\'s organization',
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