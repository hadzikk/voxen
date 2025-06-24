@if(session('success') || session('error'))
    <div class="notification-container {{ session('success') ? 'success' : 'error' }}">
        <div class="notification">
            <p class="notification-text">
                {{ session('success') ?? session('error') }}
            </p>
            <i class="notification-icon {{ session('success') ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-exclamation' }}"></i>
        </div>
    </div>
@endif

<script src="{{ asset('js/auth.js') }}"></script>