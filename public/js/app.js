/**
 * Bunge FlexiBetter Event Microsite — Main JavaScript Orchestrator (Browser/Public Version)
 * Food Ingredients Asia (FIA) Indonesia 2026
 */

document.addEventListener('DOMContentLoaded', () => {
  // Initialize Lucide Icons if available globally
  if (typeof lucide !== 'undefined' && lucide.createIcons) {
    lucide.createIcons();
  }

  // Initialize GSAP animations if available globally
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    // Hero fade-in animation
    gsap.from('[data-gsap="hero-content"]', {
      opacity: 0,
      y: 30,
      duration: 1,
      ease: 'power3.out'
    });

    // Benefit cards staggered animation
    gsap.from('[data-gsap="benefit-card"]', {
      scrollTrigger: {
        trigger: '#benefit',
        start: 'top 80%'
      },
      opacity: 0,
      y: 40,
      duration: 0.8,
      stagger: 0.2,
      ease: 'power2.out'
    });
  }

  // Alpine.js component data fallbacks (if using standalone CDN script)
  if (typeof Alpine !== 'undefined') {
    Alpine.data('navManager', () => ({
      isScrolled: false,
      mobileMenuOpen: false,

      init() {
        window.addEventListener('scroll', () => {
          this.isScrolled = window.scrollY > 20;
        });
      },

      toggleMobileMenu() {
        this.mobileMenuOpen = !this.mobileMenuOpen;
      }
    }));
  }
});
