@extends('layouts.app')

@section('content')
@if (session('redirect_message'))
<div class="alert alert-info fade show text-center" id="autohidealert" style="transition:all 0.5s;">
    {{session('redirect_message') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success fade show text-center" id="successalert" style="transition:all 0.5s">
    {{ session('success') }}
</div>
@endif
@if (session('message'))
<div class=" --bs-primary fade show text-center" id="messagealert" style="transition: all 0.5s;">
    {{ session('message') }}
</div>

@endif
@error('email')
            <div class="alert alert-danger fade show text-center" id="errorAlert" style="transition: all 0.5s;">
                {{ __('auth.failed') }}
            </div>
            @enderror
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:calc(100vh - 80px);">
        <div class="col-md-6">
            <div class="glass-card fade-slide-up">
                <h2 style="text-align:center; margin-bottom:10px; color:white;">Welcome Back 👋</h2>
                <p style="text-align:center; margin-bottom:20px; color:#ddd; font-size:14px;">
                    Log in to continue to MiniShop
                </p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <input type="email" name="email" class="glass-input" placeholder="Email Address" required>
                    
                    <div class="password-wrapper">
                        <input type="password" name="password" class="glass-input" id="password" placeholder="Password" required>
                        <span id="togglePass" class="toggle-pass">Show</span>
                    </div>

                    <button type="submit" class="login-btn">Login</button>

                    <div class="register-link">
                        Don't have an account? <a href="/register">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        //handle success created user
    setTimeout(function(){
        var alert = document.getElementById('successalert');
        if(alert){
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';

            setTimeout(() => alert.remove(),600);
        }
    },7000)
    //handle error add to product
    setTimeout(function(){
        var alert = document.getElementById('autohidealert');
        if(alert){
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';

            setTimeout(() => alert.remove(),600);
        }
    },7000)
    // Show/Hide Password
    //handle error email/login
    setTimeout(function(){
        var alert = document.getElementById('errorAlert');
        if (alert){
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(),500);
        }
    },5000);
    const passwordInput = document.getElementById('password');
    const togglePass = document.getElementById('togglePass');

    togglePass.addEventListener('click', () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePass.textContent = "Hide";
        } else {
            passwordInput.type = "password";
            togglePass.textContent = "Show";
        }
    });
</script>
@endsection