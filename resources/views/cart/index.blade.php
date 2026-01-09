@extends('layouts.app')

@section('content')
    <div class="container">
        <center>
            <h1 style="padding:20px;margin:30px;margin-top:-20px;background:lightgray;">Your Cart</h1>
        </center>
        @if(count($products) > 0)
            <div class="table-responsive">
                <table class="table" style="width:100%;">
                    <thead style="padding:20px;margin:20px;margin-top:-20px;background-color:dimgrey;">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Add/Del</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }} EGP</td>
                                <td>{{ $cart[$product->id] }}</td>
                                <td>{{ $product->price * $cart[$product->id] }} EGP</td>
                                <td>
                                    <div style="display:flex;gap:5px;align-items:center;">
                                        <form action="{{ route('cart.decrease', ['id' => $product->id]) }}" method="post">
                                            @csrf
                                            <button class="btn-solid" style="background:red;font-weight:700;">-</button>
                                        </form>
                                        <form action="{{ route('cart.increase', ['id' => $product->id]) }}" method="post">
                                            @csrf
                                            <button class="btn-solid" style="background:green;font-weight:700;">+</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <center style="margin:30px;">
                <br>
                <a href="{{ route('checkout.confirmation') }}" class="btn-solid">Complete The Purchase</a>

        @else
                <p>Your cart is empty.</p>
            @endif
    </div>
    </center>
@endsection