<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Ticket Pass - {{ $booking->booking_number }} - Bunge FlexiBetter</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #0F172A;
            background-color: #FFFFFF;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .ticket-container {
            border: 2px solid #002D6E;
            border-radius: 12px;
            overflow: hidden;
            max-width: 750px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .header {
            background-color: #002D6E;
            color: #FFFFFF;
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 4px 0 0 0;
            font-size: 12px;
            color: #93C5FD;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #10B981;
            color: #FFFFFF;
        }
        .status-pending { background-color: #F59E0B; color: #FFFFFF; }
        .status-completed { background-color: #0EA5E9; color: #FFFFFF; }
        .status-cancelled { background-color: #F43F5E; color: #FFFFFF; }
        
        .booking-number-bar {
            background-color: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .booking-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #64748B;
            letter-spacing: 1px;
        }
        .booking-value {
            font-family: monospace;
            font-size: 24px;
            font-weight: 800;
            color: #002D6E;
        }
        .content-grid {
            padding: 28px 32px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        .section-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #002D6E;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }
        .info-group {
            margin-bottom: 12px;
        }
        .info-label {
            font-size: 11px;
            color: #64748B;
            margin-bottom: 2px;
        }
        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #0F172A;
        }
        .full-width {
            grid-column: span 2;
        }
        .topic-box {
            background-color: #F1F5F9;
            border-left: 4px solid #002D6E;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 13px;
            color: #334155;
            line-height: 1.5;
        }
        .event-banner {
            background-color: #001D47;
            color: #FFFFFF;
            padding: 20px 32px;
            border-top: 1px solid #1E293B;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }
        .event-item p {
            margin: 0;
        }
        .event-item .lbl {
            font-size: 10px;
            text-transform: uppercase;
            color: #94A3B8;
            letter-spacing: 0.5px;
        }
        .event-item .val {
            font-size: 13px;
            font-weight: 700;
            color: #FFFFFF;
            margin-top: 2px;
        }
        .footer {
            text-align: center;
            padding: 16px;
            font-size: 11px;
            color: #64748B;
            background-color: #F8FAFC;
            border-top: 1px solid #E2E8F0;
        }
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-print {
            background-color: #002D6E;
            color: #FFFFFF;
            border: none;
            padding: 10px 24px;
            font-size: 14px;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .ticket-container { box-shadow: none; border-color: #000; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" class="btn-print">Print / Save as PDF</button>
    </div>

    <div class="ticket-container">
        
        <!-- Header -->
        <div class="header">
            <div>
                <h1>Bunge FlexiBetter</h1>
                <p>Internal Consultation Confirmation Pass</p>
            </div>
            <div>
                @if($booking->status === 'confirmed')
                    <span class="status-badge">Confirmed Pass</span>
                @elseif($booking->status === 'pending')
                    <span class="status-badge status-pending">Pending Review</span>
                @elseif($booking->status === 'completed')
                    <span class="status-badge status-completed">Completed</span>
                @else
                    <span class="status-badge status-cancelled">Cancelled</span>
                @endif
            </div>
        </div>

        <!-- Booking Bar -->
        <div class="booking-number-bar">
            <div>
                <div class="booking-label">Booking Number Pass</div>
                <div class="booking-value">{{ $booking->booking_number }}</div>
            </div>
            <div style="text-align: right;">
                <div class="booking-label">Date Generated</div>
                <div style="font-size: 12px; font-weight: 600; color: #334155;">{{ $booking->created_at ? $booking->created_at->format('d M Y, H:i') : date('d M Y') }} WIB</div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="content-grid">
            
            <!-- Visitor Info -->
            <div>
                <div class="section-title">Visitor Information</div>
                
                <div class="info-group">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">{{ $booking->full_name }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">{{ $booking->email }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Phone / WhatsApp</div>
                    <div class="info-value">{{ $booking->phone }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Company</div>
                    <div class="info-value">{{ $booking->company ?? '-' }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Industry</div>
                    <div class="info-value">{{ $booking->industry ?? '-' }}</div>
                </div>
            </div>

            <!-- Consultation Info -->
            <div>
                <div class="section-title">Consultation Information</div>

                <div class="info-group">
                    <div class="info-label">Preferred Date</div>
                    <div class="info-value">{{ $booking->formatted_preferred_date }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Preferred Time</div>
                    <div class="info-value">{{ $booking->preferred_time ?? '-' }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Assigned Specialist</div>
                    <div class="info-value">{{ $booking->specialist ?? 'Bunge Specialist Team' }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Session Duration</div>
                    <div class="info-value">{{ $booking->duration ?? '30 minutes' }}</div>
                </div>
            </div>

            <!-- Topic -->
            <div class="full-width">
                <div class="section-title">Discussion Topic / Focus</div>
                <div class="topic-box">
                    {{ $booking->discussion_topic ?? 'Product Performance & Formulation Consultation' }}
                </div>
            </div>

            @if($booking->notes)
                <div class="full-width">
                    <div class="section-title">Admin Internal Notes</div>
                    <div class="topic-box" style="background-color: #FEF3C7; border-left-color: #D97706; color: #78350F;">
                        {{ $booking->notes }}
                    </div>
                </div>
            @endif

        </div>

        <!-- Event Banner -->
        <div class="event-banner">
            <div class="event-item">
                <p class="lbl">Event Name</p>
                <p class="val">FIA Indonesia 2026</p>
            </div>
            <div class="event-item">
                <p class="lbl">Venue Location</p>
                <p class="val">JIExpo, Hall D2</p>
            </div>
            <div class="event-item">
                <p class="lbl">Bunge Booth</p>
                <p class="val">Booth D2A48</p>
            </div>
            <div class="event-item">
                <p class="lbl">Event Dates</p>
                <p class="val">16-18 Sept 2026</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            Bunge FlexiBetter &copy; {{ date('Y') }} — Official Event Consultation Ticket Pass. Please present this ticket pass at the Bunge Booth.
        </div>

    </div>

</body>
</html>
