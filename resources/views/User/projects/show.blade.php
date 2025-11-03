{{-- resources/views/User/solutions/show.blade.php --}}
@extends('User.layouts.app')

@section('title', $project->nama_projek)

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $project->nama_projek }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.home') }}">Home</a></li>
                    <li class="current">{{ $project->nama_projek }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <!-- LEFT: IMAGE SLIDER + DESCRIPTION -->
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                            {
                                "loop": true,
                                "speed": 600,
                                "autoplay": {
                                    "delay": 5000
                                },
                                "slidesPerView": 1,
                                "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                }
                            }
                        </script>

                        <div class="swiper-wrapper align-items-center">
                            @forelse($project->imageProjects as $img)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $img->gambar) }}" alt="{{ $project->nama_projek }}">
                                </div>
                            @empty
                                <div class="swiper-slide">
                                    <img src="{{ asset('images/no-image.jpg') }}" alt="No image available">
                                </div>
                            @endforelse
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Deskripsi di bawah slider -->
                    <div class="portfolio-description mt-4" data-aos="fade-up" data-aos-delay="300">
                        {!! $project->deskripsi !!}
                    </div>
                </div>

                <!-- RIGHT: PROJECT INFORMATION -->
                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                        <h3>Informasi Proyek</h3>

                        <div class="info-list">
                            <div class="info-item">
                                <span class="label">Kategori</span>
                                <span class="value">{{ $project->kategori_projek }}</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Lokasi</span>
                                <span class="value">{{ $project->lokasi ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="label">User</span>
                                <span class="value">{{ $project->clients->nama ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Tahun</span>
                                <span class="value">{{ $project->tahun }}</span>
                            </div>
                            <div class="info-item">
                                <span class="label">URL</span>
                                <span class="value">
                                    @if($project->url)
                                        <a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        {{-- Tampilkan tombol White Paper jika ada --}}
                        @if(!empty($project->white_paper))
                            <div class="mt-3 text-center">
                                <a href="{{ $project->white_paper }}" target="_blank" class="btn btn-sm px-4 py-2 btn-whitepaper">
                                    <i class="bi bi-file-earmark-text me-1"></i> Lihat White Paper
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section><!-- /Portfolio Details Section -->
@endsection
