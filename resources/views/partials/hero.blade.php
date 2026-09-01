{{--
  Bunge FlexiBetter Event Microsite — Production Hero Component
  Food Ingredients Asia (FIA) Indonesia 2026
  Blade Partial: resources/views/partials/hero.blade.php
--}}

<section
  id="hero"
  class="relative w-full bg-white overflow-hidden flex flex-col justify-between h-auto lg:h-screen lg:min-h-screen lg:max-h-screen"
  aria-label="Hero Banner"
>
  <style>
    @media (min-width: 1024px) {
      .hero-content-box {
        margin-top: -7rem !important;
      }
      .hero-left-box {
        margin-top: -2rem !important;
      }
    }
    @media (min-width: 1024px) and (max-width: 1279px) {
      .hero-left-title {
        font-size: 26px !important;
        line-height: 1.12 !important;
      }
      .hero-left-desc {
        font-size: 12px !important;
        line-height: 1.4 !important;
        margin-bottom: 0.85rem !important;
      }
      .hero-title-heading {
        font-size: 30px !important;
        line-height: 1.1 !important;
        margin-bottom: 0.75rem !important;
      }
      .hero-desc-para {
        font-size: 12px !important;
        line-height: 1.4 !important;
        margin-bottom: 0.85rem !important;
      }
    }
    @media (min-width: 1280px) and (max-width: 1440px) {
      .hero-content-box {
        margin-top: -8.5rem !important;
      }
      .hero-logo-pair {
        margin-top: 2rem !important;
        margin-bottom: -1rem !important;
      }
      .hero-left-box {
        margin-top: -2.5rem !important;
      }
      .hero-left-title {
        font-size: 24px !important;
        line-height: 1.15 !important;
        margin-bottom: 0.75rem !important;
      }
      .hero-left-desc {
        font-size: 12px !important;
        line-height: 1.4 !important;
        margin-bottom: 1rem !important;
        max-width: 350px !important;
      }
      .hero-tagline-text {
        font-size: 10.5px !important;
        margin-bottom: 0.5rem !important;
      }
      .hero-title-line1 {
        font-size: 28px !important;
        line-height: 1.1 !important;
      }
      .hero-title-line2 {
        font-size: 46px !important;
        line-height: 1.05 !important;
      }
      .hero-desc-para {
        font-size: 12px !important;
        line-height: 1.4 !important;
        margin-bottom: 1rem !important;
        max-width: 350px !important;
      }
      .hero-meta-title {
        font-size: 24px !important;
      }
      .hero-cta-box-desktop {
        padding: 0.45rem 0.75rem 0.45rem 0.85rem !important;
        max-width: 330px !important;
        border-radius: 0.75rem !important;
      }
      .hero-cta-text-desktop {
        font-size: 10px !important;
      }
      .hero-cta-btn-desktop {
        padding: 0.35rem 0.75rem !important;
        font-size: 10px !important;
        border-radius: 0.5rem !important;
      }
    }
    @media (min-width: 1441px) and (max-width: 1536px) {
      .hero-content-box {
        margin-top: -9.5rem !important;
      }
      .hero-left-box {
        margin-top: -3rem !important;
      }
      .hero-left-title {
        font-size: 32px !important;
        line-height: 1.1 !important;
      }
      .hero-left-desc {
        font-size: 13px !important;
        line-height: 1.45 !important;
        margin-bottom: 1.25rem !important;
      }
      .hero-title-heading {
        font-size: 38px !important;
        line-height: 1.08 !important;
        margin-bottom: 1rem !important;
      }
      .hero-desc-para {
        font-size: 13px !important;
        line-height: 1.45 !important;
        margin-bottom: 1.25rem !important;
      }
    }
    @media (min-width: 1537px) {
      .hero-content-box {
        margin-top: -11.5rem !important;
      }
      .hero-left-box {
        margin-top: -3.5rem !important;
      }
    }

    /* Clean initial state for Hero elements to prevent FOUC / pop glitch on page load */
    .hero-left-box > *,
    .hero-content-box > *,
    .hero-mobile-box > *,
    .hero-indo-logo {
      opacity: 0;
      transform: translateY(25px);
      will-change: opacity, transform;
    }
  </style>

  {{-- DESKTOP HERO BACKGROUND IMAGE LAYER (1 Viewport Screen Height, Bottom Center Aligned) --}}
  <div
    data-gsap="hero-bg"
    class="hidden lg:block relative w-full lg:h-screen z-0 pointer-events-none"
  >
    <img
      src="{{ asset('images/heronew-5.jpg') }}"
      alt="Bunge FI Asia Indonesia 2026 Exhibition Booth and FlexiBetter Innovations"
      class="w-full h-full block object-cover object-bottom"
      loading="eager"
      fetchpriority="high"
    />
    {{-- Right Side Indo5 Logo Badge on Desktop Hero Image --}}
    <div class="absolute bottom-8 right-8 xl:right-16 z-20 pointer-events-auto">
      <img 
        src="{{ asset('images/indo5.png') }}" 
        alt="Indonesia Event Partner Logo" 
        class="h-21 lg:h-26 xl:h-32 w-auto object-contain drop-shadow-lg"
      />
    </div>
  </div>

  {{-- MOBILE HERO TOP IMAGE --}}
  <div class="block lg:hidden relative w-full overflow-hidden z-0">
    <div
      data-gsap="hero-mobile-bg"
      class="relative w-full h-[326px] sm:h-[408px] overflow-hidden"
    >
      <img
        src="{{ asset('images/heronew-5.jpg') }}"
        alt="Bunge FI Asia Indonesia 2026 Exhibition Booth and FlexiBetter Innovations"
        class="w-full h-full block object-cover object-bottom scale-100 origin-bottom"
        loading="eager"
      />
      {{-- Bottom Right Indo5 Logo Badge on Mobile Blue Hero Image --}}
      <div class="absolute bottom-3 right-4 z-20 pointer-events-none">
        <img 
          src="{{ asset('images/indo5.png') }}" 
          alt="Indonesia Event Partner Logo" 
          class="h-16 sm:h-20 w-auto object-contain drop-shadow-md"
        />
      </div>
    </div>
  </div>

  {{-- DESKTOP LAYOUT (Left Side Event Info & Right Side Feature Text + 5-Slide Carousel) --}}
  <div class="hidden lg:flex absolute inset-0 z-40 w-full flex-col justify-center pt-14 lg:pt-20 xl:pt-24 pointer-events-none">
    <div class="w-full px-5 sm:px-8 lg:px-12 xl:px-16 my-auto flex justify-between items-start pointer-events-auto z-40">
      
      {{-- LEFT COLUMN: EVENT INFORMATION & LOCATION --}}
      <div class="w-full lg:w-[44%] xl:w-[40%] hero-content-box">
        {{-- FlexiBetter & FIA2 Logos Side-by-Side (Paling Atas - Center Aligned, Gap 2) --}}
        <div data-gsap="hero-tagline" class="mb-2 lg:mb-3 flex items-center gap-2 hero-logo-pair">
          <img 
            src="{{ asset('images/logoflexi.png') }}" 
            alt="Bunge FlexiBetter Logo" 
            class="h-8 sm:h-9 lg:h-11 xl:h-12 w-auto object-contain"
          />
          <img 
            src="{{ asset('images/fia5.png') }}" 
            alt="FI Asia Logo" 
            class="h-[105px] sm:h-[120px] lg:h-[145px] xl:h-[165px] w-auto object-contain drop-shadow-lg"
          />
        </div>

        {{-- Short Thin Green Horizontal Divider Line --}}
        <div class="w-32 sm:w-40 lg:w-48 h-[1.5px] bg-[#5AA546]/50 -mt-2 lg:-mt-4 mb-3 lg:mb-4"></div>

        {{-- Headline --}}
        <h1
          data-gsap="hero-title"
          class="font-black text-[#002D6E] leading-[1.02] tracking-tight mb-3 lg:mb-4 hero-title-heading"
        >
          <template x-if="$store.lang.current === 'ID'">
            <div>
              <span class="block text-2xl lg:text-3xl xl:text-[40px] font-bold text-[#002D6E] hero-title-line1">Pilihan yang</span>
              <span class="block text-5xl lg:text-6xl xl:text-[76px] font-black text-[#002D6E] mt-1 hero-title-line2">Lebih Baik</span>
            </div>
          </template>
          <template x-if="$store.lang.current !== 'ID'">
            <div>
              <span class="block text-2xl lg:text-3xl xl:text-[40px] font-bold text-[#002D6E] hero-title-line1">What a</span>
              <span class="block text-5xl lg:text-6xl xl:text-[76px] font-black text-[#002D6E] mt-1 hero-title-line2">Better Choice</span>
            </div>
          </template>
        </h1>

        {{-- Description --}}
        <p
          data-gsap="hero-desc"
          class="text-xs lg:text-sm text-slate-600 font-normal leading-relaxed mb-3 lg:mb-4 max-w-md hero-desc-para"
          x-text="$store.lang.current === 'ID' ? 'Memperkenalkan FlexiBetter: alternatif mentega inovatif yang dirancang untuk industri makanan modern. Temui tim Bunge di FI Asia Indonesia 2026!' : 'Introducing FlexiBetter: the innovative dairy butter alternative built for the modern food industry. Catch the Bunge team at our FI Asia Indonesia 2026 booth!'"
        >
          Introducing FlexiBetter: the innovative dairy butter alternative built for the modern food industry. Catch the Bunge team at our FI Asia Indonesia 2026 booth!
        </p>

        {{-- Tagline Text (Di atas Location) --}}
        <div class="mb-2 lg:mb-3 hero-tagline-text">
          <span class="inline-block text-[9px] sm:text-[10px] lg:text-[11px] font-bold text-[#002D6E] tracking-wider uppercase whitespace-nowrap">
            FI ASIA INDONESIA 2026 · JAKARTA · 16–18 SEPTEMBER
          </span>
        </div>

        {{-- Location & Booth Metadata (Neumorphism Soft UI Card) --}}
        <div data-gsap="hero-meta" class="mt-2 mb-1 inline-flex items-center gap-7 lg:gap-9 bg-[#f2f6fa]/95 backdrop-blur-md p-3.5 px-6 rounded-2xl border border-white/90 shadow-[6px_6px_16px_rgba(0,45,110,0.11),-6px_-6px_16px_rgba(255,255,255,0.95)] pointer-events-auto">
          <div>
            <span class="block text-xs lg:text-sm font-extrabold text-[#5AA546] uppercase tracking-widest mb-0.5 [text-shadow:_1px_1px_2px_rgba(255,255,255,0.9),_-1px_-1px_1px_rgba(0,0,0,0.12)]" x-text="$store.lang.current === 'ID' ? 'LOKASI' : 'LOCATION'">
              LOCATION
            </span>
            <span class="block text-2xl lg:text-3xl xl:text-[32px] font-extrabold text-[#002D6E] [text-shadow:_2px_2px_4px_rgba(0,45,110,0.25),_-1px_-1px_2px_rgba(255,255,255,0.8)] hero-meta-title">
              JIExpo, Hall D2
            </span>
          </div>

          <div class="h-12 w-[2px] bg-gradient-to-b from-slate-200 via-slate-300 to-slate-200 rounded-full shadow-[inset_1px_1px_2px_rgba(0,0,0,0.1)]"></div>

          <div>
            <span class="block text-xs lg:text-sm font-extrabold text-[#5AA546] uppercase tracking-widest mb-0.5 [text-shadow:_1px_1px_2px_rgba(255,255,255,0.9),_-1px_-1px_1px_rgba(0,0,0,0.12)]" x-text="$store.lang.current === 'ID' ? 'STAN' : 'BOOTH'">
              BOOTH
            </span>
            <span class="block text-2xl lg:text-3xl xl:text-[32px] font-extrabold text-[#002D6E] [text-shadow:_2px_2px_4px_rgba(0,45,110,0.25),_-1px_-1px_2px_rgba(255,255,255,0.8)] hero-meta-title">
              D2A48
            </span>
          </div>
        </div>

        {{-- Limited Slots Info & Book a Session CTA Box (Green BG Version - Slightly Compact) --}}
        <div class="mt-3.5 lg:mt-4 flex items-center justify-between gap-3 bg-[#5AA546] p-2.5 pl-3.5 pr-4 rounded-xl border border-[#5AA546] shadow-md shadow-[#5AA546]/20 max-w-[390px] pointer-events-auto hero-cta-box-desktop">
          <span class="text-[11px] lg:text-xs font-extrabold text-white tracking-tight shrink-0 hero-cta-text-desktop" x-text="$store.lang.current === 'ID' ? 'Slot Konsultasi Terbatas' : 'Consultation Slot are Limited'">
            Consultation Slot are Limited
          </span>
          <a 
            href="#consultation" 
            onclick="document.getElementById('consultation')?.scrollIntoView({behavior: 'smooth'})"
            class="inline-flex items-center justify-center gap-1.5 px-4 lg:px-5 py-1.5 lg:py-2 rounded-lg lg:rounded-xl bg-[#002D6E] hover:bg-[#001E4B] text-white font-extrabold text-[11px] lg:text-xs shadow-sm shadow-[#002D6E]/30 transition duration-200 shrink-0 group cursor-pointer hero-cta-btn-desktop"
          >
            <span x-text="$store.lang.current === 'ID' ? 'pesan sesi' : 'book a session'">book a session</span>
            <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
            </svg>
          </a>
        </div>
      </div>

      {{-- RIGHT COLUMN: FEATURE TEXT & 5-SLIDE CAROUSEL CARD --}}
      <div class="w-full lg:w-[40%] xl:w-[37%] ml-auto hero-left-box">
        <h2 class="text-3xl lg:text-4xl xl:text-[42px] font-black text-[#002D6E] leading-[1.08] tracking-tight mb-4 hero-left-title">
          <template x-if="$store.lang.current === 'ID'">
            <span>Tekstur yang sama,<br />Olahan yang sama,<br />Cita Rasa Buttery yang Sama</span>
          </template>
          <template x-if="$store.lang.current !== 'ID'">
            <span>Same Texture,<br />Same Handling,<br />Same Buttery Taste</span>
          </template>
        </h2>

        <p class="text-xs lg:text-sm text-slate-600 font-normal leading-relaxed max-w-md hero-left-desc" style="margin-bottom: 2.1rem !important;">
          <template x-if="$store.lang.current === 'ID'">
            <span>Di balik setiap pastri yang luar biasa ada keputusan yang lebih cerdas: temukan bagaimana FlexiBetter memungkinkan Anda mengganti atau mencampur mentega susu tanpa mengorbankan kualitas gigitan, lapisan, atau sensorik.</span>
          </template>
          <template x-if="$store.lang.current !== 'ID'">
            <span>Behind every exceptional pastry is a smarter decision: discover how FlexiBetter lets you replace or blend dairy butter seamlessly without compromising on bite, layer, or sensory quality.</span>
          </template>
        </p>

        {{-- 5-SLIDE GLASSMORPHISM CAROUSEL CARD COMPONENT --}}
        <div 
          x-data="{ 
            activeSlide: 0, 
            timer: null,
            slides: [
              { 
                enTitle: 'Cost Efficiency', idTitle: 'Efisiensi Biaya',
                enSub: 'Reduce cost by up to 40%', idSub: 'Mengurangi biaya produksi hingga 40%',
                icon: '{{ asset('images/money.png') }}' 
              },
              { 
                enTitle: 'Same Texture', idTitle: 'Tekstur yang Sama',
                enSub: 'Familiar texture that delivers similar bite and layered structure as dairy butter.', idSub: 'Tekstur familier yang memberikan gigitan memuaskan dan struktur berlapis yang sama dengan mentega susu.',
                icon: '{{ asset('images/cake.png') }}' 
              },
              { 
                enTitle: 'Same Handling', idTitle: 'Penanganan yang Sama',
                enSub: 'Works seamlessly in your existing recipes and production process, just like dairy butter.', idSub: 'Dapat dengan mudah diaplikasikan dalam resep dan proses produksi Anda yang sudah ada, seperti mentega susu.',
                icon: '{{ asset('images/box-benefit.png') }}' 
              },
              { 
                enTitle: 'Same Buttery Taste', idTitle: 'Rasa Mentega yang Sama',
                enSub: 'Keeps the rich, buttery taste and sensory experience your customers know and love.', idSub: 'Mempertahankan rasa mentega yang kaya dan pengalaman sensorik yang dikenal dan disukai pelanggan Anda.',
                icon: '{{ asset('images/heart2.png') }}' 
              },
              { 
                enTitle: 'Seamless Switch', idTitle: 'Transisi Mulus',
                enSub: 'Replace or blend with dairy butter without compromising the final product experience.', idSub: 'Ganti atau campur dengan mentega susu tanpa mengorbankan kualitas produk anda',
                icon: '{{ asset('images/magic-star-benefit.png') }}' 
              }
            ]
          }"
          x-init="timer = setInterval(() => activeSlide = (activeSlide + 1) % slides.length, 3000)"
          @mouseenter="clearInterval(timer)"
          @mouseleave="timer = setInterval(() => activeSlide = (activeSlide + 1) % slides.length, 3000)"
          class="w-full max-w-sm sm:max-w-md lg:max-w-[370px] xl:max-w-[390px]"
        >
          <!-- Glassmorphism Floating Card Container (Compact Height & Premium Glass Effect) -->
          <div class="bg-white/40 backdrop-blur-lg rounded-2xl lg:rounded-3xl py-2.5 px-4 sm:py-3 sm:px-4.5 border border-white/70 shadow-[0_8px_32px_0_rgba(0,45,110,0.08)] relative overflow-hidden h-[82px] sm:h-[86px] flex items-center justify-between">
            <template x-for="(slide, index) in slides" :key="index">
              <div 
                x-show="activeSlide === index" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-x-4"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200 transform absolute inset-0 py-2.5 px-4 sm:py-3 sm:px-4.5 flex items-center justify-between"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 -translate-x-4"
                class="w-full h-full flex items-center justify-between gap-3"
              >
                <div class="pr-1 flex-1 flex flex-col justify-center">
                  <h3 class="text-base sm:text-lg font-extrabold text-[#002D6E] mb-0.5" x-text="$store.lang.current === 'ID' ? slide.idTitle : slide.enTitle"></h3>
                  <p class="text-xs text-slate-600 leading-snug font-medium line-clamp-2" x-text="$store.lang.current === 'ID' ? slide.idSub : slide.enSub"></p>
                </div>
                <!-- Icon without background -->
                <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center">
                  <img :src="slide.icon" :alt="slide.enTitle" class="w-full h-full object-contain" />
                </div>
              </div>
            </template>
          </div>

          <!-- 5 Indicator Dots & Left/Right Nav Arrows Below Card -->
          <div class="flex items-center justify-between mt-3 px-1">
            <!-- Left Nav Arrows -->
            <div class="flex items-center gap-1.5">
              <button 
                @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
                class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-[#5AA546] hover:bg-[#9BC83C] text-white flex items-center justify-center shadow-xs transition-all cursor-pointer"
                aria-label="Previous Slide"
              >
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                </svg>
              </button>
              <button 
                @click="activeSlide = (activeSlide + 1) % slides.length"
                class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-[#5AA546] hover:bg-[#9BC83C] text-white flex items-center justify-center shadow-xs transition-all cursor-pointer"
                aria-label="Next Slide"
              >
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
              </button>
            </div>

            <!-- Right Dots -->
            <div class="flex items-center gap-1.5">
              <template x-for="(slide, index) in slides" :key="index">
                <button 
                  @click="activeSlide = index" 
                  class="focus:outline-none transition-all duration-300 cursor-pointer"
                  :class="activeSlide === index ? 'w-5 h-2 bg-[#5AA546] rounded-full' : 'w-2 h-2 bg-[#9BC83C] rounded-full hover:opacity-80'"
                  :aria-label="'Slide ' + (index + 1)"
                ></button>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>    {{-- MOBILE LAYOUT CONTENT AREA (Positioned cleanly below top hero image) --}}
    <div class="block lg:hidden relative z-20 px-6 sm:px-10 pt-6 sm:pt-8 pb-4 sm:pb-6 w-full flex-1 bg-white hero-mobile-box">
      
      {{-- 1. TEKSTUR YANG SAMA PART (NOW ON TOP FOR MOBILE) --}}
      {{-- Mobile Left Feature Heading (Formatted to 3 Lines Break After Comma) --}}
      <h2 class="text-2xl sm:text-3xl font-extrabold text-[#002D6E] leading-snug mb-4">
        <template x-if="$store.lang.current === 'ID'">
          <span>Tekstur yang sama,<br />Olahan yang sama,<br />Cita Rasa Buttery yang Sama</span>
        </template>
        <template x-if="$store.lang.current !== 'ID'">
          <span>Same Texture,<br />Same Handling,<br />Same Buttery Taste</span>
        </template>
      </h2>

      <p class="text-xs sm:text-sm text-slate-600 font-normal leading-relaxed mb-8">
        <template x-if="$store.lang.current === 'ID'">
          <span>Di balik setiap pastri yang luar biasa ada keputusan yang lebih cerdas: temukan bagaimana FlexiBetter memungkinkan Anda mengganti atau mencampur mentega susu tanpa mengorbankan kualitas gigitan, lapisan, atau sensorik.</span>
        </template>
        <template x-if="$store.lang.current !== 'ID'">
          <span>Behind every exceptional pastry is a smarter decision: discover how FlexiBetter lets you replace or blend dairy butter seamlessly without compromising on bite, layer, or sensory quality.</span>
        </template>
      </p>

      {{-- Mobile 5-Slide Carousel Card --}}
      <div 
        x-data="{ 
          activeSlide: 0, 
          timer: null,
          slides: [
            { 
              enTitle: 'Cost Efficiency', idTitle: 'Efisiensi Biaya',
              enSub: 'Reduce cost by up to 40%', idSub: 'Mengurangi biaya produksi hingga 40%',
              icon: '{{ asset('images/money-white.png') }}' 
            },
            { 
              enTitle: 'Same Texture', idTitle: 'Tekstur yang Sama',
              enSub: 'Familiar texture that delivers similar bite and layered structure as dairy butter.', idSub: 'Tekstur familier yang memberikan gigitan memuaskan dan struktur berlapis yang sama dengan mentega susu.',
              icon: '{{ asset('images/cake-white.png') }}' 
            },
            { 
              enTitle: 'Same Handling', idTitle: 'Penanganan yang Sama',
              enSub: 'Works seamlessly in your existing recipes and production process, just like dairy butter.', idSub: 'Dapat dengan mudah diaplikasikan dalam resep dan proses produksi Anda yang sudah ada, seperti mentega susu.',
              icon: '{{ asset('images/box.png') }}' 
            },
            { 
              enTitle: 'Same Buttery Taste', idTitle: 'Rasa Mentega yang Sama',
              enSub: 'Keeps the rich, buttery taste and sensory experience your customers know and love.', idSub: 'Mempertahankan rasa mentega yang kaya dan pengalaman sensorik yang dikenal dan disukai pelanggan Anda.',
              icon: '{{ asset('images/heart.png') }}' 
            },
            { 
              enTitle: 'Seamless Switch', idTitle: 'Transisi Mulus',
              enSub: 'Replace or blend with dairy butter without compromising the final product experience.', idSub: 'Ganti atau campur dengan mentega susu tanpa mengorbankan kualitas produk anda',
              icon: '{{ asset('images/magic-star-white.png') }}' 
            }
          ]
        }"
        x-init="timer = setInterval(() => activeSlide = (activeSlide + 1) % slides.length, 3000)"
        class="w-full mb-6"
      >
        <div class="bg-[#002D6E] rounded-2xl p-4 border border-[#002D6E] shadow-[0_8px_30px_rgba(0,45,110,0.25)] relative overflow-hidden h-[120px] flex items-center justify-between">
          <template x-for="(slide, index) in slides" :key="index">
            <div 
              x-show="activeSlide === index" 
              x-transition:enter="transition ease-out duration-300 transform"
              x-transition:enter-start="opacity-0 translate-x-4"
              x-transition:enter-end="opacity-100 translate-x-0"
              class="w-full h-full flex items-center justify-between gap-3"
            >
              <div class="pr-1 flex-1 flex flex-col justify-center">
                <h3 class="text-base font-bold text-white mb-0.5" x-text="$store.lang.current === 'ID' ? slide.idTitle : slide.enTitle"></h3>
                <p class="text-xs text-white/90 leading-tight line-clamp-2" x-text="$store.lang.current === 'ID' ? slide.idSub : slide.enSub"></p>
              </div>
              <div class="flex-shrink-0 w-11 h-11 flex items-center justify-center bg-white/15 backdrop-blur-sm rounded-xl p-2 shadow-xs border border-white/20">
                <img :src="slide.icon" :alt="slide.enTitle" class="w-full h-full object-contain" />
              </div>
            </div>
          </template>
        </div>

        <!-- 5 Indicator Dots (Color Matched with Desktop: #5AA546 Active, #9BC83C Inactive) -->
        <div class="flex items-center gap-2 mt-4 mb-6 pl-1">
          <template x-for="(slide, index) in slides" :key="index">
            <button 
              @click="activeSlide = index" 
              class="focus:outline-none transition-all duration-300 cursor-pointer"
              :class="activeSlide === index ? 'w-5 h-2 bg-[#5AA546] rounded-full' : 'w-2 h-2 bg-[#9BC83C] rounded-full hover:opacity-80'"
              :aria-label="'Slide ' + (index + 1)"
            ></button>
          </template>
        </div>
      </div>

      <hr class="border-slate-200/80 mt-10 mb-8 sm:mt-12 sm:mb-10" />

      {{-- 2. FI ASIA INDONESIA & WHAT A BETTER CHOICE PART (EXACT USER GRADIENT WRAPPER FOR ENTIRE BLOCK) --}}
      <div 
        class="-mx-6 sm:-mx-10 px-6 sm:px-10 py-6 my-2"
        style="background: #ffffff; background: linear-gradient(180deg, rgba(255, 255, 255, 1) 0%, rgba(236, 225, 219, 1) 27%, rgba(236, 225, 219, 1) 74%, rgba(255, 255, 255, 1) 100%);"
      >
        {{-- Tagline & FlexiBetter + FIA5 Logos --}}
        <div data-gsap="hero-tagline-mobile" class="mt-1 mb-4">
          <div class="flex items-center gap-2 sm:gap-3 mb-2">
            <img 
              src="{{ asset('images/logoflexi.png') }}" 
              alt="Bunge FlexiBetter Logo" 
              class="h-8 sm:h-10 w-auto object-contain shrink-0"
            />
            <img 
              src="{{ asset('images/fia5.png') }}" 
              alt="FI Asia Logo" 
              class="h-[88px] sm:h-[105px] w-auto object-contain shrink-0 drop-shadow-md"
            />
          </div>
        </div>

        {{-- Short Thin Green Horizontal Divider Line (Matching Desktop) --}}
        <div class="w-32 sm:w-40 h-[1.5px] bg-[#5AA546]/50 my-4"></div>

        {{-- Headline --}}
        <h1
          data-gsap="hero-title-mobile"
          class="font-black text-[#002D6E] leading-[1.08] tracking-tight mb-4"
        >
          <template x-if="$store.lang.current === 'ID'">
            <div>
              <span class="block text-xl sm:text-2xl font-bold text-[#002D6E]">Pilihan yang</span>
              <span class="block text-4xl sm:text-[44px] font-black text-[#002D6E] mt-0.5">Lebih Baik</span>
            </div>
          </template>
          <template x-if="$store.lang.current !== 'ID'">
            <div>
              <span class="block text-xl sm:text-2xl font-bold text-[#002D6E]">What a</span>
              <span class="block text-4xl sm:text-[44px] font-black text-[#002D6E] mt-0.5">Better Choice</span>
            </div>
          </template>
        </h1>

        {{-- Description --}}
        <p
          data-gsap="hero-desc-mobile"
          class="text-xs sm:text-sm text-slate-600 font-normal leading-relaxed mb-5"
          x-text="$store.lang.current === 'ID' ? 'Memperkenalkan FlexiBetter: alternatif mentega inovatif yang dirancang untuk industri makanan modern. Temui tim Bunge di FI Asia Indonesia 2026!' : 'Introducing FlexiBetter: the innovative dairy butter alternative built for the modern food industry. Catch the Bunge team at our FI Asia Indonesia 2026 booth!'"
        >
          Introducing FlexiBetter: the innovative dairy butter alternative built for the modern food industry. Catch the Bunge team at our FI Asia Indonesia 2026 booth!
        </p>

        {{-- Tagline Text (Positioned directly above Location & Booth Metadata) --}}
        <span class="inline-block text-[11px] sm:text-xs font-bold text-[#002D6E] tracking-wider uppercase mb-2">
          FI ASIA INDONESIA 2026 · JAKARTA · 16–18 SEPTEMBER
        </span>

        {{-- Location & Booth Metadata (Mobile Neumorphism Soft UI Card) --}}
        <div 
          data-gsap="hero-meta-mobile" 
          class="inline-flex items-center justify-start gap-6 sm:gap-8 bg-[#f2f6fa]/95 backdrop-blur-md p-3.5 px-5 rounded-2xl border border-white/90 shadow-[5px_5px_14px_rgba(0,45,110,0.11),-5px_-5px_14px_rgba(255,255,255,0.95)] mb-1 w-full sm:w-auto overflow-hidden"
        >
          <div>
            <span class="block text-xs sm:text-sm font-extrabold text-[#5AA546] uppercase tracking-widest mb-0.5 [text-shadow:_1px_1px_2px_rgba(255,255,255,0.9),_-1px_-1px_1px_rgba(0,0,0,0.12)]" x-text="$store.lang.current === 'ID' ? 'LOKASI' : 'LOCATION'">
              LOCATION
            </span>
            <span class="block text-xl sm:text-2xl font-extrabold text-[#002D6E] [text-shadow:_2px_2px_4px_rgba(0,45,110,0.25),_-1px_-1px_2px_rgba(255,255,255,0.8)]">
              JIExpo, Hall D2
            </span>
          </div>

          <!-- Vertical Divider -->
          <div class="h-9 w-[2px] bg-gradient-to-b from-slate-200 via-slate-300 to-slate-200 rounded-full shadow-[inset_1px_1px_2px_rgba(0,0,0,0.1)]"></div>

          <div>
            <span class="block text-xs sm:text-sm font-extrabold text-[#5AA546] uppercase tracking-widest mb-0.5 [text-shadow:_1px_1px_2px_rgba(255,255,255,0.9),_-1px_-1px_1px_rgba(0,0,0,0.12)]" x-text="$store.lang.current === 'ID' ? 'STAN' : 'BOOTH'">
              BOOTH
            </span>
            <span class="block text-xl sm:text-2xl font-extrabold text-[#002D6E] [text-shadow:_2px_2px_4px_rgba(0,45,110,0.25),_-1px_-1px_2px_rgba(255,255,255,0.8)]">
              D2A48
            </span>
          </div>
        </div>
      </div>

      {{-- Limited Slots Info & Book a Session CTA Box (Mobile Snug Fit Centered Pill) --}}
      <div data-gsap="hero-cta-mobile" class="mt-4 flex items-center justify-center gap-2.5 bg-[#5AA546] p-1.5 pl-3.5 pr-1.5 rounded-full border border-[#5AA546] shadow-md shadow-[#5AA546]/20 w-fit mx-auto overflow-hidden">
        <span class="text-[10px] sm:text-[10.5px] font-extrabold text-white tracking-tight shrink-0 whitespace-nowrap" x-text="$store.lang.current === 'ID' ? 'Slot Konsultasi Terbatas' : 'Consultation Slot are Limited'">
          Consultation Slot are Limited
        </span>
        <a 
          href="#consultation" 
          onclick="document.getElementById('consultation')?.scrollIntoView({behavior: 'smooth'})"
          class="inline-flex items-center justify-center gap-1 px-2.5 py-1.5 sm:px-3 sm:py-1.5 rounded-full bg-[#002D6E] hover:bg-[#001E4B] active:scale-95 text-white font-extrabold text-[10px] sm:text-[10.5px] shadow-sm shadow-[#002D6E]/30 transition duration-200 shrink-0 group cursor-pointer"
        >
          <span x-text="$store.lang.current === 'ID' ? 'pesan sesi' : 'book a session'">book a session</span>
          <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
          </svg>
        </a>
      </div>
    </div>

</section>
