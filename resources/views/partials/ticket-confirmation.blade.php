{{-- 
  TICKET CONFIRMATION COMPONENT
  Bunge FlexiBetter Event Microsite — Food Ingredients Asia (FIA) Indonesia 2026
  Blade Partial: resources/views/partials/ticket-confirmation.blade.php
--}}
<section id="ticket-confirmation" class="relative w-full min-h-screen pt-12 sm:pt-16 lg:pt-20 pb-0 select-none overflow-hidden" style="background: linear-gradient(180deg, #002D6E 0%, #002D6E 75%, #C4D9EE 90%, #E5F1FC 100%);">
  <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- TOP BADGE & HEADLINE --}}
    <div class="text-center mb-8 sm:mb-12">
      {{-- Green Checkmark Circle Badge --}}
      <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white flex items-center justify-center mx-auto mb-4 sm:mb-5 shadow-xl">
        <div class="w-12 h-12 sm:w-15 sm:h-15 rounded-full bg-[#10B981] flex items-center justify-center">
          <svg class="w-7 h-7 sm:w-9 sm:h-9 text-white stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
          </svg>
        </div>
      </div>

      {{-- CONFIRMED Pill Badge --}}
      <div class="inline-block mb-3 sm:mb-4">
        <span class="bg-[#10B981] text-white text-xs sm:text-sm font-extrabold px-4 sm:px-5 py-1 sm:py-1.5 rounded-full uppercase tracking-wider shadow-sm">
          CONFIRMED
        </span>
      </div>

      {{-- Main Title --}}
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight mb-3 sm:mb-4 drop-shadow-sm">
        Your Consultation Session<br class="hidden sm:inline" /> Has Been Confirmed
      </h1>

      {{-- Subtitle --}}
      <p class="text-sm sm:text-base lg:text-lg text-white/90 font-medium leading-relaxed max-w-xl mx-auto drop-shadow-xs">
        Thank you for scheduling a consultation with the Bunge team. We look forward to seeing you at Fi Asia Indonesia 2026.
      </p>
    </div>

    {{-- TICKET PASS CARD (NO BORDER, CLEAN SHADOW) --}}
    <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden mb-8 sm:mb-10">
      
      {{-- TICKET CARD HEADER BAR --}}
      <div class="bg-[#004B99] px-6 sm:px-8 py-5 sm:py-6 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
          <span class="block text-[11px] sm:text-xs font-black tracking-widest text-white/80 uppercase mb-0.5">
            BUNGE
          </span>
          <h2 class="text-lg sm:text-xl lg:text-2xl font-black tracking-tight">
            Bunge FlexiBetter Consultation Pass
          </h2>
        </div>
        <div class="flex items-center justify-between sm:justify-end gap-3 pt-1 sm:pt-0 border-t border-white/10 sm:border-none">
          <span style="display: inline-block; height: 24px; line-height: 24px; padding: 0 12px; border-radius: 9999px; background-color: #10B981; color: #ffffff; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; text-align: center; vertical-align: middle; box-sizing: border-box;">
            CONFIRMED
          </span>
          <span class="font-mono font-bold text-xs sm:text-sm text-white/90 tracking-wide">
            BNG-FIA26-001245
          </span>
        </div>
      </div>

      {{-- TICKET CARD CONTENT BODY --}}
      <div class="p-6 sm:p-8 lg:p-10 space-y-8 sm:space-y-10">
        
        {{-- SECTION 1: VISITOR INFORMATION --}}
        <div>
          <h3 class="text-sm sm:text-base font-black text-[#002D6E] uppercase tracking-wider mb-5">
            VISITOR INFORMATION
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-4 sm:gap-y-6 gap-x-6">
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                FULL NAME
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                Michael Santoso
              </span>
            </div>
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                PHONE
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                +62 812 3456 7890
              </span>
            </div>
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                COMPANY
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                Artisan Bakery Group
              </span>
            </div>
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                INDUSTRY
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                Bakery & Pastry
              </span>
            </div>
            <div class="sm:col-span-2 lg:col-span-2">
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                EMAIL
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900 break-all">
                michael.s@artisangroup.com
              </span>
            </div>
          </div>
        </div>

        {{-- DASHED SEPARATOR WITH SIDE NOTCHES --}}
        <div class="relative -mx-6 sm:-mx-8 lg:-mx-10 my-6 h-6 flex items-center">
          <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-[#002D6E]"></div>
          <div class="w-full border-b-2 border-dashed border-slate-200"></div>
          <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-[#002D6E]"></div>
        </div>

        {{-- SECTION 2: CONSULTATION INFORMATION --}}
        <div>
          <h3 class="text-sm sm:text-base font-black text-[#002D6E] uppercase tracking-wider mb-5">
            CONSULTATION INFORMATION
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-4 sm:gap-y-6 gap-x-6">
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                DISCUSSION TOPIC
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                Product Application Focus
              </span>
            </div>
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                SPECIALIST
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                To be assigned
              </span>
            </div>
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                DATE
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                17 September 2026
              </span>
            </div>
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                TIME
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                10:00 – 10:30 WIB
              </span>
            </div>
            <div>
              <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                DURATION
              </span>
              <span class="block text-sm sm:text-base font-extrabold text-slate-900">
                30 Menit
              </span>
            </div>
          </div>
        </div>

        {{-- DASHED SEPARATOR WITH SIDE NOTCHES --}}
        <div class="relative -mx-6 sm:-mx-8 lg:-mx-10 my-6 h-6 flex items-center">
          <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-[#002D6E]"></div>
          <div class="w-full border-b-2 border-dashed border-slate-200"></div>
          <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-[#002D6E]"></div>
        </div>

        {{-- SECTION 3: EVENT INFORMATION & BEFORE YOU ARRIVE (2 COLS) --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 pt-2">
          
          {{-- Left Col: EVENT INFORMATION --}}
          <div>
            <h3 class="text-sm sm:text-base font-black text-[#002D6E] uppercase tracking-wider mb-5">
              EVENT INFORMATION
            </h3>
            <ul class="space-y-4">
              <li class="flex items-start gap-3">
                <div class="w-7 h-7 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                  <svg class="w-4 h-4 text-[#002D6E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                  </svg>
                </div>
                <span class="text-sm sm:text-base font-extrabold text-slate-800 pt-1">
                  JIExpo Hall D2 · Booth D2A48
                </span>
              </li>

              <li class="flex items-start gap-3">
                <div class="w-7 h-7 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                  <svg class="w-4 h-4 text-[#002D6E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                  </svg>
                </div>
                <span class="text-sm sm:text-base font-extrabold text-slate-800 pt-1">
                  16–18 September 2026
                </span>
              </li>

              <li class="flex items-start gap-3">
                <div class="w-7 h-7 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                  <svg class="w-4 h-4 text-[#002D6E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                </div>
                <span class="text-sm sm:text-base font-extrabold text-slate-800 pt-1">
                  {{ config('event.hours', '10:00 AM - 06:00 PM') }}
                </span>
              </li>
            </ul>
          </div>

          {{-- Right Col: BEFORE YOU ARRIVE --}}
          <div class="pt-4 lg:pt-0 border-t lg:border-t-0 border-slate-100 lg:pl-6 lg:border-l lg:border-slate-100">
            <h3 class="text-sm sm:text-base font-black text-[#D97706] uppercase tracking-wider mb-5">
              BEFORE YOU ARRIVE
            </h3>
            <ul class="space-y-3.5">
              <li class="flex items-start gap-3">
                <div class="w-5 h-5 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                  <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                </div>
                <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug">
                  Arrive 10–15 minutes before your session
                </span>
              </li>

              <li class="flex items-start gap-3">
                <div class="w-5 h-5 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                  <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                </div>
                <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug">
                  Show your Booking ID or Consultation Pass
                </span>
              </li>

              <li class="flex items-start gap-3">
                <div class="w-5 h-5 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                  <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                </div>
                <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug">
                  Visit Bunge Booth D2A48
                </span>
              </li>

              <li class="flex items-start gap-3">
                <div class="w-5 h-5 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                  <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                </div>
                <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug">
                  Contact the Bunge reception desk if you need assistance
                </span>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </div>

    {{-- PRIMARY ACTION BUTTONS --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-6">
      <button
        type="button"
        onclick="window.print()"
        class="w-full sm:w-auto bg-[#002D6E] hover:bg-[#001D48] active:scale-[0.99] text-white py-3.5 px-8 rounded-full font-bold text-sm sm:text-base shadow-xl hover:shadow-2xl transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer"
      >
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
        </svg>
        <span>DOWNLOAD PDF</span>
      </button>

      <button
        type="button"
        class="w-full sm:w-auto bg-slate-200/80 hover:bg-slate-300/80 active:scale-[0.99] text-[#002D6E] border border-[#002D6E]/20 py-3.5 px-8 rounded-full font-bold text-sm sm:text-base shadow-sm transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer"
      >
        <svg class="w-5 h-5 text-[#002D6E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
        </svg>
        <span>DOWNLOAD IMAGE</span>
      </button>
    </div>

    {{-- SECONDARY LINKS --}}
    <div class="text-center space-y-3 mb-12 sm:mb-16 lg:mb-20">
      <div class="flex items-center justify-center gap-6 text-sm font-extrabold text-[#002D6E]">
        <a href="#" class="underline hover:text-[#0E529B] transition-colors duration-200">
          Add to Calendar
        </a>
        <a href="index.html" class="underline hover:text-[#0E529B] transition-colors duration-200">
          Back to Home
        </a>
      </div>

      <div class="flex items-center justify-center gap-4 text-xs font-semibold text-slate-400">
        <a href="#" class="hover:text-slate-600 transition-colors duration-200">Reschedule</a>
        <span>·</span>
        <a href="#" class="hover:text-slate-600 transition-colors duration-200">Cancel Booking</a>
      </div>
    </div>

  </div>

  {{-- BOTTOM BLUE DISCLAIMER BANNER --}}
  <div class="w-full bg-[#E5F1FC] border-t border-slate-200/60 py-3.5 px-4 text-center">
    <p class="text-xs sm:text-sm font-semibold text-slate-700 flex items-center justify-center gap-2">
      <svg class="w-4 h-4 text-[#002D6E] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
      </svg>
      <span>You can also take a screenshot of this page and show it when checking in at the Bunge booth.</span>
    </p>
  </div>
</section>
