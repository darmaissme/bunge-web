/**
 * Bunge FlexiBetter Event Microsite — Main JavaScript Orchestrator
 * Food Ingredients Asia (FIA) Indonesia 2026
 *
 * Architecture Principles:
 * - Decoupled modular initialization
 * - Blade partial independent maintainability
 * - Alpine.js + GSAP + Lucide integration
 */

import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { createIcons, Menu, X, ArrowRight, Calendar, MapPin, CheckCircle, ChevronDown } from 'lucide';

// Register GSAP Plugins
gsap.registerPlugin(ScrollTrigger);

// Attach global references safely
window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// ==========================================================================
// Alpine.js Global State & Component Registration
// ==========================================================================

// Global Navigation State
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

// Consultation Form Alpine State Bridge
Alpine.data('consultationForm', () => ({
  submitting: false,
  errors: {},
  formData: {
    full_name: '',
    email: '',
    company: '',
    job_title: '',
    topic: '',
    message: ''
  },

  submitForm(event) {
    this.submitting = true;
    // Laravel will handle native POST or AJAX endpoint submission downstream
  }
}));

// ==========================================================================
// Icon Initializer Engine
// ==========================================================================
function initIcons() {
  createIcons({
    icons: {
      Menu,
      X,
      ArrowRight,
      Calendar,
      MapPin,
      CheckCircle,
      ChevronDown
    }
  });
}

// ==========================================================================
// Bootstrap Cycle
// ==========================================================================
document.addEventListener('DOMContentLoaded', () => {
  // 1. Initialize Icons
  initIcons();

  // 2. Start Alpine Engine
  Alpine.start();

  // 3. Dispatch ready event for downstream Blade partial handlers
  window.dispatchEvent(new CustomEvent('bunge:app-ready'));
});
