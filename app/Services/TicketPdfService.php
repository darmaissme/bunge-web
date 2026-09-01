<?php

namespace App\Services;

use App\Models\Consultation;

class TicketPdfService
{
    /**
     * Generate native A4 Portrait PDF binary string for a single consultation ticket.
     *
     * @param Consultation $booking
     * @return string PDF Binary String
     */
    public static function generate(Consultation $booking): string
    {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();

        // Full A4 Canvas margins: Left=10mm, Top=10mm, Printable W=190mm, H=277mm
        $left = 10;
        $top = 10;
        $width = 190;
        $height = 277;

        // Outer Border Card (Bunge Navy border)
        $pdf->SetDrawColor(0, 45, 110);
        $pdf->SetLineWidth(1.0);
        $pdf->RoundedRect($left, $top, $width, $height, 4, 'D');

        // -------------------------------------------------------------
        // SECTION 1: NAVY HEADER BANNER
        // -------------------------------------------------------------
        $pdf->SetFillColor(0, 45, 110); // #002D6E
        $pdf->RoundedRect($left, $top, $width, 32, 3, 'F');
        // Square bottom corners of header banner
        $pdf->Rect($left, $top + 24, $width, 8, 'F');

        // Header Title
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Helvetica', 'B', 18);
        $pdf->SetXY($left + 10, $top + 7);
        $pdf->Cell(110, 8, self::sanitizeText('BUNGE FLEXIBETTER'), 0, 1, 'L');

        // Header Subtitle
        $pdf->SetTextColor(147, 197, 253); // Light Blue #93C5FD
        $pdf->SetFont('Helvetica', '', 10);
        $pdf->SetXY($left + 10, $top + 17);
        $pdf->Cell(110, 6, self::sanitizeText('Internal Consultation Confirmation Pass'), 0, 0, 'L');

        // Status Badge (Right aligned)
        $badgeText = 'CONFIRMED PASS';
        if ($booking->status === 'pending') {
            $badgeText = 'PENDING REVIEW';
        } elseif ($booking->status === 'completed') {
            $badgeText = 'COMPLETED';
        } elseif ($booking->status === 'cancelled') {
            $badgeText = 'CANCELLED';
        }

        $pdf->SetFillColor(236, 253, 245); // Emerald Light #ECFDF5
        $pdf->SetDrawColor(16, 185, 129);
        $pdf->SetLineWidth(0.4);
        $pdf->RoundedRect($left + $width - 54, $top + 10, 44, 12, 6, 'DF');

        $pdf->SetTextColor(4, 120, 87); // Emerald Dark #047857
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->SetXY($left + $width - 54, $top + 10);
        $pdf->Cell(44, 12, self::sanitizeText($badgeText), 0, 0, 'C');

        // -------------------------------------------------------------
        // SECTION 2: BOOKING NUMBER BAR
        // -------------------------------------------------------------
        $barY = $top + 32;
        $pdf->SetFillColor(248, 250, 252); // #F8FAFC
        $pdf->SetDrawColor(226, 232, 240);
        $pdf->Rect($left, $barY, $width, 24, 'F');
        $pdf->Line($left, $barY + 24, $left + $width, $barY + 24);

        // Booking Label
        $pdf->SetTextColor(100, 116, 139);
        $pdf->SetFont('Helvetica', 'B', 8.5);
        $pdf->SetXY($left + 10, $barY + 4);
        $pdf->Cell(90, 5, self::sanitizeText('BOOKING NUMBER PASS'), 0, 0, 'L');

        // Booking Number Value
        $pdf->SetTextColor(0, 45, 110);
        $pdf->SetFont('Helvetica', 'B', 16);
        $pdf->SetXY($left + 10, $barY + 10);
        $pdf->Cell(90, 9, self::sanitizeText($booking->booking_number), 0, 0, 'L');

        // Date Generated Label & Value (Right Side)
        $pdf->SetTextColor(100, 116, 139);
        $pdf->SetFont('Helvetica', 'B', 8.5);
        $pdf->SetXY($left + 100, $barY + 4);
        $pdf->Cell(80, 5, self::sanitizeText('DATE GENERATED'), 0, 0, 'R');

        $pdf->SetTextColor(15, 23, 42);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->SetXY($left + 100, $barY + 10);
        $generatedAt = $booking->created_at ? $booking->created_at->format('d M Y, H:i') . ' WIB' : date('d M Y, H:i') . ' WIB';
        $pdf->Cell(80, 9, self::sanitizeText($generatedAt), 0, 0, 'R');

        // -------------------------------------------------------------
        // SECTION 3: VISITOR INFORMATION
        // -------------------------------------------------------------
        $visY = $barY + 30;
        $pdf->SetTextColor(0, 45, 110);
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->SetXY($left + 10, $visY);
        $pdf->Cell(170, 6, self::sanitizeText('VISITOR INFORMATION'), 0, 1, 'L');

        $pdf->SetDrawColor(226, 232, 240);
        $pdf->SetLineWidth(0.5);
        $pdf->Line($left + 10, $visY + 7, $left + $width - 10, $visY + 7);

        // Row 1: Full Name & Company
        $row1Y = $visY + 11;
        self::renderField($pdf, $left + 10, $row1Y, 85, 'FULL NAME', $booking->full_name);
        self::renderField($pdf, $left + 100, $row1Y, 80, 'COMPANY NAME', $booking->company ?: '-');

        // Row 2: Phone & Email
        $row2Y = $row1Y + 15;
        self::renderField($pdf, $left + 10, $row2Y, 85, 'PHONE / WHATSAPP', $booking->phone);
        self::renderField($pdf, $left + 100, $row2Y, 80, 'EMAIL ADDRESS', $booking->email);

        // Row 3: Industry
        $row3Y = $row2Y + 15;
        self::renderField($pdf, $left + 10, $row3Y, 170, 'INDUSTRY', $booking->industry ?: '-');

        // -------------------------------------------------------------
        // DASHED DIVIDER WITH SIDE NOTCHES
        // -------------------------------------------------------------
        $div1Y = $row3Y + 18;
        $pdf->SetDrawColor(203, 213, 225);
        $pdf->SetLineWidth(0.5);
        for ($dx = $left + 10; $dx < ($left + $width - 10); $dx += 5) {
            $pdf->Line($dx, $div1Y, min($dx + 3, $left + $width - 10), $div1Y);
        }

        // -------------------------------------------------------------
        // SECTION 4: CONSULTATION INFORMATION
        // -------------------------------------------------------------
        $conY = $div1Y + 7;
        $pdf->SetTextColor(0, 45, 110);
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->SetXY($left + 10, $conY);
        $pdf->Cell(170, 6, self::sanitizeText('CONSULTATION INFORMATION'), 0, 1, 'L');

        $pdf->Line($left + 10, $conY + 7, $left + $width - 10, $conY + 7);

        // Row 1: Discussion Topic & Specialist
        $cRow1Y = $conY + 11;
        self::renderField($pdf, $left + 10, $cRow1Y, 85, 'DISCUSSION TOPIC', $booking->discussion_topic);
        self::renderField($pdf, $left + 100, $cRow1Y, 80, 'ASSIGNED SPECIALIST', $booking->specialist ?: 'To be assigned');

        // Row 2: Preferred Event Date & Session Time
        $cRow2Y = $cRow1Y + 15;

        // FORMATTED EVENT DATE (17 September 2026)
        $formattedDateDisplay = $booking->formatted_preferred_date ?: ($booking->preferred_date ? $booking->preferred_date->format('d F Y') : '-');
        self::renderField($pdf, $left + 10, $cRow2Y, 85, 'PREFERRED EVENT DATE', $formattedDateDisplay);

        $formattedTimeDisplay = $booking->formatted_preferred_time ?: ($booking->preferred_time ?: '-');
        self::renderField($pdf, $left + 100, $cRow2Y, 80, 'PREFERRED SESSION TIME', $formattedTimeDisplay);

        // Row 3: Session Duration
        $cRow3Y = $cRow2Y + 15;
        self::renderField($pdf, $left + 10, $cRow3Y, 170, 'SESSION DURATION', $booking->duration ?: '30 Menit');

        // -------------------------------------------------------------
        // DASHED DIVIDER 2
        // -------------------------------------------------------------
        $div2Y = $cRow3Y + 18;
        for ($dx = $left + 10; $dx < ($left + $width - 10); $dx += 5) {
            $pdf->Line($dx, $div2Y, min($dx + 3, $left + $width - 10), $div2Y);
        }

        // -------------------------------------------------------------
        // SECTION 5: EVENT INFORMATION & BEFORE YOU ARRIVE (2 COLS)
        // -------------------------------------------------------------
        $evY = $div2Y + 7;

        // LEFT COLUMN: EVENT INFORMATION
        $pdf->SetTextColor(0, 45, 110);
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->SetXY($left + 10, $evY);
        $pdf->Cell(85, 6, self::sanitizeText('EVENT INFORMATION'), 0, 1, 'L');

        $evItemY = $evY + 10;
        self::renderBullet($pdf, $left + 10, $evItemY, 'LOCATION', config('event.location', 'JIExpo Hall D2 - Booth D2A48'));
        self::renderBullet($pdf, $left + 10, $evItemY + 13, 'EVENT DATES', config('event.dates', '16-18 September 2026'));
        self::renderBullet($pdf, $left + 10, $evItemY + 26, 'OPERATIONAL HOURS', config('event.hours', '10:00 AM - 06:00 PM'));

        // RIGHT COLUMN: BEFORE YOU ARRIVE (AMBER HEADING)
        $pdf->SetTextColor(217, 119, 6); // Amber #D97706
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->SetXY($left + 100, $evY);
        $pdf->Cell(80, 6, self::sanitizeText('BEFORE YOU ARRIVE'), 0, 1, 'L');

        $arrItemY = $evY + 10;
        self::renderCheckItem($pdf, $left + 100, $arrItemY, 'Arrive 10-15 minutes before your session');
        self::renderCheckItem($pdf, $left + 100, $arrItemY + 10, 'Show your Booking ID or Consultation Pass');
        self::renderCheckItem($pdf, $left + 100, $arrItemY + 20, 'Visit Bunge Booth D2A48');
        self::renderCheckItem($pdf, $left + 100, $arrItemY + 30, 'Contact reception desk if assistance needed');

        // -------------------------------------------------------------
        // SECTION 6: FOOTER BANNER (BOTTOM OF FULL A4 PAGE)
        // -------------------------------------------------------------
        $footY = $top + $height - 18;
        $pdf->SetFillColor(248, 250, 252);
        $pdf->SetDrawColor(226, 232, 240);
        $pdf->Rect($left, $footY, $width, 18, 'F');

        $pdf->SetTextColor(100, 116, 139);
        $pdf->SetFont('Helvetica', '', 8.5);
        $pdf->SetXY($left, $footY + 5);
        $footerNote = self::sanitizeText('Bunge FlexiBetter ' . date('Y') . ' - Official Event Consultation Pass - Please present at Booth D2A48');
        $pdf->Cell($width, 7, $footerNote, 0, 0, 'C');

        return $pdf->Output('S', "Bunge-FlexiBetter-Ticket-{$booking->booking_number}.pdf");
    }

    /**
     * Helper to render a field label and value pair with text sanitization.
     */
    protected static function renderField($pdf, $x, $y, $w, $label, $value): void
    {
        $pdf->SetTextColor(100, 116, 139);
        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->SetXY($x, $y);
        $pdf->Cell($w, 4, self::sanitizeText($label), 0, 1, 'L');

        $pdf->SetTextColor(15, 23, 42);
        $pdf->SetFont('Helvetica', 'B', 10.5);
        $pdf->SetXY($x, $y + 4.5);
        $pdf->Cell($w, 5.5, self::sanitizeText($value), 0, 1, 'L');
    }

    /**
     * Helper to render event bullet items with text sanitization.
     */
    protected static function renderBullet($pdf, $x, $y, $label, $value): void
    {
        $pdf->SetTextColor(100, 116, 139);
        $pdf->SetFont('Helvetica', 'B', 8);
        $pdf->SetXY($x, $y);
        $pdf->Cell(85, 4, self::sanitizeText($label), 0, 1, 'L');

        $pdf->SetTextColor(15, 23, 42);
        $pdf->SetFont('Helvetica', 'B', 9.5);
        $pdf->SetXY($x, $y + 4.5);
        $pdf->Cell(85, 5.5, self::sanitizeText($value), 0, 1, 'L');
    }

    /**
     * Helper to render Before You Arrive checklist items with text sanitization.
     */
    protected static function renderCheckItem($pdf, $x, $y, $text): void
    {
        $pdf->SetTextColor(4, 120, 87); // Emerald Checkmark #047857
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->SetXY($x, $y);
        $pdf->Cell(7, 5, '[v]', 0, 0, 'L');

        $pdf->SetTextColor(51, 65, 85); // Slate 700
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->SetXY($x + 7, $y);
        $pdf->Cell(73, 5, self::sanitizeText($text), 0, 1, 'L');
    }

    /**
     * Convert UTF-8 unicode special characters (en-dashes, em-dashes, middle dots, checkmarks) to clean PDF ASCII.
     */
    protected static function sanitizeText($text): string
    {
        if (empty($text)) {
            return '';
        }

        $str = (string) $text;

        // Replace UTF-8 en-dash (\xE2\x80\x93) & em-dash (\xE2\x80\x94) with standard ASCII hyphen
        $str = str_replace(["\xE2\x80\x93", "\xE2\x80\x94", '–', '—'], '-', $str);

        // Replace UTF-8 bullet/middle dot (\xE2\x80\xA2, \xC2\xB7) with standard ASCII hyphen
        $str = str_replace(["\xE2\x80\xA2", "\xC2\xB7", '·', '•'], '-', $str);

        // Replace UTF-8 checkmark (\xE2\x9C\x93) with standard ASCII [v]
        $str = str_replace(["\xE2\x9C\x93", '✓'], '[v]', $str);

        return $str;
    }
}
