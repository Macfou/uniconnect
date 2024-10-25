<section class="relative h-72  flex flex-col justify-center align-center text-center space-y-4 mb-4 mt-20 pt-20">
<!-----src="{{ asset('images/umak_logo.png') }}"------>
    <!-- component -->
<!-- component -->
<head>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
      <script>
        var cont=0;
    function loopSlider(){
      var xx= setInterval(function(){
            switch(cont)
            {
            case 0:{
                $("#slider-1").fadeOut(400);
               
                $("#sButton1").removeClass("bg-purple-800");
               
            cont=1;
            
            break;
            }
            case 1:
            {
            
                
                $("#slider-1").delay(400).fadeIn(400);
               
                $("#sButton1").addClass("bg-purple-800");
               
            cont=0;
            
            break;
            }
            
            
            }},8000);
    
    }
    
    function reinitLoop(time){
    clearInterval(xx);
    setTimeout(loopSlider(),time);
    }
    
    
    
    function sliderButton1(){
    
        $("#slider-2").fadeOut(400);
        $("#slider-1").delay(400).fadeIn(400);
        $("#sButton2").removeClass("bg-purple-800");
        $("#sButton1").addClass("bg-purple-800");
        reinitLoop(4000);
        cont=0
        
        }
        
       
    
       
         
            
        
        
        
        
     
    
      
      </script>
    
    
    <body>
      <div class="sliderAx h-auto">
          <div id="slider-1" class="container mx-auto">
            <div class="bg-cover bg-center  h-auto text-white py-24 px-10 object-fill" style="background-image: url('{{ asset('images/welcome_herons.jpg') }}');">
           <div class="md:w-1/2">
            <p class="font-bold text-sm uppercase">Uniconnect</p>
            <p class="text-3xl font-bold">Be Updated on Events</p>
            <p class="text-2xl mb-10 leading-none">Join US!</p>
            
            </div>  
        </div> <!-- container -->
          <br>
          </div>
    
          
     <!-- <p class="font-bold text-sm uppercase">Lorem</p>
            <p class="text-3xl font-bold">Lorem Ipsum</p>
            <p class="text-2xl mb-10 leading-none">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>-->
            
             
        </div> <!-- container -->
          <br>
          </div>
        </div>
    
    
    </body>
</section>
