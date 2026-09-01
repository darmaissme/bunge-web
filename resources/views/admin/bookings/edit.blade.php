@extends('admin.layout')

@section('title', 'Edit Booking #' . $booking->booking_number)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Top Navigation Actions -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.bookings.show', $booking) }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-[#002D6E] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Booking Details</span>
        </a>
    </div>

    <!-- Edit Form Crisp White Card -->
    <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-xs">
        
        <div class="border-b border-slate-200 pb-6 mb-6">
            <h3 class="font-display text-xl font-extrabold text-[#002D6E]">Edit Consultation Booking</h3>
            <p class="text-xs text-slate-500 mt-1">Update visitor details, preferred schedule, assigned specialist, or booking status.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                @foreach($errors->all() as $error)
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ $error }}</span>
                    </p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Booking Number (Read-only) -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">Booking Number (Read-only)</label>
                <input type="text" value="{{ $booking->booking_number }}" readonly class="w-full px-4 py-2.5 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 font-mono font-bold text-sm cursor-not-allowed">
            </div>

            <!-- Visitor Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-200">
                
                <div>
                    <label for="full_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $booking->full_name) }}" required class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Address *</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $booking->email) }}" required class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

                <div>
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Phone / WhatsApp *</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $booking->phone) }}" required class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

                <div>
                    <label for="company" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Company</label>
                    <input type="text" id="company" name="company" value="{{ old('company', $booking->company) }}" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

                <div class="md:col-span-2">
                    <label for="industry" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Industry</label>
                    <input type="text" id="industry" name="industry" value="{{ old('industry', $booking->industry) }}" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

            </div>

            <!-- Schedule & Management Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-200">
                
                <div>
                    <label for="preferred_date" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Preferred Date</label>
                    <input type="text" id="preferred_date" name="preferred_date" value="{{ old('preferred_date', $booking->preferred_date) }}" placeholder="YYYY-MM-DD" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

                <div>
                    <label for="preferred_time" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Preferred Time</label>
                    <input type="text" id="preferred_time" name="preferred_time" value="{{ old('preferred_time', $booking->preferred_time) }}" placeholder="10:00 - 10:30 WIB" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

                <div>
                    <label for="specialist" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Assigned Specialist</label>
                    <input type="text" id="specialist" name="specialist" value="{{ old('specialist', $booking->specialist) }}" placeholder="e.g. Senior Specialist Bakery" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

                <div>
                    <label for="duration" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Session Duration</label>
                    <input type="text" id="duration" name="duration" value="{{ old('duration', $booking->duration ?? '30 Mins') }}" class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                </div>

                <div class="md:col-span-2">
                    <label for="status" class="block text-xs font-bold uppercase tracking-wider text-[#002D6E] mb-1.5">Status *</label>
                    <select id="status" name="status" required class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 font-bold text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                        <option value="confirmed" {{ old('status', $booking->status) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="pending" {{ old('status', $booking->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status', $booking->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status', $booking->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

            </div>

            <!-- Discussion Topic & Internal Notes -->
            <div class="space-y-4 pt-4 border-t border-slate-200">
                
                <div>
                    <label for="discussion_topic" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Discussion Topic / Focus</label>
                    <textarea id="discussion_topic" name="discussion_topic" rows="3" class="w-full p-3.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">{{ old('discussion_topic', $booking->discussion_topic) }}</textarea>
                </div>

                <div>
                    <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-amber-700 mb-1.5">Admin Internal Notes</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="Add internal notes for booth consultants or sales team..." class="w-full p-3.5 rounded-xl bg-amber-50/50 border border-amber-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">{{ old('notes', $booking->notes) }}</textarea>
                </div>

            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-200">
                <a href="{{ route('admin.bookings.show', $booking) }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs uppercase tracking-wider border border-slate-200 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#002D6E] hover:bg-[#0E529B] text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-[#002D6E]/20 transition cursor-pointer">
                    Save Changes
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
