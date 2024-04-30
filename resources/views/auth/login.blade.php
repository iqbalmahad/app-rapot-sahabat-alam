
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Muhammad Iqbal">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>e-Rapot Sahabat Alam</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/my-login.css') }}">
</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{ asset('img/logo.png') }}" alt="logo">
                    </div>

                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Login</h4>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ route('login') }}" method="POST" class="my-login-validation">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email_or_username" placeholder="Email or Username">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-block text-white" style="background-color: #495C40">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="footer">
                        Copyright &copy; 2024 &mdash; Sekolah Sahabat Alam Palangka Raya 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Script untuk menghilangkan notifikasi setelah beberapa detik dengan animasi fade
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.remove();
                }, 500); // Waktu animasi fade (500 milidetik)
            });
        }, 4000); // Notifikasi akan dihapus setelah 2 detik (2000 milidetik)
    </script>
    

    <script src="{{ url('dist/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{ url('dist/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
</body>
</html>