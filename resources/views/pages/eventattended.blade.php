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
                        View Feedback
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
                        @php
                            // Check if there is feedback for this event and this user
                            $hasFeedback = \App\Models\Feedback::where('listing_id', $attendance->event->id)
                                            ->where('user_id', auth()->id()) // better to use auth()->id()
                                            ->exists();
                        @endphp
                
                        @if($hasFeedback)
                        <a href="{{ route('view.feedback', ['listing_id' => $attendance->event->id]) }}" 
                            class="flex items-center px-4 py-2 text-white bg-laravel hover:bg-gray-700 rounded-lg shadow-md focus:outline-none">
                            View
                        </a>
                        
                        @else
                            <span class="text-gray-500">No submitted feedback</span>
                        @endif
                    </td>
                  
                    
                    
                    
                  
                    <td class="py-3 px-5 border-b border-blue-gray-50">
                        @php
                            $hasFeedback = \App\Models\Feedback::where('listing_id', $attendance->event->id)
                                            ->where('user_id', auth()->id())
                                            ->exists();
                        @endphp
                    
                        @if($hasFeedback)
                            <span class="flex items-center px-2 py-2 text-white bg-gray-400 rounded-lg shadow-md cursor-not-allowed">
                                You have already sent feedback
                            </span>
                        @else
                            <a href="{{ route('submit.feedbacks', ['listings_id' => $attendance->event->id]) }}"
                                class="flex items-center justify-center px-4 py-2 text-white bg-laravel hover:bg-gray-700 rounded-lg shadow-md focus:outline-none">
                                Review
                            </a>
                        @endif
                    </td>
                    
                    
                    
                  </tr>

               
                
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
<script>
    function submitFeedback(attendanceId) {
        document.getElementById('submit-feedback-' + attendanceId).submit();
    }
</script>

</x-layout>