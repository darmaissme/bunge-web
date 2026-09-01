<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-N2DHV5W6');</script>
  <!-- End Google Tag Manager -->

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bunge FlexiBetter — {{ $booking->status === 'cancelled' ? 'Booking Cancelled' : 'Ticket Confirmation Pass' }}</title>
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Tailwind CSS CDN & Custom CSS/JS Fallback -->
  <script src="https://cdn.tailwindcss.com"></script>
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script defer src="{{ asset('js/app.js') }}"></script>
  @endif
  
  <!-- Alpine.js CDN -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('lang', {
        current: localStorage.getItem('bunge_lang') || 'EN',
        setLang(lang) {
          this.current = lang;
          localStorage.setItem('bunge_lang', lang);
          window.dispatchEvent(new CustomEvent('bunge-lang-changed', { detail: lang }));
        }
      });
    });
  </script>

  <!-- html2canvas Library CDN for PNG Download -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <style>
    [x-cloak] { display: none !important; }
    body, p, span, button, input, select, textarea, label {
      font-family: 'NeverMind Serif Small', serif, sans-serif !important;
    }
    h1, h2, h3, h4, h5, h6 {
      font-family: 'NeverMind Serif Small', serif, sans-serif !important;
    }
    .focus-ring-standard:focus-visible {
      outline: 2px solid #D97706;
      outline-offset: 2px;
    }
  </style>
</head>
<body 
  class="bg-white min-h-screen text-slate-900 antialiased selection:bg-amber-500 selection:text-white overflow-x-hidden"
  x-data="{ 
    showCancelModal: false, 
    showRescheduleModal: false,
    isSubmitting: false, 
    errorMessage: '',
    
    // Reschedule state
    isSubmittingReschedule: false,
    isRescheduleCompleted: false,
    rescheduleErrorMessage: '',
    rescheduleSuccessMessage: '',
    eventDates: [],
    isLoadingDates: false,
    selectedDateId: '{{ $booking->event_date_id }}',
    selectedDateString: '{{ optional($booking->preferred_date)->format('Y-m-d') }}',
    selectedDateFormatted: '{{ $booking->formatted_preferred_date }}',
    slots: [],
    isLoadingSlots: false,
    selectedSlotId: '{{ $booking->event_slot_id }}',
    selectedSlotTime: '{{ $booking->formatted_preferred_time }}',
    reason: '',
    notes: '',

    init() {
      // Automatic Modal Auto-Open Handling via Query String Trigger
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get('action') === 'reschedule') {
        this.openRescheduleModal();
      } else if (urlParams.get('action') === 'cancel') {
        this.openCancelModal();
      }
    },

    openCancelModal() {
      this.errorMessage = '';
      this.reason = '';
      this.showCancelModal = true;
    },

    closeCancelModal() {
      if (!this.isSubmitting) {
        this.showCancelModal = false;
      }
    },

    submitCancel() {
      if (!this.reason.trim()) {
        this.errorMessage = 'Please select or state a reason for cancellation.';
        return;
      }
      this.isSubmitting = true;
      this.errorMessage = '';
      this.$refs.cancelForm.submit();
    },

    openRescheduleModal() {
      this.rescheduleErrorMessage = '';
      this.rescheduleSuccessMessage = '';
      this.isRescheduleCompleted = false;
      this.showRescheduleModal = true;
      if (this.eventDates.length === 0) {
        this.fetchDates();
      }
      if (this.selectedDateId && this.slots.length === 0) {
        this.fetchSlots(this.selectedDateId);
      }
    },

    closeRescheduleModal() {
      if (!this.isSubmittingReschedule) {
        this.showRescheduleModal = false;
      }
    },

    fetchDates() {
      this.isLoadingDates = true;
      fetch('/api/events/dates')
        .then(res => res.json())
        .then(data => {
          this.eventDates = data;
          this.isLoadingDates = false;
        })
        .catch(err => {
          console.error('Error fetching event dates:', err);
          this.isLoadingDates = false;
          this.rescheduleErrorMessage = 'Failed to load available dates. Please try again.';
        });
    },

    selectDate(dateObj) {
      this.selectedDateId = dateObj.id;
      this.selectedDateString = dateObj.date;
      this.selectedDateFormatted = dateObj.formatted_date;
      this.selectedSlotId = '';
      this.selectedSlotTime = '';
      this.fetchSlots(dateObj.id);
    },

    fetchSlots(dateId) {
      this.isLoadingSlots = true;
      this.slots = [];
      fetch(`/api/events/dates/${dateId}/slots`)
        .then(res => res.json())
        .then(data => {
          this.slots = data;
          this.isLoadingSlots = false;
        })
        .catch(err => {
          console.error('Error fetching slots:', err);
          this.isLoadingSlots = false;
          this.rescheduleErrorMessage = 'Failed to load slots for selected date.';
        });
    },

    selectSlot(slotObj) {
      if (slotObj.remaining_capacity <= 0 && slotObj.id != '{{ $booking->event_slot_id }}') {
        return;
      }
      this.selectedSlotId = slotObj.id;
      this.selectedSlotTime = slotObj.formatted_time;
    },

    submitReschedule() {
      if (!this.selectedDateId || !this.selectedSlotId) {
        this.rescheduleErrorMessage = 'Please select both a date and an available time slot.';
        return;
      }
      
      this.isSubmittingReschedule = true;
      this.rescheduleErrorMessage = '';

      fetch(`/ticket/{{ $booking->booking_number }}/reschedule`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          event_date_id: this.selectedDateId,
          event_slot_id: this.selectedSlotId,
          notes: this.notes
        })
      })
      .then(res => res.json())
      .then(data => {
        this.isSubmittingReschedule = false;
        if (data.success) {
          this.isRescheduleCompleted = true;
          this.rescheduleSuccessMessage = data.message || 'Booking rescheduled successfully!';
          setTimeout(() => {
            window.location.reload();
          }, 1500);
        } else {
          this.rescheduleErrorMessage = data.message || 'Failed to reschedule. Please try again.';
        }
      })
      .catch(err => {
        console.error('Reschedule error:', err);
        this.isSubmittingReschedule = false;
        this.rescheduleErrorMessage = 'A network error occurred. Please try again.';
      });
    },
    isLoadingSlots: false,
    selectedSlotId: '{{ $booking->consultation_slot_id }}',
    selectedSlotTimeFormatted: '{{ $booking->formatted_preferred_time }}',
    
    // Current booking reference
    currentDateId: '{{ $booking->event_date_id }}',
    currentSlotId: '{{ $booking->consultation_slot_id }}',
    currentDateFormatted: '{{ $booking->formatted_preferred_date }}',
    currentTimeFormatted: '{{ $booking->formatted_preferred_time }}',

    openRescheduleModal() {
      this.rescheduleErrorMessage = '';
      this.rescheduleSuccessMessage = '';
      this.isRescheduleCompleted = false;
      this.isSubmittingReschedule = false;
      this.showRescheduleModal = true;
      if (this.eventDates.length === 0) {
        this.fetchEventDates();
      }
      if (this.selectedDateString) {
        this.fetchSlots(this.selectedDateString);
      }
    },

    fetchEventDates() {
      this.isLoadingDates = true;
      fetch('{{ route('api.event-dates') }}')
        .then(res => res.json())
        .then(data => {
          this.isLoadingDates = false;
          if (data.success) {
            this.eventDates = data.data;
          }
        })
        .catch(err => {
          this.isLoadingDates = false;
        });
    },

    onDateChange(event) {
      if (this.isRescheduleCompleted) return;
      const selectedId = event.target.value;
      const foundDate = this.eventDates.find(d => String(d.id) === String(selectedId));
      if (foundDate) {
        this.selectedDateId = foundDate.id;
        this.selectedDateString = foundDate.date;
        this.selectedDateFormatted = foundDate.formatted_date;
      } else {
        this.selectedDateId = '';
        this.selectedDateString = '';
        this.selectedDateFormatted = '';
      }
      
      this.selectedSlotId = '';
      this.selectedSlotTimeFormatted = '';
      this.slots = [];
      
      if (this.selectedDateString) {
        this.fetchSlots(this.selectedDateString);
      }
    },

    fetchSlots(dateStr) {
      this.isLoadingSlots = true;
      fetch(`{{ route('api.availability') }}?date=${dateStr}`)
        .then(res => res.json())
        .then(data => {
          this.isLoadingSlots = false;
          if (data.slots) {
            this.slots = data.slots;
          }
        })
        .catch(err => {
          this.isLoadingSlots = false;
        });
    },

    onSlotChange(event) {
      if (this.isRescheduleCompleted) return;
      const slotId = event.target.value;
      const foundSlot = this.slots.find(s => String(s.id) === String(slotId));
      if (foundSlot) {
        this.selectedSlotId = foundSlot.id;
        this.selectedSlotTimeFormatted = foundSlot.formatted_time;
      } else {
        this.selectedSlotId = '';
        this.selectedSlotTimeFormatted = '';
      }
    },

    get isRescheduleValid() {
      if (!this.selectedDateId || !this.selectedSlotId) return false;
      if (this.isSubmittingReschedule || this.isRescheduleCompleted) return false;
      if (String(this.selectedDateId) === String(this.currentDateId) && String(this.selectedSlotId) === String(this.currentSlotId)) {
        return false;
      }
      return true;
    },

    confirmReschedule() {
      // Guard against double clicks & duplicate POST submissions
      if (!this.isRescheduleValid || this.isSubmittingReschedule || this.isRescheduleCompleted) return;
      
      this.isSubmittingReschedule = true;
      this.rescheduleErrorMessage = '';
      this.rescheduleSuccessMessage = '';
      
      fetch('{{ route('ticket.reschedule', $booking->booking_number) }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          event_date_id: this.selectedDateId,
          consultation_slot_id: this.selectedSlotId,
          preferred_date: this.selectedDateString,
          preferred_time: this.selectedSlotTimeFormatted
        })
      })
      .then(res => res.json().then(data => ({ status: res.status, data })))
      .then(res => {
        this.isSubmittingReschedule = false;
        if (res.data.success) {
          // 1. Immediately set form to COMPLETED success state (disables button & select inputs)
          this.isRescheduleCompleted = true;
          this.rescheduleSuccessMessage = (Alpine.store('lang') && Alpine.store('lang').current === 'ID')
            ? 'Jadwal konsultasi Anda telah berhasil diperbarui.'
            : (res.data.message || 'Your consultation schedule has been successfully updated.');
          
          // 2. Update visible ticket pass data immediately
          if (res.data.booking) {
            this.currentDateFormatted = res.data.booking.formatted_date;
            this.currentTimeFormatted = res.data.booking.formatted_time;
          } else {
            this.currentDateFormatted = this.selectedDateFormatted;
            this.currentTimeFormatted = this.selectedSlotTimeFormatted;
          }
          this.currentDateId = this.selectedDateId;
          this.currentSlotId = this.selectedSlotId;

          // 3. Automatically close modal after updated ticket data is displayed
          setTimeout(() => {
            this.showRescheduleModal = false;
          }, 1400);
        } else {
          this.isRescheduleCompleted = false;
          this.rescheduleErrorMessage = (Alpine.store('lang') && Alpine.store('lang').current === 'ID')
            ? 'Tidak dapat memperbarui konsultasi Anda. Silakan coba lagi.'
            : (res.data.message || 'Unable to update your consultation. Please try again.');
        }
      })
      .catch(err => {
        this.isSubmittingReschedule = false;
        this.isRescheduleCompleted = false;
        this.rescheduleErrorMessage = (Alpine.store('lang') && Alpine.store('lang').current === 'ID')
          ? 'Tidak dapat memperbarui konsultasi Anda. Silakan coba lagi.'
          : 'Unable to update your consultation. Please try again.';
      });
    },

    confirmCancel() {
      if (this.isSubmitting) return;
      this.isSubmitting = true;
      this.errorMessage = '';
      
      fetch('{{ route('ticket.cancel', $booking->booking_number) }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        }
      })
      .then(res => res.json().then(data => ({ status: res.status, data })))
      .then(res => {
        if (res.data.success) {
          window.location.reload();
        } else {
          this.isSubmitting = false;
          this.errorMessage = (Alpine.store('lang') && Alpine.store('lang').current === 'ID')
            ? 'Tidak dapat membatalkan booking. Silakan coba lagi.'
            : (res.data.message || 'Unable to cancel booking. Please try again.');
        }
      })
      .catch(err => {
        this.isSubmitting = false;
        this.errorMessage = (Alpine.store('lang') && Alpine.store('lang').current === 'ID')
          ? 'Tidak dapat membatalkan booking. Silakan coba lagi.'
          : 'Unable to cancel booking. Please try again.';
      });
    }
  }"
  @keydown.window.escape="showCancelModal = false; showRescheduleModal = false"
>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N2DHV5W6"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- ==================================================================== -->
  <!-- HEADER COMPONENT -->
  <!-- ==================================================================== -->
  @include('partials.header')

  <!-- ==================================================================== -->
  <!-- MAIN TICKET / CANCELLATION STATE SECTION -->
  <!-- ==================================================================== -->
  <section id="ticket-confirmation" class="relative w-full min-h-screen pt-32 sm:pt-36 lg:pt-40 pb-0 select-none overflow-hidden flex flex-col justify-between bg-white">
    <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 sm:pb-16">
      
      @if (isset($isVerified) && ! $isVerified)

        <!-- ==================================================================== -->
        <!-- UNVERIFIED DIRECT URL ACCESS GATE CARD -->
        <!-- ==================================================================== -->
        <div class="text-center mb-8 sm:mb-12">
          <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4 sm:mb-5 shadow-md">
            <div class="w-12 h-12 sm:w-15 sm:h-15 rounded-full bg-[#002D6E] flex items-center justify-center">
              <svg class="w-7 h-7 sm:w-9 sm:h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
          </div>
          <h1 class="text-3xl sm:text-4xl lg:text-4xl xl:text-5xl font-black text-[#002D6E] leading-tight tracking-tight mb-3" x-text="$store.lang.current === 'ID' ? 'Verifikasi Akses Booking' : 'Verify Booking Access'">
            Verify Booking Access
          </h1>
          <p class="text-sm sm:text-base lg:text-lg text-slate-600 font-medium leading-relaxed max-w-3xl lg:max-w-4xl mx-auto" x-text="$store.lang.current === 'ID' ? 'Silakan masukkan alamat email terdaftar Anda untuk melihat dan mengelola sesi konsultasi ini.' : 'Please enter your registered email address to view and manage this consultation session.'">
            Please enter your registered email address to view and manage this consultation session.
          </p>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl p-8 sm:p-12 text-left max-w-lg mx-auto my-8 sm:my-12 border border-slate-100">
          <form class="space-y-5" x-data="{ gateBookingNumber: '{{ $booking->booking_number }}', gateEmail: '', gateLoading: false, gateError: '' }">
            @csrf

            <template x-if="gateError">
              <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-xs">
                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span x-text="gateError"></span>
              </div>
            </template>

            <div>
              <label class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Nomor Booking' : 'Booking Number'">
                Booking Number
              </label>
              <input
                type="text"
                value="{{ $booking->booking_number }}"
                readonly
                class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3.5 text-sm sm:text-base text-slate-600 font-mono uppercase font-bold cursor-not-allowed"
              />
            </div>

            <div>
              <label for="gate_email" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Alamat Email *' : 'Email Address *'">
                Email Address *
              </label>
              <input
                type="email"
                id="gate_email"
                x-model="gateEmail"
                :placeholder="$store.lang.current === 'ID' ? 'Masukkan alamat email terdaftar' : 'Enter registered email address'"
                placeholder="Enter registered email address"
                required
                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm sm:text-base text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:bg-white"
              />
            </div>

            <div class="pt-2">
              <button
                type="button"
                @click="
                  if (!gateEmail) return;
                  gateLoading = true;
                  gateError = '';
                  fetch('{{ route('booking.manage.lookup') }}', {
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                      'Accept': 'application/json',
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ booking_number: gateBookingNumber, email: gateEmail })
                  })
                  .then(r => r.json())
                  .then(d => {
                    if (d.success) {
                      window.location.reload();
                    } else {
                      gateLoading = false;
                      gateError = d.message || ($store.lang.current === 'ID' ? 'Detail booking tidak ditemukan.' : 'We couldn\'t find a booking matching those details.');
                    }
                  })
                  .catch(e => {
                    gateLoading = false;
                    gateError = $store.lang.current === 'ID' ? 'Terjadi kesalahan. Silakan coba lagi.' : 'Something went wrong. Please try again.';
                  })
                "
                :disabled="gateLoading || !gateEmail"
                class="w-full bg-[#002D6E] hover:bg-[#001D48] text-white py-4 px-6 rounded-full font-bold text-base sm:text-lg transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer"
              >
                <span x-show="!gateLoading" x-text="$store.lang.current === 'ID' ? 'VERIFIKASI & LIHAT BOOKING' : 'VERIFY & VIEW BOOKING'">VERIFY & VIEW BOOKING</span>
                <span x-show="gateLoading" class="flex items-center gap-2" style="display: none;">
                  <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  <span x-text="$store.lang.current === 'ID' ? 'Memverifikasi...' : 'Verifying...'">Verifying...</span>
                </span>
              </button>
            </div>
          </form>
        </div>

      @elseif ($booking->status === 'cancelled')

        <!-- ==================================================================== -->
        <!-- CANCELLED BOOKING STATE (COMPLETE TICKET REMOVAL) -->
        <!-- ==================================================================== -->
        <div class="text-center mb-8 sm:mb-12">
          <!-- Red X Circle Badge for Cancelled State -->
          <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white flex items-center justify-center mx-auto mb-4 sm:mb-5 shadow-xl">
            <div class="w-12 h-12 sm:w-15 sm:h-15 rounded-full bg-rose-600 flex items-center justify-center">
              <svg class="w-7 h-7 sm:w-9 sm:h-9 text-white stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </div>
          </div>

          <!-- CANCELLED Pill Badge -->
          <div class="inline-block mb-3 sm:mb-4">
            <span class="bg-rose-600 text-white text-xs sm:text-sm font-extrabold px-4 sm:px-5 py-1 sm:py-1.5 rounded-full uppercase tracking-wider shadow-sm" x-text="$store.lang.current === 'ID' ? 'DIBATALKAN' : 'CANCELLED'">
              CANCELLED
            </span>
          </div>

          <!-- Main Title for Cancelled State -->
          <h1 class="text-3xl sm:text-4xl lg:text-4xl xl:text-5xl font-black text-[#002D6E] leading-tight tracking-tight mb-3 sm:mb-4" x-text="$store.lang.current === 'ID' ? 'Booking Dibatalkan' : 'Booking Cancelled'">
            Booking Cancelled
          </h1>

          <!-- Subtitle for Cancelled State -->
          <p class="text-sm sm:text-base lg:text-lg text-slate-600 font-medium leading-relaxed max-w-3xl lg:max-w-4xl mx-auto" x-text="$store.lang.current === 'ID' ? 'Booking ini telah dibatalkan. Waktu konsultasi untuk sesi ini telah tersedia kembali.' : 'This booking has been cancelled. The consultation slot for this session has been released back into availability.'">
            This booking has been cancelled. The consultation slot for this session has been released back into availability.
          </p>
        </div>

        <!-- CLEAN CANCELLED STATE CARD (REPLACES TICKET PREVIEW) -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 sm:p-12 text-center max-w-2xl mx-auto my-8 sm:my-12 border border-slate-100">
          <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-6 border border-rose-100">
            <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
          </div>

          <span class="block text-xs sm:text-sm font-mono font-bold text-slate-400 uppercase tracking-widest mb-1.5">
            <span x-text="$store.lang.current === 'ID' ? 'REF BOOKING:' : 'BOOKING REF:'">BOOKING REF:</span> {{ $booking->booking_number }}
          </span>

          <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight mb-3 sm:mb-4" x-text="$store.lang.current === 'ID' ? 'Booking Dibatalkan' : 'Booking Cancelled'">
            Booking Cancelled
          </h2>

          <p class="text-sm sm:text-base lg:text-lg font-medium text-slate-600 leading-relaxed mb-8 sm:mb-10 max-w-lg mx-auto" x-text="$store.lang.current === 'ID' ? 'Booking ini telah dibatalkan. Waktu konsultasi untuk sesi ini telah tersedia kembali.' : 'This booking has been cancelled. The consultation slot for this session has been released back into availability.'">
            This booking has been cancelled. The consultation slot for this session has been released back into availability.
          </p>

          <!-- CANCELLED STATE ACTION BUTTONS -->
          <div class="flex flex-col-reverse sm:flex-row items-center justify-center gap-3.5 sm:gap-5 max-w-xl mx-auto">
            <!-- Secondary CTA: BACK TO HOME -->
            <a
              href="{{ url('/') }}"
              class="w-full sm:w-auto min-w-[180px] bg-slate-100 hover:bg-slate-200 active:scale-[0.98] text-slate-700 border border-slate-300 py-3.5 px-6 sm:px-8 rounded-full font-extrabold text-xs sm:text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer no-underline whitespace-nowrap"
            >
              <span x-text="$store.lang.current === 'ID' ? 'KEMBALI KE BERANDA' : 'BACK TO HOME'">BACK TO HOME</span>
            </a>

            <!-- Primary CTA: BOOK ANOTHER SESSION -->
            <a
              href="{{ url('/#consultation') }}"
              class="w-full sm:w-auto min-w-[220px] bg-[#002D6E] hover:bg-[#001D48] active:scale-[0.98] text-white py-3.5 px-6 sm:px-8 rounded-full font-extrabold text-xs sm:text-sm shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer no-underline whitespace-nowrap"
            >
              <span x-text="$store.lang.current === 'ID' ? 'BOOKING SESI LAIN' : 'BOOK ANOTHER SESSION'">BOOK ANOTHER SESSION</span>
            </a>
          </div>
        </div>

      @else

        <!-- ==================================================================== -->
        <!-- ACTIVE CONFIRMED TICKET PASS STATE -->
        <!-- ==================================================================== -->
        <div class="text-center mb-8 sm:mb-12">
          <!-- Green Checkmark Circle Badge for Confirmed State -->
          <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-4 sm:mb-5 shadow-md border border-emerald-100">
            <div class="w-12 h-12 sm:w-15 sm:h-15 rounded-full bg-[#10B981] flex items-center justify-center">
              <svg class="w-7 h-7 sm:w-9 sm:h-9 text-white stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
              </svg>
            </div>
          </div>

          <!-- CONFIRMED Pill Badge -->
          <div class="inline-block mb-3 sm:mb-4">
            <span class="bg-[#10B981] text-white text-xs sm:text-sm font-extrabold px-4 sm:px-5 py-1 sm:py-1.5 rounded-full uppercase tracking-wider shadow-xs" x-text="$store.lang.current === 'ID' ? 'DIKONFIRMASI' : 'CONFIRMED'">
              {{ strtoupper($booking->status ?? 'CONFIRMED') }}
            </span>
          </div>

          <!-- Main Title -->
          <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-black text-[#002D6E] leading-tight tracking-tight mb-3 sm:mb-4" x-text="$store.lang.current === 'ID' ? 'Sesi Konsultasi Anda Telah Dikonfirmasi' : 'Your Consultation Session Has Been Confirmed'">
            Your Consultation Session Has Been Confirmed
          </h1>

          <!-- Subtitle -->
          <p class="text-sm sm:text-base lg:text-lg text-slate-600 font-medium leading-relaxed max-w-3xl lg:max-w-4xl mx-auto" x-text="$store.lang.current === 'ID' ? 'Terima kasih telah menjadwalkan konsultasi dengan tim Bunge. Kami siap menyambut Anda di Fi Asia Indonesia 2026.' : 'Thank you for scheduling a consultation with the Bunge team. We look forward to seeing you at Fi Asia Indonesia 2026.'">
            Thank you for scheduling a consultation with the Bunge team. We look forward to seeing you at Fi Asia Indonesia 2026.
          </p>
        </div>

        <!-- TICKET PASS CARD (CLEAN SHADOW & BORDER ON WHITE BG) -->
        <div id="ticket-card" class="relative bg-white rounded-3xl shadow-xl border border-slate-200/80 overflow-hidden mb-8 sm:mb-10">
          
          <!-- TICKET CARD HEADER BAR -->
          <div class="bg-[#004B99] px-6 sm:px-8 py-5 sm:py-6 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
              <span class="block text-[11px] sm:text-xs font-black tracking-widest text-white/80 uppercase mb-0.5">
                BUNGE
              </span>
              <h2 class="text-lg sm:text-xl lg:text-2xl font-black tracking-tight" x-text="$store.lang.current === 'ID' ? 'Tiket Konsultasi Bunge FlexiBetter' : 'Bunge FlexiBetter Consultation Pass'">
                Bunge FlexiBetter Consultation Pass
              </h2>
            </div>
            <div class="flex items-center justify-between sm:justify-end gap-3 pt-1 sm:pt-0 border-t border-white/10 sm:border-none">
              <span id="ticket-status-badge" class="inline-flex items-center justify-center leading-none bg-[#10B981] text-white text-[11px] sm:text-xs font-extrabold h-6 px-3.5 rounded-full uppercase tracking-wider text-center" x-text="$store.lang.current === 'ID' ? 'DIKONFIRMASI' : 'CONFIRMED'">
                {{ strtoupper($booking->status ?? 'CONFIRMED') }}
              </span>
              <span class="font-mono font-bold text-xs sm:text-sm text-white/90 tracking-wide">
                {{ $booking->booking_number }}
              </span>
            </div>
          </div>

          <!-- TICKET CARD CONTENT BODY -->
          <div class="p-5 sm:p-6 lg:p-7 space-y-5 sm:space-y-6">
            
            <!-- SECTION 1: VISITOR INFORMATION -->
            <div>
              <h3 class="text-xs sm:text-sm font-black text-[#002D6E] uppercase tracking-wider mb-3" x-text="$store.lang.current === 'ID' ? 'INFORMASI PENGUNJUNG' : 'VISITOR INFORMATION'">
                VISITOR INFORMATION
              </h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-2.5 sm:gap-y-3 gap-x-6">
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'NAMA LENGKAP' : 'FULL NAME'">
                    FULL NAME
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                    {{ $booking->full_name }}
                  </span>
                </div>
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'TELEPON' : 'PHONE'">
                    PHONE
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                    {{ $booking->phone }}
                  </span>
                </div>
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'PERUSAHAAN' : 'COMPANY'">
                    COMPANY
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                    {{ $booking->company }}
                  </span>
                </div>
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'INDUSTRI' : 'INDUSTRY'">
                    INDUSTRY
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                    {{ $booking->industry }}
                  </span>
                </div>
                <div class="sm:col-span-2 lg:col-span-2">
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'EMAIL' : 'EMAIL'">
                    EMAIL
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 break-all leading-tight">
                    {{ $booking->email }}
                  </span>
                </div>
              </div>
            </div>

            <!-- DASHED SEPARATOR WITH SIDE NOTCHES -->
            <div class="relative -mx-5 sm:-mx-6 lg:-mx-7 my-3 h-4 flex items-center">
              <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-white border-r border-slate-200/80"></div>
              <div class="w-full border-b-2 border-dashed border-slate-200"></div>
              <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-white border-l border-slate-200/80"></div>
            </div>

            <!-- SECTION 2: CONSULTATION INFORMATION -->
            <div>
              <h3 class="text-xs sm:text-sm font-black text-[#002D6E] uppercase tracking-wider mb-3" x-text="$store.lang.current === 'ID' ? 'INFORMASI KONSULTASI' : 'CONSULTATION INFORMATION'">
                CONSULTATION INFORMATION
              </h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-2.5 sm:gap-y-3 gap-x-6">
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'TOPIK DISKUSI' : 'DISCUSSION TOPIC'">
                    DISCUSSION TOPIC
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                    {{ $booking->discussion_topic }}
                  </span>
                </div>
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'SPESIALIS' : 'SPECIALIST'">
                    SPECIALIST
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight" x-text="$store.lang.current === 'ID' ? '{{ $booking->specialist ? $booking->specialist : 'Akan ditentukan' }}' : '{{ $booking->specialist ? $booking->specialist : 'To be assigned' }}'">
                    {{ $booking->specialist ?? 'To be assigned' }}
                  </span>
                </div>
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'TANGGAL' : 'DATE'">
                    DATE
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight" x-text="currentDateFormatted">
                    {{ $booking->formatted_preferred_date }}
                  </span>
                </div>
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'WAKTU' : 'TIME'">
                    TIME
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight" x-text="currentTimeFormatted">
                    {{ $booking->formatted_preferred_time }}
                  </span>
                </div>
                <div>
                  <span class="block text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-0.5" x-text="$store.lang.current === 'ID' ? 'DURASI' : 'DURATION'">
                    DURATION
                  </span>
                  <span class="block text-sm sm:text-base font-extrabold text-slate-900 leading-tight" x-text="$store.lang.current === 'ID' ? '30 Menit' : '30 Minutes'">
                    {{ $booking->duration ?? '30 Menit' }}
                  </span>
                </div>
              </div>
            </div>

            <!-- DASHED SEPARATOR WITH SIDE NOTCHES -->
            <div class="relative -mx-5 sm:-mx-6 lg:-mx-7 my-3 h-4 flex items-center">
              <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/2 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-white border-r border-slate-200/80"></div>
              <div class="w-full border-b-2 border-dashed border-slate-200"></div>
              <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-white border-l border-slate-200/80"></div>
            </div>

            <!-- SECTION 3: EVENT INFORMATION & BEFORE YOU ARRIVE (2 COLS) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 pt-1">
              
              <!-- Left Col: EVENT INFORMATION -->
              <div>
                <h3 class="text-xs sm:text-sm font-black text-[#002D6E] uppercase tracking-wider mb-3" x-text="$store.lang.current === 'ID' ? 'INFORMASI ACARA' : 'EVENT INFORMATION'">
                  EVENT INFORMATION
                </h3>
                <ul class="space-y-2.5">
                  <li class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                      <svg class="w-4 h-4 text-[#002D6E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                      </svg>
                    </div>
                    <span class="text-sm sm:text-base font-extrabold text-slate-800 pt-1">
                      {{ config('event.location', 'JIExpo Hall D2 · Booth D2A48') }}
                    </span>
                  </li>

                  <li class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                      <svg class="w-4 h-4 text-[#002D6E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                      </svg>
                    </div>
                    <span class="text-sm sm:text-base font-extrabold text-slate-800 pt-1">
                      {{ config('event.dates', '16–18 September 2026') }}
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

              <!-- Right Col: BEFORE YOU ARRIVE -->
              <div class="pt-4 lg:pt-0 border-t lg:border-t-0 border-slate-100 lg:pl-6 lg:border-l lg:border-slate-100">
                <h3 class="text-xs sm:text-sm font-black text-[#D97706] uppercase tracking-wider mb-3" x-text="$store.lang.current === 'ID' ? 'SEBELUM KEDATANGAN ANDA' : 'BEFORE YOU ARRIVE'">
                  BEFORE YOU ARRIVE
                </h3>
                <ul class="space-y-2">
                  <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                      <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug" x-text="$store.lang.current === 'ID' ? 'Datang 10–15 menit sebelum sesi Anda' : 'Arrive 10–15 minutes before your session'">
                      Arrive 10–15 minutes before your session
                    </span>
                  </li>

                  <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                      <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug" x-text="$store.lang.current === 'ID' ? 'Tunjukkan ID Booking atau Tiket Konsultasi Anda' : 'Show your Booking ID or Consultation Pass'">
                      Show your Booking ID or Consultation Pass
                    </span>
                  </li>

                  <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                      <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug" x-text="$store.lang.current === 'ID' ? 'Kunjungi Stan Bunge D2A48' : 'Visit Bunge Booth D2A48'">
                      Visit Bunge Booth D2A48
                    </span>
                  </li>

                  <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-[#EEF5F0] flex items-center justify-center shrink-0 mt-0.5">
                      <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                      </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-semibold text-slate-700 leading-snug" x-text="$store.lang.current === 'ID' ? 'Hubungi meja resepsionis Bunge jika memerlukan bantuan' : 'Contact the Bunge reception desk if you need assistance'">
                      Contact the Bunge reception desk if you need assistance
                    </span>
                  </li>
                </ul>
              </div>

            </div>

          </div>

        </div>

        <!-- PRIMARY ACTION BUTTONS -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-6">
          <a
            href="{{ route('ticket.pdf', $booking->booking_number) }}"
            class="w-full sm:w-auto bg-[#002D6E] hover:bg-[#001D48] active:scale-[0.99] text-white py-3.5 px-8 rounded-full font-bold text-sm sm:text-base shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer no-underline"
          >
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
            </svg>
            <span x-text="$store.lang.current === 'ID' ? 'UNDUH PDF' : 'DOWNLOAD PDF'">DOWNLOAD PDF</span>
          </a>

          <button
            type="button"
            id="btn-download-image"
            onclick="downloadTicketImage()"
            class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 active:scale-[0.99] text-[#002D6E] border border-slate-300 py-3.5 px-8 rounded-full font-bold text-sm sm:text-base shadow-xs transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer"
          >
            <svg class="w-5 h-5 text-[#002D6E]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
            </svg>
            <span x-text="$store.lang.current === 'ID' ? 'UNDUH GAMBAR' : 'DOWNLOAD IMAGE'">DOWNLOAD IMAGE</span>
          </button>
        </div>

        <!-- SECONDARY LINKS FOR CONFIRMED PASS -->
        <div class="text-center space-y-3 mb-8">
          <div class="flex items-center justify-center gap-6 text-sm font-extrabold text-[#002D6E]">
            <a href="javascript:void(0)" onclick="addToCalendar()" class="underline hover:text-[#0E529B] transition-colors duration-200 cursor-pointer" x-text="$store.lang.current === 'ID' ? 'Tambah ke Kalender' : 'Add to Calendar'">
              Add to Calendar
            </a>
            <a href="{{ url('/') }}" class="underline hover:text-[#0E529B] transition-colors duration-200" x-text="$store.lang.current === 'ID' ? 'Kembali ke Beranda' : 'Back to Home'">
              Back to Home
            </a>
          </div>

          <div class="flex items-center justify-center gap-4 text-xs font-semibold text-slate-400">
            <button 
              type="button" 
              @click="openRescheduleModal()" 
              class="text-slate-600 hover:text-[#002D6E] font-bold transition-colors duration-200 cursor-pointer bg-transparent border-0 p-0 underline"
              x-text="$store.lang.current === 'ID' ? 'Jadwalkan Ulang Booking' : 'Reschedule Booking'"
            >
              Reschedule Booking
            </button>
            <span>·</span>
            <button 
              type="button" 
              @click="showCancelModal = true" 
              class="text-slate-600 hover:text-rose-600 font-bold transition-colors duration-200 cursor-pointer bg-transparent border-0 p-0 underline"
              x-text="$store.lang.current === 'ID' ? 'Batalkan Booking' : 'Cancel Booking'"
            >
              Cancel Booking
            </button>
          </div>
        </div>

      @endif

    </div>

    @if ($booking->status !== 'cancelled')
      <!-- BOTTOM DISCLAIMER BANNER (100% FULL WIDTH, CLEAN ON WHITE) -->
      <div class="w-full bg-slate-50 border-t border-b border-slate-200/80 py-3.5 px-4 text-center">
        <p class="text-xs sm:text-sm font-semibold text-slate-600 flex items-center justify-center gap-2">
          <svg class="w-4 h-4 text-[#002D6E] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
          </svg>
          <span x-text="$store.lang.current === 'ID' ? 'Anda juga dapat mengambil tangkapan layar (screenshot) halaman ini dan menunjukkannya saat check-in di stan Bunge.' : 'You can also take a screenshot of this page and show it when checking in at the Bunge booth.'">You can also take a screenshot of this page and show it when checking in at the Bunge booth.</span>
        </p>
      </div>
    @endif
  </section>

  <!-- ==================================================================== -->
  <!-- CANCELLATION CONFIRMATION MODAL -->
  <!-- ==================================================================== -->
  @if ($booking->status !== 'cancelled')
    <div 
      x-show="showCancelModal" 
      x-cloak 
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto bg-slate-900/60 backdrop-blur-sm"
      @click.self="showCancelModal = false"
      role="dialog"
      aria-modal="true"
      aria-labelledby="cancel-modal-title"
    >
      <div 
        x-show="showCancelModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100 my-auto"
      >
        <!-- Modal Header -->
        <div class="p-6 sm:p-8 pb-4 text-center">
          <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-4 border border-rose-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
            </svg>
          </div>

          <h3 id="cancel-modal-title" class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-2" x-text="$store.lang.current === 'ID' ? 'Batalkan Konsultasi Anda?' : 'Cancel Your Consultation?'">
            Cancel Your Consultation?
          </h3>
          
          <p class="text-xs sm:text-sm font-medium text-slate-600 leading-relaxed" x-text="$store.lang.current === 'ID' ? 'Apakah Anda yakin ingin membatalkan booking konsultasi ini? Booking Anda akan ditandai sebagai dibatalkan dan waktu konsultasi yang dipilih akan tersedia kembali.' : 'Are you sure you want to cancel this consultation booking? Your booking will be marked as cancelled and the selected consultation slot will become available again.'">
            Are you sure you want to cancel this consultation booking? Your booking will be marked as cancelled and the selected consultation slot will become available again.
          </p>
        </div>

        <!-- Booking Details Box -->
        <div class="px-6 sm:px-8 py-4 bg-slate-50 border-y border-slate-100">
          <div class="space-y-2.5 text-xs sm:text-sm">
            <div class="flex justify-between items-center">
              <span class="font-bold text-slate-500 uppercase tracking-wider text-[11px]" x-text="$store.lang.current === 'ID' ? 'Nomor Booking:' : 'Booking Number:'">Booking Number:</span>
              <span class="font-mono font-extrabold text-[#002D6E]">{{ $booking->booking_number }}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="font-bold text-slate-500 uppercase tracking-wider text-[11px]" x-text="$store.lang.current === 'ID' ? 'Tanggal:' : 'Date:'">Date:</span>
              <span class="font-extrabold text-slate-800" x-text="currentDateFormatted">{{ $booking->formatted_preferred_date }}</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="font-bold text-slate-500 uppercase tracking-wider text-[11px]" x-text="$store.lang.current === 'ID' ? 'Waktu:' : 'Time:'">Time:</span>
              <span class="font-extrabold text-slate-800" x-text="currentTimeFormatted">{{ $booking->formatted_preferred_time }}</span>
            </div>
          </div>
        </div>

        <!-- Error Alert Message -->
        <template x-if="errorMessage">
          <div class="px-6 sm:px-8 pt-4">
            <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-bold flex items-center gap-2">
              <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
              </svg>
              <span x-text="errorMessage"></span>
            </div>
          </div>
        </template>

        <!-- Modal Action Buttons -->
        <div class="p-6 sm:p-8 pt-6 flex flex-col-reverse sm:flex-row items-center gap-3">
          <button
            type="button"
            @click="showCancelModal = false"
            :disabled="isSubmitting"
            class="w-full sm:w-1/2 py-3 px-5 rounded-full border border-slate-300 hover:bg-slate-100 text-slate-700 font-extrabold text-xs sm:text-sm transition-all duration-200 cursor-pointer disabled:opacity-50"
            x-text="$store.lang.current === 'ID' ? 'Pertahankan Booking Saya' : 'Keep My Booking'"
          >
            Keep My Booking
          </button>

          <button
            type="button"
            @click="confirmCancel()"
            :disabled="isSubmitting"
            class="w-full sm:w-1/2 py-3 px-5 rounded-full bg-rose-600 hover:bg-rose-700 active:scale-[0.98] text-white font-extrabold text-xs sm:text-sm shadow-md transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50"
          >
            <template x-if="isSubmitting">
              <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </template>
            <span x-text="isSubmitting ? ($store.lang.current === 'ID' ? 'Membatalkan booking...' : 'Cancelling booking...') : ($store.lang.current === 'ID' ? 'Batalkan Booking' : 'Cancel Booking')"></span>
          </button>
        </div>
      </div>
    </div>
  @endif

  <!-- ==================================================================== -->
  <!-- RESCHEDULE CONSULTATION MODAL -->
  <!-- ==================================================================== -->
  @if ($booking->status !== 'cancelled')
    <div 
      x-show="showRescheduleModal" 
      x-cloak 
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto bg-slate-900/60 backdrop-blur-sm"
      @click.self="showRescheduleModal = false"
      role="dialog"
      aria-modal="true"
      aria-labelledby="reschedule-modal-title"
    >
      <div 
        x-show="showRescheduleModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="bg-white rounded-3xl shadow-2xl max-w-lg w-full p-6 sm:p-8 relative border border-slate-100 text-left my-auto"
      >
        <!-- Close Modal Button -->
        <button 
          type="button" 
          @click="showRescheduleModal = false" 
          :disabled="isSubmittingReschedule || isRescheduleCompleted"
          class="absolute top-5 right-5 text-slate-400 hover:text-slate-600 p-1.5 rounded-full hover:bg-slate-100 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
          aria-label="Close modal"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

        <!-- Modal Header -->
        <div class="mb-6 text-center">
          <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-3 border border-amber-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
            </svg>
          </div>
          <h3 id="reschedule-modal-title" class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight" x-text="$store.lang.current === 'ID' ? 'Jadwalkan Ulang Konsultasi' : 'Reschedule Your Consultation'">
            Reschedule Your Consultation
          </h3>
          <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
            <span x-text="$store.lang.current === 'ID' ? 'Ref Booking:' : 'Booking Ref:'">Booking Ref:</span> <span class="font-mono font-bold text-[#002D6E]">{{ $booking->booking_number }}</span>
          </p>
        </div>

        <!-- Read-Only Current Schedule Card -->
        <div class="bg-slate-50 rounded-2xl p-4 mb-5 border border-slate-200/80">
          <span class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-1" x-text="$store.lang.current === 'ID' ? 'Jadwal Saat Ini' : 'Current Schedule'">
            Current Schedule
          </span>
          <div class="flex items-center gap-2.5 text-slate-800 font-extrabold text-sm sm:text-base">
            <svg class="w-4 h-4 text-[#002D6E] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <span x-text="currentDateFormatted + ' • ' + currentTimeFormatted">{{ $booking->formatted_preferred_date }} &bull; {{ $booking->formatted_preferred_time }}</span>
          </div>
        </div>

        <!-- Reschedule Form Controls (Compact Dropdown UI) -->
        <div class="space-y-4 mb-5">
          <!-- NEW EVENT DATE SELECT -->
          <div>
            <label for="reschedule_date" class="block text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5" x-text="$store.lang.current === 'ID' ? 'Tanggal Acara Baru' : 'New Event Date'">
              New Event Date
            </label>
            <select
              id="reschedule_date"
              :value="selectedDateId"
              @change="onDateChange($event)"
              :disabled="isSubmittingReschedule || isRescheduleCompleted"
              class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-sm font-semibold text-slate-800 focus:border-[#002D6E] focus:ring-2 focus:ring-[#002D6E]/20 transition-all cursor-pointer disabled:bg-slate-100 disabled:cursor-not-allowed"
            >
              <option value="" disabled x-text="$store.lang.current === 'ID' ? '-- Pilih Tanggal Acara --' : '-- Select Event Date --'">-- Select Event Date --</option>
              <template x-for="dateItem in eventDates" :key="dateItem.id">
                <option :value="dateItem.id" x-text="dateItem.formatted_date + (dateItem.is_full ? ($store.lang.current === 'ID' ? ' (Sudah Penuh)' : ' (FULL)') : '')"></option>
              </template>
            </select>
          </div>

          <!-- NEW CONSULTATION TIME SELECT -->
          <div>
            <label for="reschedule_slot" class="block text-xs font-extrabold uppercase tracking-wider text-slate-700 mb-1.5" x-text="$store.lang.current === 'ID' ? 'Waktu Konsultasi Baru' : 'New Consultation Time'">
              New Consultation Time
            </label>
            <select
              id="reschedule_slot"
              :value="selectedSlotId"
              @change="onSlotChange($event)"
              :disabled="isSubmittingReschedule || isLoadingSlots || !selectedDateId || isRescheduleCompleted"
              class="w-full bg-white border border-slate-300 rounded-xl px-4 py-3 text-sm font-semibold text-slate-800 focus:border-[#002D6E] focus:ring-2 focus:ring-[#002D6E]/20 transition-all cursor-pointer disabled:bg-slate-100 disabled:cursor-not-allowed"
            >
              <option value="" disabled x-text="isLoadingSlots ? ($store.lang.current === 'ID' ? 'Memuat waktu tersedia...' : 'Loading available times...') : (!selectedDateId ? ($store.lang.current === 'ID' ? '-- Pilih Tanggal Terlebih Dahulu --' : '-- Select Date First --') : ($store.lang.current === 'ID' ? '-- Pilih Waktu Konsultasi --' : '-- Select Consultation Time --'))"></option>
              <template x-for="slotItem in slots" :key="slotItem.id">
                <option 
                  :value="slotItem.id" 
                  :disabled="!slotItem.is_active || (slotItem.available <= 0 && !(String(selectedDateId) === String(currentDateId) && String(slotItem.id) === String(currentSlotId)))"
                  x-text="slotItem.formatted_time + (String(selectedDateId) === String(currentDateId) && String(slotItem.id) === String(currentSlotId) ? ($store.lang.current === 'ID' ? ' — Booking saat ini' : ' — Current Booking') : (slotItem.available <= 0 ? ($store.lang.current === 'ID' ? ' — Sudah Penuh' : ' — FULL') : ' — ' + slotItem.available + ($store.lang.current === 'ID' ? ' tersedia' : ' available')))"
                ></option>
              </template>
            </select>
          </div>
        </div>

        <!-- NEW SCHEDULE PREVIEW -->
        <div x-show="selectedDateFormatted && selectedSlotTimeFormatted && !(String(selectedDateId) === String(currentDateId) && String(selectedSlotId) === String(currentSlotId))" class="bg-amber-50/80 rounded-2xl p-4 mb-5 border border-amber-200/80">
          <span class="block text-[11px] font-extrabold uppercase tracking-wider text-amber-700 mb-1" x-text="$store.lang.current === 'ID' ? 'Pratinjau Jadwal Baru' : 'New Schedule Preview'">
            New Schedule Preview
          </span>
          <div class="flex items-center gap-2 text-amber-900 font-extrabold text-sm sm:text-base">
            <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
            </svg>
            <span x-text="selectedDateFormatted + ' • ' + selectedSlotTimeFormatted"></span>
          </div>
        </div>

        <!-- Same Schedule Helper Warning -->
        <div x-show="selectedDateId && selectedSlotId && String(selectedDateId) === String(currentDateId) && String(selectedSlotId) === String(currentSlotId)" class="bg-slate-100 rounded-xl p-3 mb-5 text-center text-xs font-bold text-slate-500" x-text="$store.lang.current === 'ID' ? 'Ini sudah menjadi jadwal Anda saat ini.' : 'This is already your current schedule.'">
          This is already your current schedule.
        </div>

        <!-- Error Message Alert -->
        <div x-show="rescheduleErrorMessage" x-cloak class="mb-4 p-3.5 bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2">
          <svg class="w-4 h-4 shrink-0 text-rose-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
          </svg>
          <span x-text="rescheduleErrorMessage"></span>
        </div>

        <!-- Success Message Alert -->
        <div x-show="rescheduleSuccessMessage" x-cloak class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2">
          <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
          </svg>
          <span x-text="rescheduleSuccessMessage"></span>
        </div>

        <!-- Modal Action Buttons -->
        <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-2">
          <button 
            type="button" 
            @click="showRescheduleModal = false" 
            :disabled="isSubmittingReschedule || isRescheduleCompleted"
            class="w-full sm:w-auto px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-full font-bold text-xs sm:text-sm transition-colors cursor-pointer border border-slate-200 disabled:opacity-50 disabled:cursor-not-allowed"
            x-text="$store.lang.current === 'ID' ? 'PERTAHANKAN JADWAL SAAT INI' : 'KEEP CURRENT SCHEDULE'"
          >
            KEEP CURRENT SCHEDULE
          </button>
          
          <button 
            type="button" 
            @click="confirmReschedule()" 
            :disabled="!isRescheduleValid || isSubmittingReschedule || isRescheduleCompleted"
            class="w-full sm:w-auto px-6 py-3 bg-[#002D6E] hover:bg-[#001D48] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed disabled:active:scale-100 text-white rounded-full font-extrabold text-xs sm:text-sm shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer"
          >
            <template x-if="isSubmittingReschedule">
              <span class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span x-text="$store.lang.current === 'ID' ? 'Memperbarui konsultasi Anda...' : 'Updating your consultation...'">Updating your consultation...</span>
              </span>
            </template>
            <template x-if="isRescheduleCompleted && !isSubmittingReschedule">
              <span x-text="$store.lang.current === 'ID' ? 'JADWAL DIPERBARUI' : 'SCHEDULE UPDATED'">SCHEDULE UPDATED</span>
            </template>
            <template x-if="!isSubmittingReschedule && !isRescheduleCompleted">
              <span x-text="$store.lang.current === 'ID' ? 'KONFIRMASI JADWAL ULANG' : 'CONFIRM RESCHEDULE'">CONFIRM RESCHEDULE</span>
            </template>
          </button>
        </div>
      </div>
    </div>
  @endif

  <!-- ==================================================================== -->
  <!-- FOOTER SECTION -->
  <!-- ==================================================================== -->
  @include('partials.footer')

  <!-- JS ENGINE: IMAGE & CALENDAR DOWNLOAD -->
  @if ($booking->status !== 'cancelled')
    <script>
      function addToCalendar() {
        const bookingNumber = "{{ $booking->booking_number }}";
        const dateStr = "{{ $booking->preferred_date ? $booking->preferred_date->format('Y-m-d') : '2026-09-17' }}";
        const timeStr = "{{ $booking->preferred_time ?? '10:00 AM' }}";
        const topic = "{{ addslashes($booking->discussion_topic ?? 'Consultation Session') }}";
        
        let cleanDate = dateStr.replace(/-/g, '');
        if (!cleanDate || cleanDate.length !== 8) {
          cleanDate = '20260917';
        }
        
        let startTime = '100000';
        let endTime = '103000';
        
        if (timeStr.includes('11:00') || timeStr.includes('11.00')) {
          startTime = '110000';
          endTime = '113000';
        } else if (timeStr.includes('14:00') || timeStr.includes('14.00') || timeStr.includes('2:00')) {
          startTime = '140000';
          endTime = '143000';
        } else if (timeStr.includes('09:00') || timeStr.includes('09.00') || timeStr.includes('9:00')) {
          startTime = '090000';
          endTime = '093000';
        }

        const startIso = cleanDate + 'T' + startTime;
        const endIso = cleanDate + 'T' + endTime;

        const icsContent = 
  `BEGIN:VCALENDAR
  VERSION:2.0
  PRODID:-//Bunge FlexiBetter//Consultation Session//EN
  CALSCALE:GREGORIAN
  METHOD:REQUEST
  BEGIN:VEVENT
  UID:bunge-consultation-${bookingNumber}@danlainlain.id
  DTSTAMP:${startIso}Z
  DTSTART:${startIso}
  DTEND:${endIso}
  SUMMARY:Bunge FlexiBetter Consultation Session (${bookingNumber})
  DESCRIPTION:Bunge FlexiBetter Consultation Session at FI Asia Indonesia 2026.\\nBooking ID: ${bookingNumber}\\nTopic: ${topic}\\nSpecialist: Bunge Specialist Team
  LOCATION:JIExpo Hall D2 · Booth D2A48\\, Jakarta\\, Indonesia
  STATUS:CONFIRMED
  END:VEVENT
  END:VCALENDAR`;

        const blob = new Blob([icsContent], { type: 'text/calendar;charset=utf-8;' });
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `Bunge-Consultation-${bookingNumber}.ics`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }

      function downloadTicketImage() {
        const btn = document.getElementById('btn-download-image');
        if (!btn) return;
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="animate-pulse font-bold">Generating PNG...</span>';
        btn.disabled = true;

        const ticketElement = document.getElementById('ticket-card');
        if (!ticketElement) {
          alert('Ticket card element not found');
          btn.innerHTML = originalHtml;
          btn.disabled = false;
          return;
        }

        html2canvas(ticketElement, {
          scale: 2,
          useCORS: true,
          backgroundColor: null,
          logging: false,
          onclone: (clonedDoc) => {
            const badge = clonedDoc.getElementById('ticket-status-badge');
            if (badge) {
              badge.style.transform = 'translateY(3px)';
              badge.style.marginTop = '3px';
            }
          }
        }).then(canvas => {
          const image = canvas.toDataURL('image/png');
          const link = document.createElement('a');
          link.download = 'Bunge-FlexiBetter-Ticket-{{ $booking->booking_number }}.png';
          link.href = image;
          link.click();

          btn.innerHTML = originalHtml;
          btn.disabled = false;
        }).catch(err => {
          console.error('Image export failed:', err);
          alert('Gagal mengunduh gambar tiket. Silakan gunakan tombol DOWNLOAD PDF.');
          btn.innerHTML = originalHtml;
          btn.disabled = false;
        });
      }
    </script>
  @endif

</body>
</html>
