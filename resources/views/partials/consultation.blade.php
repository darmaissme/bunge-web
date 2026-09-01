{{-- 
  CONSULTATION FORM & EXPERT SECTION
  Bunge FlexiBetter Event Microsite
  Background: Solid #002D6E
--}}
<section id="consultation" class="relative w-full pt-8 sm:pt-12 lg:pt-16 pb-16 sm:pb-24 lg:pb-28 bg-white select-none">
  <style>
    @media (min-width: 1024px) and (max-width: 1536px) {
      .consultation-form-card-box {
        padding: 2rem 2.25rem !important;
      }
      .consultation-form-title-text {
        font-size: 30px !important;
        margin-bottom: 0.5rem !important;
      }
      .consultation-form-desc-text {
        font-size: 13px !important;
        line-height: 1.45 !important;
      }
      .consultation-form-header-box {
        margin-bottom: 1.25rem !important;
      }
      .consultation-form-spacing {
        row-gap: 1rem !important;
      }
      .consultation-form-spacing > div {
        margin-top: 0rem !important;
      }
      .consultation-input-field {
        padding-top: 0.6rem !important;
        padding-bottom: 0.6rem !important;
        font-size: 13px !important;
      }
      .consultation-label-text {
        font-size: 12px !important;
        margin-bottom: 0.35rem !important;
      }
      .expert-title-heading {
        font-size: 38px !important;
      }
      .expert-image-wrapper {
        width: 100% !important;
        margin-top: 0rem !important;
        margin-right: 0rem !important;
      }
    }
  </style>

  <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
    
    {{-- MAIN GRID CONTAINER (LG: MAX-W-[80VW] EXACTLY ALIGNED WITH EVENT PREVIEW SECTION) --}}
    <div class="w-full lg:max-w-[80vw] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch">
      
      {{-- LEFT COLUMN: CONSULTATION FORM CARD (LG: 7 COLS) --}}
      <div data-gsap="consultation-form-card" class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-10 lg:p-12 shadow-xl border border-[#002D6E] consultation-form-card-box">
        
        {{-- FORM HEADING & SUBTITLE --}}
        <div class="mb-9 lg:mb-11 consultation-form-header-box">
          <h2
            class="text-3xl sm:text-4xl lg:text-[42px] font-black text-[#002D6E] leading-tight tracking-tight mb-3 consultation-form-title-text"
            x-text="$store.lang.current === 'ID' ? 'Booking Sesi Konsultasi' : 'Book a Consultation Session'"
          >
            Book a Consultation Session
          </h2>
          <p
            class="text-sm sm:text-base text-slate-500 font-medium leading-relaxed max-w-xl consultation-form-desc-text"
            x-text="$store.lang.current === 'ID' ? 'Bertemu langsung dengan spesialis Bunge selama acara berlangsung. Pilih waktu konsultasi dan topik diskusi yang sesuai dengan kebutuhan Anda.' : 'Meet directly with Bunge specialists during the event. Choose a consultation time and discussion topic that suits your needs.'"
          >
            Meet directly with Bunge specialists during the event. Choose a consultation time and discussion topic that suits your needs.
          </p>
        </div>

        {{-- LARAVEL COMPATIBLE FORM WITH DYNAMIC AVAILABILITY SELECTOR --}}
        <form
          method="POST"
          action="{{ route('consultation.store') }}"
          x-data="consultationBookingComponent()"
          x-init="initComponent()"
          @submit.prevent="submitBooking($event)"
          class="space-y-7 sm:space-y-8 lg:space-y-9"
        >
          @csrf

          {{-- ANTI-SPAM HONEYPOT GUARD --}}
          <div style="display:none !important;" aria-hidden="true">
            <input type="text" name="bunge_website_hp" x-model="honeypot" tabindex="-1" autocomplete="off" />
          </div>

          {{-- HIDDEN INPUTS FOR BACKEND VALIDATION --}}
          <input type="hidden" name="event_date_id" :value="selectedDateId">
          <input type="hidden" name="consultation_slot_id" :value="selectedSlotId">
          <input type="hidden" name="preferred_date" :value="selectedDateString" required>
          <input type="hidden" name="preferred_time" :value="selectedSlotTime" required>
          
          {{-- GLOBAL FORM ERROR ALERT BANNER --}}
          <div
            x-show="Object.keys(validationErrors).length > 0 || errorMessage || {{ $errors->any() ? 'true' : 'false' }}"
            x-cloak
            class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-xs"
          >
            <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
              <template x-if="validationErrors.email">
                <p x-text="formatValidationMsg(validationErrors.email)"></p>
              </template>
              <template x-if="!validationErrors.email && validationErrors.phone">
                <p x-text="formatValidationMsg(validationErrors.phone)"></p>
              </template>
              <template x-if="!validationErrors.email && !validationErrors.phone && errorMessage">
                <p x-text="formatValidationMsg(errorMessage)"></p>
              </template>
              <template x-if="!validationErrors.email && !validationErrors.phone && !errorMessage && Object.keys(validationErrors).length > 0">
                <p x-text="$store.lang.current === 'ID' ? 'Silakan periksa kolom yang ditandai di bawah ini dan coba lagi.' : 'Please review the highlighted fields below and try again.'"></p>
              </template>
              @if ($errors->any())
                <template x-if="Object.keys(validationErrors).length === 0 && !errorMessage">
                  <p x-text="$store.lang.current === 'ID' ? '{{ $errors->has("email") ? "Anda sudah memiliki booking konsultasi yang masih aktif." : ($errors->has("phone") ? "Anda sudah memiliki booking konsultasi yang masih aktif." : "Silakan periksa kolom yang ditandai di bawah ini dan coba lagi.") }}' : '{{ $errors->first("email") ?: ($errors->first("phone") ?: "Please review the highlighted fields below and try again.") }}'"></p>
                </template>
              @endif
            </div>
          </div>

          {{-- ROW 1: FULL NAME, PHONE NUMBER, EMAIL ADDRESS --}}
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
            
            {{-- Field: Full Name --}}
            <div>
              <label for="full_name" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Nama Lengkap *' : 'Full Name *'">
                Full Name *
              </label>
              <input
                type="text"
                id="full_name"
                name="full_name"
                x-model="fullName"
                @input="fullName = $event.target.value.replace(/[^a-zA-Z\s\.\'-]/g, '').slice(0, 70)"
                maxlength="70"
                minlength="2"
                pattern="^[a-zA-Z\s\.\'-]+$"
                title="Only letters, spaces, dots, hyphens, and apostrophes allowed (max 70 characters)"
                value="{{ old('full_name') }}"
                :placeholder="$store.lang.current === 'ID' ? 'Nama lengkap' : 'Full name'"
                placeholder="Full name"
                required
                class="w-full bg-white border border-slate-200 rounded-xl px-3 sm:px-3.5 py-2.5 sm:py-3 text-xs sm:text-xs lg:text-sm text-slate-800 placeholder:text-xs placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:border-transparent transition-all duration-200"
              />
              <template x-if="validationErrors.full_name">
                <p class="text-xs text-red-500 mt-1 font-medium" x-text="formatValidationMsg(validationErrors.full_name)"></p>
              </template>
              @if (isset($errors) && $errors->has('full_name'))
                <p x-show="!validationErrors.full_name" class="text-xs text-red-500 mt-1 font-medium">{{ $errors->first('full_name') }}</p>
              @endif
            </div>

            {{-- Field: Phone Number --}}
            <div>
              <label for="phone" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Nomor Telepon *' : 'Phone Number *'">
                Phone Number *
              </label>
              <input
                type="tel"
                id="phone"
                name="phone"
                x-model="phone"
                @input="phone = $event.target.value.replace(/[^0-9+\s\-()]/g, '').slice(0, 16)"
                maxlength="16"
                minlength="7"
                pattern="^[\+]?[0-9\s\-()]{7,16}$"
                title="Only numbers and phone symbols (+ - ( )) up to 16 digits"
                value="{{ old('phone') }}"
                :placeholder="$store.lang.current === 'ID' ? 'Contoh: 08123456' : 'e.g. +62 8123456'"
                placeholder="e.g. +62 8123456"
                required
                class="w-full bg-white border border-slate-200 rounded-xl px-3 sm:px-3.5 py-2.5 sm:py-3 text-xs sm:text-xs lg:text-sm text-slate-800 placeholder:text-xs placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:border-transparent transition-all duration-200"
              />
              <template x-if="validationErrors.phone">
                <p class="text-xs text-red-500 mt-1 font-medium" x-text="formatValidationMsg(validationErrors.phone)"></p>
              </template>
              @if (isset($errors) && $errors->has('phone'))
                <p x-show="!validationErrors.phone" class="text-xs text-red-500 mt-1 font-medium">{{ $errors->first('phone') }}</p>
              @endif
            </div>

            {{-- Field: Email Address --}}
            <div>
              <label for="email" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Alamat Email *' : 'Email Address *'">
                Email Address *
              </label>
              <input
                type="email"
                id="email"
                name="email"
                x-model="email"
                @blur="email = email.trim()"
                maxlength="100"
                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                title="Please enter a valid email address containing @"
                value="{{ old('email') }}"
                :placeholder="$store.lang.current === 'ID' ? 'Email Anda' : 'Your email'"
                placeholder="Your email"
                required
                class="w-full bg-white border border-slate-200 rounded-xl px-3 sm:px-3.5 py-2.5 sm:py-3 text-xs sm:text-xs lg:text-sm text-slate-800 placeholder:text-xs placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:border-transparent transition-all duration-200"
              />
              <template x-if="validationErrors.email">
                <p class="text-xs text-red-500 mt-1 font-medium" x-text="formatValidationMsg(validationErrors.email)"></p>
              </template>
              @if (isset($errors) && $errors->has('email'))
                <p x-show="!validationErrors.email" class="text-xs text-red-500 mt-1 font-medium">{{ $errors->first('email') }}</p>
              @endif
            </div>

          </div>

          {{-- ROW 2: COMPANY NAME, INDUSTRY, DISCUSSION TOPIC --}}
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
            
            {{-- Field: Company Name --}}
            <div>
              <label for="company" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Nama Perusahaan *' : 'Company Name *'">
                Company Name *
              </label>
              <input
                type="text"
                id="company"
                name="company"
                x-model="company"
                @input="company = $event.target.value.replace(/[<>]/g, '').slice(0, 100)"
                maxlength="100"
                minlength="2"
                value="{{ old('company') }}"
                :placeholder="$store.lang.current === 'ID' ? 'Nama perusahaan' : 'Your company'"
                placeholder="Your company"
                required
                class="w-full bg-white border border-slate-200 rounded-xl px-3 sm:px-3.5 py-2.5 sm:py-3 text-xs sm:text-xs lg:text-sm text-slate-800 placeholder:text-xs placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:border-transparent transition-all duration-200"
              />
              <template x-if="validationErrors.company">
                <p class="text-xs text-red-500 mt-1 font-medium" x-text="formatValidationMsg(validationErrors.company)"></p>
              </template>
              @if (isset($errors) && $errors->has('company'))
                <p x-show="!validationErrors.company" class="text-xs text-red-500 mt-1 font-medium">{{ $errors->first('company') }}</p>
              @endif
            </div>

            {{-- Field: Industry --}}
            <div>
              <label for="industry" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Industri' : 'Industry'">
                Industry
              </label>
              <div class="relative">
                <select
                  id="industry"
                  name="industry"
                  required
                  class="w-full bg-white border border-slate-200 rounded-xl px-3 sm:px-3.5 py-2.5 sm:py-3 text-xs sm:text-xs lg:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:border-transparent appearance-none cursor-pointer pr-8 transition-all duration-200 truncate"
                >
                  <option value="" disabled {{ old('industry') ? '' : 'selected' }} hidden x-text="$store.lang.current === 'ID' ? 'Pilih industri' : 'Select industry'">Select industry</option>
                  <option value="Bakery" {{ old('industry') === 'Bakery' ? 'selected' : '' }}>Bakery</option>
                  <option value="Pastry" {{ old('industry') === 'Pastry' ? 'selected' : '' }}>Pastry</option>
                  <option value="Cookies & Biscuits" {{ old('industry') === 'Cookies & Biscuits' ? 'selected' : '' }}>Cookies & Biscuits</option>
                  <option value="Confectionery" {{ old('industry') === 'Confectionery' ? 'selected' : '' }}>Confectionery</option>
                  <option value="Dairy" {{ old('industry') === 'Dairy' ? 'selected' : '' }}>Dairy</option>
                  <option value="Food Manufacturing" {{ old('industry') === 'Food Manufacturing' ? 'selected' : '' }}>Food Manufacturing</option>
                  <option value="Other" {{ old('industry') === 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                <svg class="w-4 h-4 text-slate-500 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
              </div>
              <template x-if="validationErrors.industry">
                <p class="text-xs text-red-500 mt-1 font-medium" x-text="formatValidationMsg(validationErrors.industry)"></p>
              </template>
              @if (isset($errors) && $errors->has('industry'))
                <p x-show="!validationErrors.industry" class="text-xs text-red-500 mt-1 font-medium">{{ $errors->first('industry') }}</p>
              @endif
            </div>

            {{-- Field: Discussion Topic --}}
            <div>
              <label for="discussion_topic" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Topik Diskusi' : 'Discussion Topic'">
                Discussion Topic
              </label>
              <div class="relative">
                <select
                  id="discussion_topic"
                  name="discussion_topic"
                  required
                  class="w-full bg-white border border-slate-200 rounded-xl px-3 sm:px-3.5 py-2.5 sm:py-3 text-xs sm:text-xs lg:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:border-transparent appearance-none cursor-pointer pr-8 transition-all duration-200 truncate"
                >
                  <option value="" disabled {{ old('discussion_topic') ? '' : 'selected' }} hidden x-text="$store.lang.current === 'ID' ? 'Pilih topik' : 'Select topic'">Select topic</option>
                  <option value="Product Performance" {{ old('discussion_topic') === 'Product Performance' ? 'selected' : '' }}>Product Performance & Yield Optimization</option>
                  <option value="Butter Solution" {{ old('discussion_topic') === 'Butter Solution' ? 'selected' : '' }}>Functional Butter Solution Integration</option>
                  <option value="Cost Efficiency" {{ old('discussion_topic') === 'Cost Efficiency' ? 'selected' : '' }}>Cost & Supply Chain Efficiency</option>
                  <option value="Custom Formulation" {{ old('discussion_topic') === 'Custom Formulation' ? 'selected' : '' }}>Custom Recipe & Formulation Consultation</option>
                </select>
                <svg class="w-4 h-4 text-slate-500 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
              </div>
              <template x-if="validationErrors.discussion_topic">
                <p class="text-xs text-red-500 mt-1 font-medium" x-text="formatValidationMsg(validationErrors.discussion_topic)"></p>
              </template>
              @if (isset($errors) && $errors->has('discussion_topic'))
                <p x-show="!validationErrors.discussion_topic" class="text-xs text-red-500 mt-1 font-medium">{{ $errors->first('discussion_topic') }}</p>
              @endif
            </div>

          </div>

          {{-- ROW 3: COMPACT DATE & TIME DROPDOWNS --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">

            {{-- FIELD 1: COMPACT EVENT DATE SELECTOR --}}
            <div class="relative" @click.away="dateDropdownOpen = false">
              <label class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Pilih Tanggal Acara' : 'Select Preferred Event Date'">
                Select Preferred Event Date
              </label>

              {{-- Closed Control Box --}}
              <button
                type="button"
                @click="dateDropdownOpen = !dateDropdownOpen"
                :disabled="loadingDates"
                :class="{
                  'border-[#002D6E] ring-2 ring-[#002D6E]/20': dateDropdownOpen,
                  'border-slate-200 hover:border-slate-300': !dateDropdownOpen
                }"
                class="w-full bg-white border rounded-xl px-3 sm:px-3.5 py-2.5 sm:py-3 text-left text-xs sm:text-xs lg:text-sm text-slate-800 focus:outline-none transition-all duration-200 flex items-center justify-between cursor-pointer"
              >
                <div class="flex items-center gap-2.5 truncate">
                  <svg class="w-4.5 h-4.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                  </svg>
                  <span x-show="loadingDates" class="text-slate-400 font-medium animate-pulse text-xs" x-text="$store.lang.current === 'ID' ? 'Memuat tanggal...' : 'Loading dates...'">Loading dates...</span>
                  <span x-show="!loadingDates && selectedFormattedDate" x-text="selectedFormattedDate" class="font-bold text-slate-900 truncate text-xs sm:text-xs lg:text-sm"></span>
                  <span x-show="!loadingDates && !selectedFormattedDate" class="text-slate-400 text-xs" x-text="$store.lang.current === 'ID' ? 'Pilih tanggal' : 'Select date'">Select date</span>
                </div>
                <svg
                  class="w-4 h-4 text-slate-500 shrink-0 transition-transform duration-200"
                  :class="{ 'rotate-180': dateDropdownOpen }"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2.5"
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
              </button>

              {{-- Custom Date Dropdown Panel --}}
              <div
                x-show="dateDropdownOpen"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                class="absolute left-0 right-0 top-full mt-1.5 bg-white border border-slate-200 rounded-2xl shadow-xl z-50 overflow-hidden py-1 text-left"
                style="display: none;"
              >
                <template x-for="dateItem in eventDates" :key="dateItem.id">
                  <div
                    @click="selectDate(dateItem)"
                    :class="{
                      'bg-slate-100 text-slate-400 cursor-not-allowed opacity-60': dateItem.is_full,
                      'bg-[#002D6E]/5 text-[#002D6E] font-extrabold': selectedDateId === dateItem.id && !dateItem.is_full,
                      'hover:bg-slate-50 text-slate-800 cursor-pointer': selectedDateId !== dateItem.id && !dateItem.is_full
                    }"
                    class="px-4 py-3 border-b border-slate-100 last:border-0 flex items-center justify-between transition-colors"
                  >
                    <div>
                      <div class="text-sm font-extrabold" x-text="dateItem.formatted_date"></div>
                      <div class="text-xs text-slate-500 font-medium" x-text="dateItem.subtitle"></div>
                    </div>
                    <span
                      class="text-xs font-extrabold px-2.5 py-0.5 rounded-full"
                      :class="{
                        'bg-red-100 text-red-600': dateItem.is_full,
                        'bg-emerald-50 text-emerald-700': !dateItem.is_full && selectedDateId !== dateItem.id,
                        'bg-[#002D6E] text-white': !dateItem.is_full && selectedDateId === dateItem.id
                      }"
                      x-text="dateItem.is_full ? ($store.lang.current === 'ID' ? 'Sudah Penuh' : 'FULL') : ($store.lang.current === 'ID' ? 'Tersedia' : 'Available')"
                    ></span>
                  </div>
                </template>
              </div>

              <template x-if="validationErrors.preferred_date || validationErrors.event_date_id">
                <p class="text-xs text-red-500 mt-1.5 font-medium" x-text="Array.isArray(validationErrors.preferred_date || validationErrors.event_date_id) ? (validationErrors.preferred_date || validationErrors.event_date_id)[0] : (validationErrors.preferred_date || validationErrors.event_date_id)"></p>
              </template>
            </div>

            {{-- FIELD 2: COMPACT CONSULTATION TIME SELECTOR --}}
            <div class="relative" @click.away="timeDropdownOpen = false">
              <label class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Pilih Waktu Sesi Konsultasi' : 'Select Consultation Time'">
                Select Consultation Time
              </label>

              {{-- Closed Control Box --}}
              <button
                type="button"
                @click="if (selectedDateString && slots.length > 0) timeDropdownOpen = !timeDropdownOpen"
                :disabled="!selectedDateString || loadingSlots || slots.length === 0"
                :class="{
                  'border-[#002D6E] ring-2 ring-[#002D6E]/20': timeDropdownOpen,
                  'border-slate-200 hover:border-slate-300': timeDropdownOpen === false && selectedDateString && slots.length > 0,
                  'border-slate-200 bg-slate-50 cursor-not-allowed opacity-60': !selectedDateString || slots.length === 0
                }"
                class="w-full bg-white border rounded-xl px-3 sm:px-3.5 py-2.5 sm:py-3 text-left text-xs sm:text-xs lg:text-sm text-slate-800 focus:outline-none transition-all duration-200 flex items-center justify-between cursor-pointer"
              >
                <div class="flex items-center gap-2.5 truncate">
                  <svg class="w-4.5 h-4.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                  </svg>
                  <span x-show="!selectedDateString" class="text-slate-400 text-xs" x-text="$store.lang.current === 'ID' ? 'Pilih tanggal dahulu' : 'Select date first'">Select date first</span>
                  <span x-show="selectedDateString && loadingSlots" class="text-slate-400 font-medium animate-pulse text-xs" x-text="$store.lang.current === 'ID' ? 'Memuat waktu...' : 'Loading times...'">Loading times...</span>
                  <span x-show="selectedDateString && !loadingSlots && selectedSlotTime" x-text="selectedSlotTime" class="font-bold text-slate-900 truncate text-xs sm:text-xs lg:text-sm"></span>
                  <span x-show="selectedDateString && !loadingSlots && !selectedSlotTime && slots.length > 0" class="text-slate-400 text-xs" x-text="$store.lang.current === 'ID' ? 'Pilih waktu tersedia' : 'Select available time'">Select available time</span>
                  <span x-show="selectedDateString && !loadingSlots && slots.length === 0" class="text-red-500 font-medium text-xs" x-text="$store.lang.current === 'ID' ? 'Tidak ada waktu' : 'No slots available'">No slots available</span>
                </div>
                <svg
                  class="w-4 h-4 text-slate-500 shrink-0 transition-transform duration-200"
                  :class="{ 'rotate-180': timeDropdownOpen }"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2.5"
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                </svg>
              </button>

              {{-- Custom Time Dropdown Panel --}}
              <div
                x-show="timeDropdownOpen"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                class="absolute left-0 right-0 top-full mt-1.5 bg-white border border-slate-200 rounded-2xl shadow-xl z-50 overflow-hidden py-1 text-left max-h-64 overflow-y-auto"
                style="display: none;"
              >
                <template x-for="slot in slots" :key="slot.id">
                  <div
                    @click="selectSlot(slot)"
                    :class="{
                      'bg-slate-100 text-slate-400 cursor-not-allowed opacity-60': slot.is_full || !slot.is_active,
                      'bg-[#002D6E]/5 text-[#002D6E] font-extrabold': selectedSlotId === slot.id && !slot.is_full && slot.is_active,
                      'hover:bg-slate-50 text-slate-800 cursor-pointer': selectedSlotId !== slot.id && !slot.is_full && slot.is_active
                    }"
                    class="px-4 py-3 border-b border-slate-100 last:border-0 flex items-center justify-between transition-colors"
                  >
                    <span class="text-sm font-bold" x-text="slot.formatted_time"></span>
                    <span
                      class="text-xs font-extrabold px-2.5 py-0.5 rounded-full"
                      :class="{
                        'bg-red-100 text-red-600': slot.is_full,
                        'bg-emerald-50 text-emerald-700': !slot.is_full && selectedSlotId !== slot.id,
                        'bg-[#002D6E] text-white': !slot.is_full && selectedSlotId === slot.id
                      }"
                      x-text="slot.is_full ? ($store.lang.current === 'ID' ? 'Sudah Penuh' : 'FULL') : (slot.available + ($store.lang.current === 'ID' ? ' tersedia' : ' available'))"
                    ></span>
                  </div>
                </template>
              </div>

              <template x-if="validationErrors.preferred_time || validationErrors.consultation_slot_id">
                <p class="text-xs text-red-500 mt-1.5 font-medium" x-text="formatValidationMsg(validationErrors.preferred_time || validationErrors.consultation_slot_id)"></p>
              </template>

              @if (isset($errors) && $errors->has('preferred_time'))
                <p x-show="!validationErrors.preferred_time" class="text-xs text-red-500 mt-1.5 font-medium">{{ $errors->first('preferred_time') }}</p>
              @endif
            </div>

          </div>

          {{-- SUBMIT BUTTON --}}
          <div class="pt-4 lg:pt-6">
            <button
              type="submit"
              :disabled="submitting || !selectedDateString || !selectedSlotTime"
              :class="(submitting || !selectedDateString || !selectedSlotTime) ? 'opacity-50 cursor-not-allowed bg-slate-400' : 'bg-[#5AA546] hover:bg-[#488937] active:bg-[#3D742E] active:scale-[0.99] cursor-pointer shadow-xl hover:shadow-2xl'"
              class="w-full text-white py-4 sm:py-4.5 px-8 rounded-full font-bold text-base sm:text-lg transition-all duration-300 flex items-center justify-center gap-3 group"
            >
              <span x-show="!submitting" x-text="$store.lang.current === 'ID' ? 'Booking Sesi Saya' : 'Book My Session'">Book My Session</span>
              <span x-show="submitting" class="flex items-center gap-2" style="display: none;">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span x-text="$store.lang.current === 'ID' ? 'Memproses...' : 'Processing...'">Processing...</span>
              </span>
              <svg x-show="!submitting" class="w-5 h-5 text-white transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
              </svg>
            </button>
          </div>

        </form>

      </div>

      {{-- RIGHT COLUMN: BUNGE BOOTH SHOWCASE IMAGE (EXACT EQUAL HEIGHT WITH LEFT FORM ON DESKTOP) --}}
      <div class="lg:col-span-5 flex flex-col h-full">
        <div data-gsap="consultation-process-card" class="z-10 relative overflow-hidden rounded-3xl h-full w-full min-h-[300px]">
          <img
            src="{{ asset('images/bunge_booth2.jpg') }}"
            alt="Bunge FlexiBetter Exhibition Booth"
            class="w-full h-full object-cover rounded-3xl block"
          />
        </div>
      </div>

    </div>

  </div>
</section>

<script>
  function toggleExpertProfile() {
    const card = document.getElementById('expert-profile-card');
    const panel = document.getElementById('expert-profile-panel');
    const chevron = document.getElementById('expert-profile-chevron');
    if (!panel) return;
    
    if (panel.classList.contains('hidden')) {
      panel.classList.remove('hidden');
      chevron.classList.add('rotate-180');
    } else {
      panel.classList.add('hidden');
      chevron.classList.remove('rotate-180');
    }
  }

  function consultationBookingComponent() {
    return {
      fullName: '{{ old("full_name") }}',
      phone: '{{ old("phone") }}',
      email: '{{ old("email") }}',
      company: '{{ old("company") }}',
      honeypot: '',
      eventDates: [],
      selectedDateId: '{{ old("event_date_id") }}',
      selectedDateString: '{{ old("preferred_date") }}',
      selectedFormattedDate: '',
      selectedSlotId: '{{ old("consultation_slot_id") }}',
      selectedSlotTime: '{{ old("preferred_time") }}',
      slots: [],
      loadingDates: true,
      loadingSlots: false,
      errorMessage: '',
      dateDropdownOpen: false,
      timeDropdownOpen: false,
      submitting: false,
      validationErrors: {},

      formatValidationMsg(msg) {
        if (!msg) return '';
        if (Array.isArray(msg)) msg = msg[0];
        if (Alpine.store('lang') && Alpine.store('lang').current === 'ID') {
          if (msg.includes('Full Name can only contain letters')) {
            return 'Nama Lengkap hanya boleh diisi huruf, spasi, titik, tanda hubung, dan petik.';
          }
          if (msg.includes('Full Name cannot exceed')) {
            return 'Nama Lengkap tidak boleh lebih dari 70 karakter.';
          }
          if (msg.includes('Phone Number must contain valid')) {
            return 'Nomor Telepon hanya boleh diisi angka (maksimal 16 karakter).';
          }
          if (msg.includes('Phone Number cannot exceed')) {
            return 'Nomor Telepon tidak boleh lebih dari 16 karakter.';
          }
          if (msg.includes('Phone Number must be at least')) {
            return 'Nomor Telepon minimal 7 digit.';
          }
          if (msg.includes('Company Name cannot exceed')) {
            return 'Nama Perusahaan tidak boleh lebih dari 100 karakter.';
          }
          if (msg.includes('already have an active consultation booking') || msg.includes('active consultation booking already exists')) {
            if (msg.includes('email')) {
              return 'Anda sudah memiliki booking konsultasi yang masih aktif dengan alamat email ini.';
            } else if (msg.includes('phone')) {
              return 'Anda sudah memiliki booking konsultasi yang masih aktif dengan nomor telepon ini.';
            }
            return 'Anda sudah memiliki booking konsultasi yang masih aktif.';
          }
          if (msg.includes('field is required') || msg.includes('required')) {
            return 'Kolom ini wajib diisi.';
          }
          if (msg.includes('valid email')) {
            return 'Silakan masukkan alamat email yang valid (harus menyertakan @ dan domain).';
          }
          if (msg.includes('valid phone')) {
            return 'Silakan masukkan nomor telepon yang valid.';
          }
          if (msg.includes('fully booked') || msg.includes('full')) {
            return 'Waktu konsultasi yang dipilih sudah penuh. Silakan pilih waktu lain.';
          }
        }
        return msg;
      },

      async submitBooking(e) {
        if (this.submitting) return;

        // Anti-spam honeypot check on frontend
        if (this.honeypot) {
          console.warn('Bot detected via honeypot.');
          window.location.href = '{{ url('/') }}';
          return;
        }

        this.submitting = true;
        this.validationErrors = {};
        this.errorMessage = '';

        const form = e.target;
        const formData = new FormData(form);

        try {
          const res = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
            }
          });

          if (res.status === 422) {
            const data = await res.json();
            if (data.errors) {
              this.validationErrors = data.errors;
            } else if (data.message) {
              this.errorMessage = data.message;
            }
            this.submitting = false;
            return;
          }

          if (!res.ok) {
            const data = await res.json().catch(() => ({}));
            let msg = data.message;
            if (!msg || msg === 'Server Error' || msg.includes('500') || msg.includes('SQLSTATE')) {
              msg = (Alpine.store('lang').current === 'ID' ? 'Terjadi kesalahan saat memproses booking Anda. Silakan coba lagi.' : 'An error occurred while processing your booking. Please try again.');
            }
            this.errorMessage = msg;
            this.submitting = false;
            return;
          }

          const data = await res.json();
          if (data.redirect) {
            window.location.href = data.redirect;
          } else if (data.booking_number) {
            window.location.href = `/ticket/${data.booking_number}`;
          } else {
            window.location.reload();
          }
        } catch (err) {
          console.error(err);
          this.errorMessage = (Alpine.store('lang').current === 'ID' ? 'Kesalahan jaringan. Silakan periksa koneksi Anda dan coba lagi.' : 'Network error. Please check your connection and try again.');
          this.submitting = false;
        }
      },

      async initComponent() {
        @if ($errors->any())
          this.$nextTick(() => {
            const section = document.getElementById('consultation');
            if (section) {
              section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
          });
        @endif
        try {
          const res = await fetch('{{ route("api.event-dates") }}');
          const data = await res.json();
          if (data.success && data.data.length > 0) {
            this.eventDates = data.data;
            let targetDate = this.eventDates.find(d => d.date === this.selectedDateString);
            if (!targetDate) {
              targetDate = this.eventDates.find(d => !d.is_full) || this.eventDates[0];
            }
            if (targetDate) {
              await this.selectDate(targetDate);
            }
          }
        } catch (e) {
          console.error(e);
          this.errorMessage = (Alpine.store('lang').current === 'ID' ? 'Tidak dapat memuat tanggal acara. Silakan coba lagi.' : 'Unable to load available event dates. Please try again.');
        } finally {
          this.loadingDates = false;
        }
      },

      async selectDate(dateObj) {
        if (dateObj.is_full) return;
        
        // Only reset time selection if changing to a different event date
        if (this.selectedDateId && this.selectedDateId !== dateObj.id) {
          this.selectedSlotId = '';
          this.selectedSlotTime = '';
        }

        this.selectedDateId = dateObj.id;
        this.selectedDateString = dateObj.date;
        this.selectedFormattedDate = dateObj.formatted_date;
        this.dateDropdownOpen = false;
        
        this.slots = [];
        this.loadingSlots = true;
        this.errorMessage = '';

        try {
          const res = await fetch(`{{ route("api.availability") }}?date=${dateObj.date}`);
          const data = await res.json();
          if (data.slots) {
            this.slots = data.slots;
            const matched = this.slots.find(s => (s.id == this.selectedSlotId || s.formatted_time === this.selectedSlotTime) && !s.is_full);
            if (matched) {
              this.selectedSlotId = matched.id;
              this.selectedSlotTime = matched.formatted_time;
            } else if (!this.selectedSlotTime) {
              this.selectedSlotId = '';
              this.selectedSlotTime = '';
            }
          }
        } catch (e) {
          console.error(e);
          this.errorMessage = (Alpine.store('lang').current === 'ID' ? 'Tidak dapat memuat waktu yang tersedia. Silakan coba lagi.' : 'Unable to load available time slots. Please try again.');
        } finally {
          this.loadingSlots = false;
        }
      },

      selectSlot(slot) {
        if (slot.is_full || !slot.is_active) return;
        this.selectedSlotId = slot.id;
        this.selectedSlotTime = slot.formatted_time;
        this.timeDropdownOpen = false;
      }
    };
  }
</script>
