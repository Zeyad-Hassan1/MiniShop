@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:calc(120vh - 80px);">
        <div class="col-md-6">
            <div class="glass-card fade-slide-up">
                <h2 style="text-align:center; margin-bottom:10px; color:white;">Welcome to MiniShop 🎉</h2>
                <p style="text-align:center; margin-bottom:20px; color:#ddd; font-size:14px;">
                    Create your account and start your journey!
                </p>

                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <input type="text" class="glass-input" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
                    @error('name')
                    <div style="color:#dc3545; font-weight: bold; margin-top: 5px;" >
                        {{ $message }}
                    </div>
                    @enderror
                    <input type="text" class="glass-input" name="username" value="{{ old('username') }}" placeholder="user name" required>
                    @error('username')
                    <div style="color:#dc3545; font-weight: bold; margin-top: 5px;" >
                        {{ $message }}
                    </div>
                    @enderror
                    <input type="email" class="glass-input" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                    @error('email')
                    <div style="color:#dc3545; font-weight: bold; margin-top: 5px;" >
                        {{ $message }}
                    </div>
                    <!-- <small class="text-danger" >{{ $message }}</small> -->
                    @enderror

                    <input type="password" class="glass-input" name="password" id="password" placeholder="Password" required>
                    @error('password')
                    <small>{{ $message }}</small>
                    @enderror

                    <!-- Strength Meter -->
                    <div class="strength-bar">
                        <div id="strength-fill" class="strength-bar-fill"></div>
                    </div>
                    <div id="strength-text" class="strength-text">Password Strength</div>

                    <input type="password" class="glass-input" name="password_confirmation" placeholder="Confirm Password" required>

                    <button type="submit" class="submit-btn">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const strengthFill = document.getElementById('strength-fill');
    const strengthText = document.getElementById('strength-text');

    passwordInput.addEventListener('input', function () {
        const value = passwordInput.value;
        let strength = 0;

        if (value.length >= 6) strength++;
        if (value.match(/[A-Z]/)) strength++;
        if (value.match(/[0-9]/)) strength++;
        if (value.match(/[^A-Za-z0-9]/)) strength++;

        if (strength === 0) {
            strengthFill.style.width = "0%";
            strengthText.textContent = "Password Strength";
            strengthText.style.color = "#ccc";
        } else if (strength === 1) {
            strengthFill.style.width = "25%";
            strengthFill.style.background = "red";
            strengthText.textContent = "Weak";
            strengthText.style.color = "red";
        } else if (strength === 2) {
            strengthFill.style.width = "50%";
            strengthFill.style.background = "orange";
            strengthText.textContent = "Medium";
            strengthText.style.color = "orange";
        } else if (strength === 3) {
            strengthFill.style.width = "75%";
            strengthFill.style.background = "yellowgreen";
            strengthText.textContent = "Good";
            strengthText.style.color = "yellowgreen";
        } else {
            strengthFill.style.width = "100%";
            strengthFill.style.background = "limegreen";
            strengthText.textContent = "Strong";
            strengthText.style.color = "limegreen";
        }
    });
</script>
@endsection