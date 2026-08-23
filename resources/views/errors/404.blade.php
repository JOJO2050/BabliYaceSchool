<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 - Page introuvable</title>

    <link rel="icon" href="{{ asset('assets1/img/kaiadmin/logo_ecole.jpg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/kaiadmin.min.css') }}">

    <style>
        body {
            min-height: 100vh;
            background: #f5f7fb;
        }

        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .error-card {
            max-width: 650px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .error-number {
            font-size: 120px;
            font-weight: 800;
            line-height: 1;
            color: #1572e8;
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 30px;
            font-weight: 700;
            color: #2a2f5b;
            margin-bottom: 15px;
        }

        .error-text {
            color: #6c757d;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .btn-dashboard {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .error-card {
                padding: 40px 20px;
            }

            .error-number {
                font-size: 90px;
            }

            .error-title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="error-container">

        <div class="error-card">

            <div class="error-number">
                404
            </div>

            <h1 class="error-title">
                Oups ! Page introuvable
            </h1>

            <p class="error-text">
                Désolé, la page que vous recherchez n'existe pas
                ou vous n'avez pas l'autorisation d'y accéder.
            </p>
            @auth

                @if (Auth::user()->user_type == 1)
                    <a href="{{ url('admin/dashboard') }}" class="btn btn-primary btn-dashboard">
                        Retour au dashboard
                    </a>
                @elseif (Auth::user()->user_type == 2)
                    <a href="{{ url('teacher/dashboard') }}" class="btn btn-primary btn-dashboard">
                        Retour au dashboard
                    </a>
                @elseif (Auth::user()->user_type == 3)
                    <a href="{{ url('student/dashboard') }}" class="btn btn-primary btn-dashboard">
                        Retour au dashboard
                    </a>
                @elseif (Auth::user()->user_type == 4)
                    <a href="{{ url('parent/dashboard') }}" class="btn btn-primary btn-dashboard">
                        Retour au dashboard
                    </a>
                @endif
            @else
                <a href="{{ url('') }}" class="btn btn-primary btn-dashboard">
                    Retour à l'accueil
                </a>

            @endauth

        </div>

    </div>

</body>

</html>
