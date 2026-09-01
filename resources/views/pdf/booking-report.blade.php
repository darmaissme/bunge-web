<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Consultation Booking Report - Bunge FlexiBetter</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #0F172A;
            background-color: #FFFFFF;
            margin: 0;
            padding: 0;
            font-size: 11px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .report-header {
            border-bottom: 3px solid #002D6E;
            padding-bottom: 16px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .brand-title {
            font-size: 20px;
            font-weight: 800;
            color: #002D6E;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .report-subtitle {
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .meta-box {
            text-align: right;
            font-size: 10px;
            color: #64748B;
        }
        .meta-box strong {
            color: #002D6E;
        }
        .filter-banner {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 10px 16px;
            margin-bottom: 16px;
            font-size: 10px;
            color: #334155;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }
        .filter-tag {
            background-color: #E2E8F0;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
            color: #002D6E;
        }
        table.report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
            table-layout: auto;
        }
        table.report-table th {
            background-color: #002D6E;
            color: #FFFFFF;
            text-align: left;
            padding: 8px 10px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
            border: 1px solid #002D6E;
        }
        table.report-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #E2E8F0;
            border-right: 1px solid #F1F5F9;
            border-left: 1px solid #F1F5F9;
            vertical-align: top;
            word-wrap: break-word;
        }
        table.report-table tr:nth-child(even) td {
            background-color: #F8FAFC;
        }
        .font-mono {
            font-family: monospace;
            font-weight: 700;
            color: #002D6E;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-confirmed { background-color: #D1FAE5; color: #047857; }
        .badge-pending { background-color: #FEF3C7; color: #B45309; }
        .badge-completed { background-color: #E0F2FE; color: #0369A1; }
        .badge-cancelled { background-color: #FFE4E6; color: #BE123C; }

        .no-print {
            text-align: right;
            margin-bottom: 12px;
        }
        .btn-print {
            background-color: #002D6E;
            color: #FFFFFF;
            border: none;
            padding: 8px 18px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 6px;
            cursor: pointer;
        }
        @media print {
            .no-print { display: none !important; }
            @page { margin: 10mm; }
            table.report-table thead { display: table-header-group; }
            table.report-table tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" class="btn-print">Print / Save PDF Report</button>
    </div>

    <!-- Report Header -->
    <div class="report-header">
        <div>
            <h1 class="brand-title">Bunge FlexiBetter</h1>
            <div class="report-subtitle">Consultation Booking Report</div>
        </div>
        <div class="meta-box">
            <div>Generated: <strong>{{ \Illuminate\Support\Carbon::now('Asia/Jakarta')->format('d M Y, H:i:s') }} WIB</strong></div>
            <div>Total Records: <strong>{{ $bookings->count() }} bookings</strong></div>
        </div>
    </div>

    <!-- Active Filters Summary -->
    <div class="filter-banner">
        <div><strong>Applied Filters:</strong></div>
        @if(!empty($filters['search']))
            <div>Search: <span class="filter-tag">"{{ $filters['search'] }}"</span></div>
        @endif
        @if(!empty($filters['status']))
            <div>Status: <span class="filter-tag">{{ ucfirst($filters['status']) }}</span></div>
        @endif
        @if(!empty($filters['industry']))
            <div>Industry: <span class="filter-tag">{{ $filters['industry'] }}</span></div>
        @endif
        @if(!empty($filters['preferred_date']))
            <div>Date: <span class="filter-tag">{{ $filters['preferred_date'] }}</span></div>
        @endif
        @if(!empty($filters['specialist']))
            <div>Specialist: <span class="filter-tag">{{ $filters['specialist'] }}</span></div>
        @endif
        @if(empty($filters['search']) && empty($filters['status']) && empty($filters['industry']) && empty($filters['preferred_date']) && empty($filters['specialist']))
            <div><span class="filter-tag">All Booking Records (No Filter)</span></div>
        @endif
    </div>

    <!-- Report Data Table -->
    <table class="report-table">
        <thead>
            <tr>
                <th style="width: 12%;">Booking #</th>
                <th style="width: 13%;">Full Name</th>
                <th style="width: 10%;">Phone</th>
                <th style="width: 13%;">Email</th>
                <th style="width: 11%;">Company</th>
                <th style="width: 9%;">Industry</th>
                <th style="width: 12%;">Discussion Topic</th>
                <th style="width: 8%;">Pref. Date</th>
                <th style="width: 8%;">Time</th>
                <th style="width: 4%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $b)
                <tr>
                    <td class="font-mono">{{ $b->booking_number }}</td>
                    <td><strong>{{ $b->full_name }}</strong></td>
                    <td>{{ $b->phone }}</td>
                    <td>{{ $b->email }}</td>
                    <td>{{ $b->company ?? '-' }}</td>
                    <td>{{ $b->industry ?? '-' }}</td>
                    <td>{{ $b->discussion_topic ?? '-' }}</td>
                    <td>{{ $b->formatted_preferred_date }}</td>
                    <td>{{ $b->preferred_time ?? '-' }}</td>
                    <td>
                        @if($b->status === 'confirmed')
                            <span class="badge badge-confirmed">Confirmed</span>
                        @elseif($b->status === 'pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif($b->status === 'completed')
                            <span class="badge badge-completed">Completed</span>
                        @else
                            <span class="badge badge-cancelled">Cancelled</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 24px; color: #64748B;">
                        No consultation bookings found matching the selected filter criteria.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="font-size: 9px; color: #94A3B8; text-align: center; margin-top: 12px; border-top: 1px solid #E2E8F0; padding-top: 8px;">
        Bunge FlexiBetter &copy; {{ date('Y') }} — Internal Consultation Booking Dataset Report. Confirmed single data source.
    </div>

</body>
</html>
