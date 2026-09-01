@extends('admin.layout')

@section('title', 'Bookings / Consultations')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">

    <!-- Header & Export Toolbar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-200 pb-6">
        <div>
            <h2 class="font-display text-2xl md:text-3xl font-extrabold text-[#002D6E] tracking-tight">Bookings / Consultations</h2>
            <p class="text-slate-500 text-sm mt-1">Manage all consultation bookings submitted through the Bunge FlexiBetter public form.</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Reset All Data & Availability Button -->
            <form action="{{ route('admin.bookings.reset-all') }}" method="POST" class="inline-block" onsubmit="return confirm('WARNING: Are you sure you want to RESET ALL booking records and reset slot availability counters to 0?\n\nThis action cannot be undone!');">
                @csrf
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-rose-600/10 transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>Reset All Data</span>
                </button>
            </form>

            <!-- Export CSV Button (Preserves Filters) -->
            <a href="{{ route('admin.bookings.export.csv', request()->query()) }}" 
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider shadow-md shadow-emerald-600/10 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Export CSV</span>
            </a>

            <!-- Export PDF Report Button (Shares Exact Same Query & Filters) -->
            <a href="{{ route('admin.bookings.export.pdf', request()->query()) }}" 
               target="_blank"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white hover:bg-slate-50 text-[#002D6E] font-bold text-xs uppercase tracking-wider shadow-xs border border-blue-200 transition">
                <svg class="w-4 h-4 text-[#002D6E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                <span>Export PDF</span>
            </a>
        </div>
    </div>

    <!-- Search & Filters Toolbar White Card -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 md:p-6 shadow-xs">
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-7 gap-4">
            
            <!-- Search Keyword Input -->
            <div class="lg:col-span-2">
                <label for="search" class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Search</label>
                <div class="relative">
                    <input type="text" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search by booking number, name, email, company..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Date Filter (16, 17, 18 September 2026) -->
            <div>
                <label for="preferred_date" class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Date</label>
                <select id="preferred_date" name="preferred_date" class="w-full px-3 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                    <option value="">All Dates</option>
                    <option value="16" {{ request('preferred_date') == '16' || str_contains(request('preferred_date', ''), '16') ? 'selected' : '' }}>16 Sept 2026</option>
                    <option value="17" {{ request('preferred_date') == '17' || str_contains(request('preferred_date', ''), '17') ? 'selected' : '' }}>17 Sept 2026</option>
                    <option value="18" {{ request('preferred_date') == '18' || str_contains(request('preferred_date', ''), '18') ? 'selected' : '' }}>18 Sept 2026</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Status</label>
                <select id="status" name="status" class="w-full px-3 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                    <option value="">All Statuses</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Industry Filter -->
            <div>
                <label for="industry" class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Industry</label>
                <select id="industry" name="industry" class="w-full px-3 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                    <option value="">All Industries</option>
                    @foreach($industries as $ind)
                        <option value="{{ $ind }}" {{ request('industry') === $ind ? 'selected' : '' }}>{{ $ind }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sort Order Filter (Newest First / Oldest First) -->
            <div>
                <label for="sort" class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 mb-1.5">Sort Order</label>
                <select id="sort" name="sort" class="w-full px-3 py-2.5 rounded-xl bg-white border border-slate-300 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#002D6E]">
                    <option value="desc" {{ request('sort', 'desc') === 'desc' ? 'selected' : '' }}>Newest First</option>
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Oldest First</option>
                </select>
            </div>

            <!-- Filter Actions -->
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-[#002D6E] hover:bg-[#0E529B] text-white font-bold text-xs uppercase tracking-wider shadow-sm transition">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'status', 'industry', 'sort', 'preferred_date', 'specialist']))
                    <a href="{{ route('admin.bookings.index') }}" class="py-2.5 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider transition border border-slate-200" title="Reset Filter">
                        Reset
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Data Table Crisp White Card -->
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs md:text-sm text-slate-800">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4">Booking #</th>
                        <th class="px-6 py-4">Name & Contact</th>
                        <th class="px-6 py-4">Company & Industry</th>
                        <th class="px-6 py-4">Discussion Topic</th>
                        <th class="px-6 py-4">Schedule / Specialist</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $b)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-[#002D6E] whitespace-nowrap">
                                <a href="{{ route('admin.bookings.show', $b) }}" class="hover:underline">{{ $b->booking_number }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-900">{{ $b->full_name }}</div>
                                <div class="text-xs text-slate-500">{{ $b->email }}</div>
                                <div class="text-xs text-slate-500">{{ $b->phone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-slate-800">{{ $b->company ?? '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $b->industry ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 max-w-xs truncate">
                                {{ $b->discussion_topic ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-700">
                                <div class="font-semibold">{{ $b->formatted_preferred_date }}</div>
                                <div class="text-xs text-slate-500">{{ $b->preferred_time ?? '' }}</div>
                                @if($b->specialist)
                                    <div class="text-xs text-[#002D6E] font-semibold mt-0.5">Specialist: {{ $b->specialist }}</div>
                                @endif
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
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-1.5">
                                <a href="{{ route('admin.bookings.show', $b) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-xs font-bold text-slate-700 border border-slate-200 transition">View Details</a>
                                <a href="{{ route('admin.bookings.edit', $b) }}" class="px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-xs font-bold text-[#002D6E] border border-blue-200 transition">Edit</a>
                                <form action="{{ route('admin.bookings.destroy', array_merge(['booking' => $b->id], request()->query())) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete booking #{{ $b->booking_number }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-xs font-bold text-rose-700 border border-rose-200 transition cursor-pointer">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <p class="font-bold text-base text-slate-700">No bookings found.</p>
                                    <p class="text-xs text-slate-500">No records match your search criteria.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bookings->hasPages())
            <div class="p-5 border-t border-slate-200 bg-slate-50/50">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
