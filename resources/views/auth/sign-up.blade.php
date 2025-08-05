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
            <form action="{{ route('signup.submit') }}" method="POST">
                @csrf
                <h2 class="card-title">welcome back</h2>
                <p class="card-greeting">hey <strong>user</strong>, please enter your details</p>

                <div class="authenticate-select">
                    <div class="signin-btn"><a href="/signin">sign in</a></div>
                    <div class="signup-btn --active"><a href="/signup" class="--text-none">sign up</a></div>
                </div>

                <div class="input-box">
                    <div class="input-username-icon"></div>
                    <input type="text" name="username" class="input-textbox" placeholder="Username">
                </div>
                <div class="input-box">
                    <div class="input-username-icon"></div>
                    <input type="text" name="firstname" class="input-textbox" placeholder="First name">
                </div>
                <div class="input-box">
                    <input type="text" name="lastname" class="input-textbox" placeholder="Last name">
                </div>
                <div class="input-box">
                    <input type="text" name="email" class="input-textbox" placeholder="Email">
                </div>
                <div class="input-box">
                    <input type="password" name="password" class="input-textbox" placeholder="Password">
                </div>
                {{-- <div class="input-box">
                    <input type="text" name="" class="input-textbox" placeholder="Confirm password">
                </div> --}}

                <button class="btn-submit" type="submit">continue</button>
            </form>
        </div>
    </div>
</x-app.layout>