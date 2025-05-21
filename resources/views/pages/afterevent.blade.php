<x-layout>
    @include('partials._myevents')


    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full max-w-4xl bg-white shadow-lg border-2 border-gray-300 p-10 rounded-lg relative">
          
            <section class="pb-10">
                <p class="pl-4 font-bold">Event Attendees</p>
                <div class="p-0 overflow-scroll">
                    <table class="w-full mt-4 text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Name</th>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Organization</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendees as $attendee)
                                <tr>
                                    <td class="p-4 border-b border-slate-200">{{ $attendee->fname }} {{ $attendee->lname }}</td>
                                    <td class="p-4 border-b border-slate-200">{{ $attendee->org }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

           
            <!---------feedback------------------>
            <section class="pb-10">
                <p class="pl-4 font-bold">Event Feedback</p>
                <div class="p-0 overflow-scroll">
                    <table class="w-full mt-4 text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Feedback</th>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td class="p-4 border-b border-slate-200">{{ $feedback->feedback }}</td>
                                    <td class="p-4 border-b border-slate-200">
                                        @if ($feedback->sentiment == 1)
                                            Positive
                                        @elseif ($feedback->sentiment == 0)
                                            Neutral
                                        @elseif ($feedback->sentiment == -1)
                                            Negative
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <!---------feedback------------------>

             <!---------feedback venue------------------>
             <section class="pb-10">
                <p class="pl-4 font-bold">Venue Feedback</p>
                <div class="p-0 overflow-scroll">
                    <table class="w-full mt-4 text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Feedback</th>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td class="p-4 border-b border-slate-200">{{ $feedback->feedback_venue }}</td>
                                    <td class="p-4 border-b border-slate-200">
                                        @if ($feedback->sentiment_venue == 1)
                                            Positive
                                        @elseif ($feedback->sentiment_venue == 0)
                                            Neutral
                                        @elseif ($feedback->sentiment_venue == -1)
                                            Negative
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <!---------feedback------------------>
             <!---------Speaker------------------>
             <section class="pb-10">
                <p class="pl-4 font-bold">Speaker Feedback</p>
                <div class="p-0 overflow-scroll">
                    <table class="w-full mt-4 text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Feedback</th>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td class="p-4 border-b border-slate-200">{{ $feedback->feedback_speaker }}</td>
                                    <td class="p-4 border-b border-slate-200">
                                        @if ($feedback->sentiment_speaker == 1)
                                            Positive
                                        @elseif ($feedback->sentiment_speaker == 0)
                                            Neutral
                                        @elseif ($feedback->sentiment_speaker == -1)
                                            Negative
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <!---------feedback------------------>
             <!---------feedback time management------------------>
             <section class="pb-10">
                <p class="pl-4 font-bold">Time Management Feedback</p>
                <div class="p-0 overflow-scroll">
                    <table class="w-full mt-4 text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Feedback</th>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td class="p-4 border-b border-slate-200">{{ $feedback->feedback_time }}</td>
                                    <td class="p-4 border-b border-slate-200">
                                        @if ($feedback->sentiment_time == 1)
                                            Positive
                                        @elseif ($feedback->sentiment_time == 0)
                                            Neutral
                                        @elseif ($feedback->sentiment_time == -1)
                                            Negative
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <!---------feedback------------------>
            
            
            
            
          <!-- Print Button Script -->


<!-- EVENT ATTENDEES SECTION -->


<!-- FEEDBACK TABLE + CHART SECTION -->
<div id="feedbackSection" class="mt-12">
    <div class="flex justify-end mb-4">
        <button onclick="printSection('feedbackSection')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            Print Feedback Results
        </button>
    </div>

    <div class="capitalize">
        <nav aria-label="breadcrumb" class="w-max">
            <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                <li class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                    <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Feedback Results</h6>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Feedback Table -->
    <table class="w-full border-collapse border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left text-gray-800">Categories</th>
                <th class="border border-gray-300 px-4 py-2 text-center text-gray-800">Positive</th>
                <th class="border border-gray-300 px-4 py-2 text-center text-gray-800">Neutral</th>
                <th class="border border-gray-300 px-4 py-2 text-center text-gray-800">Negative</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-300 px-4 py-2 text-gray-700">Event</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($positivePercentage, 2) }}%</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($neutralPercentage, 2) }}%</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($negativePercentage, 2) }}%</td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2 text-gray-700">Event Venue</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($positiveVenuePercentage, 2) }}%</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($neutralVenuePercentage, 2) }}%</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($negativeVenuePercentage, 2) }}%</td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2 text-gray-700">Event Speaker</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($positiveSpeakerPercentage, 2) }}%</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($neutralSpeakerPercentage, 2) }}%</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($negativeSpeakerPercentage, 2) }}%</td>
            </tr>
            <tr>
                <td class="border border-gray-300 px-4 py-2 text-gray-700">Event Time</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($positiveTimePercentage, 2) }}%</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($neutralTimePercentage, 2) }}%</td>
                <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">{{ number_format($negativeTimePercentage, 2) }}%</td>
            </tr>
        </tbody>
    </table>

    <!-- Bar Chart -->
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Event Feedback Bar Graph</h1>
        <canvas id="feedbackChart" class="w-full"></canvas>
    </div>
</div>

<!-- Chart.js Script (outside printSection function) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('feedbackChart').getContext('2d');
    const feedbackChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Event', 'Venue', 'Speaker', 'Time Management'],
            datasets: [
                {
                    label: 'Positive',
                    data: [
                        {{ number_format($positivePercentage, 2) }},
                        {{ number_format($positiveVenuePercentage, 2) }},
                        {{ number_format($positiveSpeakerPercentage, 2) }},
                        {{ number_format($positiveTimePercentage, 2) }}
                    ],
                    backgroundColor: 'rgba(34, 197, 94, 0.6)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Neutral',
                    data: [
                        {{ number_format($neutralPercentage, 2) }},
                        {{ number_format($neutralVenuePercentage, 2) }},
                        {{ number_format($neutralSpeakerPercentage, 2) }},
                        {{ number_format($neutralTimePercentage, 2) }}
                    ],
                    backgroundColor: 'rgba(234, 179, 8, 0.6)',
                    borderColor: 'rgba(234, 179, 8, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Negative',
                    data: [
                        {{ number_format($negativePercentage, 2) }},
                        {{ number_format($negativeVenuePercentage, 2) }},
                        {{ number_format($negativeSpeakerPercentage, 2) }},
                        {{ number_format($negativeTimePercentage, 2) }}
                    ],
                    backgroundColor: 'rgba(239, 68, 68, 0.6)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: {
                    display: true,
                    text: 'Event Feedback Overview'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Percentage (%)' }
                },
                x: {
                    title: { display: true, text: 'Categories' }
                }
            }
        }
    });
</script>

            
            <!-- Ratings Section -->
 <div class="p-6">
    <div class="flex justify-end mb-4">
        <button onclick="printDiv('printSection')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            🖨️ Print
        </button>
    </div>

    <div id="printSection">
        <h2 class="text-2xl font-bold mb-4 text-center text-blue-800">Event Attendees</h2>

        @if ($ratings->isEmpty())
            <p class="text-center text-gray-600">No feedback has been submitted for this event yet.</p>
        @else
            @foreach ($ratings->take(1) as $rating)
                @php
                    $questions = [
                        'q_one' => 'r_one',
                        'q_two' => 'r_two',
                        'q_three' => 'r_three',
                        'q_four' => 'r_four',
                        'q_five' => 'r_five',
                        'q_six' => 'r_six',
                        'q_seven' => 'r_seven',
                        'q_eight' => 'r_eight',
                        'q_nine' => 'r_nine',
                        'q_ten' => 'r_ten',
                        'q_eleven' => 'r_eleven',
                        'q_twelve' => 'r_twelve',
                        'q_thirteen' => 'r_thirteen',
                        'q_fourteen' => 'r_fourteen',
                        'q_fifteen' => 'r_fifteen',
                        'q_sixteen' => 'r_sixteen',
                        'q_seventeen' => 'r_seventeen',
                        'q_eighteen' => 'r_eighteen',
                        'q_nineteen' => 'r_nineteen',
                        'q_twenty' => 'r_twenty',
                    ];
                @endphp

                <div class="space-y-4 mt-8">
                    @foreach ($questions as $q => $r)
                        @if (!empty($rating->$q))
                            <div class="flex justify-between bg-white rounded-lg shadow-md p-4">
                                <span class="font-medium text-lg text-gray-800">{{ $rating->$q }}</span>
                                <span class="font-semibold text-lg text-green-700">{{ $percentages[$r] ?? 0 }}% Agree</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
</div>
<script>
    function printDiv(divId) {
        const printContents = document.getElementById(divId).innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

        // Prevents white screen on reload
        location.reload();
    }
</script>

</x-layout>