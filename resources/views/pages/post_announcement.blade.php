<x-layout>
    @include('partials._myevents')

    <!-- Sliding Background -->
    <div class="fixed inset-0 z-0 overflow-hidden">
        <div class="sliding-background">
            <div style="background-image: url('/api/placeholder/1200/800');"></div>
            <div style="background-image: url('/api/placeholder/1200/800');"></div>
            <div style="background-image: url('/api/placeholder/1200/800');"></div>
            <div style="background-image: url('/api/placeholder/1200/800');"></div>
        </div>
        <div class="fixed inset-0 bg-black bg-opacity-40 z-0"></div>
    </div>
    
    <!-- CSS for sliding animation -->
    <style>
        @keyframes slideBackground {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        
        .sliding-background {
            width: 200%;
            height: 100%;
            display: flex;
            animation: slideBackground 60s linear infinite;
        }
        
        .sliding-background div {
            flex: 1;
            background-size: cover;
            background-position: center;
            filter: blur(3px);
        }
    </style>

    <div class="min-h-screen p-6 flex items-center justify-center relative z-10">
        <div class="max-w-full mx-auto pt-20 pl-6 pr-2 pl-2 lg:pl-32 lg:max-w-[1000px]">
            <div>
                <!-- Form Start -->
                <form action="{{ route('pages.post_announcements.store') }}" method="POST">
                    @csrf
                    <div class="min-h-screen p-6 flex items-center justify-center">
                        <div class="container max-w-full sm:max-w-screen-lg mx-auto">
                            <div>
                                <div class="bg-white bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                                        <div class="text-gray-600">
                                            <p class="font-bold text-black text-lg">Announcement Details</p>
                                            <p>Please fill out all the fields.</p>
                                        </div>

                                        <div class="lg:col-span-2">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                                <!-- Title -->
                                                <div class="md:col-span-5">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" id="title" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" required />
                                                </div>

                                                <!-- Organization -->
                                                <div class="md:col-span-5">
                                                    <label for="org">Organization</label>
                                                    <input type="text" name="org" id="org" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" required />
                                                </div>

                                                <!-- End Date -->
                                                <div class="md:col-span-5">
                                                    <label for="end_date">End Date</label>
                                                    <input type="date" name="end_date" id="date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" required />
                                                </div>

                                                <!-- Organizations Involved -->
                                                <div class="md:col-span-5">
                                                    <label for="organizations_involved">Organizations Involved</label>
                                                    <input type="text" name="organizations_involved" id="organizations_involved" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="Separate with commas (e.g., Org1, Org2)" />
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="md:col-span-5">
                                                <label for="description">Description</label>
                                                <textarea class="bg-gray-50 text-black border border-gray-200 rounded p-2 w-full" name="description" rows="10" placeholder="Description about the announcement" required>{{ old('description') }}</textarea>

                                                @error('description')
                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="md:col-span-5 text-right">
                                            <div class="inline-flex items-end">
                                                <button type="submit" class="bg-laravel hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                    Post Announcement
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</x-layout>