<x-admin-layout>
    <div class="max-w-[720px] mx-auto">
        <div class="block mb-4 mx-auto border-b border-slate-300 pb-2 max-w-[360px]"></div>

        <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between ">
                    <h3 class="text-lg font-semibold text-slate-800">Events</h3>
                </div>
            </div>
            <div class="p-0 overflow-scroll">
                <table class="w-full mt-4 text-left table-auto min-w-max">
                    <thead>
                        <tr>
                            <th class="p-4 cursor-pointer border-y border-slate-200 bg-slate-50">Author</th>
                            <th class="p-4 cursor-pointer border-y border-slate-200 bg-slate-50">Organization</th>
                            <th class="p-4 cursor-pointer border-y border-slate-200 bg-slate-50">Title</th>
                            <th class="p-4 cursor-pointer border-y border-slate-200 bg-slate-50">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td class="p-4 border-b border-slate-200">{{ $event->author }}</td>
                                <td class="p-4 border-b border-slate-200">{{ $event->organization }}</td>
                                <td class="p-4 border-b border-slate-200">{{ $event->tags }}</td>
                                <td class="p-4 border-b border-slate-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.366 1.16-.915 2.245-1.625 3.208C18.342 17.688 15.32 19 12 19c-3.32 0-6.342-1.312-7.917-3.792A12.948 12.948 0 012.458 12z" />
                                    </svg>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                
            </div>
        </div>
    </div>
</x-admin-layout>
