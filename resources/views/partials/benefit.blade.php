{{--
  Bunge FlexiBetter Event Microsite — Production Product Benefit Component
  Food Ingredients Asia (FIA) Indonesia 2026
  Blade Partial: resources/views/partials/benefit.blade.php
--}}

<section
  id="benefit"
  class="hidden !important relative w-full bg-white text-slate-900 pt-16 sm:pt-24 pb-12 lg:pb-8 overflow-x-clip overflow-y-visible z-20"
  aria-label="FlexiBetter Product Benefit Section"
>

  {{-- STANDALONE ORNAMENT 0 (HIDDEN ON MOBILE, FLOATING DESKTOP ONLY) --}}
  <div class="hidden lg:block absolute -top-16 sm:-top-24 lg:-top-28 xl:-top-32 left-[2%] sm:left-[5%] w-48 sm:w-64 lg:w-72 xl:w-80 pointer-events-none z-30 animate-yoyo-1">
    <img src="{{ asset('images/ornament-0.png') }}" alt="Pastry Ornament 0" class="w-full h-auto object-contain drop-shadow-lg" />
  </div>

  {{-- ANIMATION STYLES FOR FLOATING YOYO ORNAMENTS & SCREEN RESOLUTION ADAPTATION --}}
  <style>
    @keyframes yoyoFloat1 {
      0% { transform: translateY(0px) rotate(0deg); }
      100% { transform: translateY(-16px) rotate(4deg); }
    }
    @keyframes yoyoFloat2 {
      0% { transform: translateY(0px) rotate(0deg); }
      100% { transform: translateY(18px) rotate(-5deg); }
    }
    @keyframes yoyoFloat3 {
      0% { transform: translateY(0px) scale(1); }
      100% { transform: translateY(-14px) scale(1.04); }
    }
    @keyframes yoyoFloat4 {
      0% { transform: translateY(0px) rotate(0deg); }
      100% { transform: translateY(-18px) rotate(-3deg); }
    }
    .animate-yoyo-1 {
      animation: yoyoFloat1 3.8s ease-in-out infinite alternate;
    }
    .animate-yoyo-2 {
      animation: yoyoFloat2 4.4s ease-in-out infinite alternate;
    }
    .animate-yoyo-3 {
      animation: yoyoFloat3 4.1s ease-in-out infinite alternate;
    }
    .animate-yoyo-4 {
      animation: yoyoFloat4 3.5s ease-in-out infinite alternate;
    }

    /* SPECIFIC RESPONSIVE OVERRIDES FOR LG AND 1280-1440 RESOLUTIONS */
    @media (min-width: 1024px) and (max-width: 1366px) {
      .benefit-col-left, .benefit-col-right {
        grid-column: span 3 / span 3 !important;
      }
      .benefit-col-center {
        grid-column: span 6 / span 6 !important;
      }
      .benefit-showcase-img {
        max-width: 78% !important;
        margin-left: auto;
        margin-right: auto;
      }
      .ornament-1-box {
        width: 145px !important;
      }
      .ornament-3-box {
        width: 155px !important;
        bottom: -6.5rem !important;
        left: 25.5% !important;
        z-index: 25 !important;
      }
      .ornament-4-box {
        width: 120px !important;
        bottom: -4rem !important;
        right: 0 !important;
      }
      .point-left-1 {
        transform: translateX(34%) !important;
      }
      .point-left-2 {
        transform: translateX(26%) !important;
      }
      .point-right-3 {
        transform: translateX(-34%) !important;
      }
      .point-right-4 {
        transform: translateX(-26%) !important;
      }
    }

    /* SPECIFIC RESPONSIVE OVERRIDES FOR 1440 RESOLUTION */
    @media (min-width: 1367px) and (max-width: 1536px) {
      .benefit-col-left, .benefit-col-right {
        grid-column: span 3 / span 3 !important;
      }
      .benefit-col-center {
        grid-column: span 6 / span 6 !important;
      }
      .benefit-showcase-img {
        max-width: 80% !important;
        margin-left: auto;
        margin-right: auto;
      }
      .ornament-1-box {
        width: 182px !important;
      }
      .ornament-3-box {
        width: 175px !important;
        bottom: -7rem !important;
        left: 26.5% !important;
        z-index: 25 !important;
      }
      .ornament-4-box {
        width: 135px !important;
        bottom: -4rem !important;
        right: 0 !important;
      }
      .point-left-1 {
        transform: translateX(36%) !important;
      }
      .point-left-2 {
        transform: translateX(28%) !important;
      }
      .point-right-3 {
        transform: translateX(-36%) !important;
      }
      .point-right-4 {
        transform: translateX(-28%) !important;
      }
    }

    /* ORNAMENT 4 ALWAYS STRICTLY FLUSH TO RIGHT EDGE WITH 0 GAP */
    .ornament-4-box {
      right: 0 !important;
      margin-right: 0 !important;
    }
  </style>

  <div class="w-full px-0">
    
    {{-- SECTION HEADER --}}
    <div class="relative text-center max-w-4xl mx-auto mb-12 sm:mb-16 px-4 sm:px-6">
      
      {{-- ORNAMENT 2 (XL: -RIGHT-12 / LG: -RIGHT-8 / SM: -RIGHT-4) --}}
      <div class="hidden lg:block absolute top-4 sm:top-6 lg:top-8 xl:top-[4.5rem] -right-4 sm:-right-4 lg:-right-8 xl:-right-12 w-28 sm:w-36 lg:w-44 xl:w-64 pointer-events-none z-20 animate-yoyo-3">
        <img src="{{ asset('images/ornament-2.png') }}" alt="Pastry Ornament 2" class="w-full h-auto object-contain drop-shadow-md" />
      </div>

      <h2
        data-gsap="benefit-title"
        class="text-4xl sm:text-5xl lg:text-[54px] font-black text-[#002D6E] leading-[1.12] tracking-tight mb-4"
        x-text="$store.lang.current === 'ID' ? 'Tekstur Sama, Penanganan Sama, Rasa Mentega Sama' : 'Same Texture, Same Handling, Same Buttery Taste'"
      >
        Same Texture, Same Handling, Same Buttery Taste
      </h2>

      <p
        data-gsap="benefit-desc"
        class="text-base sm:text-lg text-slate-600 font-normal leading-relaxed max-w-3xl mx-auto"
        x-text="$store.lang.current === 'ID' ? 'Di balik setiap kue dan pastry yang istimewa terdapat pilihan yang lebih cerdas: temukan bagaimana FlexiBetter memungkinkan Anda mengganti atau mencampur mentega tanpa mengorbankan tekstur, lapisan, atau kualitas rasa.' : 'Behind every exceptional pastry is a smarter decision: discover how FlexiBetter lets you replace or blend dairy butter seamlessly without compromising on bite, layer, or sensory quality.'"
      >
        Behind every exceptional pastry is a smarter decision: discover how FlexiBetter lets you replace or blend dairy butter seamlessly without compromising on bite, layer, or sensory quality.
      </p>
    </div>

    {{-- MAIN PRODUCT SHOWCASE (FULL WIDTH NO MAX-W, NO PADDING-X) --}}
    <div class="relative w-full px-0 mb-16 sm:mb-24">
      
      {{-- FLOATING YOYO ANIMATED ORNAMENTS (HIDDEN ON MOBILE, DESKTOP ONLY) --}}
      {{-- Left Center: ornament-1 --}}
      <div class="hidden lg:block absolute top-[24%] left-0 w-24 sm:w-32 lg:w-36 xl:w-44 pointer-events-none z-10 animate-yoyo-2 ornament-1-box">
        <img src="{{ asset('images/ornament-1.png') }}" alt="Pastry Ornament 1" class="w-full h-auto object-contain drop-shadow-md" />
      </div>

      {{-- Left Bottom: ornament-3 --}}
      <div class="hidden lg:block absolute -bottom-20 left-[2%] sm:left-[5%] w-32 sm:w-44 lg:w-48 xl:w-56 pointer-events-none z-10 animate-yoyo-4 ornament-3-box">
        <img src="{{ asset('images/ornament-3.png') }}" alt="Pastry Ornament 3" class="w-full h-auto object-contain drop-shadow-md" />
      </div>

      {{-- Right Bottom: ornament-4 --}}
      <div class="hidden lg:block absolute -bottom-12 sm:-bottom-16 lg:-bottom-20 right-0 w-24 sm:w-28 lg:w-32 xl:w-36 pointer-events-none z-10 animate-yoyo-1 ornament-4-box">
        <img src="{{ asset('images/ornament-4.png') }}" alt="Pastry Ornament 4" class="w-full h-auto object-contain drop-shadow-md" />
      </div>

      {{-- DESKTOP SHOWCASE (3 COLUMNS: POINT 1 & 2 LEFT, BENEFTI-ITEM CENTER, POINT 3 & 4 RIGHT) --}}
      <div class="hidden lg:grid grid-cols-12 items-center gap-4 xl:gap-6 relative z-20 py-4 benefit-showcase-grid">
        
        {{-- LEFT COLUMN: POINT 1 & POINT 2 --}}
        <div class="col-span-3 flex flex-col justify-between gap-16 xl:gap-20 text-right benefit-col-left">
          
          {{-- Point 1: Same Texture --}}
          <div class="flex items-start gap-2.5 justify-end point-left-1 z-30">
            <div class="flex flex-col items-end text-right">
              <h3 class="text-lg xl:text-xl font-black text-[#002D6E] leading-tight mb-1" x-text="$store.lang.current === 'ID' ? 'Tekstur Sama' : 'Same Texture'">
                Same Texture
              </h3>
              <p class="text-xs xl:text-sm text-slate-600 leading-relaxed max-w-[280px] lg:max-w-[320px] xl:max-w-[360px] text-right" x-text="$store.lang.current === 'ID' ? 'Tekstur yang familiar memberikan gigitan dan struktur berlapis yang sama memuaskannya dengan mentega susu.' : 'Familiar texture that delivers similar bite and layered structure as dairy butter.'">
                Familiar texture that delivers similar bite and layered structure as dairy butter.
              </p>
            </div>
            <img src="{{ asset('images/cake.png') }}" alt="Cake Icon" class="w-6 h-6 object-contain shrink-0 mt-0.5" />
          </div>

          {{-- Point 2: Same Buttery Taste --}}
          <div class="flex items-start gap-2.5 justify-end point-left-2 z-30">
            <div class="flex flex-col items-end text-right">
              <h3 class="text-lg xl:text-xl font-black text-[#002D6E] leading-tight mb-1" x-text="$store.lang.current === 'ID' ? 'Rasa Mentega Sama' : 'Same Buttery Taste'">
                Same Buttery Taste
              </h3>
              <p class="text-xs xl:text-sm text-slate-600 leading-relaxed max-w-[280px] lg:max-w-[320px] xl:max-w-[360px] text-right" x-text="$store.lang.current === 'ID' ? 'Menjaga rasa mentega yang kaya serta pengalaman sensori yang disukai pelanggan Anda.' : 'Keeps the rich, buttery taste and sensory experience your customers know and love.'">
                Keeps the rich, buttery taste and sensory experience your customers know and love.
              </p>
            </div>
            <img src="{{ asset('images/heart2.png') }}" alt="Heart Icon" class="w-6 h-6 object-contain shrink-0 mt-0.5" />
          </div>

        </div>

        {{-- CENTER COLUMN: BIG SHOWCASE IMAGE --}}
        <div class="col-span-6 flex items-center justify-center relative benefit-col-center">
          <img
            src="{{ asset('images/benefti-item.png') }}"
            alt="Bunge FlexiBetter Product Benefit Showcase"
            class="w-full h-auto object-contain select-none drop-shadow-xl benefit-showcase-img"
            loading="eager"
          />
        </div>

        {{-- RIGHT COLUMN: POINT 3 & POINT 4 --}}
        <div class="col-span-3 flex flex-col justify-between gap-16 xl:gap-20 text-left benefit-col-right">
          
          {{-- Point 3: Same Handling --}}
          <div class="flex items-start gap-2.5 justify-start point-right-3 z-30">
            <img src="{{ asset('images/box-benefit.png') }}" alt="Box Icon" class="w-6 h-6 object-contain shrink-0 mt-0.5" />
            <div class="flex flex-col items-start text-left">
              <h3 class="text-lg xl:text-xl font-black text-[#002D6E] leading-tight mb-1" x-text="$store.lang.current === 'ID' ? 'Penanganan Sama' : 'Same Handling'">
                Same Handling
              </h3>
              <p class="text-xs xl:text-sm text-slate-600 leading-relaxed max-w-[280px] lg:max-w-[320px] xl:max-w-[360px] text-left" x-text="$store.lang.current === 'ID' ? 'Bekerja dengan lancar dalam resep dan proses produksi yang ada, persis seperti mentega susu.' : 'Works seamlessly in your existing recipes and production process, just like dairy butter.'">
                Works seamlessly in your existing recipes and production process, just like dairy butter.
              </p>
            </div>
          </div>

          {{-- Point 4: Seamless Switch --}}
          <div class="flex items-start gap-2.5 justify-start point-right-4 z-30">
            <img src="{{ asset('images/magic-star-benefit.png') }}" alt="Star Icon" class="w-6 h-6 object-contain shrink-0 mt-0.5" />
            <div class="flex flex-col items-start text-left">
              <h3 class="text-lg xl:text-xl font-black text-[#002D6E] leading-tight mb-1" x-text="$store.lang.current === 'ID' ? 'Penggantian Mudah' : 'Seamless Switch'">
                Seamless Switch
              </h3>
              <p class="text-xs xl:text-sm text-slate-600 leading-relaxed max-w-[280px] lg:max-w-[320px] xl:max-w-[360px] text-left" x-text="$store.lang.current === 'ID' ? 'Ganti atau campur dengan mentega susu tanpa mengorbankan pengalaman produk akhir.' : 'Replace or blend with dairy butter without compromising the final product experience.'" >
                Replace or blend with dairy butter without compromising the final product experience.
              </p>
            </div>
          </div>

        </div>

      </div>

      {{-- MOBILE / TABLET SHOWCASE (CENTER IMAGE + SWIPEABLE CAROUSEL FOR 4 POINTS) --}}
      <div 
        x-data="{
          activeSlide: 0,
          totalSlides: 4,
          touchStartX: 0,
          touchEndX: 0,
          handleTouchStart(e) { this.touchStartX = e.changedTouches[0].screenX; },
          handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            if (this.touchStartX - this.touchEndX > 40) {
              this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
            } else if (this.touchEndX - this.touchStartX > 40) {
              this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
            }
          }
        }"
        class="block lg:hidden relative z-20 w-full"
      >
        {{-- CENTER IMAGE FOR MOBILE --}}
        <div class="w-full flex justify-center mb-6 px-4">
          <img
            src="{{ asset('images/benefti-item.png') }}"
            alt="Bunge FlexiBetter Product Benefit Showcase"
            class="w-full max-w-[672px] h-auto object-contain select-none drop-shadow-lg"
            loading="eager"
          />
        </div>

        {{-- MOBILE SWIPEABLE CAROUSEL FOR THE 4 POINTS --}}
        <div 
          @touchstart="handleTouchStart($event)"
          @touchend="handleTouchEnd($event)"
          class="relative w-full max-w-md mx-auto px-4"
        >
          {{-- CAROUSEL SLIDES WRAPPER --}}
          <div class="overflow-hidden relative w-full rounded-2xl min-h-[120px]">
            <div 
              class="flex transition-transform duration-300 ease-out"
              :style="`transform: translateX(-${activeSlide * 100}%)`"
            >
              
              {{-- Slide 1: Same Texture --}}
              <div class="w-full shrink-0 flex items-start gap-4 p-2 justify-start">
                <img src="{{ asset('images/cake.png') }}" alt="Cake Icon" class="w-10 h-10 object-contain shrink-0 mt-0.5" />
                <div class="flex flex-col text-left">
                  <h3 class="text-xl font-black text-[#002D6E] mb-1" x-text="$store.lang.current === 'ID' ? 'Tekstur Sama' : 'Same Texture'">
                    Same Texture
                  </h3>
                  <p class="text-sm text-slate-600 leading-relaxed max-w-[280px]" x-text="$store.lang.current === 'ID' ? 'Tekstur yang familiar memberikan gigitan dan struktur berlapis yang sama memuaskannya dengan mentega susu.' : 'Familiar texture that delivers similar bite and layered structure as dairy butter.'">
                    Familiar texture that delivers similar bite and layered structure as dairy butter.
                  </p>
                </div>
              </div>

              {{-- Slide 2: Same Buttery Taste --}}
              <div class="w-full shrink-0 flex items-start gap-4 p-2 justify-start">
                <img src="{{ asset('images/heart2.png') }}" alt="Heart Icon" class="w-10 h-10 object-contain shrink-0 mt-0.5" />
                <div class="flex flex-col text-left">
                  <h3 class="text-xl font-black text-[#002D6E] mb-1" x-text="$store.lang.current === 'ID' ? 'Rasa Mentega Sama' : 'Same Buttery Taste'">
                    Same Buttery Taste
                  </h3>
                  <p class="text-sm text-slate-600 leading-relaxed max-w-[280px]" x-text="$store.lang.current === 'ID' ? 'Menjaga rasa mentega yang kaya serta pengalaman sensori yang disukai pelanggan Anda.' : 'Keeps the rich, buttery taste and sensory experience your customers know and love.'">
                    Keeps the rich, buttery taste and sensory experience your customers know and love.
                  </p>
                </div>
              </div>

              {{-- Slide 3: Same Handling --}}
              <div class="w-full shrink-0 flex items-start gap-4 p-2 justify-start">
                <img src="{{ asset('images/box-benefit.png') }}" alt="Box Icon" class="w-10 h-10 object-contain shrink-0 mt-0.5" />
                <div class="flex flex-col text-left">
                  <h3 class="text-xl font-black text-[#002D6E] mb-1" x-text="$store.lang.current === 'ID' ? 'Penanganan Sama' : 'Same Handling'">
                    Same Handling
                  </h3>
                  <p class="text-sm text-slate-600 leading-relaxed max-w-[280px]" x-text="$store.lang.current === 'ID' ? 'Bekerja dengan lancar dalam resep dan proses produksi yang ada, persis seperti mentega susu.' : 'Works seamlessly in your existing recipes and production process, just like dairy butter.'">
                    Works seamlessly in your existing recipes and production process, just like dairy butter.
                  </p>
                </div>
              </div>

              {{-- Slide 4: Seamless Switch --}}
              <div class="w-full shrink-0 flex items-start gap-4 p-2 justify-start">
                <img src="{{ asset('images/magic-star-benefit.png') }}" alt="Star Icon" class="w-10 h-10 object-contain shrink-0 mt-0.5" />
                <div class="flex flex-col text-left">
                  <h3 class="text-xl font-black text-[#002D6E] mb-1" x-text="$store.lang.current === 'ID' ? 'Penggantian Mudah' : 'Seamless Switch'">
                    Seamless Switch
                  </h3>
                  <p class="text-sm text-slate-600 leading-relaxed max-w-[280px]" x-text="$store.lang.current === 'ID' ? 'Ganti atau campur dengan mentega susu tanpa mengorbankan pengalaman produk akhir.' : 'Replace or blend with dairy butter without compromising the final product experience.'">
                    Replace or blend with dairy butter without compromising the final product experience.
                  </p>
                </div>
              </div>

            </div>
          </div>

          {{-- CAROUSEL PAGINATION DOTS / PILL INDICATORS --}}
          <div class="flex items-center justify-center gap-2 mt-4">
            <template x-for="(slide, index) in totalSlides" :key="index">
              <button
                @click="activeSlide = index"
                type="button"
                :class="activeSlide === index ? 'w-8 bg-[#002D6E]' : 'w-2.5 bg-[#002D6E]/30 hover:bg-[#002D6E]/50'"
                class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"
                :aria-label="`Go to slide ${index + 1}`"
              ></button>
            </template>
          </div>

        </div>
      </div>

    </div>

  </div>

  {{-- REMAINING COMPONENTS INSIDE CONTAINER --}}
  <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- COMPONENT 02: HORIZONTAL SLIDE FADEOUT VIDEO CAROUSEL WITH BOTTOM BULLET NAV (NO PEEK) --}}
    <div
      data-gsap="benefit-video-card"
      x-data="{
        active: 0,
        isPlaying: false,
        touchStartX: 0,
        touchEndX: 0,
        videos: [
          {
            title: 'MADE WITH SMARTER DECISION',
            thumb: '{{ asset('images/carousel-section3-2.jpg') }}',
            youtubeId: 'LXb3EKWsInQ'
          },
          {
            title: 'INNOVATION IN EVERY BITE',
            thumb: '{{ asset('images/carousel-section3-1.jpg') }}',
            youtubeId: '9No-FiEInLA'
          }
        ],
        playVideo() {
          this.isPlaying = true;
        },
        stopVideo() {
          this.isPlaying = false;
        },
        setActive(index) {
          this.active = index;
          this.isPlaying = false;
        },
        handleTouchStart(e) {
          this.touchStartX = e.changedTouches[0].screenX;
        },
        handleTouchEnd(e) {
          this.touchEndX = e.changedTouches[0].screenX;
          if (this.touchStartX - this.touchEndX > 40) {
            this.active = (this.active + 1) % this.videos.length;
            this.isPlaying = false;
          } else if (this.touchEndX - this.touchStartX > 40) {
            this.active = (this.active - 1 + this.videos.length) % this.videos.length;
            this.isPlaying = false;
          }
        }
      }"
      class="relative max-w-4xl mx-auto pt-12 sm:pt-16 mb-12 sm:mb-16 px-4 sm:px-0"
    >
      
      {{-- ORNAMENT 5 (PASTRY ORNAMENT AT TOP RIGHT CORNER OF VIDEO CARD) --}}
      <div class="absolute top-4 sm:top-2 lg:-top-6 xl:-top-10 -right-2 sm:-right-6 lg:-right-24 xl:-right-32 w-24 sm:w-36 lg:w-64 xl:w-84 pointer-events-none z-40 animate-yoyo-2 drop-shadow-2xl">
        <img src="{{ asset('images/ornament-5.png') }}" alt="Pastry Ornament 5" class="w-full h-auto object-contain drop-shadow-2xl" />
      </div>

      {{-- MAIN VIDEO CAROUSEL CONTAINER (FULL WIDTH ROUNDED CARD NO PEEK) --}}
      <div 
        @touchstart="handleTouchStart($event)"
        @touchend="handleTouchEnd($event)"
        class="relative w-full aspect-[16/9] rounded-3xl sm:rounded-[32px] overflow-hidden shadow-2xl bg-slate-900 border border-slate-100"
      >
        
        {{-- SLIDES SLIDE / FADE WRAPPER --}}
        <template x-for="(vid, idx) in videos" :key="idx">
          <div
            x-show="active === idx"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="opacity-0 translate-x-12 scale-98"
            x-transition:enter-end="opacity-100 translate-x-0 scale-100"
            x-transition:leave="transition ease-in duration-300 transform absolute inset-0"
            x-transition:leave-start="opacity-100 translate-x-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-x-12 scale-98"
            class="absolute inset-0 w-full h-full"
          >
            {{-- THUMBNAIL IMAGE --}}
            <img
              :src="vid.thumb"
              :alt="vid.title"
              class="w-full h-full object-cover select-none"
            />

            {{-- OVERLAY TEXT & PLAY BUTTON --}}
            <div
              x-show="!isPlaying"
              @click="playVideo()"
              class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/20 flex flex-col items-center justify-center text-center p-6 cursor-pointer group"
            >
              {{-- BOLD OVERLAY TITLE --}}
              <h3 
                class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-wider uppercase drop-shadow-lg mb-4 sm:mb-6 max-w-2xl px-4"
                x-text="vid.title"
              >
                MADE WITH SMARTER DECISION
              </h3>

              {{-- PLAY BUTTON WITH SMOOTH HOVER RING --}}
              <button
                type="button"
                @click.stop="playVideo()"
                class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 rounded-full border-4 border-white bg-white/20 hover:bg-white/35 backdrop-blur-xs flex items-center justify-center text-white transition-all duration-300 shadow-2xl group-hover:scale-110 active:scale-95 cursor-pointer"
                aria-label="Play video showcase"
              >
                <svg class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 fill-white translate-x-0.5 sm:translate-x-1 drop-shadow-md" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z"/>
                </svg>
              </button>
            </div>

            {{-- YOUTUBE EMBED IFRAME PLAYER --}}
            <div
              x-show="isPlaying"
              x-transition:enter="transition ease-out duration-300 opacity-0"
              x-transition:enter-end="opacity-100"
              class="absolute inset-0 z-30 bg-black"
            >
              <template x-if="isPlaying && active === idx">
                <iframe
                  class="w-full h-full border-0"
                  :src="'https://www.youtube.com/embed/' + vid.youtubeId + '?autoplay=1&rel=0'"
                  title="YouTube video player"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  allowfullscreen
                ></iframe>
              </template>
              
              {{-- CLOSE BUTTON --}}
              <button
                type="button"
                @click.stop="stopVideo()"
                class="absolute top-4 right-4 z-40 w-10 h-10 rounded-full bg-black/70 hover:bg-black text-white flex items-center justify-center border border-white/40 shadow-lg transition-transform hover:scale-110"
                aria-label="Close video player"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>

          </div>
        </template>

      </div>

      {{-- BULLET NAVIGATION (BOTTOM CENTER HORIZONTAL PILL/DOT INDICATORS FOR DESKTOP & MOBILE) --}}
      <div class="flex items-center justify-center gap-2.5 mt-6 z-30">
        <template x-for="(vid, idx) in videos" :key="idx">
          <button
            type="button"
            @click="setActive(idx)"
            :class="active === idx ? 'w-8 bg-[#002D6E]' : 'w-2.5 bg-[#002D6E]/30 hover:bg-[#002D6E]/50'"
            class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"
            :aria-label="'Go to video slide ' + (idx + 1)"
          ></button>
        </template>
      </div>

    </div>    {{-- COMPONENT 03: PRODUCT APPLICATIONS ("CAN BE APPLIED IN:") --}}
    <div data-gsap="benefit-applications" class="hidden max-w-6xl mx-auto mb-16 sm:mb-24 text-center">
      <h3 class="text-2xl sm:text-4xl lg:text-[42px] font-black text-[#002D6E] tracking-tight uppercase mb-8 sm:mb-14" x-text="$store.lang.current === 'ID' ? 'DAPAT DIAPLIKASIKAN PADA:' : 'CAN BE APPLIED IN:'">
        CAN BE APPLIED IN:
      </h3>

      {{-- DESKTOP ROW (5 Equal Circle Cards) --}}
      <div class="hidden sm:flex items-center justify-center gap-6 lg:gap-10">
        {{-- Application 1: Bakery --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-28 h-28 sm:w-36 sm:h-36 lg:w-40 lg:h-40 rounded-full shadow-md overflow-hidden mb-4 transition-transform duration-300 group-hover:scale-105">
            <img src="{{ asset('images/bakery.png') }}" alt="Bakery Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-base sm:text-lg lg:text-xl font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors" x-text="$store.lang.current === 'ID' ? 'Roti' : 'Bakery'">
            Bakery
          </span>
        </div>

        {{-- Application 2: Pastry --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-28 h-28 sm:w-36 sm:h-36 lg:w-40 lg:h-40 rounded-full shadow-md overflow-hidden mb-4 transition-transform duration-300 group-hover:scale-105">
            <img src="{{ asset('images/pastry.png') }}" alt="Pastry Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-base sm:text-lg lg:text-xl font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors">
            Pastry
          </span>
        </div>

        {{-- Application 3: Cookies & Biscuits --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-28 h-28 sm:w-36 sm:h-36 lg:w-40 lg:h-40 rounded-full shadow-md overflow-hidden mb-4 transition-transform duration-300 group-hover:scale-105">
            <img src="{{ asset('images/cookies.png') }}" alt="Cookies & Biscuits Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-base sm:text-lg lg:text-xl font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors" x-text="$store.lang.current === 'ID' ? 'Kukis & Biskuit' : 'Cookies & Biscuits'">
            Cookies & Biscuits
          </span>
        </div>

        {{-- Application 4: Confectionery --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-28 h-28 sm:w-36 sm:h-36 lg:w-40 lg:h-40 rounded-full shadow-md overflow-hidden mb-4 transition-transform duration-300 group-hover:scale-105">
            <img src="{{ asset('images/confectionery.png') }}" alt="Confectionery Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-base sm:text-lg lg:text-xl font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors" x-text="$store.lang.current === 'ID' ? 'Penganan Manis' : 'Confectionery'">
            Confectionery
          </span>
        </div>

        {{-- Application 5: Dairy --}}
        <div class="flex flex-col items-center text-center group cursor-pointer">
          <div class="w-28 h-28 sm:w-36 sm:h-36 lg:w-40 lg:h-40 rounded-full shadow-md overflow-hidden mb-4 transition-transform duration-300 group-hover:scale-105">
            <img src="{{ asset('images/daily.png') }}" alt="Dairy Application" class="w-full h-full object-cover" />
          </div>
          <span class="text-base sm:text-lg lg:text-xl font-bold text-[#002D6E] group-hover:text-[#0055D4] transition-colors" x-text="$store.lang.current === 'ID' ? 'Olahan Susu' : 'Dairy'">
            Dairy
          </span>
        </div>
      </div>

      {{-- MOBILE INFINITE CONTINUOUS MARQUEE LOOP WITH CLEAN CONTAINER BOUNDS --}}
      <style>
        @keyframes marqueeLoop {
          0% { transform: translateX(0); }
          100% { transform: translateX(-50%); }
        }
        .animate-marquee-loop {
          display: flex;
          width: max-content;
          animation: marqueeLoop 20s linear infinite;
        }
        .animate-marquee-loop:hover {
          animation-play-state: paused;
        }
      </style>
      
      <div class="block sm:hidden relative w-full overflow-hidden py-3">
        <div class="animate-marquee-loop gap-6">
          {{-- ORIGINAL 5 ITEMS --}}
          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/bakery.png') }}" alt="Bakery Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]" x-text="$store.lang.current === 'ID' ? 'Roti' : 'Bakery'">Bakery</span>
          </div>

          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/pastry.png') }}" alt="Pastry Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]">Pastry</span>
          </div>

          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/cookies.png') }}" alt="Cookies & Biscuits Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]" x-text="$store.lang.current === 'ID' ? 'Kukis' : 'Cookies & Biscuits'">Cookies & Biscuits</span>
          </div>

          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/confectionery.png') }}" alt="Confectionery Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]" x-text="$store.lang.current === 'ID' ? 'Penganan Manis' : 'Confectionery'">Confectionery</span>
          </div>

          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/daily.png') }}" alt="Dairy Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]" x-text="$store.lang.current === 'ID' ? 'Susu' : 'Dairy'">Dairy</span>
          </div>

          {{-- DUPLICATED 5 ITEMS FOR SEAMLESS 360 CONTINUOUS LOOP --}}
          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/bakery.png') }}" alt="Bakery Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]" x-text="$store.lang.current === 'ID' ? 'Roti' : 'Bakery'">Bakery</span>
          </div>

          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/pastry.png') }}" alt="Pastry Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]">Pastry</span>
          </div>

          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/cookies.png') }}" alt="Cookies & Biscuits Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]" x-text="$store.lang.current === 'ID' ? 'Kukis' : 'Cookies & Biscuits'">Cookies & Biscuits</span>
          </div>

          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/confectionery.png') }}" alt="Confectionery Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]" x-text="$store.lang.current === 'ID' ? 'Penganan Manis' : 'Confectionery'">Confectionery</span>
          </div>

          <div class="flex flex-col items-center text-center shrink-0 w-[110px]">
            <div class="w-24 h-24 rounded-full shadow-md overflow-hidden mb-2.5">
              <img src="{{ asset('images/daily.png') }}" alt="Dairy Application" class="w-full h-full object-cover" />
            </div>
            <span class="text-xs font-bold text-[#002D6E]" x-text="$store.lang.current === 'ID' ? 'Susu' : 'Dairy'">Dairy</span>
          </div>
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
      class="hidden max-w-[1320px] mx-auto text-center"
    >
      <h3 class="text-2xl sm:text-4xl lg:text-[42px] font-black text-[#002D6E] tracking-tight uppercase mb-8 sm:mb-14" x-text="$store.lang.current === 'ID' ? 'SPESIFIKASI PRODUK' : 'PRODUCT SPECIFICATIONS'">
        PRODUCT SPECIFICATIONS
      </h3>

      {{-- DESKTOP GRID (4 Cards) --}}
      <div class="hidden sm:grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5 text-left">
        
        {{-- Card 1: Form Factor --}}
        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-md border-2 border-white/80 rounded-2xl p-5 lg:p-6 shadow-lg flex flex-col justify-start gap-2.5 transition-all duration-300 overflow-hidden">
          <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-black tracking-wider px-3.5 py-1.5 rounded-full uppercase shadow-xs w-fit">
            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span x-text="$store.lang.current === 'ID' ? 'BENTUK KEMASAN' : 'FORM FACTOR'">FORM FACTOR</span>
          </div>
          <p class="text-xs sm:text-[13px] md:text-sm lg:text-base font-extrabold text-white leading-tight whitespace-nowrap drop-shadow-sm" x-text="$store.lang.current === 'ID' ? 'Blok 10 kg / Lembaran 1 kg × 10' : '10 kg block / 1 kg sheet × 10'">
            10 kg block / 1 kg sheet × 10
          </p>
        </div>

        {{-- Card 2: Shelf Life --}}
        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-md border-2 border-white/80 rounded-2xl p-5 lg:p-6 shadow-lg flex flex-col justify-start gap-2.5 transition-all duration-300 overflow-hidden">
          <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-black tracking-wider px-3.5 py-1.5 rounded-full uppercase shadow-xs w-fit">
            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span x-text="$store.lang.current === 'ID' ? 'MASA SIMPAN' : 'SHELF LIFE'">SHELF LIFE</span>
          </div>
          <p class="text-xs sm:text-[13px] md:text-sm lg:text-base font-extrabold text-white leading-tight whitespace-nowrap drop-shadow-sm" x-text="$store.lang.current === 'ID' ? 'Dingin: 5 bln / Beku: 18 bln' : 'Chilled: 5 mo / Frozen: 18 mo'">
            Chilled: 5 mo / Frozen: 18 mo
          </p>
        </div>

        {{-- Card 3: Storage --}}
        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-md border-2 border-white/80 rounded-2xl p-5 lg:p-6 shadow-lg flex flex-col justify-start gap-2.5 transition-all duration-300 overflow-hidden">
          <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-black tracking-wider px-3.5 py-1.5 rounded-full uppercase shadow-xs w-fit">
            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5ZM12 15.75a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/>
            </svg>
            <span x-text="$store.lang.current === 'ID' ? 'PENYIMPANAN' : 'STORAGE'">STORAGE</span>
          </div>
          <p class="text-xs sm:text-[13px] md:text-sm lg:text-base font-extrabold text-white leading-tight whitespace-nowrap drop-shadow-sm" x-text="$store.lang.current === 'ID' ? '0-10°C Dingin / -18°C Beku' : '0-10°C Chilled / -18°C Frozen'">
            0-10°C Chilled / -18°C Frozen
          </p>
        </div>

        {{-- Card 4: Compliance --}}
        <div class="bg-white/20 hover:bg-white/30 backdrop-blur-md border-2 border-white/80 rounded-2xl p-5 lg:p-6 shadow-lg flex flex-col justify-start gap-2.5 transition-all duration-300 overflow-hidden">
          <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-black tracking-wider px-3.5 py-1.5 rounded-full uppercase shadow-xs w-fit">
            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span x-text="$store.lang.current === 'ID' ? 'SERTIFIKASI' : 'COMPLIANCE'">COMPLIANCE</span>
          </div>
          <p class="text-xs sm:text-[13px] md:text-sm lg:text-base font-extrabold text-white leading-tight whitespace-nowrap drop-shadow-sm" x-text="$store.lang.current === 'ID' ? 'Tersertifikasi Halal' : 'Halal Certified'">
            Halal Certified
          </p>
        </div>

      </div>

      {{-- MOBILE CAROUSEL (Visible on mobile < 640px) --}}
      <div class="block sm:hidden w-full px-4">
        <div class="relative w-full max-w-[340px] mx-auto min-h-[110px] flex items-center justify-center">
          
          {{-- Card 1 --}}
          <div
            x-show="specActive === 0"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-white/20 backdrop-blur-md border-2 border-white/80 rounded-2xl p-5 shadow-lg text-left flex flex-col justify-start gap-2.5 overflow-hidden"
          >
            <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-black tracking-wider px-3.5 py-1.5 rounded-full uppercase shadow-xs w-fit">
              <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
              <span x-text="$store.lang.current === 'ID' ? 'BENTUK KEMASAN' : 'FORM FACTOR'">FORM FACTOR</span>
            </div>
            <p class="text-sm sm:text-base lg:text-[18px] font-black text-white leading-normal drop-shadow-sm" x-text="$store.lang.current === 'ID' ? 'Blok 10 kg / Lembaran 1 kg × 10' : '10 kg block / 1 kg sheet × 10'">
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
            class="w-full bg-white/20 backdrop-blur-md border-2 border-white/80 rounded-2xl p-5 shadow-lg text-left flex flex-col justify-start gap-2.5 overflow-hidden"
          >
            <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-black tracking-wider px-3.5 py-1.5 rounded-full uppercase shadow-xs w-fit">
              <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <span x-text="$store.lang.current === 'ID' ? 'MASA SIMPAN' : 'SHELF LIFE'">SHELF LIFE</span>
            </div>
            <p class="text-sm sm:text-base lg:text-[18px] font-black text-white leading-normal drop-shadow-sm" x-text="$store.lang.current === 'ID' ? 'Dingin: 5 bln / Beku: 18 bln' : 'Chilled: 5 mo / Frozen: 18 mo'">
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
            class="w-full bg-white/20 backdrop-blur-md border-2 border-white/80 rounded-2xl p-5 shadow-lg text-left flex flex-col justify-start gap-2.5 overflow-hidden"
          >
            <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-black tracking-wider px-3.5 py-1.5 rounded-full uppercase shadow-xs w-fit">
              <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.5a3.75 3.75 0 1 1 0 7.5 3.75 3.75 0 0 1 0-7.5ZM12 15.75a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/>
              </svg>
              <span x-text="$store.lang.current === 'ID' ? 'PENYIMPANAN' : 'STORAGE'">STORAGE</span>
            </div>
            <p class="text-sm sm:text-base lg:text-[18px] font-black text-white leading-normal drop-shadow-sm" x-text="$store.lang.current === 'ID' ? '0-10°C Dingin / -18°C Beku' : '0-10°C Chilled / -18°C Frozen'">
              0-10°C Chilled / -18°C Frozen
            </p>
          </div>

          {{-- Card 4 --}}
          <div
            x-show="specActive === 3"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform absolute"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full bg-white/20 backdrop-blur-md border-2 border-white/80 rounded-2xl p-5 shadow-lg text-left flex flex-col justify-start gap-2.5 overflow-hidden"
          >
            <div class="inline-flex items-center gap-2 bg-white text-slate-700 text-xs font-black tracking-wider px-3.5 py-1.5 rounded-full uppercase shadow-xs w-fit">
              <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
              </svg>
              <span x-text="$store.lang.current === 'ID' ? 'SERTIFIKASI' : 'COMPLIANCE'">COMPLIANCE</span>
            </div>
            <p class="text-sm sm:text-base lg:text-[18px] font-black text-white leading-normal drop-shadow-sm" x-text="$store.lang.current === 'ID' ? 'Tersertifikasi Halal' : 'Halal Certified'">
              Halal Certified
            </p>
          </div>

        </div>

        {{-- BULLET DOTS PAGINATION (NAVY BLUE ACTIVE AND INACTIVE FOR HIGH VISIBILITY) --}}
        <div class="flex items-center justify-center gap-2.5 mt-5">
          <template x-for="(item, index) in [0, 1, 2, 3]" :key="index">
            <button
              type="button"
              @click="specActive = index"
              :class="specActive === index ? 'w-7 bg-[#002D6E] shadow-sm' : 'w-2.5 bg-[#002D6E]/40 hover:bg-[#002D6E]'"
              class="h-2.5 rounded-full transition-all duration-300 focus-ring-standard cursor-pointer"
              :aria-label="'Go to specification slide ' + (index + 1)"
            ></button>
          </template>
        </div>
      </div>

    </div>  </div>

  </div>
</section>
