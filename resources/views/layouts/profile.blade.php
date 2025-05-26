<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .profile-container {
      max-width: 1000px;
      margin: 40px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .profile-header {
      border-bottom: 1px solid #eee;
      padding-bottom: 20px;
      margin-bottom: 30px;
    }
    .section-title {
      margin-bottom: 30px;
    }
    .form-control {
      padding: 10px 15px;
      border-radius: 8px;
    }
    .btn-primary {
      background-color: #5fcf80;
      border-color: #5fcf80;
      padding: 10px 25px;
      border-radius: 8px;
    }
    .btn-primary:hover {
      background-color: #4da76a;
      border-color: #4da76a;
    }
    .btn-danger {
      border-radius: 8px;
      padding: 10px 25px;
    }
    .back-btn {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="profile-container">
      
      <!-- Page Header -->
      <div class="profile-header">
        <h2 class="section-title">@yield('header')</h2>
      </div>

      <!-- Page Content -->
      <main>
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  @stack('scripts')
</body>
</html>