<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Réinitialisation du mot de passe - BabliYaceSchool</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('logo_ecole.jpg') }}">

    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <!-- Logo -->
                    <div class="app-auth-branding mb-4">
                        <a class="app-logo">
                            <img class="logo-icon me-2 h-100 w-100" src="{{ asset('logo_ecole.jpg') }}" alt="logo">
                        </a>
                    </div>


                    <!-- Titre -->
                    <h2 class="auth-heading text-center mb-5">BlaBla de mot de passe</h2>
                    @include('_message')
                    <!-- Formulaire -->
                    <div class="auth-form-container text-start">
                        <form method="post" action="" class="auth-form login-form">
                            {{ csrf_field() }}

                            {{-- {{ Hash::make('azerty') }} --}}

                            <!-- Email -->
                            <div class="email mb-3">
                                <label class="form-label" for="signin-password"><b>Mot de passe</b></label>
                                <input id="signin-password" name="password" type="password"
                                    class="form-control signin-password" placeholder="Saisir un nouveau mot de passe">
                                {{-- @error('password')
                                    <div class="error-message invalid-feedback" style="display: block;">
                                        <b> {{ $message }}</b>
                                    </div>
                                @enderror --}}
                            </div>

                            <div class="email mb-3">
                                <label class="form-label" for="signin-password"><b>Confirmer Mot de passe</b></label>
                                <input id="signin-password" name="password_confirmation" type="password"
                                    class="form-control signin-password"
                                    placeholder="Veillez confirmer le mot de passe saisi">
                                {{-- @error('password')
                                    <div class="error-message invalid-feedback" style="display: block;">
                                        <b> {{ $message }}</b>
                                    </div>
                                @enderror --}}
                            </div>

                            <!-- Mot de passe -->
                            <div class="password mb-3">


                                <!-- Extra (remember + mot de passe oublié) -->
                                <div class="extra mt-3 row justify-content-between">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="RememberPassword">
                                            <label class="form-check-label" for="RememberPassword">
                                                Se souvenir de moi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="forgot-password text-end">
                                            <a href="{{ url('/') }}">Se connecter ?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bouton -->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">
                                    Sauvegarder
                                </button>
                            </div>
                        </form>
                    </div><!--//auth-form-container-->
                </div><!--//app-auth-body-->

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <small class="copyright">
                            Système De <a class="app-link" href="#" target="_blank">GESTION SCOLAIRE
                                BabliYaceSchool</a>
                        </small>
                    </div>
                </footer><!--//app-auth-footer-->
            </div>
        </div><!--//auth-main-col-->

        <!-- Colonne de droite avec image -->

        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder"></div>
            <div class="auth-background-mask"></div>
            <div class="auth-background-overlay p-3 p-lg-5">
                <div class="d-flex flex-column align-content-end h-100">
                    <div class="h-100"></div>
                    <div class="overlay-content p-3 p-lg-4 rounded">
                        <h5 class="mb-3 overlay-title">Bienvenue</h5>
                        <div>Réinitialiser votre mot de passe afin d'accéder à la plateforme <b>BabliYaceSchool</b>.
                        </div>
                    </div>
                </div>
            </div><!--//auth-background-overlay-->
        </div><!--//auth-background-col-->
    </div><!--//row-->



</body>

</html>
