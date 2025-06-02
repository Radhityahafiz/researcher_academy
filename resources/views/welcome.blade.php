<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Beranda - Research Academy</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('frontend/assets/img/HRP.png') }}" rel="icon">
  <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@800&family=Nunito:wght@400;800&family=Quicksand:wght@500;800&display=swap" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/css/new.css') }}" rel="stylesheet">

  <style>
    /* CSS untuk Progress Circle */
    .progress-circle {
    width: 120px;
    height: 120px;
    position: relative;
    border-radius: 50%;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.progress-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0dcaf0; /* Warna biru muda (#0dcaf0) untuk angka presentase */
    z-index: 1;
}

.progress-circle::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: conic-gradient(#0dcaf0 var(--progress, 0%), #edf2f7 var(--progress, 0%)); /* Warna biru muda (#0dcaf0) untuk lingkaran progress */
    transform: rotate(-90deg);
    transform-origin: center;
    transition: background 0.5s ease;
}

.progress-circle::after {
    content: '';
    position: absolute;
    top: 10px;
    left: 10px;
    width: calc(100% - 20px);
    height: calc(100% - 20px);
    border-radius: 50%;
    background: white;
}

    /* Testimonials Section Styles */
    .testimonials-section {
      padding: 80px 0;
      background-color: white;
    }
    
    .testimonial-card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      transition: all 0.5s ease;
      height: 100%;
      border: none;
      background: #fff;
      transform: perspective(1000px) rotateY(0deg);
    }
    
    .testimonial-card:hover {
      transform: perspective(1000px) rotateY(5deg);
      box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .testimonial-header {
      padding: 20px;
      display: flex;
      align-items: center;
      border-bottom: 1px solid #eee;
    }
    
    .testimonial-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
      border: 3px solid #f8f9fa;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .testimonial-user {
      flex: 1;
    }
    
    .testimonial-user h5 {
      margin-bottom: 0;
      font-weight: 700;
    }
    
    .testimonial-user p {
      margin-bottom: 0;
      color: #6c757d;
      font-size: 0.9rem;
    }
    
    .testimonial-rating {
      color: #ffc107;
      font-size: 1rem;
    }
    
    .testimonial-body {
      padding: 20px;
    }
    
    .testimonial-text {
      font-style: italic;
      color: #495057;
      position: relative;
    }
    
    .testimonial-text::before,
    .testimonial-text::after {
      content: '"';
      font-size: 2rem;
      color: #dee2e6;
      position: absolute;
    }
    
    .testimonial-text::before {
      top: -15px;
      left: -10px;
    }
    
    .testimonial-text::after {
      bottom: -25px;
      right: -10px;
    }
    
    .testimonial-date {
      text-align: right;
      font-size: 0.8rem;
      color: #adb5bd;
      margin-top: 15px;
    }
    
    /* Section Navigation Buttons */
    .section-nav-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      transition: all 0.3s;
      margin-left: 10px;
    }
    
    .section-nav-btn:hover {
      background:rgb(37, 202, 252);
      color: white;
      transform: scale(1.1);
    }
    
    /* Progress Section Styles */
    .progres-belajar .section-scroll {
      justify-content: center !important;
      flex-wrap: wrap !important;
      overflow: visible !important;
    }

    .progres-belajar .content-col {
      flex: 0 0 auto;
      width: auto;
      max-width: 300px;
      padding: 0 10px;
    }

    /* Testimonial Auto-scroll Styles */
    #testimonials-scroll {
      scroll-behavior: smooth;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
    }

    #testimonials-scroll .content-col {
      scroll-snap-align: start;
      flex: 0 0 calc(33.333% - 20px);
      margin: 0 10px;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
      #testimonials-scroll .content-col {
        flex: 0 0 calc(50% - 20px);
      }
    }

    @media (max-width: 768px) {
      .progres-belajar .content-col {
        max-width: 100%;
        width: 100%;
      }
      
      #testimonials-scroll .content-col {
        flex: 0 0 calc(100% - 20px);
      }
      
      .section-header h2 {
        font-size: 1.8rem;
      }
    }
  </style>
</head>

<body class="index-page">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="{{ route('welcome') }}" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('frontend/assets/img/logo_HRP.png') }}" alt="HRP Logo" class="img-fluid">
      </a>
      <form id="globalSearchForm" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
          <input type="text" id="globalSearchInput" class="form-control bg-light border-0 small" 
              placeholder="Cari materi, video, quiz..." aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-custom-search" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </div>
      </form>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('welcome') }}">Beranda</a></li>
          <li><a href="#materi">Materi</a></li>
          <li><a href="#progres-belajar">Progres</a></li>
          <li><a href="#testimoni">Testimoni</a></li>
          @auth
            <li><a href="{{ route('profile.edit') }}">Profil</a></li>
          @endauth
          
          <!-- Mobile-only auth buttons -->
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
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <!-- Desktop-only auth buttons -->
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
          <img src="{{ asset('frontend/assets/img/hero_i.png') }}" alt="Hero Image">
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
          <div class="section-nav">
            <div class="section-nav-btn" onclick="scrollSectionLeft('materi-scroll')">
              <i class="bi bi-chevron-left"></i>
            </div>
            <div class="section-nav-btn" onclick="scrollSectionRight('materi-scroll')">
              <i class="bi bi-chevron-right"></i>
            </div>
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
                  <span class="badge bg-success">{{ $category->quizzes_count }} Kuis</span>
                </div>
                <a href="{{ route('participant.categories.show', $category) }}" class="btn btn-primary stretched-link">
                  Lihat Detail
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- End Materi Section -->

    <!-- ======= Progres Belajar Section ======= -->
<section id="progres-belajar" class="progres-belajar content-section bg-light">
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

            <!-- Progress Card 3: Kuis yang Diselesaikan -->
            <div class="col-md-4 col-lg-3 content-col mb-4">
                <div class="card h-100 content-card">
                    <div class="card-body text-center">
                        <div class="progress-circle mx-auto mb-3" data-value="{{ $quizProgress }}" style="--progress: 0%">
                            <span class="progress-value">0%</span>
                        </div>
                        <h5 class="card-title">Kuis Diselesaikan</h5>
                        <p class="card-text">Anda telah menyelesaikan {{ $completedQuizzes }} dari {{ $totalQuizzes }} kuis</p>
                        <a href="{{ route('progress.quizzes') }}" class="btn btn-outline-primary">Lihat Detail</a>
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
        <div class="section-container">
            <div class="section-header" data-aos="fade-up">
                <h2>Testimoni Peserta</h2>
                <p class="mt-3">Apa kata mereka tentang Research Academy</p>
            </div>
            @auth
                <div class="section-nav">
                    <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i>Tambah Testimoni
                    </a>
                </div>
            @endauth
        </div>

        <div class="row">
            @forelse($testimonials as $testimonial)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 testimonial-card">
                        <div class="testimonial-header">
                            <div class="testimonial-avatar bg-primary text-white rounded-circle">
                                {{ substr($testimonial->user->full_name, 0, 1) }}
                            </div>
                            <div class="testimonial-user">
                                <h5>{{ $testimonial->user->full_name }}</h5>
                                <p>Peserta Research Academy</p>
                            </div>
                            <div class="testimonial-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="testimonial-body">
                            <p class="testimonial-text">
                                {{ $testimonial->content }}
                            </p>
                            <div class="testimonial-date">
                                {{ $testimonial->created_at->format('d F Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada testimoni yang disetujui.
                    </div>
                </div>
            @endforelse
        </div>
</section>
<!-- End Testimonials Section -->

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
            <p><i class="bi bi-telephone-fill me-2"></i> <strong>Telp:</strong> 0212 9343 888</p>
            <p><i class="bi bi-envelope-fill me-2"></i> <strong>Email:</strong> hrp@hasnurcentre.org</p>
          </div>

          <div class="social-links d-flex mt-4">
            <a href="#" class="me-2"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="me-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="me-2"><i class="bi bi-instagram"></i></a>
            <a href="#" class="me-2"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <!-- Quick Links Column -->
        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Quick Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('welcome') }}">Beranda</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#materi">Materi</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#progres-belajar">Progres Belajar</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#testimoni">Testimoni</a></li>
            @auth
            <li><i class="bi bi-chevron-right"></i> <a href="{{ route('profile.edit') }}">Profil</a></li>
            @endauth
          </ul>
        </div>

        <!-- Motivation Card Column -->
        <div class="col-lg-6 col-md-12">
          <div class="card border-0 shadow-lg p-4 rounded-4 bg-light h-100">
            <div class="card-body d-flex flex-column justify-content-center h-100">
              <h4 class="card-title text-primary mb-3">Motivasi Hari Ini</h4>
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
  
  <script>
    // Fungsi untuk animasi progress circle
    document.addEventListener('DOMContentLoaded', function() {
      const progressCircles = document.querySelectorAll('.progress-circle');
      
      progressCircles.forEach(circle => {
        const value = parseInt(circle.getAttribute('data-value'));
        const progressValue = circle.querySelector('.progress-value');
        
        // Animate progress
        let start = 0;
        const duration = 1000;
        const increment = value / (duration / 16);
        
        const timer = setInterval(() => {
          start += increment;
          if (start >= value) {
            start = value;
            clearInterval(timer);
          }
          
          // Update text
          progressValue.textContent = Math.floor(start) + '%';
          
          // Update circle background
          circle.style.setProperty('--progress', start + '%');
          
          // Fallback for browsers that don't support CSS variables
          circle.style.background = `conic-gradient(#4361ee ${start}%, #edf2f7 ${start}%)`;
        }, 16);
      });
      
      // Fungsi untuk scroll horizontal
      function scrollSectionLeft(sectionId) {
        const container = document.getElementById(sectionId);
        container.scrollBy({ left: -300, behavior: 'smooth' });
      }
      
      function scrollSectionRight(sectionId) {
        const container = document.getElementById(sectionId);
        container.scrollBy({ left: 300, behavior: 'smooth' });
      }
      
      // Mobile nav toggle
      const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
      const navmenu = document.querySelector('#navmenu');
      
      if (mobileNavToggle && navmenu) {
          mobileNavToggle.addEventListener('click', function(e) {
              e.preventDefault();
              navmenu.classList.toggle('mobile-nav-active');
              this.classList.toggle('bi-list');
              this.classList.toggle('bi-x');
          });
      }
      
      // Smooth scroll for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function(e) {
              e.preventDefault();
              
              const targetId = this.getAttribute('href');
              if (targetId === '#') return;
              
              const targetElement = document.querySelector(targetId);
              if (targetElement) {
                  window.scrollTo({
                      top: targetElement.offsetTop - 70,
                      behavior: 'smooth'
                  });
                  
                  // Close mobile menu if open
                  if (navmenu.classList.contains('mobile-nav-active')) {
                      navmenu.classList.remove('mobile-nav-active');
                      mobileNavToggle.classList.toggle('bi-list');
                      mobileNavToggle.classList.toggle('bi-x');
                  }
              }
          });
      });
      
      // Add shadow to header on scroll
      const header = document.querySelector('#header');
      if (header) {
          window.addEventListener('scroll', function() {
              if (window.scrollY > 100) {
                  header.style.boxShadow = '0 2px 15px rgba(0, 0, 0, 0.1)';
              } else {
                  header.style.boxShadow = 'none';
              }
          });
      }
    });
  </script>
</body>
</html>