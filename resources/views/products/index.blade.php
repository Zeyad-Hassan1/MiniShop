@extends('layouts.app')

@section('content')
<style>
    .grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .product-card {
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: scale(1.05);
    }

    .lightbox {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90%;
    }

    .lightbox .close,
    .lightbox .prev,
    .lightbox .next {
        position: absolute;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }

    .lightbox .close {
        top: 20px;
        right: 30px;
    }

    .lightbox .prev {
        left: 30px;
    }

    .lightbox .next {
        right: 30px;
    }

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
    <h1>Our Products</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="product-card h-100">
                <a href="{{ asset('images/' . $product->image) }}" data-lightbox="product-gallery" data-title="{{ $product->name }}">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                </a>
                <div class="info card-body">
                    <h2 class="card-title" style="font-weight: bold;"><span style="color: blue;">Name :</span> {{ $product->name }}</h2>
                    <p class="card-text"><span style="color: red;">Price :</span> <span style="color: green; font-weight: bold;">{{ $product->price }}</span> EGP</p>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-solid">Add to cart</button>
                        <a href="{{ route('products.show', $product->id) }}" class="btn-solid">View Details</a>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div id="lightbox" class="lightbox">
    <span class="close">&times;</span>
    <span class="prev">&#10094;</span>
    <span class="next">&#10095;</span>
    <img class="lightbox-content" id="lightbox-img">
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const productImages = document.querySelectorAll('.product-card a[data-lightbox]');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const closeBtn = document.querySelector('.lightbox .close');
        const prevBtn = document.querySelector('.lightbox .prev');
        const nextBtn = document.querySelector('.lightbox .next');
        let currentIndex = 0;
        const images = Array.from(productImages).map(a => a.href);

        productImages.forEach((link, index) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                currentIndex = index;
                showImage(currentIndex);
                lightbox.style.display = 'flex';
            });
        });

        function showImage(index) {
            lightboxImg.src = images[index];
        }

        closeBtn.addEventListener('click', () => {
            lightbox.style.display = 'none';
        });

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        });

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        });

        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                lightbox.style.display = 'none';
            }
        });

        const addToCartForms = document.querySelectorAll('form[action*="cart/add"]');
        const cartCount = document.getElementById('cartCount');

        addToCartForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    cartCount.textContent = data.cartCount;
                    cartCount.classList.add('active');
                });
            });
        });
    });
</script>
@endsection
