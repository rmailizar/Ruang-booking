<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo text-center">
            <img src="{{ asset('assets/badak/badak app.png') }}" alt="SiBadak Logo" >
          </div>
          <h4 class="text-center fw-bold">REGISTER</h4>
              

              @if ($errors->any())
                <div style="color: red;">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form method="POST" action="{{ route('register.post') }}" class="pt-3">
                @csrf

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="name" placeholder="Nama" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="no_hp" placeholder="No HP" value="{{ old('no_hp') }}">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="nim" placeholder="NIM" value="{{ old('nim') }}">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="jurusan" placeholder="Jurusan" value="{{ old('jurusan') }}">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Konfirmasi Password">
                </div>

                <div class="mt-3 d-grid gap-2">
                  <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">SIGN UP</button>
                </div>

                <div class="text-center mt-4 fw-light">
                  Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/template.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/todolist.js"></script>
</body>
</html>
