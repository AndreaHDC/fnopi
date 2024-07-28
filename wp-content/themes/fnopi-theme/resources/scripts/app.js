import domReady from '@roots/sage/client/dom-ready';
import {
  Swiper,
  Pagination,
  Navigation,
  Autoplay,
  FreeMode,
  Scrollbar,
  EffectFade,
  Mousewheel,
} from 'swiper';
Swiper.use([Autoplay,EffectFade,Pagination,Scrollbar,FreeMode,Navigation]);

/**
 * Application entrypoint
 */
domReady(async () => {
  // ...

  const hamburger = document.querySelector('#header-mobile-nav-btn');
  const hamburgerSticky = document.querySelector('#header-mobile-nav-btn-sticky');
 


  const handleHamburgerClick = (e) =>{
    e.preventDefault();
    hamburger.classList.toggle('is-active');
    hamburgerSticky.classList.toggle('is-active');
    let headerHeight = 0;
    let visibleHeader = false;
    const drawer = document.querySelector('#mobile-drawer');
    if(document.body.classList.contains('has-scrolled')){
      visibleHeader = document.querySelector('#mobile-sticky');
      headerHeight = visibleHeader.offsetHeight;
    }else{
      visibleHeader = document.querySelector('#sticky-not-scroll');
      headerHeight = visibleHeader.offsetHeight;
    }


    // this.drawer.style.top = `${headerHeight}px`;
    drawer.style.height = `calc(100vh - ${headerHeight}px)`;
    document.body.classList.toggle("overflow-hidden");


    if (drawer.style.display === 'none' || drawer.style.display === '') {
      drawer.style.display = 'block';
      setTimeout(() => {
        document.body.classList.toggle("is-nav-open");
      }, 100);
    
      
    } else {
      document.body.classList.toggle("is-nav-open");
      setTimeout(() => {
        drawer.style.display = 'none';
      }, 1000);
     
    }
    
    
   
   

   
  }

  hamburgerSticky.addEventListener('click', handleHamburgerClick);
  hamburger.addEventListener('click', handleHamburgerClick);


  function checkScroll() {
    const banner = document.getElementById('fnopi-banner');
    if (banner) {
        let bannerTop = 0;
        // Get the top value of the banner and transform it to positive
        bannerTop = Math.abs(parseInt(window.getComputedStyle(banner).top, 10));
        console.log(bannerTop)
        // Add or remove the class based on the scroll position and media query
        if (bannerTop && bannerTop < window.scrollY) {
            document.body.classList.add('has-scrolled');
        } else {
            document.body.classList.remove('has-scrolled');
        }
    }
  }

  checkScroll();
  // Add event listener to check scroll on page scroll
  window.addEventListener('scroll', checkScroll);



  
  const gridBox1 = new Swiper("#grid-box-1 .swiper", {
    effect: 'fade', // Use fade effect for crossfade
    fadeEffect: {
        crossFade: true
    },
    autoplay: {
        delay: 5000, // Set autoplay delay to 5 seconds
        disableOnInteraction: false // Continue autoplay even after user interaction
    },
    speed: 1500, // Adjust the transition speed (in milliseconds) to make it slower
    loop: false, // Do not loop the slides
    allowTouchMove: false, // Disable user interaction
  });


  const gridBox3 = new Swiper("#grid-box-3 .swiper", {
    effect: 'fade', // Use fade effect for crossfade
    fadeEffect: {
        crossFade: true
    },
    autoplay: {
        delay: 6000, // Set autoplay delay to 5 seconds
        disableOnInteraction: false // Continue autoplay even after user interaction
    },
    speed: 1500, // Adjust the transition speed (in milliseconds) to make it slower
    loop: false, // Do not loop the slides
    allowTouchMove: false, // Disable user interaction
  });

  const gridBox4 = new Swiper("#grid-box-4 .swiper", {
    effect: 'fade', // Use fade effect for crossfade
    fadeEffect: {
        crossFade: true
    },
    autoplay: {
        delay: 4000, // Set autoplay delay to 5 seconds
        disableOnInteraction: false // Continue autoplay even after user interaction
    },
    speed: 1500, // Adjust the transition speed (in milliseconds) to make it slower
    loop: false, // Do not loop the slides
    allowTouchMove: false, // Disable user interaction
  });

  const gridBox5 = new Swiper("#grid-box-5 .swiper", {
    effect: 'fade', // Use fade effect for crossfade
    fadeEffect: {
        crossFade: true
    },
    autoplay: {
        delay: 2000, // Set autoplay delay to 5 seconds
        disableOnInteraction: false // Continue autoplay even after user interaction
    },
    speed: 1500, // Adjust the transition speed (in milliseconds) to make it slower
    loop: false, // Do not loop the slides
    allowTouchMove: false, // Disable user interaction
  });


  const gridBox2 = new Swiper("#grid-box-2 .swiper", {
    effect: 'fade', // Use fade effect for crossfade
    fadeEffect: {
        crossFade: true
    },
    autoplay: {
        delay: 3000, // Set autoplay delay to 5 seconds
        disableOnInteraction: false // Continue autoplay even after user interaction
    },
    speed: 1500, // Adjust the transition speed (in milliseconds) to make it slower
    loop: false, // Do not loop the slides
    allowTouchMove: false, // Disable user interaction
  });



});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
