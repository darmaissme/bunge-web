{{-- 
  MANAGE YOUR BOOKING MODAL COMPONENT
  Bunge FlexiBetter Event Microsite
  Blade Partial: resources/views/partials/manage-booking-modal.blade.php
--}}
<div
  x-data="manageBookingModalComponent()"
  x-show="isOpen"
  @open-manage-booking-modal.window="openModal()"
  @keydown.escape.window="closeModal()"
  x-cloak
  class="fixed inset-0 z-50 overflow-y-auto"
  aria-labelledby="manage-booking-modal-title"
  role="dialog"
  aria-modal="true"
  style="display: none;"
>
  {{-- BACKDROP --}}
  <div
    x-show="isOpen"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="closeModal()"
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
  ></div>

  {{-- MODAL CONTAINER --}}
  <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
    <div
      x-show="isOpen"
      x-transition:enter="ease-out duration-300"
      x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
      x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
      x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all w-full max-w-md my-8"
    >
      {{-- MODAL HEADER --}}
      <div class="bg-[#002D6E] px-6 py-6 sm:px-8 text-white relative">
        <button
          type="button"
          @click="closeModal()"
          class="absolute right-5 top-5 text-white/70 hover:text-white transition-colors cursor-pointer"
          aria-label="Close Modal"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
        <h3 id="manage-booking-modal-title" class="text-xl sm:text-2xl font-black text-white tracking-tight" x-text="$store.lang.current === 'ID' ? 'Kelola Booking Anda' : 'Manage Your Booking'">
          Manage Your Booking
        </h3>
        <p
          class="mt-1.5 text-xs sm:text-sm text-slate-200 font-medium leading-relaxed"
          x-text="$store.lang.current === 'ID' ? 'Sudah memiliki booking konsultasi? Masukkan detail booking Anda di bawah untuk melihat dan mengelola sesi Anda.' : 'Already have a consultation booking? Enter your booking details below to view and manage your session.'"
        >
          Already have a consultation booking? Enter your booking details below to view and manage your session.
        </p>
      </div>

      {{-- FORM --}}
      <form @submit.prevent="submitLookup($event)" class="p-6 sm:p-8 space-y-5">
        @csrf

        {{-- ERROR ALERT BANNER --}}
        <template x-if="lookupError">
          <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-semibold flex items-center gap-3 shadow-xs">
            <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span x-text="lookupError"></span>
          </div>
        </template>

        {{-- FIELD: BOOKING NUMBER --}}
        <div>
          <label for="lookup_booking_number" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Nomor Booking *' : 'Booking Number *'">
            Booking Number *
          </label>
          <input
            type="text"
            id="lookup_booking_number"
            x-model="bookingNumber"
            :placeholder="$store.lang.current === 'ID' ? 'contoh: BNG-FIA26-000013' : 'e.g. BNG-FIA26-000013'"
            placeholder="e.g. BNG-FIA26-000013"
            required
            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm sm:text-base text-slate-900 font-mono focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:bg-white uppercase tracking-wider transition-all"
          />
        </div>

        {{-- FIELD: EMAIL ADDRESS --}}
        <div>
          <label for="lookup_email" class="block text-xs sm:text-sm font-extrabold text-slate-800 mb-2" x-text="$store.lang.current === 'ID' ? 'Alamat Email *' : 'Email Address *'">
            Email Address *
          </label>
          <input
            type="email"
            id="lookup_email"
            x-model="email"
            :placeholder="$store.lang.current === 'ID' ? 'Alamat email terdaftar Anda' : 'Your registered email address'"
            placeholder="Your registered email address"
            required
            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 text-sm sm:text-base text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#002D6E] focus:bg-white transition-all"
          />
        </div>

        {{-- SUBMIT BUTTON --}}
        <div class="pt-3">
          <button
            type="submit"
            :disabled="loading || !bookingNumber || !email"
            :class="(loading || !bookingNumber || !email) ? 'opacity-50 cursor-not-allowed bg-slate-400' : 'bg-[#002D6E] hover:bg-[#001D48] cursor-pointer shadow-xl hover:shadow-2xl active:scale-[0.99]'"
            class="w-full text-white py-4 px-6 rounded-full font-bold text-base sm:text-lg transition-all duration-200 flex items-center justify-center gap-2"
          >
            <span x-show="!loading" x-text="$store.lang.current === 'ID' ? 'CARI BOOKING SAYA' : 'FIND MY BOOKING'">FIND MY BOOKING</span>
            <span x-show="loading" class="flex items-center gap-2" style="display: none;">
              <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <span x-text="$store.lang.current === 'ID' ? 'Mencari booking Anda...' : 'Finding your booking...'">Finding your booking...</span>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  window.addEventListener('open-manage-booking-modal', function() {
    window.dispatchEvent(new CustomEvent('open-manage-booking-modal-internal'));
  });

  function manageBookingModalComponent() {
    return {
      isOpen: false,
      bookingNumber: '',
      email: '',
      loading: false,
      lookupError: '',

      openModal() {
        this.isOpen = true;
        this.lookupError = '';
      },
      closeModal() {
        this.isOpen = false;
        this.lookupError = '';
      },

      async submitLookup(e) {
        if (this.loading) return;
        this.loading = true;
        this.lookupError = '';

        try {
          const res = await fetch('{{ route("booking.manage.lookup") }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
              booking_number: this.bookingNumber,
              email: this.email
            })
          });

          const data = await res.json();

          if (!res.ok || !data.success) {
            this.lookupError = (Alpine.store('lang') && Alpine.store('lang').current === 'ID')
              ? 'Detail booking tidak ditemukan. Silakan periksa kembali nomor booking dan alamat email Anda.'
              : (data.message || "We couldn't find a booking matching those details.");
            this.loading = false;
            return;
          }

          if (data.redirect) {
            window.location.href = data.redirect;
          } else {
            this.loading = false;
          }
        } catch (err) {
          console.error(err);
          this.lookupError = (Alpine.store('lang') && Alpine.store('lang').current === 'ID')
            ? 'Terjadi kesalahan. Silakan coba lagi.'
            : 'Something went wrong. Please try again.';
          this.loading = false;
        }
      }
    };
  }
</script>
