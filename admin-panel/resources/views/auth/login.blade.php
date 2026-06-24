<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - NantiKita</title>
    <!-- Silakan link ke CSS/Bootstrap bawaan admin panel kalian di sini -->
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Admin Login</h3>

                        <!-- Notifikasi jika registrasi berhasil -->
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- Menampilkan error validasi jika salah input -->
                        @if ($errors->any())
                            <div class="alert alert-danger text-center small p-2">
                                {{ $errors->first('username') }}
                            </div>
                        @endif

                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ old('username') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn w-100"
                                style="background-color: #2D3E35; color: white;">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>