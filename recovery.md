# Bunge FlexiBetter — Project Recovery & Snapshot Document

- **Project:** Bunge FlexiBetter Event Microsite & Consultation Pass System
- **Checkpoint Name:** `Bunge-FlexiBetter-Checkpoint-21-Bilingual-Complete`
- **Checkpoint Date:** 2026-08-09
- **Database Name:** `danlainl_bunge_web`
- **Database Dump File:** [bunge_flexibetter_db_checkpoint_21.sql](file:///d:/project/bunge-web/bunge_flexibetter_db_checkpoint_21.sql)

---

## 1. Current Working Features Verified

1. **Public Booking System:** Responsive multi-step consultation booking form with validation.
2. **MySQL Booking Storage:** Data persistence in `consultations` table with transactional integrity.
3. **Availability Engine:** 12 daily 30-minute consultation slots with strict 3-booking capacity limit per slot.
4. **Event Dates Management:** Pre-configured event dates (16, 17, 18 September 2026 at JIExpo Kemayoran, Jakarta).
5. **Duplicate Email Protection:** Pre-transaction & locked transactional duplicate active booking checks by email.
6. **Duplicate Phone Protection:** Pre-transaction & locked transactional duplicate active booking checks by phone number.
7. **Cancel Booking:** Secure cancellation via public ticket interface & CMS.
8. **Reschedule Booking:** Time slot & date rescheduling with real-time capacity re-verification.
9. **Manage Your Booking:** Secure email + booking number authentication accessible via footer CTA.
10. **Visitor Ticket:** Interactive digital ticket page featuring booking details, status badges, and QR code.
11. **Native Laravel PDF Ticket:** Clean standalone FPDF ticket generation without third-party binary dependencies.
12. **Download Ticket Image:** Canvas-based PNG ticket download (`html2canvas`) with proper badge alignment.
13. **CMS Admin Portal:** Secure admin authentication, booking overview, status updates, and availability controls.
14. **CMS CSV Export:** Instant CSV export of consultation records for event staff.
15. **Admin PDF Report:** Native PDF report compilation of all event bookings.
16. **Public Website Bilingual Support:** 100% bilingual UI switching between **English (EN)** and **Bahasa Indonesia (ID)** with global Alpine store persistence (`localStorage`).
17. **Hero Flash Fix:** Seamless validation error handling keeping page visual scroll fixed at the consultation booking form without scrolling back to Hero.

---

## 2. Environment & System Specifications

| Environment Component | Specification / Version |
| :--- | :--- |
| **PHP Engine** | `^8.2` (PHP 8.2 or higher required) |
| **Framework** | Laravel `^11.0` (Laravel 11.x) |
| **Node.js** | `^18.0.0` or `^20.0.0` |
| **Package Manager** | `npm` (or `yarn` / `pnpm`) |
| **Database Server** | MySQL 8.0+ / MariaDB 10.5+ |
| **Database Name** | `danlainl_bunge_web` |
| **Timezone** | `Asia/Jakarta` (WIB, GMT+7) |
| **Event Location** | Jakarta International Expo (JIExpo), Kemayoran, Jakarta |
| **Event Dates** | 16 September 2026, 17 September 2026, 18 September 2026 |
| **Daily Operating Hours** | 10:00 AM – 06:00 PM (GMT+7) |
| **Booking Slot Schedule**| 11:00 AM – 05:00 PM WIB (12 slots/day, 30 minutes/slot) |
| **Slot Capacity** | Maximum 3 active bookings per consultation slot |

---

## 3. Project Dependencies

### PHP (composer.json)
- `php`: `^8.2`
- `laravel/framework`: `^11.0`
- `guzzlehttp/guzzle`: `^7.8`
- `laravel/tinker`: `^2.9`

### JavaScript / CSS (package.json)
- `@tailwindcss/vite`: `^4.0.0`
- `tailwindcss`: `^4.0.0`
- `vite`: `^6.0.0`
- `alpinejs`: `^3.14.0`
- `gsap`: `^3.12.5`
- `lucide`: `^0.470.0`
- `swiper`: `^11.2.0`

---

## 4. Current Database Snapshot Summary

- **Total Event Dates:** 3 (`2026-09-16`, `2026-09-17`, `2026-09-18`)
- **Total Consultation Slots:** 36 (12 slots/day x 3 days)
- **Total Consultation Records:** 2
  - **Confirmed:** 2
  - **Pending:** 0
  - **Cancelled:** 0
  - **Completed:** 0
- **Total Admin Users:** 1 (`admin@bunge.com`)
- **Total Experts:** 1 (`Claudinei Freitas`)
- **Database Tables Count:** 8 (`migrations`, `users`, `events`, `experts`, `booking_settings`, `event_dates`, `consultation_slots`, `consultations`)

---

## 5. Local Restoration & Setup Instructions

Follow these step-by-step instructions to restore and run the project in a fresh local environment:

### Step 1: Clone / Copy Codebase
Ensure all application files are placed in your target web directory (e.g. `d:/project/bunge-web`).

### Step 2: Database Restoration
1. Open MySQL CLI or phpMyAdmin / HeidiSQL / DBeaver.
2. Create the target database:
   ```sql
   CREATE DATABASE IF NOT EXISTS `danlainl_bunge_web` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Import the database backup dump:
   ```bash
   mysql -u [db_user] -p danlainl_bunge_web < bunge_flexibetter_db_checkpoint_21.sql
   ```

### Step 3: Environment Configuration (`.env`)
1. Copy or create `.env` in the project root based on `.env.example`:
   ```env
   APP_NAME=Bunge
   APP_ENV=local
   APP_DEBUG=true
   APP_KEY=base64:ASNFZ4mrze8BI0Vniavt7wEjRWeJq+3vASNFZ4mrze8=
   APP_URL=http://127.0.0.1:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=danlainl_bunge_web
   DB_USERNAME=root
   DB_PASSWORD=your_local_password
   ```

### Step 4: Install Dependencies
1. Run PHP Composer installation:
   ```bash
   composer install
   ```
2. Run Node npm installation:
   ```bash
   npm install
   ```

### Step 5: Asset Compilation & Local Server Execution
1. Compile front-end assets:
   ```bash
   npm run build
   ```
2. Launch local Laravel development server:
   ```bash
   php artisan serve
   ```
3. Access the application in your browser at `http://127.0.0.1:8000`.

---

## 6. Server & Web Hosting Configuration

- **Document Root:** `public/`
- **URL Rewriting (Apache `.htaccess`):** Standard Laravel `.htaccess` in `public/` routing all requests through `index.php`.
- **FTP Sync Script:** `powershell -ExecutionPolicy Bypass -File .\sync_ftp.ps1` for uploading live changes to `ftp://ftp.danlainlain.id/public_html/bunge`.
