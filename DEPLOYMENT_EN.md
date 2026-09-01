# Comprehensive Deployment Documentation & Technical Guide
**Bunge FlexiBetter Event Microsite & Consultation Pass System**

This document provides a complete guide to the system architecture, tech stack, server configuration, environment setup, and deployment procedures (both automated and manual) for the **Bunge FlexiBetter** web application.

---

## 1. Project Overview & Core Features

* **Project Name:** Bunge FlexiBetter Event Microsite & Consultation Pass System
* **Description:** An interactive event microsite built for Bunge FlexiBetter featuring an event landing page, an interactive consultation booking & pass generator system (with E-Ticket PNG/PDF export and iCal `.ics` calendar sync), and an Admin Management Dashboard for managing consultation bookings and event settings.
* **Architecture Type:** Laravel Single-Directory Root Deployment (Tailored for cPanel Shared Hosting without requiring a separate `/public` directory structure).

---

## 2. Tech Stack & Dependencies

### Backend & Core Framework
* **PHP Engine:** ^8.2
* **Backend Framework:** Laravel 11.x (`laravel/framework: ^11.0`)
* **Backend Tools & Packages:** Laravel Tinker (`laravel/tinker: ^2.9`), Guzzle HTTP Client (`guzzlehttp/guzzle: ^7.8`)

### Frontend & UI Architecture
* **Build Tool:** Vite 6 (`vite: ^6.0.0`) with `@tailwindcss/vite`
* **CSS Framework:** Tailwind CSS 4 (`tailwindcss: ^4.0.0`)
* **Reactive DOM & State:** Alpine.js 3 (`alpinejs: ^3.14.0`)
* **Animations & Carousels:** GSAP (`gsap: ^3.12.5`), Swiper.js (`swiper: ^11.2.0`)
* **Icons:** Lucide Icons (`lucide: ^0.470.0`)
* **Ticket Renderer & Canvas Engine:** `html2canvas` (Custom transparent PNG canvas with `translateY(3px)` badge alignment)

### Database & Storage
* **Database Engine:** MySQL 8.0+ / MariaDB 10.4+
* **Production Database Name:** `eventbun_bunge`

---

## 3. Server Environment & Production Credentials

### Remote FTP Server (Production)
* **FTP Host:** `liege.id.rapidplex.com` (Port 21)
* **FTP Username:** `eventbun`
* **FTP Password:** `0d95+Ws*TI4Gbx`
* **Remote Path Directory:** `/public_html`

### Production Database Credentials
* **DB Host:** `localhost` (or the configured cPanel MySQL host)
* **DB Name:** `eventbun_bunge`
* **DB User:** `eventbun_bungeadmin`
* **DB Password:** `November@202103`

---

## 4. Environment Configuration (`.env`)

Create or update the production `.env` file using the template below:

```ini
APP_NAME="Bunge FlexiBetter"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_APP_KEY_HERE
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://event.bunge.id  # Update with your live domain URL

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

## 5. Deployment Procedures & Instructions

Three deployment workflows are available depending on server access and environment requirements:

### Method A: Automated FTP Sync Script (Recommended for Fast Updates)

The repository includes pre-configured automated FTP deployment scripts in PowerShell (`sync_ftp.ps1`) and Python (`sync_ftp.py`).

1. Open PowerShell in the local project root directory.
2. Execute the sync script:
   ```powershell
   .\sync_ftp.ps1
   ```
   *The script automatically parses local file changes and syncs updated files to `/public_html` on the remote server while excluding development folders (`.git`, `.agents`, `node_modules`, `scratch`, `.gemini`).*

---

### Method B: Deploy via ZIP Archive (cPanel File Manager)

Ideal for initial setup or full snapshot restoration using `file_web_bunge_complete.zip` or `deploy_package.zip`.

1. **Upload ZIP Archive:**
   - Log in to cPanel > **File Manager**.
   - Navigate to `/public_html`.
   - Upload `file_web_bunge_complete.zip`.

2. **Extract Files:**
   - Select `file_web_bunge_complete.zip` and click **Extract** to `/public_html`.

3. **Import Database Dump:**
   - Open cPanel > **phpMyAdmin**.
   - Select database `eventbun_bunge`.
   - Click the **Import** tab, upload the SQL checkpoint file (`bunge_flexibetter_db_checkpoint_21.sql` or latest database dump), and click **Go**.

4. **Directory Permissions:**
   - Ensure `storage/` and `bootstrap/cache/` have **755** or **775** write permissions.

---

### Method C: Manual CLI & SSH Deployment

For servers supporting SSH/CLI access:

1. **Clone or Extract Source Files** into `/public_html`.
2. **Install Backend Dependencies:**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
3. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```
4. **Build Frontend Assets:**
   ```bash
   npm install
   npm run build
   ```
5. **Run Migrations & Database Seeders:**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
6. **Optimize Laravel Caches:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## 6. cPanel Shared Hosting Architecture (Root Directory Setup)

In Shared Hosting environments, domain document roots point directly to `/public_html`. This application is structured to serve directly from the root without requiring `/public` in the URL.

### Root `index.php`:
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

### Root `.htaccess`:
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

## 7. Maintenance Standards & Troubleshooting (Gotchas)

1. **Session Timeouts & 419 Token Mismatch in Admin Panel:**
   - Exception handlers in `bootstrap/app.php` handle `TokenMismatchException`, `AuthenticationException`, and `HttpExceptions` (419, 500, 401) across `admin*` routes seamlessly.

2. **Compiled Asset Fallbacks:**
   - Standalone pre-compiled assets reside in `public/css/app.css` and `public/js/app.js` as fallbacks if the Vite dev server is offline.

3. **Pass Ticket Engine (PNG & iCal):**
   - E-Ticket rendering utilizes `html2canvas` configured with transparent backgrounds and `translateY(3px)` badge alignment.
   - iCal calendar integration uses the JavaScript `.ics` generator `addToCalendar()`.

---
*Document automatically maintained and synced for the Bunge FlexiBetter System.*
