 @component('mail::message')

     Bienvenue {{ $user->name }},

     Nous sommes content de vous revoir


     @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
         Réinitialiser votre mot de passe
     @endcomponent

     Si vous avez un souci de Réinitialiser votre mot de passe, veillez nous contacter

     Merci,
     {{ config('app.name') }}
 @endcomponent
