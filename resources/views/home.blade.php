<!-- resources/views/home.blade.php -->
@extends('layouts.app') <!-- نفترض عندك layout أساسي -->

@section('content')
  @auth
    @if (session('success'))
      <div class="alert alert-success fade show text-center" id="successalert" style="transition:all 0.5s">
        {{ session('success') }}
      </div>
    @endif
    @if (auth()->check() && !auth()->user()->is_admin)

      <div class="container py-5">
        <div class="text-center mb-5" style="width:200px;margin:36px;">
          <h1 class="welcome-text mb-3">
            welcome back mr {{ auth()->user()->username ?? 'mango'}}
          </h1>
          <p class="text-white fs-4 justify-content-center">You Are Ready For Day?</p>
        </div>
        <div class="row g-4 justify-content-center" style="width: 100px;">
          <div class="col-md-3">
            <div class="glass-card stat-card text-white p-4 text-center">
              <i class="bi bi-cart-check fs-1 mb-3"></i>
              <h3 class="fw-bold">1,248</h3>
              <p class="mb-0 opacity-90">orders for this day</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="glass-card stat-card text-white p-4 text-center">
              <i class="bi bi-currency-dollar fs-1 mb-3"></i>
              <h3 class="fw-bold">48,920$</h3>
              <p class="mb-0 opacity-90">total orders</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="glass-card stat-card text-white p-4 text-center">
              <i class="bi bi-person-plus fs-1 mb-3"></i>
              <h3 class="fw-bold">+89</h3>
              <p class="mb-0 opacity-90">new members</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="glass-card stat-card text-white p-4 text-center">
              <i class="bi bi-box-seam fs-1 mb-3"></i>
              <h3 class="fw-bold">512</h3>
              <p class="mb-0 opacity-90">active product</p>
            </div>
          </div>
          <center>
            <div class="row mt-5">
              <div class="col-12">
                <div class="glass-card p-5 text-center text-white">
                  <h2 class="mb-4">all things under we</h2>
                  <p class="lead"> lets gooo
                    <a href="#" class="btn-solid" style="background: rgba(255, 255, 255, 0.74);">add new product</a>
                    <a href="#" class="btn-solid">view all products</a>
                  </p>
                </div>
              </div>
            </div>
          </center>
        </div>
      </div>
    @endif

  @endauth
  <!-- ----------------------------------------------------- -->
  @if (auth()->check() && auth()->user()->is_admin)
    <div class="container py-5">
      <div class="text-center mb-5">
        <h1 class="welcome-text mb-3">
          welcome Admin ({{ auth()->user()->username }})
        </h1>
        <form action="{{ route('admin.dashboard') }}" method="post">
          @csrf
          <button class="btn-solid">Admin Dashboard</button>
        </form>
      </div>
    </div>
  @endif
  <!-- ----------------------------------------------------- -->

  @guest
    <div class="container py-5">
      <div class="text-center mb-5">
        <h1 class="welcome-text mb-3">
          welcome To MiniShop
        </h1>
        <p class="text-white fs-4 justify-content-center">The Best WebSite Online</p>
      </div>

      <!-- First card full width -->
      <center>
        <div class="row">
          <div class="col-12">
            <div class="glass-card stat-card text-white p-4 text-center">
              <i class="bi bi-cart-check fs-1 mb-3"></i>
              <h3 class="fw-bold">1,248</h3>
              <p class="mb-0 opacity-90">orders for this day</p>
            </div>
          </div>
        </div>
      </center><br>
      <!-- Second and third cards centered -->
      <div class="row justify-content-center g-4">
        <div class="col-md-4">
          <div class="glass-card stat-card text-white p-4 text-center">
            <i class="bi bi-currency-dollar fs-1 mb-3"></i>
            <h3 class="fw-bold">48,920$</h3>
            <p class="mb-0 opacity-90">total orders</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="glass-card stat-card text-white p-4 text-center">
            <i class="bi bi-person-plus fs-1 mb-3"></i>
            <h3 class="fw-bold">+89</h3>
            <p class="mb-0 opacity-90">new members</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="glass-card stat-card text-white p-4 text-center">
            <i class="bi bi-box-seam fs-1 mb-3"></i>
            <h3 class="fw-bold">512</h3>
            <p class="mb-0 opacity-90">active product</p>
          </div>
        </div>
      </div><br>
      <!-- Fourth card centered -->
      <div class="row justify-content-center">

      </div>
      <center>
        <div class="row mt-5">
          <div class="col-12">
            <div class="glass-card p-5 text-center text-white">
              <h2 class="mb-4">all things under we</h2>
              <p class="lead"> lets gooo
              <form action="{{ route('require.login') }}" method="post">
                @csrf
                <input type="hidden" name="redirect_message" value="please login as admin account to add product">
                <button type="submit" class="btn-solid" style="background: rgba(38, 36, 36, 0.74);">
                  <i class="bi bi-plus-lg">Add product</i>
                </button>
              </form>
              <!-- <a href="{{ route('login.form') }}?redirect_message=please login as admin account to add new product" class="btn-solid" style="background: rgba(255, 255, 255, 0.74);">add new product</a> -->
              <a href="{{route('products')}}" class="btn-solid">view all products</a>
              </p>
            </div>
          </div>
        </div>
      </center>
    </div>
    </div>
  @endguest

@endsection