<x-layout>
    <x-layout>
        <section class="bg-white py-24 sm:py-32">
          <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-12 text-center">
              <h2 class="text-4xl font-bold text-gray-900 sm:text-5xl">Contact Us</h2>
              <p class="mt-4 text-lg font-semibolb text-gray-600">We'd love to hear from you! Reach out with any questions, comments, or concerns.</p>
            </div>
      
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
              <!-- Contact Form -->
              <div class="bg-laravel p-8 rounded-lg shadow-lg">
                <form action="" method="POST" class="space-y-6">
                  @csrf
                  <div>
                    <label for="name" class="block text-md text-white font-medium">Name</label>
                    <input type="text" name="name" id="name" required
                    class="py-2 block w-full bg-laravel text-white rounded-md border-2 border-white shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-600">
                  </div>
                  <div>
                    <label for="email" class="block text-md font-medium text-white">Email</label>
                    <input type="email" name="email" id="email" required
                           class="py-2 block w-full bg-laravel text-white rounded-md border-2 border-white shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-600">
                  </div>
                  <div>
                    <label for="message" class="block text-sm font-medium text-white">Message</label>
                    <textarea name="message" id="message" rows="5" required
                              class="py-2 block w-full bg-laravel text-white rounded-md border-2 border-white shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-600"></textarea>
                  </div>
                  <div>
                    <button type="submit"
                            class="w-full inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-laravel/90 focus:outline-none">
                      Send Message
                    </button>
                  </div>
                </form>
              </div>
      
              <!-- Contact Info & Map -->
              <div class="space-y-6">
                <div class="bg-laravel p-6 rounded-lg shadow-md">
                  <h3 class="text-xl font-semibold text-white mb-2">Contact Details</h3>
                  <p class="text-white"><strong>Email:</strong> uniconnect243@gmail.com</p>
                  <p class="text-white"><strong>Phone:</strong> (02) 8888-8888</p>
                  <p class="text-white"><strong>Address:</strong> University of Makati, J.P. Rizal Extension, West Rembo, Makati, Metro Manila</p>
                </div>
      
                <div class="rounded-lg shadow-lg overflow-hidden h-72">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.6886607935033!2d121.05430451484292!3d14.540762889823865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c86a7d7a1d17%3A0xd4a3a2a1e6ac6e93!2sUniversity%20of%20Makati!5e0!3m2!1sen!2sph!4v1684994012723!5m2!1sen!2sph"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                  </iframe>
                </div>
              </div>
            </div>
          </div>
        </section>
      
        @include('partials._footer')
      </x-layout>
      
</x-layout>