<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #0056b3;
            --light-color: #ffffff;
            --dark-color: #212529;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-color);
        }

        .login-container {
            max-width: 1200px;
            width: 90%;
            margin: 2rem auto;
            box-shadow: 0 12px 50px rgba(0, 0, 0, 0.15);
            border-radius: 30px;
            overflow: hidden;
            background: #ffffff;
            transition: all var(--transition-speed) ease;
        }

        .hero-section {
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: 30px 0 0 30px;
            background: #ffffff;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-weight: 700;
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-section p {
            font-weight: 300;
            font-size: 1.2rem;
            color: #495057;
        }

        .login-form-section {
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: 0 30px 30px 0;
            background: #ffffff;
        }

        .form-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .form-header h2 {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control {
            height: 56px;
            padding: 1.5rem 1rem 0.5rem 3rem;
            border-radius: 12px;
            border: 1px solid #dee2e6;
            font-size: 1rem;
            transition: all var(--transition-speed) ease;
            background-color: #ffffff;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.15);
            background-color: #ffffff;
            transform: scale(1.01);
        }

        .form-floating label {
            padding-left: 3rem;
            color: #6c757d;
            font-weight: 400;
            transition: all var(--transition-speed) ease;
        }

        .form-floating .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus + .input-icon,
        .form-control:focus ~ label {
            color: var(--primary-color);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 5;
            transition: all var(--transition-speed) ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .btn-login {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            font-weight: 600;
            padding: 0.75rem;
            font-size: 1.1rem;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
            margin-top: 1rem;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, var(--secondary-color), #003087);
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }

        .animate-zoom-in {
            animation: zoomIn 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Toastr custom styles */
        .toast {
            background: #f8f9fa;
            border: none;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            color: #212529;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
        }

        .toast-success {
            border-left: 6px solid #28a745;
            background: #e6f4ea;
        }

        .toast-error {
            border-left: 6px solid #ffd700;
            background: #fff8e1;
        }

        .toast-title {
            font-weight: 600;
            color: #212529;
        }

        .toast-message {
            color: #212529;
        }

        @media (max-width: 991.98px) {
            .login-container {
                flex-direction: column;
            }

            .hero-section, .login-form-section {
                padding: 3rem 2rem;
            }

            .hero-section {
                text-align: center;
                border-radius: 30px 30px 0 0;
            }

            .login-form-section {
                border-radius: 0 0 30px 30px;
            }
        }

        @media (max-width: 575.98px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section, .login-form-section {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container animate-zoom-in">
        <div class="row g-0">
            <div class="col-lg-6">
                <div class="hero-section">
                    <div class="hero-content">
                        <h1 class="animate-slide-up">Selamat Datang di Toko Online</h1>
                        <p class="animate-slide-up">Masuk untuk pengalaman belanja terbaik!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-form-section">
                    <div class="form-header animate-slide-up">
                        <h2>Masuk</h2>
                    </div>
                    <form id="loginForm" class="login-form" method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        <div class="form-floating animate-slide-up">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Nama Pengguna" value="{{ old('username') }}">
                            <label for="username">Nama Pengguna</label>
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating animate-slide-up">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kata Sandi">
                            <label for="password">Kata Sandi</label>
                            <i class="far fa-eye password-toggle" id="togglePassword"></i>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-login w-100 animate-slide-up" type="submit">
                            Masuk <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Toastr configuration
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: "5000",
            extendedTimeOut: "2000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };

        // Password toggle functionality
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Form input animations
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.querySelector('.input-icon').style.color = '#007bff';
                this.parentNode.querySelector('label').style.color = '#007bff';
            });
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentNode.querySelector('.input-icon').style.color = '#6c757d';
                    this.parentNode.querySelector('label').style.color = '#6c757d';
                }
            });
        });

        // Client-side validation and AJAX submission
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const button = this.querySelector('button');

            // Clear previous client-side alerts
            const existingAlert = document.querySelector('.alert:not(.invalid-feedback)');
            if (existingAlert) existingAlert.remove();

            // Client-side validation
            if (!username || !password) {
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger mt-3 fade show';
                alert.style.animation = 'fadeIn 0.3s ease';
                alert.textContent = 'Harap isi nama pengguna dan kata sandi.';
                this.appendChild(alert);
                setTimeout(() => alert.remove(), 3000);
                return;
            }

            // Simulate loading state
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            // AJAX submission
            $.ajax({
                url: this.action,
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    button.disabled = false;
                    button.innerHTML = 'Masuk <i class="fas fa-arrow-right"></i>';
                    toastr.success('Login berhasil!', 'Sukses');
                    setTimeout(() => window.location.href = '{{ route('dashboard') }}', 1000);
                },
                error: function(xhr) {
                    button.disabled = false;
                    button.innerHTML = 'Masuk <i class="fas fa-arrow-right"></i>';
                    const errors = xhr.responseJSON?.errors;
                    if (errors && errors.username) {
                        toastr.error(errors.username[0], 'Error');
                    } else {
                        toastr.error('Terjadi kesalahan saat login.', 'Error');
                    }
                }
            });
        });

        // Display session-based messages
        @if(session('success'))
            toastr.success('{{ session('success') }}', 'Sukses');
        @endif
        @if(session('error'))
            toastr.error('{{ session('error') }}', 'Error');
        @endif
    </script>
</body>
</html>
