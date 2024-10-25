<x-admin-layout>
    <section>
      <div class="min-h-screen flex items-center justify-center px-4">
    
        <div class="max-w-4xl  bg-white w-full rounded-lg shadow-xl">
            <div class="p-4 border-b">
                <h2 class="text-2xl ">
                   {{-- {{ucfirst(auth()->user()->fname)}}---}}'s Information
                </h2>
                <p class="text-sm text-gray-500">
                    Personal details and application. 
                </p>
            </div>
            <div>
                @auth
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                       Full Name
                    </p>
                    <p>
                     jay Job  {{-- {{ucfirst(auth()->user()->lname)}} {{ucfirst(auth()->user()->fname)}} {{ucfirst(auth()->user()->miname)}}.--}}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Organization
                    </p>
                    <p>
                     CCIS   {{--{{strtoupper(auth()->user()->org)}}--}}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Email Address
                    </p>
                    <p>
                    kahshs@dcdm  {{--{{ucfirst(auth()->user()->email)}}--}}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        Section
                    </p>
                    <p>
                      BCSAD {{-- {{strtoupper(auth()->user()->section)}}--}}
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                    <p class="text-gray-600">
                        password
                    </p>
                    <p>
                        <button
                                type="submit"
                                class="border bg-gray-800 text-white rounded py-2 px-4 hover:underline">
                                Change password
                            </button> 
                    </p>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4">
                    <p class="text-gray-600">
                        Attachments
                    </p>
                    <div class="space-y-2">
                        
                            
                                <button
                                type="submit"
                                class="border bg-gray-800 text-white rounded py-2 px-4 hover:underline">
                                Edit my Account
                            </button>
                            </div>
                            
                        </div>
                        @endauth
    
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    
    
        
       
    </div>
    </section>
</x-admin-layout>