@extends('layouts.app')

@section('content')
<style>
    .cart-count {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 20px;
        height: 20px;
        background-color: red;
        color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        font-weight: bold;
        transform: scale(0);
        transition: transform 0.3s ease;
    }

    .cart-count.active {
        transform: scale(1);
    }
</style>

<div class="container">

    <h1>{{ $product->name }}</h1>

    <div class="product-details">

        <img src="{{ asset('images/download.webp') }}" alt="{{ $product->name }}">

        <div class="info">

            <p><strong>Price:</strong> {{ $product->price }} EGP</p>

            <p><strong>Description:</strong> {{ $product->description }}</p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">

                @csrf

                <button type="submit" class="btn-solid">Add to cart</button>

            </form>

        </div>

    </div>

</div>



<script>

    document.addEventListener('DOMContentLoaded', () => {

        const addToCartForm = document.querySelector('form[action*="cart/add"]');

        const cartCount = document.getElementById('cartCount');



        addToCartForm.addEventListener('submit', (e) => {

            e.preventDefault();



            fetch(addToCartForm.action, {

                method: 'POST',

                headers: {

                    'X-CSRF-TOKEN': addToCartForm.querySelector('input[name="_token"]').value

                }

            })

            .then(response => response.json())

            .then(data => {

                cartCount.textContent = data.cartCount;

                cartCount.classList.add('active');

            });

        });

    });

</script>

@endsection
