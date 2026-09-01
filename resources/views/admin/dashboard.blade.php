@extends('admin.layout')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    <!-- Top Overview Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-2xl font-extrabold text-[#002D6E] tracking-tight">Overview Metrics & Stats</h2>
            <p class="text-slate-500 text-sm mt-0.5">Real-time overview of consultation bookings and registration activity.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.bookings.export.csv') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 font-bold text-xs uppercase tracking-wider shadow-xs transition">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Export CSV</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#002D6E] hover:bg-[#0E529B] text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-[#002D6E]/20 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                <span>View All Bookings</span>
            </a>
        </div>
    </div>

    <!-- 5 Light Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
        
        <!-- Total Bookings -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Bookings</span>
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#002D6E] flex items-center justify-center border border-blue-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <div class="mt-3">
                <span class="font-display text-3xl font-extrabold text-[#002D6E]">{{ $totalBookings }}</span>
                <p class="text-[11px] font-semibold text-emerald-600 mt-1 flex items-center gap-1">
                    <span>+{{ $todayBookings }} registered today</span>
                </p>
            </div>
        </div>

        <!-- Confirmed Pass -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Confirmed</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center border border-emerald-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="mt-3">
                <span class="font-display text-3xl font-extrabold text-emerald-700">{{ $confirmedCount }}</span>
                <p class="text-[11px] text-slate-500 mt-1 font-medium">Confirmed ticket passes</p>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Pending</span>
                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center border border-amber-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="mt-3">
                <span class="font-display text-3xl font-extrabold text-amber-700">{{ $pendingCount }}</span>
                <p class="text-[11px] text-slate-500 mt-1 font-medium">Awaiting scheduling</p>
            </div>
        </div>

        <!-- Completed Sessions -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Completed</span>
                <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center border border-sky-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
            <div class="mt-3">
                <span class="font-display text-3xl font-extrabold text-sky-700">{{ $completedCount }}</span>
                <p class="text-[11px] text-slate-500 mt-1 font-medium">Completed booth sessions</p>
            </div>
        </div>

        <!-- Cancelled -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs hover:border-slate-300 transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Cancelled</span>
                <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center border border-rose-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
            </div>
            <div class="mt-3">
                <span class="font-display text-3xl font-extrabold text-rose-700">{{ $cancelledCount }}</span>
                <p class="text-[11px] text-slate-500 mt-1 font-medium">Cancelled bookings</p>
            </div>
        </div>

    </div>

    <!-- Recent Bookings Table Container (Light White Card) -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
        
        <div class="p-5 md:p-6 border-b border-slate-200 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="font-display font-extrabold text-base text-[#002D6E]">Recent Bookings</h3>
                <p class="text-xs text-slate-500 mt-0.5">Latest consultation bookings submitted through the public form.</p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-[#002D6E] hover:text-[#0E529B] hover:underline transition flex items-center gap-1">
                <span>View All Bookings</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs md:text-sm text-slate-800">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">Booking #</th>
                        <th class="px-6 py-4">Name & Contact</th>
                        <th class="px-6 py-4">Company & Industry</th>
                        <th class="px-6 py-4">Schedule Selection</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentBookings as $b)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-[#002D6E] whitespace-nowrap">
                                <a href="{{ route('admin.bookings.show', $b) }}" class="hover:underline">{{ $b->booking_number }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900">{{ $b->full_name }}</div>
                                <div class="text-xs text-slate-500">{{ $b->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-slate-800">{{ $b->company ?? '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $b->industry ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-700">
                                <div class="font-medium">{{ $b->formatted_preferred_date ?? ($b->preferred_date ? $b->preferred_date->format('d F Y') : '-') }}</div>
                                <div class="text-xs text-slate-500">{{ $b->formatted_preferred_time ?? ($b->preferred_time ?? '') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($b->status === 'confirmed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">Confirmed</span>
                                @elseif($b->status === 'pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200">Pending</span>
                                @elseif($b->status === 'completed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-sky-50 text-sky-700 border border-sky-200">Completed</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200">Cancelled</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                <a href="{{ route('admin.bookings.show', $b) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-xs font-bold text-slate-700 border border-slate-200 transition">View Details</a>
                                <a href="{{ route('admin.bookings.edit', $b) }}" class="px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-xs font-bold text-[#002D6E] border border-blue-200 transition">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
