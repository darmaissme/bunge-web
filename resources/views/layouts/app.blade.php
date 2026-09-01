<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?? 'en') }}" class="scroll-smooth overflow-x-hidden">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N2DHV5W6');</script>
    <!-- End Google Tag Manager -->

    @include('partials.head')
</head>
<body x-data class="bg-white text-slate-900 font-body antialiased selection:bg-amber-500 selection:text-white overflow-x-hidden">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N2DHV5W6"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    {{-- Main View Container Yield --}}
    @yield('content')

    {{-- Manage Your Booking Modal --}}
    @include('partials.manage-booking-modal')

    @include('partials.scripts')
</body>
</html>
