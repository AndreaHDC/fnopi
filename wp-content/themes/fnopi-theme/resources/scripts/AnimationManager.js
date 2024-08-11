import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import Lenis from 'lenis';

class AnimationManager {

    constructor() {
    }

    
    init() {
        this.startAnimations();
    }



    startAnimations() {
      //lenis
      const lenis = new Lenis()
      lenis.on('scroll', (e) => {})
      lenis.on('scroll', ScrollTrigger.update)
      gsap.ticker.add((time)=>{
        lenis.raf(time * 1000)
      })
      gsap.ticker.lagSmoothing(0)
      gsap.registerPlugin(ScrollTrigger);
      
      // Animate-left
      document.querySelectorAll(".animate-left").forEach(function(elem) {
        // Check if the current element is inside a div with the class 'page-hero'
        let duration = 2;
        gsap.from(elem, {
          scrollTrigger: {
            trigger: elem,
            start: "top 90%",
            end: "bottom 25%",
            toggleActions: "play none none none",
            markers: false,
          },
          x: -100,
          opacity: 0,
          duration: duration,
          ease: "power1.out",
          stagger: 0.2,
        });
      });


      // Animate-right
      document.querySelectorAll(".animate-right").forEach(function(elem) {
        // Check if the current element is inside a div with the class 'page-hero'
        let duration = 2;
        gsap.from(elem, {
          scrollTrigger: {
            trigger: elem,
            start: "top 90%",
            end: "bottom 25%",
            toggleActions: "play none none none",
            markers: false,
          },
          x: 100,
          opacity: 0,
          duration: duration,
          ease: "power1.out",
          stagger: 0.2,
        });
      });
      
      // Animate-top
      document.querySelectorAll(".animate-top").forEach(function(elem) {
        
        gsap.from(elem, {
          scrollTrigger: {
            trigger: elem,
            start: "top 90%",
            end: "bottom 25%",
            toggleActions: "play none none none",
            markers: false,
          },
          y: 100,
          opacity: 0,
          duration: 2,
          ease: "power1.out",
          stagger: 0.2,
        });
      });

      // Animate-opacity
      document.querySelectorAll(".animate-opacity").forEach(function(elem) {
        gsap.from(elem, {
          scrollTrigger: {
            trigger: elem,
            start: "top 90%",
            end: "bottom 25%",
            toggleActions: "play none none none",
            markers: false,
          },
          opacity: 0,
          duration: 2,
          ease: "power1.out",
          stagger: 0.2,
        });
      });
      
    }

    
}

export default AnimationManager;