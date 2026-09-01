{{--
  Bunge FlexiBetter Event Microsite — Production Header Component
  Food Ingredients Asia (FIA) Indonesia 2026
  Blade Partial: resources/views/partials/header.blade.php
--}}

<header
  x-data="{
    isScrolled: false,
    mobileMenuOpen: false,
    activeSection: '',
    init() {
      window.addEventListener('scroll', () => {
        this.isScrolled = window.scrollY > 20;

        @if(!request()->is('ticket*'))
        const sections = ['about', 'benefit', 'event', 'consultation'];
        const scrollPosition = window.scrollY + (window.innerHeight * 0.35);

        let currentActive = '';
        for (const sectionId of sections) {
          const el = document.getElementById(sectionId);
          if (el) {
            const top = el.offsetTop;
            const height = el.offsetHeight;
            if (scrollPosition >= top && scrollPosition < top + height) {
              currentActive = sectionId;
              break;
            }
          }
        }
        this.activeSection = currentActive;
        @endif
      });
    }
  }"
  class="relative w-full select-none z-[9999]"
>

  {{-- LEFT SIDE LOGO: NO BACKGROUND, XL:H-20 SIZE, PROMINENT & VERTICALLY ALIGNED --}}
  <div class="absolute top-5 sm:top-6 lg:top-7 left-5 sm:left-8 lg:left-12 xl:left-16 z-[9999] flex items-center">
    <a href="{{ url('/') }}" class="inline-flex items-center focus-ring-standard rounded-md group" aria-label="Bunge Home">
      <img
        src="{{ asset('images/NewLogo.svg') }}"
        alt="Bunge Logo"
        class="h-8.5 sm:h-10 lg:h-14 xl:h-[68px] w-auto object-contain transition-transform duration-300 group-hover:scale-[1.03]"
      />
    </a>
  </div>

  {{-- RIGHT SIDE NAVIGATION CAPSULE POD: FIXED STICKY ON SCROLL, VERTICALLY ALIGNED --}}
  <div class="fixed top-5 sm:top-6 lg:top-7 right-5 sm:right-8 lg:right-12 xl:right-16 z-[9999] flex items-center">
    <div class="bg-[#5AA546] backdrop-blur-md rounded-full px-5 sm:px-7 py-2.5 sm:py-3 shadow-[0_10px_32px_rgba(90,165,70,0.3)] border border-[#5AA546] flex items-center gap-4 sm:gap-6 transition-all duration-300 hover:shadow-[0_14px_40px_rgba(90,165,70,0.4)]">
      
      <!-- Language Switcher -->
      <div class="flex items-center text-xs sm:text-sm font-extrabold tracking-wide select-none" aria-label="Language Selector">
        <button
          type="button"
          @click="$store.lang.setLang('EN')"
          :class="$store.lang.current === 'EN' ? 'text-white font-black' : 'text-white/70 font-semibold hover:text-white'"
          class="px-2 py-0.5 transition-colors cursor-pointer rounded"
        >EN</button>
        <span class="text-white/50 font-light mx-1">|</span>
        <button
          type="button"
          @click="$store.lang.setLang('ID')"
          :class="$store.lang.current === 'ID' ? 'text-white font-black' : 'text-white/70 font-semibold hover:text-white'"
          class="px-2 py-0.5 transition-colors cursor-pointer rounded"
        >ID</button>
      </div>

      <!-- Primary CTA Button (Desktop Text Button) -->
      <a
        href="{{ url('/#consultation') }}"
        class="hidden sm:inline-flex items-center justify-center bg-[#002D6E] hover:bg-[#001D48] active:bg-[#001433] text-white font-extrabold text-xs sm:text-sm tracking-wider px-6 sm:px-8 py-2.5 sm:py-3 rounded-full transition-all duration-200 shadow-md hover:shadow-lg active:scale-[0.97]"
      >
        <span x-text="$store.lang.current === 'ID' ? 'booking sesi' : 'book a session'">book a session</span>
      </a>

      <!-- Primary CTA Button (Mobile Icon Button) -->
      <a
        href="{{ url('/#consultation') }}"
        class="sm:hidden inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#002D6E] hover:bg-[#001D48] text-white transition-all shadow-md active:scale-95"
        aria-label="Book a Session"
      >
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 11.25v7.5"/>
        </svg>
      </a>

    </div>

  </div>

</header>
