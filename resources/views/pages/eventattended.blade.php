<x-layout>

    @include('partials._breadcrumb')

    

    <div class="md:col-span-3 bg-white px-4 shadow-xl p-6 space-y-2 rounded-lg mt-6">

      <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
          <table class="w-full min-w-[640px] table-auto">
              <thead>
                  <p class="pl-4 text-lg"><strong>My Events Attended</strong></p>
                  <hr class="border-black px-4">
                  <tr>
                      <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                          <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">
                              Event Title
                          </p>
                      </th>
                      <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                          <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">
                             Event Organization
                          </p>
                      </th>
                      <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                          <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">
                              Date Attended
                          </p>
                      </th>
                      <th class="border-b border-blue-gray-50 py-3 px-6 text-left">
                          <p class="block antialiased font-sans text-[11px] font-medium uppercase text-blue-gray-400">
                              Feedback
                          </p>
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($eventsAttended as $attendance)
                  <tr>
                      <td class="py-3 px-5 border-b border-blue-gray-50">
                          <div class="flex items-center gap-4">
                              <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">
                                  {{ $attendance->event->tags }}
                              </p>
                          </div>
                      </td>
                      <td class="py-3 px-5 border-b border-blue-gray-50">
                          <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600 font-bold">
                              {{ $attendance->event->title }}
                          </p>
                      </td>
                      <td class="py-3 px-5 border-b border-blue-gray-50">
                          <p class="block antialiased font-sans text-xs font-medium text-blue-gray-600 font-bold">
                              {{ $attendance->created_at->format('F j, Y') }}
                          </p>
                      </td>
                      <td class="py-3 px-5 border-b border-blue-gray-50">
                          <button 
                              class="flex items-center px-4 py-2 text-white bg-laravel hover:bg-gray-700 rounded-lg shadow-md focus:outline-none"
                              id="openModal{{ $attendance->event->id }}" 
                              data-event-id="{{ $attendance->event->id }}">
                              Review
                          </button>
                      </td>
                  </tr>

                  <!-- Modal for this specific event -->
                  <div id="reviewModal{{ $attendance->event->id }}" class="fixed pt-20 inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg w-96 relative max-h-[80vh] overflow-y-auto">
                        <!-- Close Button -->
                        <button id="closeModal{{ $attendance->event->id }}" 
                            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                
                        <!-- Modal Header -->
                        <div class="px-4 py-2 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">What do you think about the event?</h2>
                        </div>
                
                        <!-- Modal Body -->
                        <div class="p-4">
                            <textarea 
                                id="feedbackText{{ $attendance->event->id }}" 
                                class="w-full h-24 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-laravel focus:outline-none"
                                placeholder="Write your comment here..."></textarea>
                            <input type="hidden" id="eventId{{ $attendance->event->id }}" value="{{ $attendance->event->id }}">
                        </div>
                
                        <!-- Venue Feedback -->
                        <div class="px-4 py-2 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">What can you say about the venue?</h2>
                        </div>
                        <div class="p-4">
                            <textarea 
                                id="venueFeedbackText{{ $attendance->event->id }}" 
                                class="w-full h-24 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-laravel focus:outline-none"
                                placeholder="Write your comment here..."></textarea>
                        </div>
                
                        <!-- Presentation Feedback -->
                        <div class="px-4 py-2 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">What can you say about the Presentation?</h2>
                        </div>
                        <div class="p-4">
                            <textarea 
                                id="speakerFeedbackText{{ $attendance->event->id }}" 
                                class="w-full h-24 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-laravel focus:outline-none"
                                placeholder="Write your comment here..."></textarea>
                        </div>
                
                        <!-- Time Management Feedback -->
                        <div class="px-4 py-2 border-b border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800">What can you say about the event Time Management?</h2>
                        </div>
                        <div class="p-4">
                            <textarea 
                                id="timeFeedbackText{{ $attendance->event->id }}" 
                                class="w-full h-24 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-laravel focus:outline-none"
                                placeholder="Write your comment here..."></textarea>
                        </div>
                
                        <!-- Action Buttons -->
                        <div class="flex justify-end px-4 py-2 border-t border-gray-200">
                            <button id="cancelModal{{ $attendance->event->id }}" class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none">
                                Cancel
                            </button>
                            <button id="submitFeedback{{ $attendance->event->id }}" 
                                    class="px-4 py-2 text-white bg-laravel rounded-lg hover:bg-gray-700 focus:outline-none"
                                    data-event-id="{{ $attendance->event->id }}">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
                
                  @empty
                  <tr>
                      <td colspan="4" class="py-3 px-5 text-center">
                          No events attended yet.
                      </td>
                  </tr>
                  @endforelse

              </tbody>
          </table>

      </div>
  </div>
  
<script>
// Attach event listeners to all "Open Modal" buttons
document.querySelectorAll('[id^="openModal"]').forEach(openModal => {
  openModal.addEventListener('click', () => {
    const eventId = openModal.getAttribute('data-event-id'); // Get the event ID
    const modal = document.getElementById(`reviewModal${eventId}`); // Select the specific modal
    modal.classList.remove('hidden'); // Show the modal
  });
});

// Attach event listeners to all "Close Modal" buttons
document.querySelectorAll('[id^="closeModal"]').forEach(closeModal => {
  closeModal.addEventListener('click', () => {
    const eventId = closeModal.id.replace('closeModal', ''); // Extract event ID
    const modal = document.getElementById(`reviewModal${eventId}`); // Select the specific modal
    modal.classList.add('hidden'); // Hide the modal
  });
});

// Attach event listeners to all "Cancel Modal" buttons
document.querySelectorAll('[id^="cancelModal"]').forEach(cancelModal => {
  cancelModal.addEventListener('click', () => {
    const eventId = cancelModal.id.replace('cancelModal', ''); // Extract event ID
    const modal = document.getElementById(`reviewModal${eventId}`); // Select the specific modal
    modal.classList.add('hidden'); // Hide the modal
  });
});

// Attach event listeners to all "Submit Feedback" buttons
document.querySelectorAll('[id^="submitFeedback"]').forEach(submitFeedback => {
    submitFeedback.addEventListener('click', () => {
        const eventId = submitFeedback.getAttribute('data-event-id'); // Get specific event ID

        // Get feedback from all fields
        const feedback = document.getElementById(`feedbackText${eventId}`).value;
        const venueFeedback = document.getElementById(`venueFeedbackText${eventId}`).value;
        const speakerFeedback = document.getElementById(`speakerFeedbackText${eventId}`).value;
        const timeFeedback = document.getElementById(`timeFeedbackText${eventId}`).value;

        // Validate that feedback fields are not empty
        if (!feedback.trim() || !venueFeedback.trim() || !speakerFeedback.trim() || !timeFeedback.trim()) {
            alert("All feedback fields must be filled out!");
            return;
        }

        // Send the feedback data to the backend
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
            if (data.message) {
                alert(data.message);
            }

            // Clear modal and hide it
            const modal = document.getElementById(`reviewModal${eventId}`);
            modal.classList.add('hidden');
            document.getElementById(`feedbackText${eventId}`).value = '';
            document.getElementById(`venueFeedbackText${eventId}`).value = '';
            document.getElementById(`speakerFeedbackText${eventId}`).value = '';
            document.getElementById(`timeFeedbackText${eventId}`).value = '';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting feedback. Please try again.');
        });
    });
});


  </script>

</x-layout>