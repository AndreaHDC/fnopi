class StoriesManager {
  constructor() {
    this.container = document.querySelector('#fnopi-stories-archive');
    this.paginationContainer = document.querySelector('#fnopi-pagination');
    this.categoryButtons = document.querySelectorAll('.fnopi-category-button');
    this.loader = document.querySelector('#fnopi-loader-container');
    this.categoriesContainer = document.querySelector('#categories-container');
    this.state = {
      page:1,
      term:'all'
    }
  }

  init() {
    const urlPath = window.location.pathname;
    const urlParams = new URLSearchParams(window.location.search);
  
    // Get the page number from the URL
    const pageMatch = urlPath.match(/\/page\/(\d+)\//);
    if (pageMatch && pageMatch[1]) {
      this.state.page = parseInt(pageMatch[1], 10);
    } else {
      this.state.page = 1;
    }
  
    // Get the term from the URL, if it exists
    const term = urlParams.get('term');
    if (term) {
      this.state.term = term;
    } else {
      this.state.term = 'all';
    }
  
    this.addClickEvents();
    this.getStories();
  }

  
  addClickEvents = () => {
    this.categoryButtons.forEach(button => {
      button.addEventListener('click', () => {
        this.state.page = 1;
        let newUrl;
  
        if (button.classList.contains('active')) {
          button.classList.remove('active');
          this.state.term = 'all';
          newUrl = `/infermieri/page/${this.state.page}/`;
        } else {
          this.categoryButtons.forEach(element => {
            element.classList.remove('active');
          });
          button.classList.add('active');
          this.state.term = button.getAttribute('data-term');
          newUrl = `/infermieri/page/${this.state.page}/?term=${this.state.term}`;
        }
  
        // Push the new URL to the history
        window.history.pushState({ page: this.state.page }, '', newUrl);
  
        this.getStories(true);
      });
    });
  }

  getStories = async (scrollToTop = false) => {
    this.loader.classList.remove('hidden');
    this.loader.classList.add('flex');
    this.container.innerHTML = '';
    try {
      const response = await fetch('/wp-json/api/v1/fnopi/stories/'+this.state.page+'/?term='+this.state.term);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json();
      this.renderStories(data);
      this.loader.classList.remove('flex');
      this.loader.classList.add('hidden');

    

      setTimeout(() => {
        if (scrollToTop) {
          const headerHeight = document.querySelector('header').offsetHeight; // Get the height of the header
          const containerTop = this.categoriesContainer.getBoundingClientRect().top + window.pageYOffset - 30;
          const scrollToPosition = containerTop - headerHeight;
          window.scrollTo({
            top: scrollToPosition,
            behavior: 'smooth'
          });
        }

        // Reinitialize fslightbox after new content is loaded
        if (typeof refreshFsLightbox === 'function') {
          console.log('refreshFsLightbox');
          try {
            refreshFsLightbox();
            this.refresTimeLightbox();
          } catch (error) {
            console.error('Error reinitializing fslightbox:', error);
          }
        }

      }, 100);

    } catch (error) {
      this.loader.classList.remove('flex');
      this.loader.classList.add('hidden');
      console.error('There has been a problem with your fetch operation:', error);
    }
  };

  refresTimeLightbox(){
    const fslightboxButtons = document.querySelectorAll('.fslightbox-trigger-cuts');
    if(fslightboxButtons.length){
      fslightboxButtons.forEach(button => {
        button.addEventListener('click', (e) => {
          const videoCut = button.getAttribute('data-videocut');
          const start = button.getAttribute('data-start');
          const end = button.getAttribute('data-end');
          // const videoId = button.getAttribute('data-fslightbox');
          
          if (typeof Vimeo !== 'undefined') {
          setTimeout(() => {
            const iframe = document.querySelector(`.fslightbox-container .story-cut-video`);
            const player = new Vimeo.Player(iframe);
            var startTime = start; // Start at 30 seconds
            var endTime = end;   // End at 60 seconds
            player.on('loaded', function() {
              player.setCurrentTime(startTime);
              player.play();
            });
        
            // Monitor playback time to stop at the end time
            player.on('timeupdate', function(data) {
                // Check if the current time is greater than the end time
                if (data.seconds >= endTime) {
                    player.pause();  // Pause the video
                    player.setCurrentTime(endTime); // Prevent scrubbing beyond the end time
                }
                // Prevent scrubbing before the start time
                if (data.seconds < startTime) {
                    player.setCurrentTime(startTime); // Reset to start time if scrubbed too far back
                }
            });
          }, 200);

            
          
          } else {
            console.error('Vimeo API is not available.');
          }
          // console.log(start,end,videoId);
        });
      });
    }
    
  }

  renderStories(data) {
    const parentElement = this.paginationContainer.parentElement;
    parentElement.classList.add('hidden');
    this.paginationContainer.innerHTML = '';
    this.container.innerHTML = data.stories
    let contentPagination = '';
    if(data.pagination.links){
      data.pagination.links.forEach(element => {
          contentPagination += element;
      });
    }
    this.paginationContainer.innerHTML = contentPagination;
    const paginationLinks = this.paginationContainer.querySelectorAll('a');
    if(paginationLinks.length){
      parentElement.classList.remove('hidden');
      parentElement.classList.add('flex');
      paginationLinks.forEach((link) => {
        link.addEventListener('click', (event) => {
          event.preventDefault();
          
          const url = new URL(link.href);
          const pathParts = url.pathname.split('/').filter(Boolean);
          
          // Assuming the page number is always after "page" in the URL
          const pageIndex = pathParts.indexOf('page') + 1;
          if (pageIndex > 0 && pathParts[pageIndex]) {
            this.state.page = parseInt(pathParts[pageIndex], 10);
          } else {
            this.state.page = 1; // Default to page 1 if no page number is found
          }
      
          let newUrl = `/infermieri/page/${this.state.page}/`;
      
          // Append query parameters only if term is not 'all'
          if (url.searchParams.get('term') !== 'all') {
            newUrl += `?${url.searchParams.toString()}`;
          }
      
          window.history.pushState({ page: this.state.page }, '', newUrl);
          this.getStories(true);
        });
      });
    }

   
    
  }


}

export default StoriesManager;
