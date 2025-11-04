{{-- resources/views/User/solutions/show.blade.php --}}
@extends('User.layouts.app')

@section('title', $solution->nama . ' | CV Arta Solusindo')

{{-- ===== SEO Meta Section ===== --}}
@section('meta_description', Str::limit(strip_tags($solution->content ?? 'Solusi teknologi profesional dari CV Arta Solusindo.'), 160))
@section('meta_keywords', $solution->meta_keywords ?? 'Solusi teknologi, engineering, Beacon Engineering, CV Arta Solusindo, sistem informasi, automation, software')
@section('og_title', $solution->nama . ' | CV Arta Solusindo')
@section('og_description', Str::limit(strip_tags($solution->content ?? 'Solusi inovatif untuk kebutuhan industri modern.'), 160))
@section('og_image', $solution->image_content ? asset('storage/' . $solution->image_content) : asset('assets/img/og-image.jpg'))
@section('twitter_title', $solution->nama . ' | CV Arta Solusindo')
@section('twitter_description', Str::limit(strip_tags($solution->content ?? 'Solusi teknologi industri dari CV Arta Solusindo.'), 160))
@section('twitter_image', $solution->image_content ? asset('storage/' . $solution->image_content) : asset('assets/img/og-image.jpg'))

@push('styles')
@php
    $solutionSchema = [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "serviceType" => $solution->nama,
        "name" => $solution->nama,
        "description" => Str::limit(strip_tags($solution->content ?? 'Solusi teknologi dan engineering profesional dari CV Arta Solusindo.'), 200),
        "provider" => [
            "@type" => "Organization",
            "name" => "CV Arta Solusindo",
            "alternateName" => "Beacon Engineering",
            "url" => url('/'),
            "logo" => asset('assets/img/icon.png'),
            "sameAs" => [
                "https://www.facebook.com/",
                "https://www.instagram.com/",
                "https://www.linkedin.com/",
                "https://wa.me/628123456789"
            ]
        ],
        "areaServed" => [
            "@type" => "Country",
            "name" => "Indonesia"
        ],
        "url" => url()->current(),
        "image" => $solution->image_content
            ? asset('storage/' . $solution->image_content)
            : asset('assets/img/og-image.jpg'),
        "mainEntityOfPage" => url()->current()
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($solutionSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $solution->nama }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.home') }}">Home</a></li>
                    <li class="current">{{ $solution->nama }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">
        <div class="container">
            <div class="row gy-4">

                {{-- Sidebar List Solutions --}}
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="services-list">
                        @forelse($solutions as $item)
                            <a href="{{ route('solutions.show', $item->slug) }}"
                                class="{{ request()->is('solutions/' . $item->slug) ? 'active' : '' }}">
                                {{ $item->nama }}
                            </a>
                        @empty
                            <p class="text-center col-12">Belum ada solutions tersedia.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Content Detail --}}
                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                    @if($solution->image_content)
                        <div class="solution-image-wrapper mb-3">
                            <img loading="lazy" src="{{ asset('storage/' . $solution->image_content) }}"
                                alt="{{ $solution->nama }}"
                                class="img-fluid services-img">
                        </div>
                    @endif

                    @if($solution->content)
                        <div class="mt-3" id="project-description">{!! $solution->content !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script>
        // Wait for the document to fully load
        document.addEventListener("DOMContentLoaded", function() {
            // Get the description container
            const descriptionElement = document.getElementById('project-description');

            // Check if the description has any lists (either ordered or unordered)
            const lists = descriptionElement.querySelectorAll('ul, ol');

            // Loop through each list and replace list items
            lists.forEach(function(list) {
                const listItems = list.querySelectorAll('li');

                listItems.forEach(function(item) {
                    // Replace list items with the custom icon
                    item.innerHTML = '<i class="bi bi-check-circle"></i>' + item.innerHTML;
                });
            });
        });
    </script>
@endsection
