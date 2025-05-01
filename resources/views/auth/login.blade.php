<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - SiBadak</title>

  <!-- Bootstrap CSS (pastikan dimuat lebih awal) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Vendor & Custom CSS -->
  <link rel="stylesheet" href="../../assets/vendors/feather/feather.css" />
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css" />
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../../assets/vendors/typicons/typicons.css" />
  <link rel="stylesheet" href="../../assets/vendors/simple-line-icons/css/simple-line-icons.css" />
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css" />
  <link rel="stylesheet" href="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="d-flex align-items-center min-vh-100 ">
  <div class="container">
    <div class="row g-0 shadow-lg rounded overflow-hidden">
      
      <!-- Left Panel -->
      <div class="col-md-6 d-none d-md-flex bg-white justify-content-center align-items-center flex-column p-4">
        <img src="{{ asset('assets/badak/badak login.png') }}" class="img-fluid mb-3" style="max-width: 80%;" alt="SiBadak Logo">
      </div>

      <!-- Right Panel -->
      <div class="col-md-6 bg-white d-flex align-items-center justify-content-center p-4">
        <div class="w-100" style="max-width: 400px;">
          <div class="text-center mb-4">
            <img src="{{ asset('assets/badak/badak login.png') }}" alt="Logo" style="width: 200px;">
            <h4 class="fw-bold mt-2 mb-1">LOGIN</h4>
            <p class="text-muted mb-3">Sign in to continue</p>
          </div>

          <form method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
              <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">SIGN IN</button>
            </div>
            <div class="text-center mt-3">
              <span class="fw-light">Don't have an account? </span><a href="{{ route('register') }}" class="text-primary">Create</a>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Vendor JS -->
  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/template.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/todolist.js"></script>
  
  @if (session('login_error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: '{{ session('login_error') }}',
        confirmButtonColor: '#d33'
      });
    </script>
  @endif

</body>
</html>
