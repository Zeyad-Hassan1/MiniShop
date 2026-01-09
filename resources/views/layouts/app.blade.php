<!doctype html>
<html lang="lang=" {{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"" data-theme=" dark">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>MiniShop</title>
  <link rel="stylesheet" href="http://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Inter font (clean modern) -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css" rel="stylesheet">
  <!-- =========================
       Theme CSS Variables (T1)
       Default = DARK (we decided Dark as default)
       Light overrides inside [data-theme="light"]
       ========================= -->

</head>

<body>

  <!-- ================= NAVBAR (Sticky UX) ================= -->
  <header id="siteNav" class="site-nav">
    <div class="container">
      <div class="nav-left">
        <a href="/" class="brand-badge" aria-label="MiniShop home">
          <div class="brand-icon" aria-hidden="true">
            <!-- simple bag icon -->
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M6 7h12l-1 12H7L6 7z" stroke="white" stroke-width="1.2" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M9 7V5a3 3 0 0 1 6 0v2" stroke="white" stroke-width="1.2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
          </div>
          <div>
            <div class="brand-title">MiniShop</div>
            <div class="brand-sub">simple • modern</div>
          </div>
        </a>
      </div>

      <!-- right actions -->
      <div class="flex items-center gap-3 ml-auto" style="display:flex; align-items:center; gap:10px;">
        @guest
          <!-- Login / Register -->
          <a href="{{ route('login.form') }}" class="btn-ghost">{{ __('words.login') }}</a>
          <a href="{{ route('register.form') }}" class="btn-solid">{{ __('words.register') }}</a>
        @endguest
        @auth
          <div class="dropdown">
            <button id="userBtn"
              class="user-name d-flex align-items-center text-decoration-none p-0 border-0 bg-transparent" type="button"
              style="cursor: pointer;">
              {{ auth()->user()->name }}
              <i class="bi bi-caret-down-fill ms-1"></i>
            </button>
            <div id="dropdownMenu" class="dropdown-content"
              style="background: rgba(36, 0, 154, 0.54); display: none; position: absolute; right: 0; z-index: 1;">
              <a href="{{ route('profile') }}" class="btn-ghost-2">Profile</a>
              <a href="{{ route('order-history') }}" class="btn-ghost-2">Order History</a>
              <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
              </form>
            </div>
          </div>
        @endauth
        <button id="mobileToggle" class="mobile-toggle"
          style="background:transparent; border:none; color:var(--text-color);">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M3 6h18M3 12h18M3 18h18" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" />
          </svg>
        </button>
      </div>
      <!-- mobile menu -->
      <div id="mobileMenu" class="mobile-menu">
        <a href="/" class="nav-link">{{ __('words.home') }}</a>
        <a href="/products" class="nav-link">{{ __('words.products') }}</a>
        <a href="{{ route('cart.index') }}" id="cartBtn" class="relative " aria-label="Cart">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
            <path d="M3 3h2l.6 3M7 13h10l3-8H6.2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          <span style="margin-left:6px">{{ __('words.cart') }}</span>
          <span id="cartDot" class="cart-dot" style="display:none;"></span>
        </a>
        <form action="{{ route('locale.switch') }}" method="post" class="d-inline">
          @csrf
          <select name="locale" onchange="this.form.submit()" class="form-select form-select-sm"
            style="background:#012853b1;">
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }} style="background:#250373;">English (EN)
            </option>
            <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }} style="background:#250373;">العربيه (AR)
            </option>
          </select>
        </form>
        <button id="themeToggle" aria-label="Toggle theme"
          style="width:44px;height:36px;border-radius:10px; border:1px solid rgba(255,255,255,0.06); display:inline-flex; align-items:center; justify-content:center; background: linear-gradient(90deg,#101828,#2b0b63);">
          <!-- Moon shown in dark, sun shown in light via JS -->
          <svg id="iconMoon" width="18" height="18" viewBox="0 0 24 24" fill="none" class="block" aria-hidden="true">
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" stroke="white" stroke-width="1.1"
              stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg id="iconSun" width="18" height="18" viewBox="0 0 24 24" fill="none" class="hidden" aria-hidden="true">
            <path d="M12 3v2M12 19v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"
              stroke="white" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="12" cy="12" r="3" stroke="white" stroke-width="1.1" />
          </svg>
        </button>
      </div>
    </div>
  </header>
  <div style="height:78px;"></div>
  <!-- main content container -->
  <main class="main-wrap">
    @yield('content')
  </main>

  <!-- footer -->
  <footer class="mt-12 py-8 text-center text-sm" style="color:var(--muted-color);">
    © {{ date('Y') }} MiniShop — Simple storefront UI
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const userBtn = document.getElementById('userBtn');
      const dropdownMenu = document.getElementById('dropdownMenu');
      const mobileToggle = document.getElementById('mobileToggle');
      const mobileMenu = document.getElementById('mobileMenu');

      if (userBtn && dropdownMenu) {
        userBtn.addEventListener('click', function (event) {
          event.stopPropagation();
          dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
        });
      }

      window.addEventListener('click', function (event) {
        if (dropdownMenu && dropdownMenu.style.display === 'block') {
          if (!userBtn.contains(event.target)) {
            dropdownMenu.style.display = 'none';
          }
        }
      });

      if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', function (event) {
          event.stopPropagation();
          console.log('mobile toggle clicked');
          mobileMenu.classList.toggle('active');
          document.body.classList.toggle('menu-open');
        });
      }

      // Close mobile menu when clicking outside
      document.addEventListener('click', function (event) {
        if (mobileMenu && mobileMenu.classList.contains('active') && !mobileMenu.contains(event.target) && !mobileToggle.contains(event.target)) {
          mobileMenu.classList.remove('active');
          document.body.classList.remove('menu-open');
        }
      });
    });
  </script>