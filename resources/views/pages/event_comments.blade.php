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
    

            
        <div class="max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-lg">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">What do you think about the event?</h2>
            </div>
        
            <!-- Feedback Textarea -->
            <div class="p-6">
                <textarea 
                    id="feedbackText{{ $event_id }}" 
                    class="w-full h-24 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-laravel focus:outline-none"
                    placeholder="Write your comment here..."></textarea>
                <input type="hidden" id="eventId{{ $event_id }}" value="{{ $event_id }}">
            </div>
        
            <!-- Venue Feedback -->
            <div class="px-6 py-2 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">What can you say about the venue?</h2>
            </div>
            <div class="p-6">
                <textarea 
                    id="venueFeedbackText{{ $event_id }}" 
                    class="w-full h-24 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-laravel focus:outline-none"
                    placeholder="Write your comment here..."></textarea>
            </div>
        
            <!-- Presentation Feedback -->
            <div class="px-6 py-2 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">What can you say about the presentation?</h2>
            </div>
            <div class="p-6">
                <textarea 
                    id="speakerFeedbackText{{ $event_id }}" 
                    class="w-full h-24 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-laravel focus:outline-none"
                    placeholder="Write your comment here..."></textarea>
            </div>
        
            <!-- Time Management Feedback -->
            <div class="px-6 py-2 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">What can you say about the event time management?</h2>
            </div>
            <div class="p-6">
                <textarea 
                    id="timeFeedbackText{{ $event_id}}" 
                    class="w-full h-24 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-laravel focus:outline-none"
                    placeholder="Write your comment here..."></textarea>
            </div>
        
            <!-- Action Buttons -->
            <div class="flex justify-end px-6 py-4 border-t border-gray-200">
                <a href="{{ url()->previous() }}" class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</a>
                <button id="submitFeedback{{ $event_id }}" 
                        class="px-4 py-2 text-white bg-laravel rounded-lg hover:bg-gray-700"
                        data-event-id="{{ $event_id }}">
                    Submit
                </button>
            </div>
        </div>
        
        </div>

        <script>
            document.querySelectorAll('[id^="submitFeedback"]').forEach(submitFeedback => {
                submitFeedback.addEventListener('click', () => {
                    const eventId = submitFeedback.getAttribute('data-event-id');
                    const feedback = document.getElementById(`feedbackText${eventId}`).value;
                    const venueFeedback = document.getElementById(`venueFeedbackText${eventId}`).value;
                    const speakerFeedback = document.getElementById(`speakerFeedbackText${eventId}`).value;
                    const timeFeedback = document.getElementById(`timeFeedbackText${eventId}`).value;
            
                    if (!feedback.trim() || !venueFeedback.trim() || !speakerFeedback.trim() || !timeFeedback.trim()) {
                        alert("All feedback fields must be filled out!");
                        return;
                    }
            
                    fetch('/feedback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            event_id: eventId,
                            feedback: feedback,
                            feedback_venue: venueFeedback,
                            feedback_speaker: speakerFeedback,
                            feedback_time: timeFeedback
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message || 'Feedback submitted successfully!');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while submitting feedback.');
                    });
                });
            });
            </script>
            

         
    </x-layout>
    