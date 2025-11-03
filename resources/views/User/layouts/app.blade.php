<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title', 'CV Arta Solusindo | Solusi Teknologi dan Engineering Profesional')</title>

  {{-- ===== Meta SEO Utama ===== --}}
  <meta name="description" content="@yield('meta_description', 'CV Arta Solusindo adalah perusahaan yang bergerak di bidang teknologi, engineering, dan pengembangan sistem informasi untuk mendukung kebutuhan industri dan bisnis modern.')">
  <meta name="keywords" content="@yield('meta_keywords', 'CV Arta Solusindo, Beacon Engineering, sistem informasi, teknologi, engineering, software development, IoT, smart factory, automation, IT Solution, Yogyakarta')">
  <meta name="author" content="CV Arta Solusindo">
  <meta name="robots" content="index, follow">
  <meta name="language" content="id">
  <meta name="distribution" content="global">
  <link rel="canonical" href="{{ url()->current() }}">

  {{-- ===== Open Graph (Facebook, LinkedIn, WhatsApp) ===== --}}
  <meta property="og:title" content="@yield('og_title', 'CV Arta Solusindo | Solusi Teknologi dan Engineering Profesional')">
  <meta property="og:description" content="@yield('og_description', 'Kami menyediakan layanan pengembangan sistem informasi, software, dan solusi teknologi industri.')">
  <meta property="og:image" content="@yield('og_image', asset('assets/img/og-image.jpg'))">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="CV Arta Solusindo">

  {{-- ===== Twitter Card ===== --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('twitter_title', 'CV Arta Solusindo | Solusi Teknologi dan Engineering Profesional')">
  <meta name="twitter:description" content="@yield('twitter_description', 'Mitra solusi teknologi industri dan sistem informasi terpercaya.')">
  <meta name="twitter:image" content="@yield('twitter_image', asset('assets/img/og-image.jpg'))">

  {{-- ===== Structured Data / Schema.org ===== --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "CV Arta Solusindo",
    "alternateName": "Beacon Engineering",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('assets/img/icon.png') }}",
    "sameAs": [
      "https://www.facebook.com/",
      "https://www.instagram.com/",
      "https://www.linkedin.com/",
      "https://wa.me/628123456789"
    ],
    "description": "CV Arta Solusindo adalah penyedia solusi teknologi, sistem informasi, dan engineering untuk kebutuhan industri dan bisnis di Indonesia.",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Jl. Contoh No. 123, Sleman, Yogyakarta",
      "addressLocality": "Yogyakarta",
      "addressCountry": "ID"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+62-812-3456-7890",
      "contactType": "customer service",
      "availableLanguage": ["Indonesian", "English"]
    }
  }
  </script>

  {{-- ===== Favicon ===== --}}
  <link rel="icon" href="{{ asset('assets/img/icon.png') }}" type="image/png">
  <link rel="apple-touch-icon" href="{{ asset('assets/img/icon.png') }}">
  <link rel="manifest" href="/site.webmanifest">

  {{-- ===== Fonts ===== --}}
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Raleway:wght@300;400;500;700;900&family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

  {{-- ===== Vendor CSS ===== --}}
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  {{-- ===== Main CSS ===== --}}
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  @stack('styles')
</head>

<body class="index-page">

  {{-- ===== Header ===== --}}
  @include('User.layouts.header')

  {{-- ===== Main Content ===== --}}
  <main class="main">
    {{-- Untuk Livewire layout --}}
    @isset($slot)
        {{ $slot }}
    @endisset

    {{-- Untuk Blade biasa --}}
    @yield('content')
  </main>

  {{-- ===== Footer ===== --}}
  @include('User.layouts.footer')

  {{-- ===== Scroll Top ===== --}}
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  {{-- ===== Preloader ===== --}}
  <div id="preloader"></div>

  {{-- ===== Vendor JS ===== --}}
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}" defer></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}" defer></script>

  {{-- ===== Main JS ===== --}}
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @stack('scripts')
</body>
</html>
