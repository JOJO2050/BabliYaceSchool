@component('mail::message')
    Bienvenue {{ $user->name }},

    {!! preg_replace('/<\/?p[^>]*>/', '', $user->send_message) !!}

    Merci,

    {{ config('app.name') }}
@endcomponent
