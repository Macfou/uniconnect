<x-layout>

    <div class="pt-28 pb-32 px-6 max-w-7xl mx-auto">
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

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold text-center mb-8">Feedback and Ratings for Event: {{ $listing->title }}</h1>
    
            <!-- Feedback Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4"> Feedback</h2>
                @if($feedbacks->isEmpty())
                    <p class="text-gray-500">No feedback yet for this event.</p>
                @else
                    <div class="space-y-4">
                        @foreach($feedbacks as $feedback)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <p class="font-medium text-lg text-gray-800">{{ $feedback->user->fname }} {{ $feedback->user->lname }}</p>
                              
    
                                @if($feedback->feedback)
                                <div class="mt-2 text-sm text-gray-600">
                                    <strong>Overall Event:</strong> {{ $feedback->feedback }}
                                </div>
                            @endif
                                @if($feedback->feedback_venue)
                                    <div class="mt-2 text-sm text-gray-600">
                                        <strong>Venue Feedback:</strong> {{ $feedback->feedback_venue }}
                                    </div>
                                @endif
                                @if($feedback->feedback_time)
                                    <div class="mt-2 text-sm text-gray-600">
                                        <strong>Time Management Feedback:</strong> {{ $feedback->feedback_time }}
                                    </div>
                                @endif
                                @if($feedback->feedback_speaker)
                                    <div class="mt-2 text-sm text-gray-600">
                                        <strong>Speaker Feedback:</strong> {{ $feedback->feedback_speaker }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
    
            <!-- Ratings Section -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ratings</h2>
                @if($ratings->isEmpty())
                    <p class="text-gray-500">No ratings yet for this event.</p>
                @else
                    <div class="space-y-4">
                        @foreach($ratings as $rating)
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            @php
                                $responses = [1 => 'Very good', 2 => 'Good', 3 => 'Neutral', 4 => 'Bad', 5 => 'Very bad'];
                            @endphp
                        
                            <p class="font-bold text-xl text-black mb-2">Overall Event:</p>
                        
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_one }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_one] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_two }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_two] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_three }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_three] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_four }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_four] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_five }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_five] ?? 'No rating' }}</span>
                                </div>
                            </div>
                        
                            <p class="font-bold text-xl text-black mt-4 mb-2">Venue:</p>
                        
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_six }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_six] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_seven }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_seven] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_eight }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_eight] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_nine }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_nine] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_ten }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_ten] ?? 'No rating' }}</span>
                                </div>
                            </div>
                        
                            <p class="font-bold text-xl text-black mt-4 mb-2">Time Management:</p>
                        
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_eleven }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_eleven] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_twelve }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_twelve] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_thirteen }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_thirteen] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_fourteen }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_fourteen] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_fifteen }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_fifteen] ?? 'No rating' }}</span>
                                </div>
                            </div>
                        
                            <p class="font-bold text-xl text-black mt-4 mb-2">Speaker:</p>
                        
                            <div class="space-y-1">
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_sixteen }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_sixteen] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_seventeen }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_seventeen] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_eighteen }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_eighteen] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_nineteen }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_nineteen] ?? 'No rating' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-lg text-gray-800">{{ $rating->q_twenty }}</span>
                                    <span class="font-medium text-lg text-gray-800">| {{ $responses[$rating->r_twenty] ?? 'No rating' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</x-layout>