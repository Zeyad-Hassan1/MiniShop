@extends('layouts.app')

@section('content')
<div class="container">
    <div style="display:flex; justify-content:center; align-items:center; height:calc(60vh - 80px);" class="row justify-content-center">
        <div class="glass-card fade-slide-up">
            <div  class="card">
                <center>
                <h2 style="text-align:center; margin-bottom:10px; color:white;">Please Complete Your Information To Complete Your Order</h2>
                

                <div class="card-body">
                    <form action="{{ route('checkout.process') }}" method="post">
                        @csrf
                        <input type="text" name="Full Name" class="glass-input" placeholder="Full Name" style="width: 300px;" required>
                        <input type="text" name="phone" class="glass-input" placeholder="Mobile phone" style="width: 300px;" required>
                        <input type="email" name="email" class="glass-input" placeholder="Email" style="width: 300px;" required>
                        <input type="text" name="city" class="glass-input" placeholder="City" style="width: 300px;" required>
                        <input type="text" name="address" class="glass-input" placeholder="Address" style="width: 300px;" required>
                        <input type="text" name="district" class="glass-input" placeholder="District" style="width: 300px;" required>
                        <input type="text" name="postal_code" class="glass-input" placeholder="Postal Code" style="width: 300px;" required>
                    </form>
                    {{-- Add order summary here --}}

                        <button type="submit" class="btn-solid">Confirm Order</button>
                </div>
            </div>
            </center>
        </div>
    </div>
</div>
@endsection
