@php
    $alertTypes = [
        'success' => 'success',
        'error' => 'danger',
        'payment-error' => 'danger',
        'warning' => 'warning',
        'info' => 'info',
        'secondary' => 'secondary',
        'primary' => 'primary',
        'light' => 'light',
    ];
@endphp

@foreach ($alertTypes as $key => $class)
    @if (session()->has($key))
        <div class="alert alert-{{ $class }} alert-dismissible fade show fw-bold border-0 border-start border-5 border-{{ $class }}"
            role="alert">

            {{ session($key) }}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach


<script>
    // Sélectionner tous les messages flash
    const flashMessages = document.querySelectorAll('.alert');

    flashMessages.forEach(msg => {
        // Supprimer après 5 secondes
        setTimeout(() => {
            // Ajouter fade-out pour animation
            msg.classList.remove('show');
            msg.classList.add('fade');

            // Supprimer complètement du DOM après la transition (150ms par défaut)
            setTimeout(() => {
                msg.remove();
            }, 150);
        }, 5000); // 5000ms = 5 secondes
    });
</script>
