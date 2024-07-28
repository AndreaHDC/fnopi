import domReady from '@roots/sage/client/dom-ready';

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

});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
