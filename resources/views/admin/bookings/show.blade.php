@extends('admin.layout')

@section('title', 'Booking Details #' . $booking->booking_number)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Top Navigation Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-[#002D6E] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Bookings</span>
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.bookings.pdf', $booking) }}" target="_blank" class="px-4 py-2.5 rounded-xl bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold uppercase tracking-wider transition border border-slate-300 shadow-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-[#002D6E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Download Ticket PDF</span>
            </a>

            <a href="{{ route('admin.bookings.edit', $booking) }}" class="px-5 py-2.5 rounded-xl bg-[#002D6E] hover:bg-[#0E529B] text-white text-xs font-bold uppercase tracking-wider transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Edit Booking</span>
            </a>

            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data booking #{{ $booking->booking_number }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold uppercase tracking-wider transition shadow-sm flex items-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>Delete</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Booking Card Crisp White Card -->
    <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-xs space-y-8">
        
        <!-- Header Banner -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-6 rounded-2xl bg-slate-50 border border-slate-200">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Booking Number</span>
                <h3 class="font-mono text-3xl font-extrabold text-[#002D6E] mt-1">{{ $booking->booking_number }}</h3>
            </div>

            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block mb-1.5">Status</span>
                @if($booking->status === 'confirmed')
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">Confirmed</span>
                @elseif($booking->status === 'pending')
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200">Pending</span>
                @elseif($booking->status === 'completed')
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-extrabold bg-sky-50 text-sky-700 border border-sky-200">Completed</span>
                @else
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200">Cancelled</span>
                @endif
            </div>
        </div>

        <!-- Section 1: Visitor Information & Section 2: Consultation Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Visitor Information -->
            <div class="space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#002D6E] border-b border-slate-200 pb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Visitor Information</span>
                </h4>
                
                <div>
                    <span class="text-xs text-slate-500 block">Full Name</span>
                    <span class="text-base font-bold text-slate-900">{{ $booking->full_name }}</span>
                </div>

                <div>
                    <span class="text-xs text-slate-500 block">Email Address</span>
                    <a href="mailto:{{ $booking->email }}" class="text-base font-bold text-[#002D6E] hover:underline">{{ $booking->email }}</a>
                </div>

                <div>
                    <span class="text-xs text-slate-500 block">Phone / WhatsApp</span>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->phone) }}" target="_blank" class="text-base font-bold text-emerald-700 hover:underline">{{ $booking->phone }}</a>
                </div>

                <div>
                    <span class="text-xs text-slate-500 block">Company</span>
                    <span class="text-base font-bold text-slate-900">{{ $booking->company ?? '-' }}</span>
                </div>

                <div>
                    <span class="text-xs text-slate-500 block">Industry</span>
                    <span class="text-base font-bold text-slate-900">{{ $booking->industry ?? '-' }}</span>
                </div>
            </div>

            <!-- Consultation Information -->
            <div class="space-y-4">
                <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-700 border-b border-slate-200 pb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Consultation Information</span>
                </h4>

                <div>
                    <span class="text-xs text-slate-500 block">Preferred Date</span>
                    <span class="text-base font-bold text-slate-900">{{ $booking->formatted_preferred_date }}</span>
                </div>

                <div>
                    <span class="text-xs text-slate-500 block">Preferred Time</span>
                    <span class="text-base font-bold text-slate-900">{{ $booking->formatted_preferred_time }}</span>
                </div>

                <div>
                    <span class="text-xs text-slate-500 block">Assigned Specialist</span>
                    <span class="text-base font-bold text-[#002D6E]">{{ $booking->specialist ?? '-' }}</span>
                </div>

                <div>
                    <span class="text-xs text-slate-500 block">Session Duration</span>
                    <span class="text-base font-bold text-slate-900">{{ $booking->duration ?? '30 mins' }}</span>
                </div>

                <div>
                    <span class="text-xs text-slate-500 block">Registration Date</span>
                    <span class="text-xs font-semibold text-slate-600">{{ $booking->created_at ? $booking->created_at->format('d F Y H:i:s') : '-' }}</span>
                </div>
            </div>

        </div>

        <!-- Topic & Notes -->
        <div class="space-y-4 pt-4 border-t border-slate-200">
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block mb-2">Discussion Topic / Focus</span>
                <div class="p-4 rounded-2xl bg-slate-50 text-slate-800 text-sm leading-relaxed border border-slate-200">
                    {{ $booking->discussion_topic ?? 'No specific topic provided.' }}
                </div>
            </div>

            @if($booking->notes)
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-amber-700 block mb-2">Admin Internal Notes</span>
                    <div class="p-4 rounded-2xl bg-amber-50 text-amber-900 text-sm leading-relaxed border border-amber-200 italic">
                        {{ $booking->notes }}
                    </div>
                </div>
            @endif
        </div>

    </div>

</div>
@endsection
