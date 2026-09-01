{{-- 
  EVENT PREVIEW COMPONENT
  Bunge FlexiBetter Event Microsite — Production Event Video Slider Showcase Component
  Blade Partial: resources/views/partials/event-preview.blade.php
--}}
<section id="event" class="relative w-full bg-white pt-4 sm:pt-10 lg:pt-20 pb-10 sm:pb-14 lg:pb-16 overflow-hidden select-none">
  <div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- TEMPORARILY HIDDEN UNTIL VIDEO IS LIVE --}}
    @if(false)
    {{-- SECTION HEADER --}}
    <div data-gsap="event-preview-header" class="text-center max-w-5xl xl:max-w-6xl mx-auto mb-8 sm:mb-12">
      <h2
        class="text-3xl sm:text-4xl lg:text-[46px] xl:text-[54px] font-black text-[#002D6E] leading-tight tracking-tight mb-4 whitespace-normal lg:whitespace-nowrap"
        x-text="$store.lang.current === 'ID' ? 'Kenali FlexiBetter Lebih Dekat' : 'Discover FlexiBetter Up Close'"
      >
        Discover FlexiBetter Up Close
      </h2>
    </div>

    {{-- SINGLE AUTOPLAY HTML5 VIDEO SHOWCASE (CLICK TO PLAY/PAUSE) --}}
    <div 
      x-data="{ 
        isPlaying: true,
        togglePlay() {
          let v = this.$refs.videoPlayer;
          if (v) {
            if (v.paused) {
              v.play();
              this.isPlaying = true;
            } else {
              v.pause();
              this.isPlaying = false;
            }
          }
        }
      }"
      class="relative w-full max-w-5xl xl:max-w-6xl mx-auto rounded-2xl sm:rounded-3xl overflow-hidden shadow-2xl bg-black group mb-8 cursor-pointer"
      @click="togglePlay()"
    >
      {{-- Video Container (Aspect Ratio Preserved) --}}
      <div class="relative w-full aspect-[16/9] sm:aspect-[21/9] md:aspect-[16/8] overflow-hidden">
        <video 
          x-ref="videoPlayer"
          src="{{ asset('videos/video-sample.mp4') }}" 
          poster="{{ asset('images/poster1.jpg') }}" 
          autoplay 
          loop 
          muted 
          playsinline 
          preload="auto"
          class="w-full h-full object-cover object-center"
          @play="isPlaying = true"
          @pause="isPlaying = false"
        ></video>
        
        <!-- Subtle Play Icon Overlay when Paused -->
        <div 
          x-show="!isPlaying" 
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 scale-90"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-90"
          class="absolute inset-0 bg-black/30 backdrop-blur-xs flex items-center justify-center pointer-events-none z-20"
        >
          <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-22 md:h-22 rounded-full bg-white/30 backdrop-blur-md border-3 sm:border-4 border-white text-white flex items-center justify-center shadow-2xl">
            <svg class="w-8 h-8 sm:w-10 sm:h-10 fill-current ml-1 text-white" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7z"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    {{-- SUBTITLE PARAGRAPH (EXPANDED WIDTH & SMALLER FONT SIZE) --}}
    <div class="text-center max-w-5xl xl:max-w-6xl mx-auto mb-8 sm:mb-10 px-2 sm:px-4">
      <p
        class="text-xs sm:text-sm lg:text-base text-slate-600 font-normal leading-relaxed max-w-4xl xl:max-w-5xl mx-auto"
        x-text="$store.lang.current === 'ID' ? 'Karena bahan yang tepat tidak seharusnya mengorbankan produk yang dicintai pelanggan Anda, bahan tersebut harus mendukung bisnis Anda untuk berkembang. Temukan mengapa Bunge FlexiBetter adalah pilihan yang lebih baik dengan menemui tim kami di FI Asia Indonesia 2026!' : 'Because the right ingredient shouldn\'t compromise the pastries your customers love, it should empower your business to grow. Experience why Bunge FlexiBetter is a better choice by meeting our team at FI Asia Indonesia 2026!'"
      >
        Because the right ingredient shouldn't compromise the pastries your customers love, it should empower your business to grow. Experience why Bunge FlexiBetter is a better choice by meeting our team at FI Asia Indonesia 2026!
      </p>
    </div>
    @endif

    {{-- DESKTOP 4 METRIC / EVENT DETAIL CARDS (4-COLUMN GRID) --}}
    <div data-gsap="event-metric-cards" class="hidden lg:grid lg:grid-cols-4 gap-6 max-w-5xl xl:max-w-6xl mx-auto">
      
      {{-- Card 1: Date --}}
      <div class="bg-white p-5 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 flex items-center gap-4 transition-transform duration-300 hover:scale-[1.02]">
        <div class="w-12 h-12 rounded-full bg-[#5AA546] flex items-center justify-center shrink-0">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
          </svg>
        </div>
        <div>
          <h4 class="text-base font-extrabold text-[#002D6E] leading-tight mb-0.5" x-text="$store.lang.current === 'ID' ? 'Tanggal' : 'Date'">
            Date
          </h4>
          <p class="text-xs font-normal text-slate-500 leading-snug">
            16–18 September 2026
          </p>
          <p class="text-xs font-normal text-slate-500 leading-snug" x-text="$store.lang.current === 'ID' ? 'Rabu - Jumat' : 'Wednesday - Friday'">
            Wednesday - Friday
          </p>
        </div>
      </div>

      {{-- Card 2: Operating Hours --}}
      <div class="bg-white p-5 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 flex items-center gap-4 transition-transform duration-300 hover:scale-[1.02]">
        <div class="w-12 h-12 rounded-full bg-[#5AA546] flex items-center justify-center shrink-0">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
            <polyline points="12 7 12 12 15 15" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div>
          <h4 class="text-base font-extrabold text-[#002D6E] leading-tight mb-0.5" x-text="$store.lang.current === 'ID' ? 'Jam Operasional' : 'Operating Hours'">
            Operating Hours
          </h4>
          <p class="text-xs font-normal text-slate-500 leading-snug">
            10:00 AM - 06:00 PM
          </p>
          <p class="text-xs font-normal text-slate-500 leading-snug">
            (GMT+7)
          </p>
        </div>
      </div>

      {{-- Card 3: Location --}}
      <div class="bg-white p-5 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 flex items-center gap-4 transition-transform duration-300 hover:scale-[1.02]">
        <div class="w-12 h-12 rounded-full bg-[#5AA546] flex items-center justify-center shrink-0">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
          </svg>
        </div>
        <div>
          <h4 class="text-base font-extrabold text-[#002D6E] leading-tight mb-0.5" x-text="$store.lang.current === 'ID' ? 'Lokasi' : 'Location'">
            Location
          </h4>
          <p class="text-xs font-normal text-slate-500 leading-snug">
            Jakarta International Expo (JIExpo)
          </p>
          <p class="text-xs font-normal text-slate-500 leading-snug">
            Kemayoran, Jakarta
          </p>
        </div>
      </div>

      {{-- Card 4: Consultation Duration --}}
      <div class="bg-white p-5 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 flex items-center gap-4 transition-transform duration-300 hover:scale-[1.02]">
        <div class="w-12 h-12 rounded-full bg-[#5AA546] flex items-center justify-center shrink-0">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
            <polyline points="12 7 12 12 15 15" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div>
          <h4 class="text-base font-extrabold text-[#002D6E] leading-tight mb-0.5" x-text="$store.lang.current === 'ID' ? 'Durasi Konsultasi' : 'Consultation Duration'">
            Consultation Duration
          </h4>
          <p class="text-xs font-normal text-slate-500 leading-snug" x-text="$store.lang.current === 'ID' ? '30 Menit per Sesi' : '30 Minutes'">
            30 Minutes
          </p>
          <p class="text-xs font-normal text-slate-500 leading-snug" x-show="$store.lang.current !== 'ID'">
            Per Session
          </p>
        </div>
      </div>

    </div>

    {{-- MOBILE 4-CARD CAROUSEL SLIDER --}}
    <div 
      data-gsap="event-metric-cards"
      x-data="{ 
        activeSlide: 0, 
        timer: null,
        total: 4 
      }"
      x-init="timer = setInterval(() => activeSlide = (activeSlide + 1) % total, 3000)"
      @mouseenter="clearInterval(timer)"
      @mouseleave="timer = setInterval(() => activeSlide = (activeSlide + 1) % total, 3000)"
      class="block lg:hidden w-full max-w-md mx-auto"
    >
      <div class="bg-[#5AA546] p-5 rounded-2xl shadow-[0_8px_30px_rgba(90,165,70,0.25)] border border-[#5AA546] relative overflow-hidden min-h-[96px] flex items-center">
        <!-- Slide 1: Date -->
        <div 
          x-show="activeSlide === 0" 
          x-transition:enter="transition ease-out duration-300 transform"
          x-transition:enter-start="opacity-0 translate-x-4"
          x-transition:enter-end="opacity-100 translate-x-0"
          x-transition:leave="transition ease-in duration-200 transform absolute inset-0 p-5 flex items-center justify-between"
          x-transition:leave-start="opacity-100 translate-x-0"
          x-transition:leave-end="opacity-0 -translate-x-4"
          class="w-full flex items-center gap-4"
        >
          <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm">
            <svg class="w-6 h-6 text-[#5AA546]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
          </div>
          <div>
            <h4 class="text-base font-extrabold text-white leading-tight mb-0.5" x-text="$store.lang.current === 'ID' ? 'Tanggal' : 'Date'">
              Date
            </h4>
            <p class="text-xs font-medium text-white/90 leading-snug">
              16–18 September 2026
            </p>
            <p class="text-xs font-medium text-white/90 leading-snug" x-text="$store.lang.current === 'ID' ? 'Rabu - Jumat' : 'Wednesday - Friday'">
              Wednesday - Friday
            </p>
          </div>
        </div>

        <!-- Slide 2: Operating Hours -->
        <div 
          x-show="activeSlide === 1" 
          x-transition:enter="transition ease-out duration-300 transform"
          x-transition:enter-start="opacity-0 translate-x-4"
          x-transition:enter-end="opacity-100 translate-x-0"
          x-transition:leave="transition ease-in duration-200 transform absolute inset-0 p-5 flex items-center justify-between"
          x-transition:leave-start="opacity-100 translate-x-0"
          x-transition:leave-end="opacity-0 -translate-x-4"
          class="w-full flex items-center gap-4"
        >
          <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm">
            <svg class="w-6 h-6 text-[#5AA546]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
              <polyline points="12 7 12 12 15 15" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h4 class="text-base font-extrabold text-white leading-tight mb-0.5" x-text="$store.lang.current === 'ID' ? 'Jam Operasional' : 'Operating Hours'">
              Operating Hours
            </h4>
            <p class="text-xs font-medium text-white/90 leading-snug">
              10:00 AM - 06:00 PM
            </p>
            <p class="text-xs font-medium text-white/90 leading-snug">
              (GMT+7)
            </p>
          </div>
        </div>

        <!-- Slide 3: Location -->
        <div 
          x-show="activeSlide === 2" 
          x-transition:enter="transition ease-out duration-300 transform"
          x-transition:enter-start="opacity-0 translate-x-4"
          x-transition:enter-end="opacity-100 translate-x-0"
          x-transition:leave="transition ease-in duration-200 transform absolute inset-0 p-5 flex items-center justify-between"
          x-transition:leave-start="opacity-100 translate-x-0"
          x-transition:leave-end="opacity-0 -translate-x-4"
          class="w-full flex items-center gap-4"
        >
          <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm">
            <svg class="w-6 h-6 text-[#5AA546]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
            </svg>
          </div>
          <div>
            <h4 class="text-base font-extrabold text-white leading-tight mb-0.5" x-text="$store.lang.current === 'ID' ? 'Lokasi' : 'Location'">
              Location
            </h4>
            <p class="text-xs font-medium text-white/90 leading-snug">
              Jakarta International Expo (JIExpo)
            </p>
            <p class="text-xs font-medium text-white/90 leading-snug">
              Kemayoran, Jakarta
            </p>
          </div>
        </div>

        <!-- Slide 4: Duration -->
        <div 
          x-show="activeSlide === 3" 
          x-transition:enter="transition ease-out duration-300 transform"
          x-transition:enter-start="opacity-0 translate-x-4"
          x-transition:enter-end="opacity-100 translate-x-0"
          x-transition:leave="transition ease-in duration-200 transform absolute inset-0 p-5 flex items-center justify-between"
          x-transition:leave-start="opacity-100 translate-x-0"
          x-transition:leave-end="opacity-0 -translate-x-4"
          class="w-full flex items-center gap-4"
        >
          <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm">
            <svg class="w-6 h-6 text-[#5AA546]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
              <polyline points="12 7 12 12 15 15" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div>
            <h4 class="text-base font-extrabold text-white leading-tight mb-0.5" x-text="$store.lang.current === 'ID' ? 'Durasi Konsultasi' : 'Consultation Duration'">
              Consultation Duration
            </h4>
            <p class="text-xs font-medium text-white/90 leading-snug" x-text="$store.lang.current === 'ID' ? '30 Menit per Sesi' : '30 Minutes'">
              30 Minutes
            </p>
            <p class="text-xs font-medium text-white/90 leading-snug" x-show="$store.lang.current !== 'ID'">
              Per Session
            </p>
          </div>
        </div>
      </div>

      <!-- 4 Indicator Dots Positioned on Left -->
      <div class="flex items-center gap-2 mt-3 pl-1">
        <template x-for="i in total" :key="i">
          <button 
            @click="activeSlide = i - 1" 
            class="focus:outline-none transition-all duration-300 cursor-pointer"
            :class="activeSlide === (i - 1) ? 'w-5 h-2 bg-[#5AA546] rounded-full' : 'w-2 h-2 bg-[#9BC83C] rounded-full hover:opacity-80'"
            :aria-label="'Slide ' + i"
          ></button>
        </template>
      </div>
    </div>

  </div>
</section>
