<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .login-page {
            height: 100vh;
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
        }
        .form-signin {
            max-width: 330px;
            padding: 15px;
        }
        .form-signin .form-floating:focus-within {
            z-index: 2;
        }
        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body class="login-page text-center">
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Toko Online</h1>
            <h2 class="h5 mb-3 fw-normal">Silahkan Login</h2>

            <div class="form-floating">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>
                <label for="username">Username</label>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }} Toko Online</p>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Toastr config
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
        };

        // Flash messages
        @if(session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if(session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>
</body>
</html>
