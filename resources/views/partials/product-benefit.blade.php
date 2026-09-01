{{--
  Bunge FlexiBetter Event Microsite — Production Product Benefit Component
  Food Ingredients Asia (FIA) Indonesia 2026
  Blade Partial: resources/views/partials/product-benefit.blade.php
--}}

<section
  id="benefit"
  class="relative w-full bg-slate-50 text-slate-900 pt-0 pb-20 sm:pb-28 overflow-hidden z-20"
  aria-label="FlexiBetter Product Benefit Section"
>

  {{-- COMPONENT 01 & 02: MAIN HERO SHOWCASE (FULL WIDTH & FULL HEIGHT BENEFIT-KV.JPG WITH HEADING & CALLOUTS OVERLAYED) --}}
  <div data-gsap="benefit-showcase" class="relative w-full mb-16 sm:mb-24">
    
    {{-- FULL WIDTH & NATURAL ASPECT IMAGE CONTAINER --}}
    <div class="relative w-full overflow-hidden shadow-[0_20px_50px_rgba(0,40,120,0.12)]">
      
      {{-- 100% Full Width and Natural Height Background Image (Responsive Desktop / Mobile) --}}
      <picture class="w-full h-auto block select-none">
        <source media="(min-width: 640px)" srcset="{{ asset('images/benefit-kv.jpg') }}" />
        <img
          src="{{ asset('images/benefit-kv-mobile.jpg') }}"
          alt="Bunge FlexiBetter Functional Butter Solution Showcase"
          class="w-full h-auto block select-none"
          loading="eager"
        />
      </picture>

      {{-- OVERLAY CONTAINER FOR DESKTOP & TABLET MATCHING UI REFERENCE --}}
      <div class="absolute inset-0 z-20 pointer-events-none p-4 sm:p-8 lg:p-12 xl:p-16 flex flex-col justify-between">
        <div class="relative w-full h-full max-w-[1440px] mx-auto flex flex-col justify-between">
          
          {{-- TOP HEADING (CENTERED OVER BLUE GRADIENT AREA AT THE TOP OF BENEFIT-KV.JPG) --}}
          <div class="text-center max-w-3xl mx-auto pt-10 sm:pt-4 lg:pt-8 pointer-events-auto">
            <div data-gsap="benefit-eyebrow" class="mb-2 sm:mb-3">
              <span class="inline-block text-xs sm:text-sm lg:text-base font-extrabold tracking-widest uppercase text-white/95">
                FLEXIBETTER EXPERIENCE
              </span>
            </div>

            <h2
              data-gsap="benefit-title"
              class="text-3xl sm:text-4xl lg:text-[54px] xl:text-[62px] font-extrabold text-white leading-[1.08] tracking-tight mb-2 sm:mb-4 lg:mb-5 drop-shadow-sm"
            >
              Better Butter<br />
              Better Performance<br />
              Better Results
            </h2>

            <p
              data-gsap="benefit-desc"
              class="text-sm sm:text-base xl:text-lg text-white/90 font-medium leading-relaxed max-w-[70%] sm:max-w-2xl mx-auto drop-shadow-sm"
            >
              Bunge FlexiBetter is a functional butter solution designed to deliver consistency, efficiency, and the best results across a wide range of food production needs.
            </p>
          </div>

          {{-- 4 CALLOUTS OVERLAY (MATCHING UI REFERENCE POSITIONS AND COLORS) --}}
          <div class="hidden md:block absolute inset-0 z-20 pointer-events-none">
            
            {{-- Top-Left Callout --}}
            <div class="absolute top-[41%] xl:top-[43%] left-[2%] xl:left-[4%] max-w-[280px] lg:max-w-[320px] pointer-events-auto">
              <div class="flex items-start justify-end gap-3 text-right">
                <div class="text-right flex flex-col items-end">
                  <h3 class="text-base sm:text-lg lg:text-2xl font-extrabold text-white leading-tight mb-1 text-right">
                    Functional<br />Butter Solution
                  </h3>
                  <p class="text-xs sm:text-sm text-white/85 font-medium leading-relaxed text-right">
                    Designed to meet the needs of the food industry and manufacturers.
                  </p>
                </div>
                <img src="{{ asset('images/heart.png') }}" alt="Heart Icon" class="w-6 h-6 lg:w-8 lg:h-8 object-contain shrink-0 filter brightness-0 invert mt-0.5" />
              </div>
            </div>

            {{-- Top-Right Callout --}}
            <div class="absolute top-[38%] xl:top-[40%] right-[0.5%] xl:right-[1.5%] max-w-[280px] lg:max-w-[320px] pointer-events-auto">
              <div class="flex items-start justify-start gap-3 text-left">
                <img src="{{ asset('images/box.png') }}" alt="Box Icon" class="w-6 h-6 lg:w-8 lg:h-8 object-contain shrink-0 filter brightness-0 invert mt-0.5" />
                <div class="text-left flex flex-col items-start">
                  <h3 class="text-base sm:text-lg lg:text-2xl font-extrabold text-white leading-tight mb-1 text-left">
                    Sustainable Supply
                  </h3>
                  <p class="text-xs sm:text-sm text-white/85 font-medium leading-relaxed text-left">
                    Responsibly sourced with the support of a reliable global network.
                  </p>
                </div>
              </div>
            </div>

            {{-- Bottom-Left Callout --}}
            <div class="absolute bottom-[4.5%] xl:bottom-[6%] left-[0%] xl:left-[-5%] max-w-[280px] lg:max-w-[320px] pointer-events-auto">
              <div class="flex items-start justify-end gap-3 text-right">
                <div class="text-right flex flex-col items-end">
                  <h3 class="text-base sm:text-lg lg:text-2xl font-extrabold text-[#002D6E] leading-tight mb-1 text-right">
                    Consistent<br />Quality
                  </h3>
                  <p class="text-xs sm:text-sm text-[#002D6E]/80 font-medium leading-relaxed text-right">
                    Delivering stable and reliable performance in every production process.
                  </p>
                </div>
                <img src="{{ asset('images/magic-star.png') }}" alt="Star Icon" class="w-6 h-6 lg:w-8 lg:h-8 object-contain shrink-0 mt-0.5" />
              </div>
            </div>

            {{-- Bottom-Right Callout --}}
            <div class="absolute bottom-[3.5%] xl:bottom-[4.5%] right-[-2%] xl:right-[-6%] max-w-[280px] lg:max-w-[320px] pointer-events-auto">
              <div class="flex items-start justify-start gap-3 text-left">
                <img src="{{ asset('images/bucket.png') }}" alt="Bucket Icon" class="w-6 h-6 lg:w-8 lg:h-8 object-contain shrink-0 mt-0.5" />
                <div class="text-left flex flex-col items-start">
                  <h3 class="text-base sm:text-lg lg:text-2xl font-extrabold text-[#002D6E] leading-tight mb-1 text-left">
                    Optimized for<br />Production
                  </h3>
                  <p class="text-xs sm:text-sm text-[#002D6E]/80 font-medium leading-relaxed text-left">
                    Efficient, stable, and easily integrated into manufacturing processes.
                  </p>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>

    {{-- MOBILE STACKED CALLOUTS (NARROWED COMPACT CONTAINER) --}}
    <div class="block md:hidden max-w-[320px] sm:max-w-md mx-auto px-4 mt-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
      <div class="flex items-start gap-3.5 p-1">
        <img src="{{ asset('images/heart2.png') }}" alt="Heart Icon" class="w-7 h-7 object-contain shrink-0 mt-0.5" />
        <div>
          <h3 class="text-base font-extrabold text-[#002D6E] leading-snug mb-0.5">
            Functional Butter Solution
          </h3>
          <p class="text-xs text-slate-700 font-medium leading-relaxed">
            Designed to meet the needs of the food industry and manufacturers.
          </p>
        </div>
      </div>

      <div class="flex items-start gap-3.5 p-1">
        <img src="{{ asset('images/box2.png') }}" alt="Box Icon" class="w-7 h-7 object-contain shrink-0 mt-0.5" />
        <div>
          <h3 class="text-base font-extrabold text-[#002D6E] leading-snug mb-0.5">
            Sustainable Supply
          </h3>
          <p class="text-xs text-slate-700 font-medium leading-relaxed">
            Responsibly sourced with the support of a reliable global network.
          </p>
        </div>
      </div>

      <div class="flex items-start gap-3.5 p-1">
        <img src="{{ asset('images/magic-star.png') }}" alt="Star Icon" class="w-7 h-7 object-contain shrink-0 mt-0.5" />
        <div>
          <h3 class="text-base font-extrabold text-[#002D6E] leading-snug mb-0.5">
            Consistent Quality
          </h3>
          <p class="text-xs text-slate-700 font-medium leading-relaxed">
            Delivering stable and reliable performance in every production process.
          </p>
        </div>
      </div>

      <div class="flex items-start gap-3.5 p-1">
        <img src="{{ asset('images/bucket.png') }}" alt="Bucket Icon" class="w-7 h-7 object-contain shrink-0 mt-0.5" />
        <div>
          <h3 class="text-base font-extrabold text-[#002D6E] leading-snug mb-0.5">
            Optimized for Production
          </h3>
          <p class="text-xs text-slate-700 font-medium leading-relaxed">
            Efficient, stable, and easily integrated into manufacturing processes.
          </p>
        </div>
      </div>
    </div>

  </div>

  {{-- REMAINING COMPONENTS INSIDE CONTAINER --}}
  <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- VIDEO SHOWCASE BANNER CARD ("MADE WITH SMARTER DECISION") --}}
    <div
      data-gsap="benefit-video-card"
      class="relative max-w-4xl mx-auto mb-20 sm:mb-28 rounded-3xl overflow-hidden shadow-[0_25px_65px_rgba(0,45,110,0.3)] border-2 border-white/80 aspect-[16/9] sm:aspect-[2.2/1] bg-slate-900 group cursor-pointer"
    >
      <img
        src="{{ asset('images/carousel-section3-2.jpg') }}"
        alt="Bunge Automated Industrial Bakery Butter Production Showcase"
        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90"
      />
      <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/30 to-slate-950/30 flex flex-col items-center justify-center text-center p-6">
        <h3 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight uppercase mb-6 drop-shadow-lg">
          MADE WITH SMARTER DECISION
        </h3>
        <button
          type="button"
          class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white/30 hover:bg-white/50 backdrop-blur-md border-2 border-white flex items-center justify-center text-white transition-all duration-300 shadow-xl hover:scale-110 active:scale-95 group-hover:bg-white text-[#002D6E] focus-ring-standard"
          aria-label="Play video showcase"
        >
          <svg class="w-8 h-8 sm:w-10 sm:h-10 fill-current translate-x-0.5" viewBox="0 0 24 24">
            <path d="M8 5v14l11-7z"/>
          </svg>
        </button>
      </div>
    </div>

    {{-- COMPONENT 03: PRODUCT APPLICATIONS ("CAN BE APPLIED IN:") --}}
    <div data-gsap="benefit-applications" class="max-w-5xl mx-auto mb-20 sm:mb-28 text-center">
      <h3 class="text-base sm:text-lg font-extrabold text-[#002D6E] tracking-widest uppercase mb-8 sm:mb-12">
        CAN BE APPLIED IN:
      </h3>

      {{-- DESKTOP ROW (5 Equal Circle Cards) --}}
      <div class="hidden sm:flex items-center justify-center gap-8 lg:gap-14">
        {{-- Application 1: Bakery --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-24 h-24 lg:w-28 lg:h-28 rounded-full border-4 border-white shadow-lg overflow-hidden mb-3.5 transition-transform duration-300 group-hover:scale-105 group-hover:border-blue-200">
            <img src="{{ asset('images/bakery.png') }}" alt="Bakery Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-sm lg:text-base font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors">
            Bakery
          </span>
        </div>

        {{-- Application 2: Pastry --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-24 h-24 lg:w-28 lg:h-28 rounded-full border-4 border-white shadow-lg overflow-hidden mb-3.5 transition-transform duration-300 group-hover:scale-105 group-hover:border-blue-200">
            <img src="{{ asset('images/pastry.png') }}" alt="Pastry Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-sm lg:text-base font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors">
            Pastry
          </span>
        </div>

        {{-- Application 3: Cookies & Biscuits --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-24 h-24 lg:w-28 lg:h-28 rounded-full border-4 border-white shadow-lg overflow-hidden mb-3.5 transition-transform duration-300 group-hover:scale-105 group-hover:border-blue-200">
            <img src="{{ asset('images/cookies.png') }}" alt="Cookies & Biscuits Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-sm lg:text-base font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors">
            Cookies & Biscuits
          </span>
        </div>

        {{-- Application 4: Confectionery --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-24 h-24 lg:w-28 lg:h-28 rounded-full border-4 border-white shadow-lg overflow-hidden mb-3.5 transition-transform duration-300 group-hover:scale-105 group-hover:border-blue-200">
            <img src="{{ asset('images/confectionery.png') }}" alt="Confectionery Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-sm lg:text-base font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors">
            Confectionery
          </span>
        </div>

        {{-- Application 5: Dairy --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-24 h-24 lg:w-28 lg:h-28 rounded-full border-4 border-white shadow-lg overflow-hidden mb-3.5 transition-transform duration-300 group-hover:scale-105 group-hover:border-blue-200">
            <img src="{{ asset('images/daily.png') }}" alt="Dairy Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-sm lg:text-base font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors">
            Dairy
          </span>
        </div>
      </div>

      {{-- MOBILE HORIZONTAL SWIPE CAROUSEL (Visible on mobile < 640px) --}}
      <div class="block sm:hidden w-full overflow-x-auto flex gap-6 px-4 pb-4 snap-x snap-mandatory scrollbar-none">
        <div class="flex flex-col items-center text-center shrink-0 snap-center w-[110px]">
          <div class="w-20 h-20 rounded-full border-3 border-white shadow-md overflow-hidden mb-2">
            <img src="{{ asset('images/bakery.png') }}" alt="Bakery Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-xs font-bold text-[#002D6E]">Bakery</span>
        </div>

        <div class="flex flex-col items-center text-center shrink-0 snap-center w-[110px]">
          <div class="w-20 h-20 rounded-full border-3 border-white shadow-md overflow-hidden mb-2">
            <img src="{{ asset('images/pastry.png') }}" alt="Pastry Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-xs font-bold text-[#002D6E]">Pastry</span>
        </div>

        <div class="flex flex-col items-center text-center shrink-0 snap-center w-[110px]">
          <div class="w-20 h-20 rounded-full border-3 border-white shadow-md overflow-hidden mb-2">
            <img src="{{ asset('images/cookies.png') }}" alt="Cookies & Biscuits Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-xs font-bold text-[#002D6E]">Cookies & Biscuits</span>
        </div>

        <div class="flex flex-col items-center text-center shrink-0 snap-center w-[110px]">
          <div class="w-20 h-20 rounded-full border-3 border-white shadow-md overflow-hidden mb-2">
            <img src="{{ asset('images/confectionery.png') }}" alt="Confectionery Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-xs font-bold text-[#002D6E]">Confectionery</span>
        </div>

        <div class="flex flex-col items-center text-center shrink-0 snap-center w-[110px]">
          <div class="w-20 h-20 rounded-full border-3 border-white shadow-md overflow-hidden mb-2">
            <img src="{{ asset('images/daily.png') }}" alt="Dairy Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-xs font-bold text-[#002D6E]">Dairy</span>
        </div>
      </div>

    </div>

    {{-- COMPONENT 04: PRODUCT SPECIFICATIONS --}}
    <div
      data-gsap="benefit-specs"
      x-data="{
        specActive: 0,
        specTimer: null,
        specCount: 4,
        nextSpec() {
          this.specActive = (this.specActive + 1) % this.specCount;
        },
        startSpecAutoplay() {
          this.stopSpecAutoplay();
          this.specTimer = setInterval(() => this.nextSpec(), 3000);
        },
        stopSpecAutoplay() {
          if (this.specTimer) clearInterval(this.specTimer);
        }
      }"
      x-init="startSpecAutoplay()"
      @mouseenter="stopSpecAutoplay()"
      @mouseleave="startSpecAutoplay()"
      class="max-w-[1320px] mx-auto text-center"
    >
      <h3 class="text-base sm:text-lg font-extrabold text-[#002D6E] tracking-widest uppercase mb-8 sm:mb-12">
        PRODUCT SPECIFICATIONS
      </h3>

      {{-- DESKTOP GRID (4 Cards) --}}
      <div class="hidden sm:grid grid-cols-2 lg:grid-cols-4 gap-6 text-left">
        
        {{-- Card 1: Form Factor --}}
        <div class="bg-gradient-to-b from-white/90 via-white/70 to-slate-100/60 backdrop-blur-xl border border-white rounded-2xl p-6 shadow-[0_10px_30px_rgba(0,40,120,0.06)] flex flex-col justify-between min-h-[150px] hover:shadow-lg transition-shadow">
          <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-extrabold tracking-wider px-3.5 py-1.5 rounded-full uppercase border border-slate-200/80 shadow-xs w-fit mb-4">
            <svg class="w-4 h-4 text-[#0055D4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span>FORM FACTOR</span>
          </div>
          <p class="text-base lg:text-lg font-extrabold text-[#002D6E] leading-snug">
            10 kg block / 1 kg sheet × 10
          </p>
        </div>

        {{-- Card 2: Shelf Life --}}
        <div class="bg-gradient-to-b from-white/90 via-white/70 to-slate-100/60 backdrop-blur-xl border border-white rounded-2xl p-6 shadow-[0_10px_30px_rgba(0,40,120,0.06)] flex flex-col justify-between min-h-[150px] hover:shadow-lg transition-shadow">
          <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-extrabold tracking-wider px-3.5 py-1.5 rounded-full uppercase border border-slate-200/80 shadow-xs w-fit mb-4">
            <svg class="w-4 h-4 text-[#0055D4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>SHELF LIFE</span>
          </div>
          <p class="text-base lg:text-lg font-extrabold text-[#002D6E] leading-snug">
            Chilled: 5 mo / Frozen: 18 mo
          </p>
        </div>

        {{-- Card 3: Storage --}}
        <div class="bg-gradient-to-b from-white/90 via-white/70 to-slate-100/60 backdrop-blur-xl border border-white rounded-2xl p-6 shadow-[0_10px_30px_rgba(0,40,120,0.06)] flex flex-col justify-between min-h-[150px] hover:shadow-lg transition-shadow">
          <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-extrabold tracking-wider px-3.5 py-1.5 rounded-full uppercase border border-slate-200/80 shadow-xs w-fit mb-4">
            <svg class="w-4 h-4 text-[#0055D4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            <span>STORAGE</span>
          </div>
          <p class="text-base lg:text-lg font-extrabold text-[#002D6E] leading-snug">
            0-10°C Chilled / -18°C Frozen
          </p>
        </div>

        {{-- Card 4: Compliance --}}
        <div class="bg-gradient-to-b from-white/90 via-white/70 to-slate-100/60 backdrop-blur-xl border border-white rounded-2xl p-6 shadow-[0_10px_30px_rgba(0,40,120,0.06)] flex flex-col justify-between min-h-[150px] hover:shadow-lg transition-shadow">
          <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-extrabold tracking-wider px-3.5 py-1.5 rounded-full uppercase border border-slate-200/80 shadow-xs w-fit mb-4">
            <svg class="w-4 h-4 text-[#0055D4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <span>COMPLIANCE</span>
          </div>
          <p class="text-base lg:text-lg font-extrabold text-[#002D6E] leading-snug">
            Halal Certified
          </p>
        </div>

      </div>

      {{-- MOBILE CAROUSEL (Visible on mobile < 640px) --}}
      <div class="block sm:hidden w-full px-4">
        <div class="relative w-full max-w-[320px] mx-auto min-h-[160px] flex items-center justify-center">
          
          {{-- Card 1 --}}
          <div
            x-show="specActive === 0"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-white/90 backdrop-blur-md border border-white rounded-2xl p-6 shadow-md text-left flex flex-col justify-between min-h-[160px]"
          >
            <div class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 text-xs font-extrabold tracking-wider px-3.5 py-1.5 rounded-full uppercase border border-slate-200/80 shadow-xs w-fit mb-3">
              <svg class="w-4 h-4 text-[#0055D4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
              <span>FORM FACTOR</span>
            </div>
            <p class="text-lg font-extrabold text-[#002D6E]">
              10 kg block / 1 kg sheet × 10
            </p>
          </div>

          {{-- Card 2 --}}
          <div
            x-show="specActive === 1"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-white/90 backdrop-blur-md border border-white rounded-2xl p-6 shadow-md text-left flex flex-col justify-between min-h-[160px]"
          >
            <div class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 text-xs font-extrabold tracking-wider px-3.5 py-1.5 rounded-full uppercase border border-slate-200/80 shadow-xs w-fit mb-3">
              <svg class="w-4 h-4 text-[#0055D4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <span>SHELF LIFE</span>
            </div>
            <p class="text-lg font-extrabold text-[#002D6E]">
              Chilled: 5 mo / Frozen: 18 mo
            </p>
          </div>

          {{-- Card 3 --}}
          <div
            x-show="specActive === 2"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-white/90 backdrop-blur-md border border-white rounded-2xl p-6 shadow-md text-left flex flex-col justify-between min-h-[160px]"
          >
            <div class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 text-xs font-extrabold tracking-wider px-3.5 py-1.5 rounded-full uppercase border border-slate-200/80 shadow-xs w-fit mb-3">
              <svg class="w-4 h-4 text-[#0055D4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
              <span>STORAGE</span>
            </div>
            <p class="text-lg font-extrabold text-[#002D6E]">
              0-10°C Chilled / -18°C Frozen
            </p>
          </div>

          {{-- Card 4 --}}
          <div
            x-show="specActive === 3"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-white/90 backdrop-blur-md border border-white rounded-2xl p-6 shadow-md text-left flex flex-col justify-between min-h-[160px]"
          >
            <div class="inline-flex items-center gap-2 bg-slate-100 text-slate-700 text-xs font-extrabold tracking-wider px-3.5 py-1.5 rounded-full uppercase border border-slate-200/80 shadow-xs w-fit mb-3">
              <svg class="w-4 h-4 text-[#0055D4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
              <span>COMPLIANCE</span>
            </div>
            <p class="text-lg font-extrabold text-[#002D6E]">
              Halal Certified
            </p>
          </div>

        </div>

        {{-- BULLET DOTS PAGINATION --}}
        <div class="flex items-center justify-center gap-2.5 mt-6">
          <template x-for="(item, index) in [0, 1, 2, 3]" :key="index">
            <button
              type="button"
              @click="specActive = index"
              :class="specActive === index ? 'w-7 bg-[#002D6E] shadow-sm' : 'w-2.5 bg-slate-300 hover:bg-slate-400'"
              class="h-2.5 rounded-full transition-all duration-300 focus-ring-standard"
              :aria-label="'Go to specification slide ' + (index + 1)"
            ></button>
          </template>
        </div>
      </div>

    </div>

  </div>
</section>
