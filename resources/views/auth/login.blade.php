<!DOCTYPE html>
<html lang="en">

<head>
    <title>Se connecter-BabliYaceSchoolDashboard</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="logo_ecole.jpg">

    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head>

<body class="app app-signup p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo"><img class="logo-icon me-2 h-100 w-100"
                                src="logo_ecole.jpg" alt="logo"></a></div>

                    {{-- {{ Hash::make('azerty') }} --}}
                    <h2 class="auth-heading text-center mb-4">Veuillez vous connectez</h2>
                    @include('_message')
                    <div class="auth-form-container text-start mx-auto">
                        <form class="auth-form login-form" action="{{ url('login') }}" method="post">
                            {{ csrf_field() }}
                            <div class="email mb-3">
                                <label class="sr-only" for="email">Email</label>
                                <input id="signin-email" name="email" type="email" class="form-control signin-email"
                                    placeholder="Entrez votre addresse email" required="required">
                            </div>


                            <div class="password mb-3">
                                <label class="sr-only" for="password">Mot de passe</label>
                                <input id="signin-password" name="password" type="password"
                                    class="form-control signin-password" placeholder="Password" required="required">
                                <div class="extra mt-3 row justify-content-between">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="remember">
                                            <label class="form-check-label" for="remember">
                                                Se souvenir
                                            </label>
                                        </div>
                                    </div><!--//col-6-->
                                    <div class="col-6">
                                        <div class="forgot-password text-end">
                                            <a href="{{ url('forgot-password') }}">Mot de passe oublié ?</a>
                                        </div>
                                    </div><!--//col-6-->
                                </div><!--//extra-->
                            </div><!--//form-group-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Se
                                    connecter</button>
                            </div>
                        </form>
                        {{-- 
                        <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link"
                                href="signup.html">here</a>.</div> --}}
                    </div><!--//auth-form-container-->



                </div><!--//auth-body-->

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <small class="copyright">Système De <a class="app-link" href="#" target="_blank"> GESTION
                                SCOLAIRE BabliYaceSchool</a>
                        </small>
                    </div>
                </footer><!--//app-auth-footer-->
            </div><!--//flex-column-->
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
                        <div>Connectez-vous pour accéder à la plateforme <b>BabliYaceSchool</b>.</div>
                    </div>
                </div>
            </div>
        </div><!--//auth-background-col-->
    </div><!--//row-->

    </div><!--//row-->


</body>

</html>
