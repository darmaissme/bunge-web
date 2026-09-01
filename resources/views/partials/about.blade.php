{{--
  Bunge FlexiBetter Event Microsite — Production About Bunge Component
  Food Ingredients Asia (FIA) Indonesia 2026
  Blade Partial: resources/views/partials/about.blade.php
--}}

<section
  id="about"
  class="hidden relative bg-[#002D6E] text-white pt-24 sm:pt-32 lg:pt-40 pb-20 sm:pb-28 overflow-hidden z-20"
  aria-label="About Bunge Section"
>
  <div class="relative z-40 max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- COMPONENT 1: SECTION HEADING (Centered with pt-24/sm:pt-32/lg:pt-40 so ABOUT BUNGE text sits cleanly below the hero wave curve on desktop) --}}
    <div class="text-center max-w-4xl mx-auto mb-10 sm:mb-14 relative z-50">
      <div data-gsap="about-eyebrow" class="mb-3 relative z-50">
        <span
          class="inline-block text-xs sm:text-base lg:text-xl font-extrabold tracking-widest uppercase text-slate-300/90"
          x-text="$store.lang.current === 'ID' ? 'TENTANG BUNGE' : 'ABOUT BUNGE'"
        >
          ABOUT BUNGE
        </span>
      </div>

      <h2
        data-gsap="about-title"
        class="text-4xl sm:text-5xl lg:text-[56px] font-extrabold text-white leading-[1.15] tracking-tight mb-6"
        x-text="$store.lang.current === 'ID' ? 'Pemimpin Global dalam Makanan, Bahan Olahan, dan Solusi' : 'A Global Leader in Food, Ingredients, and Solutions'"
      >
        A Global Leader in Food, Ingredients, and Solutions
      </h2>

      <p
        data-gsap="about-desc"
        class="text-base sm:text-lg text-slate-200/90 font-normal leading-relaxed max-w-2xl mx-auto"
        x-text="$store.lang.current === 'ID' ? 'Bunge menghubungkan petani dengan konsumen untuk memenuhi kebutuhan pangan, pakan, dan energi utama di seluruh dunia. Dengan jaringan global yang kuat, keahlian mendalam, dan komitmen terhadap keberlanjutan, kami menciptakan nilai bagi para mitra di setiap tahap perjalanan.' : 'Bunge connects farmers with consumers to deliver essential food, feed, and energy needs worldwide. With a strong global network, deep expertise, and commitment to sustainability, we create value for partners at every stage of the journey.'"
      >
        Bunge connects farmers with consumers to deliver essential food, feed, and energy needs worldwide. With a strong global network, deep expertise, and commitment to sustainability, we create value for partners at every stage of the journey.
      </p>
    </div>

    {{-- COMPONENT 2: REVOLVING TRI-CARD ORBIT CAROUSEL (Mobile Full-Width Rounded Square vs Desktop Stadium Oval) --}}
    <div
      data-gsap="about-carousel"
      x-data="{
        active: 1,
        timer: null,
        next() {
          this.active = (this.active + 1) % 3;
        },
        startAutoplay() {
          this.stopAutoplay();
          this.timer = setInterval(() => this.next(), 2200);
        },
        stopAutoplay() {
          if (this.timer) clearInterval(this.timer);
        }
      }"
      x-init="startAutoplay()"
      @mouseenter="stopAutoplay()"
      @mouseleave="startAutoplay()"
      class="relative w-full max-w-[1380px] h-[340px] sm:h-[480px] lg:h-[580px] xl:h-[640px] mx-auto mb-16 sm:mb-24 flex items-center justify-center overflow-visible select-none"
    >
      {{-- Slide 0: Agricultural Silos --}}
      <div
        :class="{
          'left-1/2 -translate-x-1/2 scale-100 opacity-100 z-30 shadow-[0_30px_70px_rgba(0,0,0,0.6)] border-2 sm:border-3 border-white/40': active === 0,
          '-left-6 sm:-left-10 lg:-left-16 xl:-left-20 translate-x-0 scale-[0.68] opacity-0 sm:opacity-95 pointer-events-none sm:pointer-events-auto z-10 shadow-[0_20px_45px_rgba(0,0,0,0.35)] border-2 border-white/25': (active + 2) % 3 === 0,
          '-right-6 sm:-right-10 lg:-right-16 xl:-right-20 translate-x-0 scale-[0.68] opacity-0 sm:opacity-95 pointer-events-none sm:pointer-events-auto z-10 shadow-[0_20px_45px_rgba(0,0,0,0.35)] border-2 border-white/25': (active + 1) % 3 === 0
        }"
        class="absolute top-1/2 -translate-y-1/2 w-[92%] sm:w-[76%] lg:w-[72%] aspect-[4/4.2] sm:aspect-[1.95/1] rounded-[32px] sm:rounded-full overflow-hidden transition-all duration-700 ease-in-out cursor-pointer"
        @click="active = 0"
      >
        <img
          src="{{ asset('images/carousel-section3-1.jpg') }}"
          alt="Bunge Global Agricultural Sourcing and Grain Silos"
          class="w-full h-full object-cover"
          loading="eager"
        />
      </div>

      {{-- Slide 1: Food Scientists Lab (Initial Center Active) --}}
      <div
        :class="{
          'left-1/2 -translate-x-1/2 scale-100 opacity-100 z-30 shadow-[0_30px_70px_rgba(0,0,0,0.6)] border-2 sm:border-3 border-white/40': active === 1,
          '-left-6 sm:-left-10 lg:-left-16 xl:-left-20 translate-x-0 scale-[0.68] opacity-0 sm:opacity-95 pointer-events-none sm:pointer-events-auto z-10 shadow-[0_20px_45px_rgba(0,0,0,0.35)] border-2 border-white/25': (active + 2) % 3 === 1,
          '-right-6 sm:-right-10 lg:-right-16 xl:-right-20 translate-x-0 scale-[0.68] opacity-0 sm:opacity-95 pointer-events-none sm:pointer-events-auto z-10 shadow-[0_20px_45px_rgba(0,0,0,0.35)] border-2 border-white/25': (active + 1) % 3 === 1
        }"
        class="absolute top-1/2 -translate-y-1/2 w-[92%] sm:w-[76%] lg:w-[72%] aspect-[4/4.2] sm:aspect-[1.95/1] rounded-[32px] sm:rounded-full overflow-hidden transition-all duration-700 ease-in-out cursor-pointer"
        @click="active = 1"
      >
        <img
          src="{{ asset('images/carousel-section3-2.jpg') }}"
          alt="Bunge Food Ingredients Research and Development Team in Laboratory"
          class="w-full h-full object-cover"
          loading="eager"
        />
      </div>

      {{-- Slide 2: Bakery & Ingredients Spread --}}
      <div
        :class="{
          'left-1/2 -translate-x-1/2 scale-100 opacity-100 z-30 shadow-[0_30px_70px_rgba(0,0,0,0.6)] border-2 sm:border-3 border-white/40': active === 2,
          '-left-6 sm:-left-10 lg:-left-16 xl:-left-20 translate-x-0 scale-[0.68] opacity-0 sm:opacity-95 pointer-events-none sm:pointer-events-auto z-10 shadow-[0_20px_45px_rgba(0,0,0,0.35)] border-2 border-white/25': (active + 2) % 3 === 2,
          '-right-6 sm:-right-10 lg:-right-16 xl:-right-20 translate-x-0 scale-[0.68] opacity-0 sm:opacity-95 pointer-events-none sm:pointer-events-auto z-10 shadow-[0_20px_45px_rgba(0,0,0,0.35)] border-2 border-white/25': (active + 1) % 3 === 2
        }"
        class="absolute top-1/2 -translate-y-1/2 w-[92%] sm:w-[76%] lg:w-[72%] aspect-[4/4.2] sm:aspect-[1.95/1] rounded-[32px] sm:rounded-full overflow-hidden transition-all duration-700 ease-in-out cursor-pointer"
        @click="active = 2"
      >
        <img
          src="{{ asset('images/carousel-section3-3.jpg') }}"
          alt="Premium Bakery Products, Grains and Dairy Butter Alternatives"
          class="w-full h-full object-cover"
          loading="eager"
        />
      </div>

    </div>

    {{-- COMPONENT 3: STATISTICS CARDS (Enhanced Premium Glassmorphism matching Reference) --}}
    <div
      data-gsap="about-stats"
      x-data="{
        statActive: 0,
        statTimer: null,
        statCount: 4,
        nextStat() {
          this.statActive = (this.statActive + 1) % this.statCount;
        },
        startStatAutoplay() {
          this.stopStatAutoplay();
          this.statTimer = setInterval(() => this.nextStat(), 2600);
        },
        stopStatAutoplay() {
          if (this.statTimer) clearInterval(this.statTimer);
        }
      }"
      x-init="startStatAutoplay()"
      @mouseenter="stopStatAutoplay()"
      @mouseleave="startStatAutoplay()"
      class="max-w-[1320px] mx-auto mb-16 sm:mb-24"
    >
      {{-- DESKTOP GRID LAYOUT (Hidden on mobile < 640px) --}}
      <div class="hidden sm:grid grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Card 01: Global Presence --}}
        <div class="bg-gradient-to-b from-white/20 via-white/12 to-white/5 backdrop-blur-xl border border-white/30 rounded-3xl p-6 sm:p-7 flex flex-col items-center text-center justify-between min-h-[250px] transition-all duration-300 hover:from-white/25 hover:to-white/10 hover:border-white/40 hover:-translate-y-1 shadow-[0_20px_50px_rgba(0,0,0,0.25),inset_0_1px_2px_rgba(255,255,255,0.4)] group">
          <div class="mb-4 group-hover:scale-110 transition-transform">
            <img
              src="{{ asset('images/global.png') }}"
              alt="Global Presence Icon"
              class="w-14 h-14 sm:w-16 sm:h-16 object-contain"
            />
          </div>
          <div>
            <h3 class="text-3xl sm:text-4xl font-extrabold text-white mb-2.5 tracking-tight">
              40+
            </h3>
            <p
              class="text-sm text-slate-200/90 font-medium leading-snug"
              x-text="$store.lang.current === 'ID' ? 'Kehadiran Global di berbagai negara' : 'Global Presence across countries'"
            >
              Global Presence<br />across countries
            </p>
          </div>
        </div>

        {{-- Card 02: Products & Solutions --}}
        <div class="bg-gradient-to-b from-white/20 via-white/12 to-white/5 backdrop-blur-xl border border-white/30 rounded-3xl p-6 sm:p-7 flex flex-col items-center text-center justify-between min-h-[250px] transition-all duration-300 hover:from-white/25 hover:to-white/10 hover:border-white/40 hover:-translate-y-1 shadow-[0_20px_50px_rgba(0,0,0,0.25),inset_0_1px_2px_rgba(255,255,255,0.4)] group">
          <div class="mb-4 group-hover:scale-110 transition-transform">
            <img
              src="{{ asset('images/like.png') }}"
              alt="Products and Solutions Icon"
              class="w-14 h-14 sm:w-16 sm:h-16 object-contain"
            />
          </div>
          <div>
            <h3 class="text-3xl sm:text-4xl font-extrabold text-white mb-2.5 tracking-tight">
              100+
            </h3>
            <p
              class="text-sm text-slate-200/90 font-medium leading-snug"
              x-text="$store.lang.current === 'ID' ? 'Produk dan Solusi bahan olahan pangan' : 'Products and Solutions for food ingredients'"
            >
              Products and Solutions<br />for food ingredients
            </p>
          </div>
        </div>

        {{-- Card 03: Supply Chain Excellence --}}
        <div class="bg-gradient-to-b from-white/20 via-white/12 to-white/5 backdrop-blur-xl border border-white/30 rounded-3xl p-6 sm:p-7 flex flex-col items-center text-center justify-between min-h-[250px] transition-all duration-300 hover:from-white/25 hover:to-white/10 hover:border-white/40 hover:-translate-y-1 shadow-[0_20px_50px_rgba(0,0,0,0.25),inset_0_1px_2px_rgba(255,255,255,0.4)] group">
          <div class="mb-4 group-hover:scale-110 transition-transform">
            <img
              src="{{ asset('images/truck-time.png') }}"
              alt="Supply Chain Icon"
              class="w-14 h-14 sm:w-16 sm:h-16 object-contain"
            />
          </div>
          <div>
            <h3 class="text-3xl sm:text-4xl font-extrabold text-white mb-2.5 tracking-tight">
              Global
            </h3>
            <p
              class="text-sm text-slate-200/90 font-medium leading-snug"
              x-text="$store.lang.current === 'ID' ? 'Keunggulan Rantai Pasok terintegrasi penuh' : 'Supply Chain Excellence fully integrated'"
            >
              Supply Chain Excellence<br />fully integrated
            </p>
          </div>
        </div>

        {{-- Card 04: Sustainability Commitment --}}
        <div class="bg-gradient-to-b from-white/20 via-white/12 to-white/5 backdrop-blur-xl border border-white/30 rounded-3xl p-6 sm:p-7 flex flex-col items-center text-center justify-between min-h-[250px] transition-all duration-300 hover:from-white/25 hover:to-white/10 hover:border-white/40 hover:-translate-y-1 shadow-[0_20px_50px_rgba(0,0,0,0.25),inset_0_1px_2px_rgba(255,255,255,0.4)] group">
          <div class="mb-4 group-hover:scale-110 transition-transform">
            <img
              src="{{ asset('images/blur.png') }}"
              alt="Sustainability Icon"
              class="w-14 h-14 sm:w-16 sm:h-16 object-contain"
            />
          </div>
          <div>
            <h3
              class="text-2xl sm:text-[30px] lg:text-[32px] font-extrabold text-white mb-2.5 tracking-tight"
              x-text="$store.lang.current === 'ID' ? 'Keberlanjutan' : 'Sustainability'"
            >
              Sustainability
            </h3>
            <p
              class="text-sm text-slate-200/90 font-medium leading-snug"
              x-text="$store.lang.current === 'ID' ? 'Komitmen terhadap solusi berkelanjutan' : 'Commitment to sustainable solutions'"
            >
              Commitment to<br />sustainable solutions
            </p>
          </div>
        </div>
      </div>

      {{-- MOBILE CAROUSEL WITH RICH GLASSMORPHISM MATCHING REFERENCE (Visible on mobile < 640px) --}}
      <div class="block sm:hidden w-full px-4">
        <div class="relative w-full max-w-[320px] mx-auto min-h-[320px] flex items-center justify-center">
          
          {{-- Card 01: Global Presence --}}
          <div
            x-show="statActive === 0"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-gradient-to-b from-white/22 via-white/12 to-white/6 backdrop-blur-2xl border border-white/35 rounded-[36px] p-8 flex flex-col items-center text-center justify-center min-h-[320px] shadow-[0_25px_60px_rgba(0,0,0,0.35),inset_0_1.5px_2px_rgba(255,255,255,0.45)]"
          >
            <div class="mb-6">
              <img
                src="{{ asset('images/global.png') }}"
                alt="Global Presence Icon"
                class="w-[84px] h-[84px] object-contain drop-shadow-[0_4px_12px_rgba(0,0,0,0.2)]"
              />
            </div>
            <h3 class="text-4xl font-extrabold text-white mb-3 tracking-tight">
              40+
            </h3>
            <p
              class="text-base text-slate-200/90 font-medium leading-snug"
              x-text="$store.lang.current === 'ID' ? 'Kehadiran Global di berbagai negara' : 'Global Presence across countries'"
            >
              Global Presence<br />across countries
            </p>
          </div>

          {{-- Card 02: Products & Solutions --}}
          <div
            x-show="statActive === 1"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-gradient-to-b from-white/22 via-white/12 to-white/6 backdrop-blur-2xl border border-white/35 rounded-[36px] p-8 flex flex-col items-center text-center justify-center min-h-[320px] shadow-[0_25px_60px_rgba(0,0,0,0.35),inset_0_1.5px_2px_rgba(255,255,255,0.45)]"
          >
            <div class="mb-6">
              <img
                src="{{ asset('images/like.png') }}"
                alt="Products and Solutions Icon"
                class="w-[84px] h-[84px] object-contain drop-shadow-[0_4px_12px_rgba(0,0,0,0.2)]"
              />
            </div>
            <h3 class="text-4xl font-extrabold text-white mb-3 tracking-tight">
              100+
            </h3>
            <p
              class="text-base text-slate-200/90 font-medium leading-snug"
              x-text="$store.lang.current === 'ID' ? 'Produk dan Solusi bahan olahan pangan' : 'Products and Solutions for food ingredients'"
            >
              Products and Solutions<br />for food ingredients
            </p>
          </div>

          {{-- Card 03: Supply Chain Excellence --}}
          <div
            x-show="statActive === 2"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-gradient-to-b from-white/22 via-white/12 to-white/6 backdrop-blur-2xl border border-white/35 rounded-[36px] p-8 flex flex-col items-center text-center justify-center min-h-[320px] shadow-[0_25px_60px_rgba(0,0,0,0.35),inset_0_1.5px_2px_rgba(255,255,255,0.45)]"
          >
            <div class="mb-6">
              <img
                src="{{ asset('images/truck-time.png') }}"
                alt="Supply Chain Icon"
                class="w-[84px] h-[84px] object-contain drop-shadow-[0_4px_12px_rgba(0,0,0,0.2)]"
              />
            </div>
            <h3 class="text-4xl font-extrabold text-white mb-3 tracking-tight">
              Global
            </h3>
            <p
              class="text-base text-slate-200/90 font-medium leading-snug"
              x-text="$store.lang.current === 'ID' ? 'Keunggulan Rantai Pasok terintegrasi penuh' : 'Supply Chain Excellence fully integrated'"
            >
              Supply Chain Excellence<br />fully integrated
            </p>
          </div>

          {{-- Card 04: Sustainability Commitment --}}
          <div
            x-show="statActive === 3"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-gradient-to-b from-white/22 via-white/12 to-white/6 backdrop-blur-2xl border border-white/35 rounded-[36px] p-8 flex flex-col items-center text-center justify-center min-h-[320px] shadow-[0_25px_60px_rgba(0,0,0,0.35),inset_0_1.5px_2px_rgba(255,255,255,0.45)]"
          >
            <div class="mb-6">
              <img
                src="{{ asset('images/blur.png') }}"
                alt="Sustainability Icon"
                class="w-[84px] h-[84px] object-contain drop-shadow-[0_4px_12px_rgba(0,0,0,0.2)]"
              />
            </div>
            <h3
              class="text-3xl font-extrabold text-white mb-3 tracking-tight"
              x-text="$store.lang.current === 'ID' ? 'Keberlanjutan' : 'Sustainability'"
            >
              Sustainability
            </h3>
            <p
              class="text-base text-slate-200/90 font-medium leading-snug"
              x-text="$store.lang.current === 'ID' ? 'Komitmen terhadap solusi berkelanjutan' : 'Commitment to sustainable solutions'"
            >
              Commitment to<br />sustainable solutions
            </p>
          </div>

        </div>

        {{-- BULLET DOTS PAGINATION WITH MINT GREEN INACTIVE DOTS --}}
        <div class="flex items-center justify-center gap-2.5 mt-6">
          <template x-for="(item, index) in [0, 1, 2, 3]" :key="index">
            <button
              type="button"
              @click="statActive = index"
              :class="statActive === index ? 'w-7 bg-white shadow-sm' : 'w-2.5 bg-[#7CC594] hover:bg-[#9BE3B3]'"
              class="h-2.5 rounded-full transition-all duration-300 focus-ring-standard"
              :aria-label="'Go to statistics slide ' + (index + 1)"
            ></button>
          </template>
        </div>
      </div>

    </div>

    {{-- COMPONENT 4: CALL TO ACTION (Significantly Enlarged CTA Button matching Reference) --}}
    <div data-gsap="about-cta" class="text-center max-w-3xl mx-auto">
      <p
        class="text-base sm:text-lg lg:text-xl text-slate-200/90 font-normal leading-relaxed mb-10 max-w-2xl mx-auto"
        x-text="$store.lang.current === 'ID' ? 'Temukan bagaimana keahlian global, solusi terintegrasi, dan komitmen keberlanjutan kami dapat mendukung bisnis Anda.' : 'Discover how our global expertise, integrated solutions, and commitment to sustainability can support your business.'"
      >
        Discover how our global expertise, integrated solutions, and commitment to sustainability can support your business.
      </p>

      <a
        href="https://www.bunge.com"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center justify-center gap-4 bg-white hover:bg-slate-100 active:bg-slate-200 text-[#002D6E] font-extrabold text-base sm:text-xl lg:text-2xl uppercase tracking-wider px-12 sm:px-18 lg:px-22 py-5 sm:py-6 lg:py-6.5 rounded-full transition-all duration-300 shadow-[0_12px_40px_rgba(0,0,0,0.25)] hover:shadow-[0_16px_50px_rgba(0,0,0,0.35)] hover:scale-[1.03] focus-ring-standard active:scale-[0.98]"
      >
        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#002D6E]" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
        </svg>
        <span x-text="$store.lang.current === 'ID' ? 'KUNJUNGI SITUS KAMI' : 'VISIT OUR WEBSITE'">VISIT OUR WEBSITE</span>
      </a>
    </div>

  </div>
</section>
