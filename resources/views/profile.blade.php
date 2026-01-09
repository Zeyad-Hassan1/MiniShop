@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success fade show text-center" id="successalert" style="transition:all 0.5s">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger fade show text-center" id="dangeralert" style="transition:all 0.5s">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li><br>
                @endforeach
            </ul>
        </div>
    @endif
<div class="container">
    <div class="container py-3">
  <div class="text-center mb-1">
    <h1 class="welcome-text mb-3">Edit Profile</h1>
</div>
</div>


    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="FullName" name="name" value="{{ old('name' , $user->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
<script>
        //handle success updated profile
    setTimeout(function(){
        var alert = document.getElementById('successalert');
        if(alert){
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';

            setTimeout(() => alert.remove(),600);
        }
    },7000)
        //handle danger error password
    setTimeout(function(){
        var alert = document.getElementById('dangeralert');
        if(alert){
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';

            setTimeout(() => alert.remove(),600);
        }
    },7000)
    </script>
@endsection