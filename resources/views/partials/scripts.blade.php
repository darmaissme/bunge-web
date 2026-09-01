{{-- Swiper.js Bundle CDN --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

{{-- GreenSock Animation Platform (GSAP) & ScrollTrigger CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

{{-- Lightweight, Clean & Subtle GSAP Scroll Animations --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // 4. Disable animations on ticket page
    if (window.location.pathname.includes('/ticket') || document.querySelector('.ticket-page-container')) {
      return;
    }

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    // 1. Header & Footer: Kept static without animations per user request

    // 2. Hero Section Animations (Clean FOUC-free sequence: Clean Empty -> Sisi Kiri -> Sisi Kanan -> Logos)
    const heroSection = document.querySelector('#hero');
    if (heroSection) {
      // Step 1: Desktop Left Column (Sisi Kiri) animates after initial delay (0.2s)
      const heroLeftItems = heroSection.querySelectorAll('.hero-left-box > *');
      if (heroLeftItems.length > 0) {
        gsap.to(heroLeftItems, {
          y: 0,
          opacity: 1,
          duration: 0.8,
          delay: 0.2,
          stagger: 0.12,
          ease: 'power2.out'
        });
      }

      // Step 2: Desktop Right Column (Sisi Kanan) animates AFTER Sisi Kiri (delay 0.7s)
      const heroRightItems = heroSection.querySelectorAll('.hero-content-box > *');
      if (heroRightItems.length > 0) {
        gsap.to(heroRightItems, {
          y: 0,
          opacity: 1,
          duration: 0.8,
          delay: 0.7,
          stagger: 0.12,
          ease: 'power2.out'
        });
      }

      // Step 3: Indo2 Logo animates in after right column (delay 1.1s)
      const indoLogo = heroSection.querySelector('.hero-indo-logo');
      if (indoLogo) {
        gsap.to(indoLogo, {
          y: 0,
          opacity: 1,
          duration: 0.8,
          delay: 1.1,
          ease: 'power2.out'
        });
      }

      // Step 4: Mobile Content Elements
      const heroMobileElements = heroSection.querySelectorAll('.hero-mobile-box > *');
      if (heroMobileElements.length > 0) {
        gsap.to(heroMobileElements, {
          y: 0,
          opacity: 1,
          duration: 0.8,
          delay: 0.25,
          stagger: 0.12,
          ease: 'power2.out'
        });
      }
    }

    // 3. Event Preview Section (Scroll Reveal)
    const eventSection = document.querySelector('#event');
    if (eventSection) {
      const eventHeader = eventSection.querySelector('[data-gsap="event-preview-header"]');
      if (eventHeader) {
        gsap.from(eventHeader, {
          scrollTrigger: {
            trigger: eventHeader,
            start: 'top 82%',
            once: true
          },
          y: 25,
          opacity: 0,
          duration: 0.85,
          delay: 0.25,
          ease: 'power2.out'
        });
      }

      const eventVideo = eventSection.querySelector('video')?.parentElement?.parentElement;
      if (eventVideo) {
        gsap.from(eventVideo, {
          scrollTrigger: {
            trigger: eventVideo,
            start: 'top 82%',
            once: true
          },
          y: 30,
          scale: 0.98,
          opacity: 0,
          duration: 0.9,
          delay: 0.35,
          ease: 'power2.out'
        });
      }

      const eventSub = eventSection.querySelector('.text-center p');
      if (eventSub) {
        gsap.from(eventSub, {
          scrollTrigger: {
            trigger: eventSub,
            start: 'top 88%',
            once: true
          },
          y: 15,
          opacity: 0,
          duration: 0.7,
          delay: 0.3,
          ease: 'power2.out'
        });
      }

      // 4 Event Metric / Info Cards Box (Date, Hours, Location, Duration) - FAST & SMOOTH FLUID REVEAL
      const eventCardsDesktop = eventSection.querySelectorAll('[data-gsap="event-metric-cards"].hidden > *');
      const eventCardsMobile = eventSection.querySelector('[data-gsap="event-metric-cards"].block');

      if (eventCardsDesktop.length > 0) {
        gsap.from(eventCardsDesktop, {
          scrollTrigger: {
            trigger: '[data-gsap="event-metric-cards"]',
            start: 'top 88%',
            once: true
          },
          y: 16,
          opacity: 0,
          duration: 0.5,
          delay: 0.05,
          stagger: 0.06,
          ease: 'power3.out'
        });
      }

      if (eventCardsMobile) {
        gsap.from(eventCardsMobile, {
          scrollTrigger: {
            trigger: eventCardsMobile,
            start: 'top 88%',
            once: true
          },
          y: 16,
          opacity: 0,
          duration: 0.5,
          delay: 0.05,
          ease: 'power3.out'
        });
      }
    }

    // 3b. Consultation Section (Scroll Reveal)
    const consultSection = document.querySelector('#consultation');
    if (consultSection) {
      const consultForm = consultSection.querySelector('[data-gsap="consultation-form-card"]');
      if (consultForm) {
        gsap.from(consultForm, {
          scrollTrigger: {
            trigger: consultForm,
            start: 'top 82%',
            once: true
          },
          y: 30,
          opacity: 0,
          duration: 0.85,
          delay: 0.25,
          ease: 'power2.out'
        });
      }

      const consultRightCards = consultSection.querySelectorAll('[data-gsap="consultation-process-card"], [data-gsap="consultation-expert-visual"]');
      if (consultRightCards.length > 0) {
        gsap.from(consultRightCards, {
          scrollTrigger: {
            trigger: consultSection,
            start: 'top 78%',
            once: true
          },
          y: 30,
          opacity: 0,
          duration: 0.85,
          delay: 0.35,
          stagger: 0.2,
          ease: 'power2.out'
        });
      }
    }
  });
</script>

{{-- Additional page-level inline or modular script includes post-bundle loading --}}
@stack('scripts')
