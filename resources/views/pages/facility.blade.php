<x-layout>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}




/* carousel */

.carousel{
    width: 100vw;
    height: 100vh;
    margin-top: -50px;
    overflow: hidden;
    position: relative;
}

.carousel .list .item{
    width: 180px;
    height: 250px;
    position: absolute;
    top: 80%;
    transform: translateY(-70%);
    left: 70%;
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    background-position: 50% 50%;
    background-size: cover;
    z-index: 10;
    transition: 1s;
}

.carousel .list .item:nth-child(1),
.carousel .list .item:nth-child(2){
    top: 0;
    left: 0;
    transform: translate(0, 0);
    border-radius: 0;
    width: 100%;
    height: 100%;
}

.carousel .list .item:nth-child(3){
    left: 67%;
}

.carousel .list .item:nth-child(4){
    left: calc(67% + 200px);
}

.carousel .list .item:nth-child(5){
    left: calc(67% + 400px);
}

.carousel .list .item:nth-child(6){
    left: calc(67% + 600px);
}

.carousel .list .item:nth-child(n+7){
    left: calc(67% + 800px);
    opacity: 0;
}





.list .item .content{
    position: absolute;
    top: 50%;
    left: 100px;
    transform: translateY(-50%);
    width: 400px;
    text-align: left;
    color: #fff;
    display: none;
}

.list .item:nth-child(2) .content{
    display: block;
}

.content .title{
    font-size: 100px;
    text-transform: uppercase;
    color: #111827;
    font-weight: bold;
    line-height: 1;

    opacity: 0;
    animation: animate 1s ease-in-out 0.3s 1 forwards;
}

.content .name{
    font-size: 100px;
    text-transform: uppercase;
    font-weight: bold;
    line-height: 1;
    text-shadow: 3px 4px 4px #111827;
    color:white;

    opacity: 0;
    animation: animate 1s ease-in-out 0.6s 1 forwards;
}

.content .des{
    margin-top: 10px;
    margin-bottom: 20px;
    font-size: 18px;
    margin-left: 5px;
    color: white;
    font-weight: bold;
    text-shadow: 1px 2px 2px #111827;

    opacity: 0;
    animation: animate 1s ease-in-out 0.9s 1 forwards;
}

.content .btn{
    margin-left: 5px;

    opacity: 0;
    animation: animate 1s ease-in-out 1.2s 1 forwards;
}

.content .btn button{
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border: 2px solid #fff;
}

.content .btn button:nth-child(1){
    margin-right: 15px;
}

.content .btn button:nth-child(2){
    background: transparent;
    color: #111827;
    border: 2px solid #fff;
    transition: 0.3s;
}

.content .btn button:nth-child(2):hover{
    background-color: #111827;
    color: #fff;
    border-color: #111827;
}


@keyframes animate {
    
    from{
        opacity: 0;
        transform: translate(0, 100px);
        filter: blur(33px);
    }

    to{
        opacity: 1;
        transform: translate(0);
        filter: blur(0);
    }
}

/* Carousel */








.arrows{
    position: absolute;
    top: 80%;
    right: 52%;
    z-index: 100;
    width: 300px;
    max-width: 30%;
    display: flex;
    gap: 10px;
    align-items: center;
}

.arrows button{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #111827;
    color: #fff;
    border: none;
    outline: none;
    font-size: 16px;
    font-family: monospace;
    font-weight: bold;
    transition: .5s;
    cursor: pointer;
}

.arrows button:hover{
    background: #fff;
    color: #000;
}


/* time running */
.carousel .timeRunning{
    position: absolute;
    z-index: 1000;
    width: 0%;
    height: 4px;
    background-color: #111827;
    left: 0;
    top: 0;
    animation: runningTime 7s linear 1 forwards;
}

@keyframes runningTime {
    
    from{width: 0%;}
    to{width: 100%;}

}


/* Responsive Design */

@media screen and (max-width: 999px){
    
    

    .list .item .content{
        left: 50px;
    }

    .content .title, .content .name{
        font-size: 70px;
    }

    .content .des{
        font-size: 16px;
    }

}

@media screen and (max-width: 690px){
    

    .list .item .content{
        top: 40%;
    }

    .content .title, .content .name{
        font-size: 45px;
    }

    .content .btn button{
        padding: 10px 15px;
        font-size: 14px;
    }
}
  </style>
  
   <div class="carousel">

    <div class="list">

      <div class="item" style="background-image: url('{{ asset('images/umak_oval.jpg') }}');">

            <div class="content">
                
                <div class="name">Oval</div>
                <div class="des">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis culpa similique consequuntur, reprehenderit dicta repudiandae.</div>
                <div class="btn">
                    
                </div>
            </div>
        </div>

        <div class="item" style="background-image: url('{{ asset('images/umak_theater.jpg') }}');">
            
            <div class="content">
                
                <div class="name"> Mini Theater</div>
                <div class="des">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis culpa similique consequuntur, reprehenderit dicta repudiandae.</div>
                <div class="btn">
                    
                </div>
            </div>

        </div>

        <div class="item" style="background-image: url('{{ asset('images/umak_basketball.jpg') }}');">

            <div class="content">
                
                <div class="name">Basketball Court</div>
                <div class="des">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis culpa similique consequuntur, reprehenderit dicta repudiandae.</div>
                <div class="btn">
                    
                </div>
            </div>

        </div>

        

        <div class="item" style="background-image: url('{{ asset('images/umak_grandtheater.jpg') }}');">
            
            <div class="content">
                
                <div class="name">Grand Theater</div>
                <div class="des">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis culpa similique consequuntur, reprehenderit dicta repudiandae.</div>
                <div class="btn">
                   
                </div>
            </div>

        </div>

        <div class="item" style="background-image: url('{{ asset('images/umak_basketball.jpg') }}');">
            
            <div class="content">
                
                <div class="name">Volleyball Court</div>
                <div class="des">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis culpa similique consequuntur, reprehenderit dicta repudiandae.</div>
                <div class="btn">
                    
                </div>
            </div>

        </div>


        <div class="item" style="background-image: url('{{ asset('images/umakadmin.jpg') }}');">
            
            <div class="content">
                
                <div class="name">Admin</div>
                <div class="des">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis culpa similique consequuntur, reprehenderit dicta repudiandae.</div>
                <div class="btn">
                   
                </div>
            </div>

        </div>

       

        

        
    </div>

    <!--next prev button-->
    <div class="arrows">
        <button class="prev"><</button>
        <button class="next">></button>
    </div>


    <!-- time running -->
    <div class="timeRunning"></div>

</div>

<script>
  var nextBtn = document.querySelector('.next'),
    prevBtn = document.querySelector('.prev'),
    carousel = document.querySelector('.carousel'),
    list = document.querySelector('.list'), 
    item = document.querySelectorAll('.item'),
    runningTime = document.querySelector('.carousel .timeRunning') 

let timeRunning = 3000 
let timeAutoNext = 7000

nextBtn.onclick = function(){
    showSlider('next')
}

prevBtn.onclick = function(){
    showSlider('prev')
}

let runTimeOut 

let runNextAuto = setTimeout(() => {
    nextBtn.click()
}, timeAutoNext)


function resetTimeAnimation() {
    runningTime.style.animation = 'none'
    runningTime.offsetHeight /* trigger reflow */
    runningTime.style.animation = null 
    runningTime.style.animation = 'runningTime 7s linear 1 forwards'
}


function showSlider(type) {
    let sliderItemsDom = list.querySelectorAll('.carousel .list .item')
    if(type === 'next'){
        list.appendChild(sliderItemsDom[0])
        carousel.classList.add('next')
    } else{
        list.prepend(sliderItemsDom[sliderItemsDom.length - 1])
        carousel.classList.add('prev')
    }

    clearTimeout(runTimeOut)

    runTimeOut = setTimeout( () => {
        carousel.classList.remove('next')
        carousel.classList.remove('prev')
    }, timeRunning)


    clearTimeout(runNextAuto)
    runNextAuto = setTimeout(() => {
        nextBtn.click()
    }, timeAutoNext)

    resetTimeAnimation() // Reset the running time animation
}

// Start the initial animation 
resetTimeAnimation()
</script>

</x-layout>
@include('partials._footer')