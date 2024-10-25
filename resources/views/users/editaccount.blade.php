<x-layout>
    @include('partials._breadcrumb')
   <section>
    <!-- This is an example component -->
<div class="min-h-screen  flex items-center justify-center px-4">
    
    <div class="max-w-4xl pt-4  bg-white w-full rounded-lg shadow-xl">
        <div class="p-4 border-b">
            <h2 class="text-2xl font-bold ">
                {{ucfirst(auth()->user()->fname)}}'s Information
            </h2>
          
        </div>
        <div>
            @auth
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                   Full Name
                </p>
                <p>
                    {{ucfirst(auth()->user()->lname)}} {{ucfirst(auth()->user()->fname)}} {{ucfirst(auth()->user()->miname)}}.
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Organization
                </p>
                <p>
                    {{strtoupper(auth()->user()->org)}}
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Email Address
                </p>
                <p>
                    {{ucfirst(auth()->user()->email)}}
                </p>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b">
                <p class="text-gray-600">
                    Section
                </p>
                <p>
                    {{strtoupper(auth()->user()->section)}}
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
 </section>

 
          

  

</x-layout>