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
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Year Level</th>
                                <th class="p-4 border-y border-slate-200 bg-slate-50">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                    <td class="p-4 border-b border-slate-200">Juan Dela Cruz</td>
                                    <td class="p-4 border-b border-slate-200">CCIS</td>
                                    <td class="p-4 border-b border-slate-200">1st year</td>
                                    <td class="p-4 border-b border-slate-200">Pending</td>
                                </tr>
                           
                           
                        </tbody>
                    </table>
                </div>
            </section>
            
            <div class="capitalize">
                <nav aria-label="breadcrumb" class="w-max">
                  <ol class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all">
                   
                    <li class="flex items-center text-blue-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-blue-500">
                        <h6 class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-gray-900">Feedback Results</h6>

                  </ol>
                </nav>
              </div>
         
            <!---table---------->
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left text-gray-800">Category</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-gray-800">Positive</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-gray-800">Neutral</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-gray-800">Negative</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Speaker</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">95%</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">4%</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">1%</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Event Venue</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">90%</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">8%</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">2%</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Time Management</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">85%</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">2%</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">12%</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-gray-700">Overall Event</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">95%</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">3%</td>
                        <td class="border border-gray-300 px-4 py-2 text-center text-gray-700">2%</td>
                    </tr>
                </tbody>
            </table>
    
 
            <!------graph results------->

            <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-6">Event Feedback Bar Graph</h1>
                <canvas id="feedbackChart" class="w-full"></canvas>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('feedbackChart').getContext('2d');
        const feedbackChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Speaker', 'Event Venue', 'Time Management', 'Overall Event'],
                datasets: [
                    {
                        label: 'Positive',
                        data: [95, 90, 85, 95],
                        backgroundColor: 'rgba(34, 197, 94, 0.6)', // Tailwind green
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Neutral',
                        data: [4, 8, 2, 3],
                        backgroundColor: 'rgba(234, 179, 8, 0.6)', // Tailwind yellow
                        borderColor: 'rgba(234, 179, 8, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Negative',
                        data: [1, 2, 12, 2],
                        backgroundColor: 'rgba(239, 68, 68, 0.6)', // Tailwind red
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Event Feedback Overview'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Percentage (%)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Categories'
                        }
                    }
                }
            }
        });
    </script>

</x-layout>