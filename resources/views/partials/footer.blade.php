{{-- 
  FOOTER COMPONENT
  Bunge FlexiBetter Event Microsite — Food Ingredients Asia (FIA) Indonesia 2026
  Blade Partial: resources/views/partials/footer.blade.php
--}}
<footer x-data="{}" class="w-full bg-[#002D6E] pt-14 pb-10 sm:pt-16 sm:pb-12 text-white select-none">
  <div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
    
    {{-- TOP FOOTER ROW: BRAND LOGO & TAGLINE (LEFT) + NAVIGATION LINKS (RIGHT) --}}
    <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-10 sm:gap-12 lg:gap-16 mb-12 sm:mb-16">
      
      {{-- BRAND LOGO & TAGLINE COLUMN --}}
      <div class="max-w-md">
        {{-- BUNGE OFFICIAL WHITE LOGO --}}
        <a href="#" class="inline-block mb-4 sm:mb-5 focus-ring-standard rounded-md group" aria-label="Bunge Home">
          <img
            src="{{ asset('images/logo-white.png') }}"
            alt="Bunge Logo"
            class="h-8 sm:h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-[1.02]"
          />
        </a>

        {{-- BRAND DESCRIPTION TEXT --}}
        <p
          class="text-white/80 text-sm sm:text-base font-normal leading-relaxed max-w-sm mb-3"
          x-text="$store.lang.current === 'ID' ? 'Jelajahi solusi, inovasi, dan komitmen kami untuk membangun sistem pangan yang lebih baik.' : 'Explore our solutions, innovations, and commitment to building a better food system.'"
        >
          Explore our solutions, innovations, and commitment to building a better food system.
        </p>

        {{-- VISIT WEBSITE LINK --}}
        <p class="text-white/80 text-sm sm:text-base font-normal">
          <span x-text="$store.lang.current === 'ID' ? 'Kunjungi ' : 'Visit '">Visit </span>
          <a
            href="https://www.bunge.com"
            target="_blank"
            rel="noopener noreferrer"
            class="font-bold text-white hover:underline inline-flex items-center gap-1 group"
          >
            <span>bunge.com</span>
            <span class="transition-transform duration-200 group-hover:translate-x-1">&rarr;</span>
          </a>
        </p>
      </div>

      {{-- FOOTER NAVIGATION LINKS (HORIZONTAL ROW ON DESKTOP WITH BALANCED SPACING) --}}
      <nav class="pt-2 sm:pt-4 lg:pt-2" aria-label="Footer Navigation">
        <ul class="flex flex-col sm:flex-row flex-wrap items-start sm:items-center gap-4 sm:gap-6 lg:gap-6 xl:gap-8 2xl:gap-14">
          <li>
            <a
              href="{{ url('/#about') }}"
              class="text-xs sm:text-[13px] font-bold text-white hover:text-white/80 transition-colors duration-200 focus-ring-standard rounded tracking-wide"
              x-text="$store.lang.current === 'ID' ? 'Tentang Kami' : 'About Us'"
            >
              About Us
            </a>
          </li>
          <li>
            <a
              href="{{ url('/#benefit') }}"
              class="text-xs sm:text-[13px] font-bold text-white hover:text-white/80 transition-colors duration-200 focus-ring-standard rounded tracking-wide"
            >
              FlexiBetter
            </a>
          </li>
          <li>
            <a
              href="{{ url('/#event') }}"
              class="text-xs sm:text-[13px] font-bold text-white hover:text-white/80 transition-colors duration-200 focus-ring-standard rounded tracking-wide"
              x-text="$store.lang.current === 'ID' ? 'Acara' : 'Event'"
            >
              Event
            </a>
          </li>
          <li>
            <a
              href="{{ url('/#consultation') }}"
              class="text-xs sm:text-[13px] font-bold text-white hover:text-white/80 transition-colors duration-200 focus-ring-standard rounded tracking-wide"
              x-text="$store.lang.current === 'ID' ? 'Jadwalkan Sesi' : 'Schedule a Session'"
            >
              Schedule a Session
            </a>
          </li>
          <li>
            <button
              type="button"
              @click="window.dispatchEvent(new CustomEvent('open-manage-booking-modal'))"
              onclick="window.dispatchEvent(new CustomEvent('open-manage-booking-modal'))"
              class="text-xs sm:text-[13px] font-bold text-white hover:text-white/80 transition-colors duration-200 focus-ring-standard rounded cursor-pointer inline-flex items-center gap-1.5 tracking-wide"
            >
              <span x-text="$store.lang.current === 'ID' ? 'Kelola Booking Anda' : 'Manage your Booking'">Manage your Booking</span>
              <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/>
              </svg>
            </button>
          </li>
        </ul>
      </nav>

    </div>

    {{-- HORIZONTAL DIVIDER LINE --}}
    <div class="w-full border-t border-white/15 mb-8 sm:mb-10"></div>

    {{-- BOTTOM COPYRIGHT ROW --}}
    <div class="text-center">
      <p
        class="text-xs sm:text-sm text-white/70 font-normal"
        x-text="$store.lang.current === 'ID' ? 'Hak Cipta © 2026 Bunge. Seluruh Hak Cipta Dilindungi.' : 'Copyright © 2026 Bunge. All Rights Reserved.'"
      >
        Copyright &copy; 2026 Bunge. All Rights Reserved.
      </p>
    </div>

  </div>
</footer>
