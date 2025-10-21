<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connexion | MediCare Pro</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        :root {
            --primary-color: #198754;
        }
        body {
            background:
                linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                url('https://images.unsplash.com/photo-1579684453423-f84349ef60b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
            background-color: white;
            transition: transform 0.3s ease;
        }
        .login-card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: var(--primary-color);
            color: #fff;
            text-align: center;
            padding: 1.5rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem #198754;
        }
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            color: white;
        }
        .btn-login:hover {
            background-color: #146c43;
            transform: translateY(-2px);
        }
        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .input-icon input {
            padding-left: 40px;
        }
        .gr {
            color: var(--primary-color);
        }
        .alert svg {
            flex-shrink: 0;
            width: 1.5em;
            height: 1.5em;
        }
    </style>
</head>
<body>
    <div class="login-card shadow-lg">
        <div class="card-header">
            <h3><i class="fas fa-lock me-2"></i>Connexion</h3>
        </div>
        <div class="card-body p-4">
            {{-- Affichage erreurs --}}
            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            {{-- Message succès --}}
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('doLogin') }}">
                @csrf

                <div class="mb-4 input-icon">
                    <i class="fas fa-envelope"></i>
                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Adresse email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 input-icon">
                    <i class="fas fa-key"></i>
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Mot de passe"
                        required
                    />
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn btn-login mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>

                <div class="text-center mt-3">
                    <a href="{{ url('/forgot-password') }}" class="gr text-decoration-none">
                        <i class="fas fa-question-circle me-1"></i>Mot de passe oublié?
                    </a>
                </div>
            </form>
        </div>

        <div class="card-footer text-center py-3">
            <small class="text-muted">Nouveau ici? <a href="{{ url('/register') }}" class="gr text-decoration-none">Créer un compte</a></small>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
