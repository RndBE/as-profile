<div>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            {{-- Loop data carousel --}}
            @foreach ($carousels as $index => $carousel)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    {{-- Gambar Carousel --}}
                    @if ($carousel->gambar && file_exists(public_path('storage/' . $carousel->gambar)))
                        <img loading="lazy" src="{{ asset('storage/' . $carousel->gambar) }}" alt="{{ $carousel->judul }}">
                    @else
                        {{-- Jika gambar tidak ada --}}
                        <img loading="lazy" src="{{ asset('assets/img/hero-carousel/hero-default.jpg') }}" alt="Default Image">
                    @endif

                    {{-- Konten Carousel --}}
                    <div class="carousel-container">
                        <h2>{{ $carousel->judul }}</h2>
                        <p>{{ $carousel->sub_judul ?? '' }}</p>
                        @if($carousel->link)
                            <a href="{{ $carousel->link }}" target="_blank" class="btn-get-started">Get Started</a>
                        @endif
                    </div>
                </div>
            @endforeach

            {{-- Tombol Navigasi --}}
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            {{-- Indikator Carousel --}}
            <ol class="carousel-indicators">
                @foreach ($carousels as $index => $carousel)
                    <li data-bs-target="#hero-carousel"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $loop->first ? 'active' : '' }}">
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    @if($about)
        <section id="about" class="about section light-background">
            <div class="container">
                <div class="row gy-4">

                    <!-- Gambar & Video -->
                    <div class="col-lg-5 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                        @if(!empty($about->gambar))
                            <img loading="lazy" src="{{ asset('storage/' . $about->gambar) }}" class="img-fluid rounded shadow-sm" alt="{{ $about->judul }}">
                        @else
                            <img loading="lazy" src="{{ asset('assets/img/about.jpg') }}" class="img-fluid rounded shadow-sm" alt="About Us">
                        @endif

                        @if(!empty($about->video_url))
                            <a href="{{ $about->video_url }}" class="glightbox pulsating-play-btn"></a>
                        @endif
                    </div>

                    <!-- Konten -->
                    <div class="col-lg-7 content" data-aos="fade-up" data-aos-delay="100">
                        <h3>{{ $about->judul ?? 'About Us' }}</h3>

                        <p>{{ $about->deskripsi ?? '' }}</p>

                        <ul class="mt-4">
                            @forelse($about->features as $feature)
                                <li>
                                    <i class="{{ $feature->icon ?? 'bi bi-star' }}"></i>
                                    <div>
                                        <h5>{{ $feature->judul ?? '-' }}</h5>
                                        <p>{{ $feature->deskripsi ?? '' }}</p>
                                    </div>
                                </li>
                            @empty
                                <p class="text-muted fst-italic">Belum ada fitur yang ditambahkan.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- /About Section -->


    <!-- Clients Section -->
    <section id="clients" class="clients section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    },
                    "breakpoints": {
                        "320": {
                        "slidesPerView": 2,
                        "spaceBetween": 40
                        },
                        "480": {
                        "slidesPerView": 3,
                        "spaceBetween": 60
                        },
                        "640": {
                        "slidesPerView": 4,
                        "spaceBetween": 80
                        },
                        "992": {
                        "slidesPerView": 6,
                        "spaceBetween": 120
                        }
                    }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    @forelse($clients as $client)
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('storage/' . $client->logo) }}" class="img-fluid" alt="{{ $client->nama }}"></div>
                    @empty
                        <p class="text-center col-12">Belum ada client.</p>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section><!-- /Clients Section -->

    <!-- Services Section -->
    <section id="solutions" class="services section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Solutions</h2>
            <p>Kami menyediakan berbagai solusi pencatatan otomatis (Automatic Recorder) untuk kebutuhan pemantauan lingkungan, hidrologi, dan sistem peringatan dini.</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                @forelse($solutions as $solution)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon">
                                {!! $solution->icon !!}
                            </div>
                            <a href="{{ route('solutions.show', $solution->slug) }}" class="stretched-link">
                                <h3>{{ $solution->nama }}</h3>
                            </a>
                            <p>{!! Str::limit(strip_tags($solution->description), 100, '...') !!}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-12">Belum ada solutions tersedia.</p>
                @endforelse
            </div>
        </div>

    </section>
    <!-- /Services Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">
        <img loading="lazy" src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    }
                    }
                </script>
                <div class="swiper-wrapper">
                    @forelse($testimonys as $testimony)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                @if($testimony->foto)
                                    <img loading="lazy" src="{{ asset('storage/' . $testimony->foto) }}"
                                        class="testimonial-img rounded-full object-cover"
                                        alt="{{ $testimony->nama }}"
                                        style="width:90px; height:90px;">
                                @endif
                                <h3>{{ $testimony->nama }}</h3>
                                <h4>{{ $testimony->pekerjaan }}</h4>
                                <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>{{ $testimony->testimoni }}</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->
                    @empty
                        <p class="text-center col-12">Belum ada testimony.</p>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section><!-- /Testimonials Section -->

    <!-- Project Section -->
    <section id="project" class="project section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Project</h2>
            <p>Beberapa proyek dan solusi sistem monitoring yang telah kami kembangkan untuk berbagai sektor industri — mulai dari manufaktur, pertanian, hingga lingkungan.</p>
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "centeredSlides": true,
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    },
                    "breakpoints": {
                        "320": {
                        "slidesPerView": 1,
                        "spaceBetween": 0
                        },
                        "768": {
                        "slidesPerView": 2,
                        "spaceBetween": 20
                        },
                        "1200": {
                        "slidesPerView": 3,
                        "spaceBetween": 20
                        }
                    }
                    }
                </script>

                <div class="swiper-wrapper align-items-center">
                    @forelse($projects as $project)
                    <!-- Item 1 -->
                    <div class="swiper-slide project-item">
                        <a href="{{ route('projects.show', $project->slug) }}" class="project-link">
                            <div class="project-img">
                                <img loading="lazy" src="{{ asset('storage/' . $project->thumbnail) }}" class="img-fluid" alt="">
                            </div>
                            <div class="project-info">
                                <h5>{{ $project->nama_projek }}</h5>
                                <p>{!! Str::limit(strip_tags($project->deskripsi), 50, '...') !!}</p>
                            </div>
                        </a>
                    </div>
                    @empty
                        <p class="text-center col-12">Belum ada proyek.</p>
                    @endforelse
                    <!-- Tambah item lainnya jika perlu -->
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- /Portfolio Section -->


    <!-- Team Section -->
    <section id="team" class="team section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Team</h2>
            <p>Tim profesional yang berdedikasi dalam memberikan solusi terbaik bagi kebutuhan Anda.</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row justify-content-center gy-4">

            <!-- Team Member 1 -->
            @forelse($teams as $team)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">

                    <div class="team-member">
                        <div class="member-img">
                            <img loading="lazy" src="{{ asset('storage/' . $team->foto) }}" class="img-fluid" alt="{{ $team->nama }}">
                            <div class="social">
                                @if (!empty($team->facebook))
                                    <a href="{{ $team->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if (!empty($team->instagram))
                                    <a href="{{ $team->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if (!empty($team->linkedin))
                                    <a href="{{ $team->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>{{ $team->nama }}</h4>
                            <span>{{ $team->posisi }}</span>
                        </div>
                    </div>

            </div>
            @empty
                    <p class="text-center col-12">Belum ada team.</p>
                @endforelse
            <!-- End Team Member -->
            </div>
        </div>
    </section>
    <!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Hubungi kami untuk konsultasi, informasi produk, atau permintaan penawaran.</p>
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                @if($contact)
                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="icon bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Address</h3>
                            <p>{{ $contact->alamat ?? '-' }}</p>
                        </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
                        <i class="icon bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>Call Us</h3>
                            <p>{{ $contact->phone ?? '-' }}</p>
                        </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="400">
                        <i class="icon bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email Us</h3>
                            <p>{{ $contact->email ?? '-' }}</p>
                        </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="500">
                            <i class="icon bi bi-share flex-shrink-0"></i>
                            <div>
                                <h3>Social Profiles</h3>
                                <div class="social-links">
                                @if($contact->instagram)
                                    <a href="{{ $contact->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if($contact->linkedin)
                                    <a href="{{ $contact->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div><!-- End Info Item -->
                @endif
            </div>

            <form action="{{ route('contact.send') }}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="600">
                @csrf
                <div class="row gy-4">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                        </div>

                        <div class="col-md-6 ">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                        </div>

                        <div class="col-md-12">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                        </div>

                        <div class="col-md-12">
                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>

                        <button type="submit">Send Message</button>
                    </div>
                </div>
            </form><!-- End Contact Form -->
        </div>
    </section><!-- /Contact Section -->
</div>
