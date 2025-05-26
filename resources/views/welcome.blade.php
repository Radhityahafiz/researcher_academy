<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Home - Research Academy</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="icon">
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

  <style>
    /* Enhanced Card Styles */
    .content-card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    
    .content-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .content-card .card-body {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    
    .content-card .card-title {
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 10px;
    }
    
    .content-card .card-text {
      color: #7f8c8d;
      flex-grow: 1;
      margin-bottom: 15px;
    }
    
    .content-card .btn-primary {
      align-self: flex-start;
      background-color: #1abc9c;
      border-color: #1abc9c;
    }
    
    .content-card .btn-primary:hover {
      background-color: #16a085;
      border-color: #16a085;
    }
    
    /* Section Styles */
    .content-section {
      padding: 80px 0;
    }
    
    .section-header {
      margin-bottom: 40px;
      text-align: center;
    }
    
    .section-header h2 {
      font-weight: 800;
      color: #2c3e50;
      position: relative;
      display: inline-block;
      padding-bottom: 15px;
    }
    
    .section-header h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: #1abc9c;
    }
    
    /* Pagination Styles */
    .pagination-container {
      margin-top: 40px;
      display: flex;
      justify-content: center;
    }
    
    .pagination .page-item.active .page-link {
      background-color: #1abc9c;
      border-color: #1abc9c;
    }
    
    .pagination .page-link {
      color: #1abc9c;
    }
    
    /* Section Navigation Styles */
    .section-container {
      position: relative;
    }
    
    .section-nav {
      position: absolute;
      top: 0;
      right: 0;
      display: flex;
      gap: 10px;
    }
    
    .section-nav-btn {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: #f8f9fa;
      border: 1px solid #dee2e6;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .section-nav-btn:hover {
      background: #1abc9c;
      color: white;
    }
    
    /* Horizontal Scroll Styles */
    .section-scroll {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      padding-bottom: 20px;
    }
    
    .section-scroll::-webkit-scrollbar {
      display: none;
    }
    
    .content-col {
      flex: 0 0 25%;
      padding: 0 15px;
    }
    
    /* Enhanced Pagination */
    .pagination-lg .page-link {
      padding: 0.75rem 1.5rem;
      font-size: 1.1rem;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
      .content-col {
        flex: 0 0 50%;
      }
    }
    
    @media (max-width: 768px) {
      .content-section {
        padding: 60px 0;
      }
      
      .section-header h2 {
        font-size: 1.8rem;
      }
      
      .content-col {
        flex: 0 0 100%;
      }
      
      .section-nav {
        position: static;
        justify-content: center;
        margin-bottom: 20px;
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

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('welcome') }}" class="active">Home</a></li>
        <li><a href="#materi">Materi</a></li>
        <li><a href="#video-mentoring">Video</a></li>
        <li><a href="#quizz">Quiz</a></li>
        @auth
          <li><a href="{{ route('profile.edit') }}">Profile</a></li>
        @endauth
        
        <!-- Mobile-only auth buttons -->
        <li class="d-xl-none mobile-auth-buttons">
          @auth
            <form method="POST" action="{{ route('logout') }}" class="w-100">
              @csrf
              <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary w-100">Login</a>
          @endauth
        </li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <!-- Desktop-only auth buttons -->
    @auth
      <form method="POST" action="{{ route('logout') }}" class="d-none d-xl-block">
        @csrf
        <button type="submit" class="btn-getstarted">Logout</button>
      </form>
    @else
      <a class="btn-getstarted d-none d-xl-block" href="{{ route('login') }}">Login</a>
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
          @foreach($materials as $material)
          <div class="col-md-4 col-lg-3 content-col mb-4">
            <div class="card h-100 content-card">
              <div class="card-body">
                <h5 class="card-title">{{ $material->title }}</h5>
                <p class="card-text">{{ Str::limit($material->description, 100) }}</p>
                <a href="{{ auth()->check() ? (auth()->user()->isPeserta() ? route('participant.materials.show', $material) : route('materials.show', $material)) : route('login') }}" 
                   class="btn btn-primary">
                   Pelajari Sekarang
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- Pagination -->
        @if($materials->hasPages())
        <div class="pagination-container" data-aos="fade-up">
          {{ $materials->onEachSide(2)->links('pagination::bootstrap-4') }}
        </div>
        @endif
      </div>
    </section>
    <!-- End Materi Section -->

    <!-- ======= Video Mentoring Section ======= -->
    <section id="video-mentoring" class="video-mentoring content-section bg-light">
      <div class="container">
        <div class="section-container">
          <!-- Section Header -->
          <div class="section-header" data-aos="fade-up">
            <h2>Video Mentoring</h2>
            <p class="mt-3">Video pembelajaran dari mentor berpengalaman</p>
          </div>
          <div class="section-nav">
            <div class="section-nav-btn" onclick="scrollSectionLeft('video-scroll')">
              <i class="bi bi-chevron-left"></i>
            </div>
            <div class="section-nav-btn" onclick="scrollSectionRight('video-scroll')">
              <i class="bi bi-chevron-right"></i>
            </div>
          </div>
        </div>

        <div class="row flex-nowrap section-scroll" id="video-scroll">
          @foreach($videos as $video)
          <div class="col-md-4 col-lg-3 content-col mb-4">
            <div class="card h-100 content-card">
              <div class="ratio ratio-16x9">
                <iframe src="{{ $video->video_link }}" allowfullscreen></iframe>
              </div>
              <div class="card-body">
                <h5 class="card-title">{{ $video->title }}</h5>
                <p class="card-text">{{ Str::limit($video->description, 100) }}</p>
                <a href="{{ auth()->check() ? (auth()->user()->isPeserta() ? route('participant.videos.show', $video) : route('videos.show', $video)) : route('login') }}" 
                   class="btn btn-primary">
                   Tonton Lengkap
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- Pagination -->
        @if($videos->hasPages())
        <div class="pagination-container" data-aos="fade-up">
          {{ $videos->onEachSide(2)->links('pagination::bootstrap-4') }}
        </div>
        @endif
      </div>
    </section>
    <!-- End Video Mentoring Section -->

    <!-- ======= Quiz Section ======= -->
<section id="quizz" class="quizz content-section">
    <div class="container">
        <div class="section-container">
            <div class="section-header" data-aos="fade-up">
                <h2>Quiz Interaktif</h2>
                <p class="mt-3">Uji pemahaman Anda dengan quiz</p>
            </div>
            <div class="section-nav">
                <div class="section-nav-btn" onclick="scrollSectionLeft('quiz-scroll')">
                    <i class="bi bi-chevron-left"></i>
                </div>
                <div class="section-nav-btn" onclick="scrollSectionRight('quiz-scroll')">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>

        <div class="row flex-nowrap section-scroll" id="quiz-scroll">
            @foreach($quizzes as $quiz)
            <div class="col-md-4 col-lg-3 content-col mb-4">
                <div class="card h-100 content-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $quiz->title }}</h5>
                        <p class="card-text">{{ Str::limit($quiz->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="badge bg-primary">{{ $quiz->questions_count }} Soal</span>
                            @auth
                                @if(!$quiz->attempts()->where('user_id', auth()->id())->exists())
                                    <a href="{{ route('participant.quizzes.start', $quiz) }}" class="btn btn-outline-primary">Mulai Quiz</a>
                                @else
                                    <a href="{{ route('participant.quizzes.result', $quiz->attempts()->where('user_id', auth()->id())->first()) }}" 
                                       class="btn btn-outline-success">Lihat Hasil</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login untuk Quiz</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($quizzes->hasPages())
        <div class="pagination-container" data-aos="fade-up">
            {{ $quizzes->onEachSide(2)->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>
</section>
<!-- End Quiz Section -->

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
          <p><i class="bi bi-envelope-fill me-2"></i> <strong>Email:</strong> info@example.com</p>
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
          <li><i class="bi bi-chevron-right"></i> <a href="{{ route('welcome') }}">Home</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#materi">Materi</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#video-mentoring">Video</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#quizz">Quiz</a></li>
          @auth
          <li><i class="bi bi-chevron-right"></i> <a href="{{ route('profile.edit') }}">Profile</a></li>
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
    // Fungsi untuk scroll horizontal
    function scrollSectionLeft(sectionId) {
      const container = document.getElementById(sectionId);
      container.scrollBy({ left: -300, behavior: 'smooth' });
    }
    
    function scrollSectionRight(sectionId) {
      const container = document.getElementById(sectionId);
      container.scrollBy({ left: 300, behavior: 'smooth' });
    }
    
    // Inisialisasi scroll untuk setiap section
    document.addEventListener('DOMContentLoaded', function() {
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
      
      // Inisialisasi scroll horizontal untuk section
      ['materi-scroll', 'video-scroll', 'quiz-scroll'].forEach(sectionId => {
        const container = document.getElementById(sectionId);
        if (container) {
          container.addEventListener('wheel', (e) => {
            if (e.deltaY !== 0) {
              e.preventDefault();
              container.scrollLeft += e.deltaY;
            }
          });
        }
      });
    });
  </script>
</body>
</html>