# Bunge FlexiBetter Event Web — Stable Recovery Snapshot

> **Checkpoint Timestamp:** 2026-08-24 06:45 WIB (CHECKPOINT 108 — REPLACED EVENT-IMAGE-NEW.PNG WITH BUNGE_BOOTH INDO2.PNG IN RESOURCES & PUBLIC IMAGES, FAST-PUSH SYNCED)  
> **Status:** Fully locked standards across all sections. Consultation Process Card Image Updated:  
> 1. **Consultation Process Image Replacement (`resources/views/partials/consultation.blade.php`)**:
>    - Replaced `event-image-new.png` with `bunge_booth indo2.png` (`D:\project\bunge-web\resources\images\bunge_booth indo2.png`).  
>    - Updated both local `resources/images/event-image-new.png` & `public/images/event-image-new.png` (plus fallback `bunge_booth indo2.png`).  
>    - Fast-push uploaded to live server `ftp://liege.id.rapidplex.com/public_html/public/images/event-image-new.png` and `ftp://liege.id.rapidplex.com/public_html/images/event-image-new.png`.  
> 2. **Mobile Hero Section Layout (`resources/views/partials/hero.blade.php`)**:
>    - Mobile CTA Card: `bg-[#002D6E] p-3 px-3.5 sm:px-4 rounded-2xl border border-[#002D6E] shadow-sm shadow-[#002D6E]/15 w-full overflow-hidden`. Soft minimalist shadow, crisp white text, green CTA button.  
>    - Logo Pair: `logoflexi.png` and `fia5.png` (`h-[64px] sm:h-[76px]`) placed side-by-side with `gap-2 sm:gap-3`.  
> 3. **Header Navbar Architecture (`resources/views/partials/header.blade.php`)**:
>    - Left Bunge Navbar Logo: `images/NewLogo.svg` (`absolute top-5 sm:top-6 lg:top-7`).  
>    - Right Navigation Capsule Pod: `fixed top-5 sm:top-6 lg:top-7`.  
> 4. **Consultation & Expert Section Architecture (`resources/views/partials/consultation.blade.php`)**:
>    - Expert Profile Image: `images/expert2.png`.  
>    - Heading: 1 single line `"Our Expert:"` (`Spesialis Kami:`) positioned above the photo.  
>    - Green Expandable Profile Badge: Wrapped in `@if(false) ... @endif` (Hidden).  
>    - Height Alignment: Left booking form card (`lg:col-span-7`) and right column (`lg:col-span-5`) use `items-stretch` and `h-full` for 100% flush top-to-bottom alignment.  
> Fully uploaded & synced to live server `ftp://liege.id.rapidplex.com/public_html`.

---

## Recovery Checklist & Architecture Guidelines

### 1. Consultation Process Card Image (`resources/views/partials/consultation.blade.php`)
- **Asset File:** `images/event-image-new.png` (Replaced with `bunge_booth indo2.png`).

---

### 2. Mobile Hero Section Layout (`resources/views/partials/hero.blade.php`)
- **Logo Pair:** `logoflexi.png` and `fia5.png` (`h-[64px] sm:h-[76px]`) placed side-by-side with `gap-2 sm:gap-3`.
- **Mobile CTA Card:** `bg-[#002D6E] p-3 px-3.5 sm:px-4 rounded-2xl border border-[#002D6E] shadow-sm shadow-[#002D6E]/15 w-full overflow-hidden`. Soft minimalist shadow, crisp white text, green CTA button.

---

### 3. Header Navbar Logo & Sticky Architecture (`resources/views/partials/header.blade.php`)
- **Left Bunge Navbar Logo:** `images/NewLogo.svg` (`absolute top-5 sm:top-6 lg:top-7`).
- **Right Navigation Capsule Pod:** `fixed top-5 sm:top-6 lg:top-7`.

---

### 4. Admin Password Toggle & Session Timeout Architecture (`resources/views/admin/login.blade.php` & `bootstrap/app.php`)
- **Password Input Visibility Toggle:** `div[x-data="{ showPass: false }"]`.
- **Session Timeout Exception Handling (`bootstrap/app.php`):** Handles `TokenMismatchException`, `AuthenticationException`, and `HttpException` (419, 500, 401) on `admin*` routes.
