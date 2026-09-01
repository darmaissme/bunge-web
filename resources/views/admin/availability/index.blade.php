@extends('admin.layout')

@section('title', 'Slot Availability Monitor')

@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-xs border border-slate-200/80">
        <div>
            <h1 class="text-2xl font-black text-[#002D6E] tracking-tight">Slot Availability Monitor</h1>
            <p class="text-sm text-slate-500 font-medium mt-1">
                Real-time 12-slot occupancy overview across event dates (3 bookings max per slot).
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-[#002D6E] border border-blue-200">
                Timezone: Asia/Jakarta (WIB)
            </span>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-semibold flex items-center justify-between">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Event Dates Cards -->
    <div class="space-y-8">
        @foreach($eventDates as $eventDate)
            @php
                $occupied = $eventDate->occupied_bookings_count;
                $available = max(0, $eventDate->capacity - $occupied);
                $isFull = $eventDate->is_full;
            @endphp
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                
                <!-- Date Header -->
                <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#002D6E] text-white flex items-center justify-center font-black text-lg shadow-sm">
                            {{ $eventDate->date ? $eventDate->date->format('d') : '' }}
                        </div>
                        <div>
                            <h2 class="text-xl font-extrabold text-slate-900">
                                {{ $eventDate->formatted_date }}
                            </h2>
                            <p class="text-xs text-slate-500 font-medium">
                                Total Occupancy: <strong class="text-slate-800">{{ $occupied }} / {{ $eventDate->capacity }} Bookings</strong>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ $isFull ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-800' }}">
                            {{ $isFull ? 'FULL' : ($available . ' Spots Available') }}
                        </span>

                        <form method="POST" action="{{ route('admin.availability.toggle-date', $eventDate) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-xl text-xs font-extrabold transition cursor-pointer {{ $eventDate->is_active ? 'bg-slate-200 text-slate-700 hover:bg-slate-300' : 'bg-emerald-600 text-white hover:bg-emerald-700' }}">
                                {{ $eventDate->is_active ? 'Deactivate Date' : 'Activate Date' }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- 12 Consultation Slots Grid -->
                <div class="p-6">
                    <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 mb-4">
                        12 Daily 30-Minute Consultation Slots
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($eventDate->slots as $slot)
                            @php
                                $slotOccupied = $slot->occupied_count;
                                $slotAvailable = max(0, $slot->capacity - $slotOccupied);
                                $slotFull = $slotAvailable <= 0;
                            @endphp
                            <div class="p-4 rounded-xl border {{ $slotFull ? 'border-red-200 bg-red-50/30' : ($slot->is_active ? 'border-slate-200 bg-white hover:border-[#002D6E]' : 'border-slate-200 bg-slate-100 opacity-60') }} transition flex flex-col justify-between gap-3">
                                <div class="flex items-center justify-between">
                                    <span class="font-extrabold text-sm text-slate-900">
                                        {{ $slot->formatted_time_range }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $slotFull ? 'bg-red-100 text-red-700' : ($slot->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600') }}">
                                        {{ $slotFull ? 'FULL' : ($slotOccupied . ' / ' . $slot->capacity) }}
                                    </span>
                                </div>

                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="h-full {{ $slotFull ? 'bg-red-500' : 'bg-[#002D6E]' }}" style="width: {{ min(100, ($slotOccupied / $slot->capacity) * 100) }}%"></div>
                                </div>

                                <div class="flex items-center justify-between pt-1 text-xs">
                                    <span class="text-slate-500 font-medium">
                                        {{ $slotAvailable }} spot(s) left
                                    </span>

                                    <form method="POST" action="{{ route('admin.availability.toggle-slot', $slot) }}">
                                        @csrf
                                        <button type="submit" class="text-[11px] font-bold text-slate-600 hover:text-[#002D6E] underline cursor-pointer">
                                            {{ $slot->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        @endforeach
    </div>

</div>
@endsection
