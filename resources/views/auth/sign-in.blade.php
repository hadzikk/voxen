<x-app.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/auth/signin.scss') }}">
        <link rel="stylesheet" href="{{ asset('css/component/notification.scss') }}">
    </x-slot:styles>

    <nav class="navbar">
        <a href="/"><i class="fa-solid fa-arrow-left"></i></a>
    </nav>

    <div class="container">
        <div class="card">
            <form action="/auth/verify" method="post">
                @csrf
                <h2 class="card-title">welcome back</h2>
                <p class="card-greeting">hey <strong>user</strong>, please enter your details</p>

                <div class="authenticate-select">
                    <div class="signin-btn --active"><a href="/auth/signin" class="--text-none">sign in</a></div>
                    <div class="signup-btn"><a href="/auth/signup">sign up</a></div>
                </div>

                <div class="input-box">
                    <div class="input-username-icon"></div>
                    <input type="text" name="username" class="input-textbox" placeholder="Enter your username here...">
                </div>
                <div class="input-box">
                    <div class="input-password-icon"></div>
                    <input type="password" name="password" class="input-textbox" placeholder="Enter your password here...">
                </div>

                <button class="btn-submit" type="submit">continue</button>
            </form>
        </div>
    </div>

    <x-app.notification></x-app.notification>
</x-app.layout>