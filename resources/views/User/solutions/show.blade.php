{{-- resources/views/User/solutions/show.blade.php --}}
@extends('User.layouts.app')

@section('title', $solution->nama)

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
                            <img src="{{ asset('storage/' . $solution->image_content) }}"
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
