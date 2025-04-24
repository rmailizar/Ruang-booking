<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login - SiBadak</title>

    <!-- CSS Vendor -->
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

    <style>
      body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Segoe UI', sans-serif;
      }

      .login-wrapper {
        display: flex;
        height: 100vh;
      }

      .left-panel {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 20px;
      }

      .left-panel img {
        max-width: 500px;
      }

      .left-panel h3 {
        margin-top: 20px;
        font-weight: bold;
        
      }

      .right-panel {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
       
      }

    .auth-form-light {
    width: 100%;
    max-width: 500px;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    background-color: #fff; /* Biarkan container-nya tetap putih */
    }

      .brand-logo img {
        width: 50px;
        margin-bottom: 15px;
      }

      .text-center {
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="login-wrapper">
      <!-- Left Panel -->
      <div class="left-panel">
      <img src="{{ asset('assets/badak/badak login.png') }}" alt="SiBadak Logo" />
        <h3>SiBadak</h3>
      </div>

      <!-- Right Panel (Login Form) -->
      <div class="right-panel">
        <div class="auth-form-light text-left">
          <div class="brand-logo text-center">
          <img src="{{ asset('assets/badak/badak login.png') }}" alt="SiBadak Logo" />
          <span class="fw-bold fs-5 text-primary">SiBadak</span>
          </div>
          <h4 class="text-center fw-bold">LOGIN</h4>
          <h6 class="fw-light text-center">Sign in to continue.</h6>

          {{-- Error Handling --}}
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form class="pt-3" method="POST" >
            @csrf
            <div class="form-group">
              <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
            </div>
            <div class="mt-3 d-grid">
              <button type="submit" class="btn btn-primary btn-lg fw-medium auth-form-btn">SIGN IN</button>
            </div>
            <div class="my-2 d-flex justify-content-between align-items-center">
              <!-- Tambahkan jika perlu -->
            </div>
            <div class="text-center mt-4 fw-light">
              Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- JS -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/template.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/todolist.js"></script>
  </body>
</html>
