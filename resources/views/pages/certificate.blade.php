<x-layout>

    @include('partials._myevents')

    <style>
        .logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .ribbon {
            width: 100%;
            height: 40px;
            background-color: #1f2937;
            color: #fff;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            font-size: 1.25rem;
        }
    </style>

    <div class="pt-20">


   

    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full max-w-4xl bg-white shadow-lg border-2 border-gray-300 p-10 rounded-lg relative">
            <!-- Logos -->
            <div class="absolute top-4 left-4">
                <img src="path_to_your_logo_left.png" alt="Left Logo" class="logo">
            </div>
            <div class="absolute top-4 right-4">
                <img src="path_to_your_logo_right.png" alt="Right Logo" class="logo">
            </div>

            <!-- Header -->
            <div class="text-center border-b-2 border-gray-200 pb-4">
                <h1 class="text-4xl font-bold text-gray-800">Certificate of Achievement</h1>
                <p class="text-gray-600 mt-2 text-lg">This certifies that</p>
            </div>
            
            <!-- Recipient Name -->
            <div class="text-center mt-6">
                <h2 class="text-3xl font-semibold text-gray-800">[Recipient's Name]</h2>
                <p class="text-gray-600 mt-2 text-base">has successfully completed the</p>
            </div>
            
            <!-- Event Name -->
            <div class="text-center mt-4">
                <h2 class="text-2xl font-medium text-gray-800">[Event Name]</h2>
                <p class="text-gray-600 mt-2">organized by</p>
                <h3 class="text-xl font-medium text-gray-700">[Organization Name]</h3>
            </div>
            
            <!-- Date and Venue -->
            <div class="text-center mt-6">
                <p class="text-gray-600">Held on</p>
                <p class="text-lg font-medium text-gray-800">[Date]</p>
                <p class="text-gray-600 mt-2">at</p>
                <p class="text-lg font-medium text-gray-800">[Venue]</p>
            </div>
            
            <!-- Signature Section -->
            <div class="flex justify-between items-center mt-12">
                <div class="text-center">
                    <p class="text-gray-600">_________________________</p>
                    <p class="text-gray-800 font-medium mt-1">[Authorized Signatory]</p>
                    <p class="text-gray-600 text-sm">Position</p>
                </div>
                <div class="text-center">
                    <p class="text-gray-600">_________________________</p>
                    <p class="text-gray-800 font-medium mt-1">[Director]</p>
                    <p class="text-gray-600 text-sm">Position</p>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="text-center border-t-2 border-gray-200 pt-4 mt-8">
                <p class="text-gray-500 text-sm">Powered by [Company/Platform Name]</p>
            </div>
        </div>
    </div>

    <!-----------------design 3---------->
    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full max-w-4xl bg-white shadow-xl border-4 border-gray-300 p-12 rounded-lg relative">
            <!-- Logos -->
            <div class="absolute top-6 left-6">
                <img src="path_to_your_logo_left.png" alt="Left Logo" class="logo">
            </div>
            <div class="absolute top-6 right-6">
                <img src="path_to_your_logo_right.png" alt="Right Logo" class="logo">
            </div>

            <!-- Title -->
            <div class="text-center pb-6">
                <h1 class="text-5xl font-bold text-gray-800">Certificate of Achievement</h1>
            </div>

            <!-- Recipient Name -->
            <div class="text-center mt-10">
                <h2 class="text-4xl font-semibold text-gray-800">[Recipient's Name]</h2>
                <p class="text-lg text-gray-600 mt-2">has successfully completed the</p>
            </div>

            <!-- Event Details -->
            <div class="text-center mt-6">
                <h3 class="text-3xl font-medium text-gray-800">[Event Name]</h3>
                <p class="text-gray-600 mt-2">Organized by</p>
                <h4 class="text-2xl font-semibold text-gray-700">[Organization Name]</h4>
            </div>

            <!-- Footer -->
            <div class="flex justify-between mt-10">
                <div class="text-center">
                    <p class="text-gray-600">_______________________</p>
                    <p class="text-gray-800">[Authorized Signatory]</p>
                    <p class="text-sm text-gray-600">Position</p>
                </div>
                <div class="text-center">
                    <p class="text-gray-600">_______________________</p>
                    <p class="text-gray-800">[Director]</p>
                    <p class="text-sm text-gray-600">Position</p>
                </div>
            </div>
        </div>
    </div>

    <!-------design 4--------------->

    

    <!-----design 5---------------->
    <div class="flex justify-center items-center min-h-screen bg-gray-50">
        <div class="w-full max-w-4xl bg-white shadow-lg border-4 border-gray-300 p-10 rounded-lg relative">
            <!-- Logos -->
            <div class="absolute top-4 left-6">
                <img src="path_to_your_logo_left.png" alt="Left Logo" class="logo">
            </div>
            <div class="absolute top-4 right-6">
                <img src="path_to_your_logo_right.png" alt="Right Logo" class="logo">
            </div>

            <!-- Title -->
            <div class="text-center py-6">
                <h1 class="text-5xl font-semibold text-gray-800">Certificate of Excellence</h1>
            </div>

            <!-- Recipient Name -->
            <div class="text-center mt-6">
                <h2 class="text-3xl font-semibold text-gray-800">[Recipient's Name]</h2>
                <p class="text-lg text-gray-600 mt-4">for outstanding performance in</p>
            </div>

            <!-- Event Name -->
            <div class="text-center mt-6">
                <h3 class="text-2xl font-medium text-gray-800">[Event Name]</h3>
                <p class="text-gray-600 mt-2">organized by</p>
                <h4 class="text-xl font-semibold text-gray-700">[Organization Name]</h4>
            </div>

            <!-- Ribbon -->
            <div class="ribbon mt-12">
                Congratulations!
            </div>

            <!-- Footer -->
            <div class="flex justify-between mt-8">
                <div class="text-center">
                    <p class="text-gray-600">_______________________</p>
                    <p class="text-gray-800">[Authorized Signatory]</p>
                    <p class="text-sm text-gray-600">Position</p>
                </div>
                <div class="text-center">
                    <p class="text-gray-600">_______________________</p>
                    <p class="text-gray-800">[Director]</p>
                    <p class="text-sm text-gray-600">Position</p>
                </div>
            </div>
        </div>
    </div>

</div>
</x-layout>