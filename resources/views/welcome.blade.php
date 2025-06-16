<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Research Academy | Beranda</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('frontend/assets/img/HRP.png') }}" rel="icon">
  <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree&family=Mulish&family=Poppins:wght@600&display=swap" rel="stylesheet">

  
  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('frontend/assets/css/new.css') }}" rel="stylesheet">
</head>

<body class="index-page">

 <!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <!-- Logo -->
        <a href="{{ route('welcome') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('frontend/assets/img/logo_HRP.png') }}" alt="HRP Logo" class="img-fluid">
        </a>

        <!-- Search Form (Tetap Muncul di Mobile) -->
        <form id="globalSearchForm" class="form-inline my-2 my-md-0 navbar-search">
            <div class="input-group">
                <input type="text" id="globalSearchInput" class="form-control bg-light border-0 small" 
                    placeholder="Cari..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-custom-search" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <!-- Pesan "Tidak ada hasil" -->
            <div id="global-no-results" class="alert alert-info mt-2 d-none"></div>
        </form>

        <!-- Nav Menu -->
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero">Beranda</a></li>
                <li><a href="#materi">Materi</a></li>
                <li><a href="#progres-belajar">Progres</a></li>
                <li><a href="#testimonials">Testimoni</a></li>
                @auth
                    <li><a href="{{ route('participant.profile.edit') }}">Profil</a></li>
                @endauth
                
                <!-- Mobile Auth Buttons -->
                <li class="d-xl-none mobile-auth-buttons">
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">Masuk</a>
                    @endauth
                </li>
            </ul>
            <!-- Hamburger Menu Toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <!-- Desktop Auth Buttons -->
        @auth
            <form method="POST" action="{{ route('logout') }}" class="d-none d-xl-block">
                @csrf
                <button type="submit" class="btn-getstarted">Keluar</button>
            </form>
        @else
            <a class="btn-getstarted d-none d-xl-block" href="{{ route('login') }}">Masuk</a>
        @endauth
    </div>
</header>
  <!-- End Header -->

  <main class="main">

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero section dark-background">
      <div class="container d-flex align-items-center">
        
        <!-- Hero Text -->
        <div class="hero-text" data-aos="fade-up">
          <h2>Research Academy</h2>
          <p>Sumber Ilmu, Sahabat Magangmu</p>
          @auth
            <p class="welcome-message">Selamat datang, {{ Auth::user()->full_name }}!</p>
          @else
            <a href="{{ route('register') }}" class="btn-get-started">Daftar Sekarang</a>
          @endauth
        </div>

        <!-- Hero Image -->
        <div class="hero-image" data-aos="zoom-in">
          <img src="{{ asset('frontend/assets/img/herohi.png') }}" alt="Hero Image">
        </div>
      </div>

      <!-- Decorative Elements -->
      <div class="hero-decor decor-1"></div>
      <div class="hero-decor decor-2"></div>
      <div class="hero-decor decor-3"></div>
    </section>
    <!-- End Hero Section -->

    <!-- ======= Materi Section ======= -->
    <section id="materi" class="materi content-section">
      <div class="container">
        <div class="section-container">
          <!-- Section Header -->
          <div class="section-header" data-aos="fade-up">
            <h2>Materi Magang</h2>
            <p class="mt-3">Kumpulan materi pembelajaran untuk mendukung magang Anda</p>
          </div>
        </div>

        <div class="row flex-nowrap section-scroll" id="materi-scroll">
          @foreach($categories as $category)
          <div class="col-md-4 col-lg-3 content-col mb-4">
            <div class="card h-100 content-card card-hover-effect">
              @if($category->thumbnail)
              <img src="{{ $category->thumbnail_url }}" class="card-img-top" alt="{{ $category->name }}" style="height: 150px; object-fit: cover;">
              @else
              <div class="card-img-top bg-secondary" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-folder text-white" style="font-size: 3rem;"></i>
              </div>
              @endif
              <div class="card-body">
                <h5 class="card-title">{{ $category->name }}</h5>
                <div class="category-stats mb-2">
                  <span class="badge bg-primary">{{ $category->materials_count }} Materi</span>
                  <span class="badge bg-info">{{ $category->videos_count }} Video</span>
                  <span class="badge bg-primary">{{ $category->assignments_count }} Tugas</span>
                </div>
                <a href="{{ route('participant.categories.show', $category) }}" class="btn btn-primary stretched-link">
                  Lihat Detail
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
       <div class="scroll-indicator">
              <i class="bi bi-arrow-left-right"></i>
              <span>Geser untuk melihat lebih banyak</span>
            </div>
    </section>
    <!-- End Materi Section -->

    <!-- ======= Progres Belajar Section ======= -->
    <section id="progres-belajar" class="progres-belajar content-section" style="background-color:rgb(148, 253, 255);">
      <div class="container">
          <div class="section-container">
              <!-- Section Header -->
              <div class="section-header" data-aos="fade-up">
                  <h2>Progres Belajar</h2>
                  <p class="mt-3">Pantau perkembangan pembelajaran Anda</p>
              </div>
          </div>

          @auth
          <div class="row justify-content-center">
              <!-- Progress Card 1: Materi yang Telah Diselesaikan -->
              <div class="col-md-4 col-lg-3 content-col mb-4">
                  <div class="card h-100 content-card">
                      <div class="card-body text-center">
                          <div class="progress-circle mx-auto mb-3" data-value="{{ $materialProgress }}" style="--progress: 0%">
                              <span class="progress-value">0%</span>
                          </div>
                          <h5 class="card-title">Materi Diselesaikan</h5>
                          <p class="card-text">Anda telah menyelesaikan {{ $completedMaterials }} dari {{ $totalMaterials }} materi</p>
                          <a href="{{ route('progress.materials') }}" class="btn btn-outline-primary">Lihat Detail</a>
                      </div>
                  </div>
              </div>

              <!-- Progress Card 2: Video yang Ditonton -->
              <div class="col-md-4 col-lg-3 content-col mb-4">
                  <div class="card h-100 content-card">
                      <div class="card-body text-center">
                          <div class="progress-circle mx-auto mb-3" data-value="{{ $videoProgress }}" style="--progress: 0%">
                              <span class="progress-value">0%</span>
                          </div>
                          <h5 class="card-title">Video Ditonton</h5>
                          <p class="card-text">Anda telah menonton {{ $completedVideos }} dari {{ $totalVideos }} video</p>
                          <a href="{{ route('progress.videos') }}" class="btn btn-outline-primary">Lihat Detail</a>
                      </div>
                  </div>
              </div>
              <!-- Progress Card 3: Tugas yang Dikerjakan -->
    <div class="col-md-4 col-lg-3 content-col mb-4">
        <div class="card h-100 content-card">
            <div class="card-body text-center">
                <div class="progress-circle mx-auto mb-3" data-value="{{ $assignmentProgress }}" style="--progress: 0%">
                    <span class="progress-value">0%</span>
                </div>
                <h5 class="card-title">Tugas Dikerjakan</h5>
                <p class="card-text">Anda telah mengerjakan {{ $completedAssignments }} dari {{ $totalAssignments }} tugas</p>
                <a href="{{ route('progress.assignments') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>
</div>

          @else
          <div class="text-center py-5">
              <h4 class="mb-3">Silakan masuk untuk melihat progres belajar Anda</h4>
              <a href="{{ route('login') }}" class="btn btn-primary">Masuk Sekarang</a>
          </div>
          @endauth
      </div>
    </section>
    <!-- End Progres Belajar Section -->

    <!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials-section content-section">
  <div class="container">
    <div class="section-header text-center" data-aos="fade-up">
      <h2>Apa Kata Mereka</h2>
      <p class="mt-2 mb-3">Testimoni dari peserta Research Academy</p>
      
      @auth
      <a href="{{ route('testimonials.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tulis Testimoni
      </a>
      @endauth
    </div>

    <div class="testimonial-carousel-container">
      <div class="testimonial-carousel">
        @forelse($testimonials as $testimonial)
          <div class="testimonial-slide">
            <div class="card h-100 testimonial-card">
              <div class="card-body">
                <div class="testimonial-author">
                  <div class="avatar-circle">
                    {{ substr($testimonial->user->full_name, 0, 1) }}
                  </div>
                  <div class="author-info">
                    <h5>{{ $testimonial->user->full_name }}</h5>
                    <div class="rating">
                      @for($i = 1; $i <= 5; $i++)
                        @if($i <= $testimonial->rating)
                          <i class="bi bi-star-fill"></i>
                        @else
                          <i class="bi bi-star"></i>
                        @endif
                      @endfor
                    </div>
                  </div>
                </div>
                
                <div class="testimonial-content">
                  <p>{{ $testimonial->content }}</p>
                </div>
                
                <div class="testimonial-footer">
                  <span class="testimonial-date">{{ $testimonial->created_at->format('d M Y') }}</span>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="testimonial-slide">
            <div class="card testimonial-empty-card">
              <i class="bi bi-chat-square-quote"></i>
              <h5>Belum Ada Testimoni</h5>
              <p class="text-muted mb-3">Jadilah yang pertama memberikan testimoni</p>
              @auth
                <a href="{{ route('testimonials.create') }}" class="btn btn-primary btn-sm">
                  <i class="bi bi-plus-lg fs-6 me-1"></i>Tulis Testimoni
                </a>
              @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                  Masuk untuk Menulis
                </a>
              @endauth
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </div>
</section>

  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer position-relative light-background">
    <div class="container footer-top">
      <div class="row gy-4 align-items-start">
        <!-- About Column -->
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ route('welcome') }}" class="logo d-flex align-items-center mb-3">
            <img src="{{ asset('frontend/assets/img/logo_HRP.png') }}" alt="Mentor Logo" style="height: 40px;">
          </a>
          <div class="footer-contact pt-3">
            <p><i class="bi bi-geo-alt-fill me-2"></i> JL. Brigjend. H. Hasan Basri KM 11, Ray 5, Kel. Handil Bakti, Kec. Alalak, Kab. Barito Kuala, Prov. Kalimantan Selatan</p>
            <p><i class="bi bi-telephone-fill me-2"></i> <strong>Telp:</strong> 0895 3664 63628</p>
            <p><i class="bi bi-envelope-fill me-2"></i> <strong>Email:</strong> hrp@hasnurcentre.org</p>
          </div>

          <div class="social-links d-flex mt-4">
            <a href=" https://www.instagram.com/hrp.yhc?igsh=dTU1M2ZvbW9veGxt" class="me-2" target="_blank"><i class="bi bi-instagram"></i></a>
            <a href="#" class="me-2"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <!-- Quick Links Column -->
        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Tautan</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('welcome') }}">Beranda</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#materi">Materi</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#progres-belajar">Progres Belajar</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#testimonials">Testimoni</a></li>
            @auth
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('profile.edit') }}">Profil</a></li>
            @endauth
          </ul>
        </div>

        <!-- Motivation Card Column -->
        <div class="col-lg-6 col-md-12">
          <div class="card border-0 shadow-lg p-4 rounded-4 bg-light h-100">
            <div class="card-body d-flex flex-column justify-content-center h-100">
              <h4 class="card-title mb-3">Motivasi</h4>
              <blockquote class="blockquote mb-0">
                <p class="fs-5 fst-italic">"Pendidikan adalah senjata paling ampuh yang bisa kamu gunakan untuk mengubah dunia."</p>
                <footer class="blockquote-footer mt-2">Nelson Mandela</footer>
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="container-fluid copyright text-center py-3 mt-4">
      <div class="container">
        <p class="mb-0">© <span>Copyright</span> <strong class="px-1 sitename">Research Academy</strong> <span>All Rights Reserved</span></p>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
  
</body>
</html>