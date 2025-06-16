/**
* Template Name: Mentor
* Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
* Updated: Aug 07 2024 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  mobileNavToggleBtn.addEventListener('click', mobileNavToogle);

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

})();

/*--------------------------------------------------------------
# welcome
--------------------------------------------------------------*/ 
 // ===== MOBILE MENU TOGGLE & SEARCH FUNCTIONALITY =====
document.addEventListener('DOMContentLoaded', function() {
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const navmenu = document.querySelector('#navmenu');
    const searchForm = document.getElementById('globalSearchForm');
    const searchInput = document.getElementById('globalSearchInput');
    const noResultsMsg = document.getElementById('global-no-results');

    // Mobile Menu Toggle
    if (mobileNavToggle && navmenu) {
        mobileNavToggle.addEventListener('click', function(e) {
            e.preventDefault();
            navmenu.classList.toggle('mobile-nav-active');
            this.classList.toggle('bi-list');
            this.classList.toggle('bi-x');
        });
    }

    // Search Functionality
    if (searchForm && searchInput) {
        // Submit Handler
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            performSearch(searchInput.value.trim().toLowerCase());
        });

        // Live Search with Debounce
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(this.value.trim().toLowerCase());
            }, 300);
        });

        // Clear Search on Escape
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                resetSearch();
            }
        });
    }

    // Perform Search
    function performSearch(query) {
        if (!query) {
            resetSearch();
            return;
        }

        const searchTargets = [
            { selector: 'h1, h2, h3, h4, h5, h6', type: 'heading' },
            { selector: '.card-title, .content-card h5', type: 'card-title' },
            { selector: '.card-text, .content-card p', type: 'card-text' },
            { selector: '.hero-text h2', type: 'hero-title' },
            { selector: '.hero-text p', type: 'hero-subtitle' },
            { selector: '.testimonial-content p', type: 'testimonial' }
        ];

        let hasResults = false;
        resetSearch();

        searchTargets.forEach(target => {
            const elements = document.querySelectorAll(target.selector);
            elements.forEach(element => {
                const text = element.textContent.toLowerCase();
                if (text.includes(query)) {
                    element.classList.add('search-highlight');
                    if (target.type === 'heading') {
                        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    if (target.type.includes('card-')) {
                        const card = element.closest('.content-card');
                        if (card) card.classList.add('search-highlight');
                    }
                    hasResults = true;
                }
            });
        });

        if (noResultsMsg) {
            noResultsMsg.classList.toggle('d-none', hasResults);
            if (!hasResults) {
                noResultsMsg.textContent = `Tidak ditemukan hasil untuk "${query}"`;
                const searchRect = searchInput.getBoundingClientRect();
                noResultsMsg.style.top = `${searchRect.bottom + window.scrollY + 5}px`;
                noResultsMsg.style.left = `${searchRect.left + window.scrollX}px`;
                noResultsMsg.style.width = `${searchRect.width}px`;
            }
        }
    }

    // Reset Search Highlights
    function resetSearch() {
        document.querySelectorAll('.search-highlight').forEach(el => {
            el.classList.remove('search-highlight');
        });
        if (noResultsMsg) noResultsMsg.classList.add('d-none');
    }

    // Ctrl+K Keyboard Shortcut
    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            if (searchInput) searchInput.focus();
        }
    });

    // Ensure Search Stays Visible on Mobile
    window.addEventListener('resize', function() {
        if (window.innerWidth <= 991.98 && searchForm) {
            searchForm.style.display = 'block';
        }
    });
});

    // Fungsi untuk animasi progress circle
    document.addEventListener('DOMContentLoaded', function() {
      const progressCircles = document.querySelectorAll('.progress-circle');
      
      progressCircles.forEach(circle => {
        const value = parseInt(circle.getAttribute('data-value'));
        const progressValue = circle.querySelector('.progress-value');
        
        // Animate progress
        let start = 0;
        const duration = 1000;
        const increment = value / (duration / 16);
        
        const timer = setInterval(() => {
          start += increment;
          if (start >= value) {
            start = value;
            clearInterval(timer);
          }
          
          // Update text
          progressValue.textContent = Math.floor(start) + '%';
          
          // Update circle background
          circle.style.setProperty('--progress', start + '%');
          
          // Fallback for browsers that don't support CSS variables
          circle.style.background = `conic-gradient(#0dcaf0 ${start}%, #edf2f7 ${start}%)`;
        }, 16);
      });
      
      // Mobile nav toggle
      const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
      const navmenu = document.querySelector('#navmenu');
      
      if (mobileNavToggle && navmenu) {
          mobileNavToggle.addEventListener('click', function(e) {
              e.preventDefault();
              navmenu.classList.toggle('mobile-nav-active');
              this.classList.toggle('bi-list');
              this.classList.toggle('bi-x');
          });
      }
      
      // Smooth scroll for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function(e) {
              e.preventDefault();
              
              const targetId = this.getAttribute('href');
              if (targetId === '#') return;
              
              const targetElement = document.querySelector(targetId);
              if (targetElement) {
                  window.scrollTo({
                      top: targetElement.offsetTop - 70,
                      behavior: 'smooth'
                  });
                  
                  // Close mobile menu if open
                  if (navmenu.classList.contains('mobile-nav-active')) {
                      navmenu.classList.remove('mobile-nav-active');
                      mobileNavToggle.classList.toggle('bi-list');
                      mobileNavToggle.classList.toggle('bi-x');
                  }
              }
          });
      });
      
      // Add shadow to header on scroll
      const header = document.querySelector('#header');
      if (header) {
          window.addEventListener('scroll', function() {
              if (window.scrollY > 100) {
                  header.style.boxShadow = '0 2px 15px rgba(0, 0, 0, 0.1)';
              } else {
                  header.style.boxShadow = 'none';
              }
          });
      }

      // Testimonial carousel auto-scroll
      const testimonialCarousel = document.querySelector('.testimonial-carousel');
      if (testimonialCarousel) {
        let scrollAmount = 0;
        const slideWidth = 350; // Adjust based on your card width + margin
        const totalSlides = testimonialCarousel.children.length;
        
        function autoScrollTestimonials() {
          if (scrollAmount >= slideWidth * (totalSlides - 1)) {
            scrollAmount = 0;
          } else {
            scrollAmount += slideWidth;
          }
          testimonialCarousel.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
          });
        }
        
        // Start auto-scrolling every 5 seconds
        setInterval(autoScrollTestimonials, 5000);
        
        // Pause on hover
        testimonialCarousel.addEventListener('mouseenter', () => {
          clearInterval(autoScrollTestimonials);
        });
        
        testimonialCarousel.addEventListener('mouseleave', () => {
          setInterval(autoScrollTestimonials, 5000);
        });
      }
    });

