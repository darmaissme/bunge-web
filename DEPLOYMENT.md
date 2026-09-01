# Dokumentasi Deployment & Panduan Teknis
**Bunge FlexiBetter Event Microsite & Consultation Pass System**

Dokumen ini berisi panduan lengkap arsitektur sistem, *tech stack*, konfigurasi server, serta langkah-langkah *deployment* (otomatis maupun manual) untuk proyek **Bunge FlexiBetter**.

---

## 1. Ringkasan Proyek & Spesifikasi Utama

* **Nama Proyek:** Bunge FlexiBetter Event Microsite & Consultation Pass System
* **Deskripsi:** Microsite interaktif untuk event Bunge FlexiBetter yang mencakup landing page informasi event, sistem registrasi & tiket konsultasi interaktif (dengan ekspor E-Ticket PNG/PDF & iCal `.ics`), serta Admin Dashboard untuk pengelolaan data pendaftaran.
* **Tipe Arsitektur:** Laravel Single-Directory Root Deployment (Disesuaikan untuk CPanel Shared Hosting tanpa memisahkan folder `public`).

---

## 2. Tech Stack & Dependensi

### Backend & Core
* **PHP:** ^8.2
* **Framework Backend:** Laravel 11.x (`laravel/framework: ^11.0`)
* **Utilities Backend:** Laravel Tinker (`laravel/tinker: ^2.9`), Guzzle HTTP Client (`guzzlehttp/guzzle: ^7.8`)

### Frontend & UI
* **Build Tool:** Vite 6 (`vite: ^6.0.0`) dengan `@tailwindcss/vite`
* **CSS Framework:** Tailwind CSS 4 (`tailwindcss: ^4.0.0`)
* **Interaktivitas & DOM:** Alpine.js 3 (`alpinejs: ^3.14.0`)
* **Animasi & Slider:** GSAP (`gsap: ^3.12.5`), Swiper.js (`swiper: ^11.2.0`)
* **Ikon:** Lucide Icons (`lucide: ^0.470.0`)
* **Ticket Renderer & Canvas:** `html2canvas` (Canvas PNG Generator dengan fallback `translateY(3px)` alignment)

### Database & Storage
* **Database Engine:** MySQL 8.0+ / MariaDB 10.4+
* **Database Name (Production):** `eventbun_bunge`

---

## 3. Informasi Server & Kredensial Environment

### Remote FTP Server (Production)
* **FTP Host:** `liege.id.rapidplex.com` (Port 21)
* **FTP Username:** `eventbun`
* **FTP Password:** `0d95+Ws*TI4Gbx`
* **Remote Path Directory:** `/public_html`

### Production Database Configuration
* **DB Host:** `localhost` (atau IP/Host yang dikonfigurasi di cPanel)
* **DB Database:** `eventbun_bunge`
* **DB Username:** `eventbun_bungeadmin`
* **DB Password:** `November@202103`

---

## 4. Konfigurasi Environment (`.env`)

Buat atau sesuaikan file `.env` di server production berdasarkan skema berikut:

```ini
APP_NAME="Bunge FlexiBetter"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_APP_KEY_HERE
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://event.bunge.id  # Sesuaikan dengan domain live

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventbun_bunge
DB_USERNAME=eventbun_bungeadmin
DB_PASSWORD="November@202103"

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
CACHE_STORE=database
```

---

## 5. Metode & Cara Deployment

Tersedia 3 metode deployment yang dapat dipilih sesuai kondisi server:

### Metode A: Automated FTP Sync Script (Direkomendasikan untuk Update Cepat)

Proyek ini telah dilengkapi script otomasisasi FTP Sync berbasis PowerShell (`sync_ftp.ps1`) dan Python (`sync_ftp.py`).

1. Buka PowerShell di direktori proyek lokal.
2. Jalankan perintah sync:
   ```powershell
   .\sync_ftp.ps1
   ```
   *Script akan secara otomatis membaca struktur folder lokal dan meng-upload file yang berubah ke `/public_html` di server FTP, serta mengabaikan folder development seperti `.git`, `.agents`, `node_modules`, `scratch`, dan `.gemini`.*

---

### Metode B: Deploy via ZIP Backup (cPanel File Manager)

Metode ini cocok untuk deployment awal atau pemulihan *checkpoint* penuh dari file ZIP (`file_web_bunge_complete.zip` atau `deploy_package.zip`).

1. **Upload File ZIP:**
   - Log in ke cPanel > **File Manager**.
   - Buka direktori `/public_html`.
   - Upload file `file_web_bunge_complete.zip`.

2. **Ekstrak File:**
   - Pilih `file_web_bunge_complete.zip` lalu klik **Extract** ke `/public_html`.

3. **Import Database:**
   - Masuk ke cPanel > **phpMyAdmin**.
   - Pilih database `eventbun_bunge`.
   - Klik tab **Import**, upload file SQL checkpoint (`bunge_flexibetter_db_checkpoint_21.sql` atau file dump terbaru), lalu klik **Go**.

4. **Set Hak Akses (Permissions):**
   - Pastikan folder `storage/` dan `bootstrap/cache/` memiliki izin akses **755** atau **775** (writable oleh web server).

---

### Metode C: Manual Setup via SSH / Terminal Server

Jika server mendukung akses SSH/CLI Terminal:

1. **Clone / Upload Source Code** ke direktori server (`/public_html`).
2. **Install Dependensi Backend:**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
3. **Generate App Key:**
   ```bash
   php artisan key:generate
   ```
4. **Build Asset Frontend:**
   ```bash
   npm install
   npm run build
   ```
5. **Jalankan Migration & Seeder:**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
6. **Optimasi Cache Laravel:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## 6. Arsitektur cPanel Shared Hosting (Root Web Entry)

Pada environment Shared Hosting (cPanel), document root domain mengarah langsung ke `/public_html`. Aplikasi ini telah dikonfigurasi agar dapat langsung diakses dari root tanpa harus menambahkan `/public` pada URL.

### File `index.php` di Root:
```php
<?php
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/vendor/autoload.php';

(require_once __DIR__.'/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

### File `.htaccess` di Root:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## 7. Standar Pemeliharaan & Troubleshooting (Gotchas)

1. **Session Timeout & Error 419 pada Admin Panel:**
   - Exception handler telah disesuaikan di `bootstrap/app.php` untuk menangani `TokenMismatchException`, `AuthenticationException`, dan `HttpException` (419, 500, 401) pada route `admin*`.

2. **Asset Fallback:**
   - File compiled CSS & JS siap pakai berada di `public/css/app.css` dan `public/js/app.js` sebagai fallback jika Vite dev server tidak berjalan.

3. **Generasi Tiket (E-Ticket Canvas & iCal):**
   - E-Ticket menggunakan `html2canvas` dengan konfigurasi background transparan dan penyesuaian `translateY(3px)` badge.
   - iCal menggunakan fungsi pembentukan `.ics` langsung via JavaScript (`addToCalendar()`).

---
*Dokumen ini diperbarui secara otomatis berdasarkan Checkpoint & Konfigurasi Sistem Bunge FlexiBetter.*
