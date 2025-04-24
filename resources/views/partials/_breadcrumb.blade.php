@php
    $user = Auth::user();
    $attendanceRoute = ($user && $user->status === 'faculty') ? '/pages/studentsattendance' : '/pages/eventattended';
    $attendanceLabel = ($user && $user->status === 'faculty') ? 'Students Attendances' : 'Event Attended';
@endphp

<section class="pt-24">
    <div class="bg-gray-200 shadow-xl dark:bg-gray-800">
        <div class="container flex items-center px-6 py-4 mx-auto overflow-y-auto whitespace-nowrap">
            
            <a href="/editaccount" class="flex items-center text-gray-600 -px-2 dark:text-gray-200 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                <span class="mx-2">Account</span>
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300"></span>

            <a href="/mycertificate" class="flex items-center text-gray-600 -px-2 dark:text-gray-200 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 3 3 0 00-2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                </svg>
                <span class="mx-2">Certificates</span>
            </a>


            <span class="mx-5 text-gray-500 dark:text-gray-300"></span>

            <a href="/event-registered" class="flex items-center text-gray-600 -px-2 dark:text-gray-200 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 3 3 0 00-2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                </svg>
                <span class="mx-2">Registered Events</span>
            </a>

            <span class="mx-5 text-gray-500 dark:text-gray-300"></span>

            <a href="{{ $attendanceRoute }}" class="flex items-center text-gray-600 -px-2 dark:text-gray-200 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon review-icon">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v10h4z"></path>
                </svg>

                <span class="mx-2">{{ $attendanceLabel }}</span>
            </a>

        </div>
    </div>
</section>
