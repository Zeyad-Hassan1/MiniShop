import './bootstrap';
    (function(){
      // ---------- Config keys ----------
      const THEME_KEY = 'mini_theme_v2';   // stores "dark" or "light"
      const LANG_KEY  = 'mini_lang_v1';    // stores "en" or "ar"
      const CART_KEY  = 'mini_cart_v1';    // optional cart key (UI only)

      // ---------- DOM references ----------
      const htmlEl = document.documentElement; // <html data-theme="...">
      const themeToggle = document.getElementById('themeToggle');
      const iconSun = document.getElementById('iconSun');
      const iconMoon = document.getElementById('iconMoon');

      const langToggle = document.getElementById('langToggle');
      const langMenu = document.getElementById('langMenu');

      const cartDot = document.getElementById('cartDot');
      const cartBtn = document.getElementById('cartBtn');

      const siteNav = document.getElementById('siteNav');

      // ---------- Helper: apply theme UI changes ----------
      function applyTheme(theme) {
        // set attribute on <html> so CSS [data-theme="light"] rules apply
        if(theme === 'light') {
          htmlEl.setAttribute('data-theme','light');
          // show sun icon, hide moon
          iconSun.classList.remove('hidden'); iconSun.classList.add('block');
          iconMoon.classList.remove('block'); iconMoon.classList.add('hidden');
        } else {
          htmlEl.setAttribute('data-theme','dark');
          iconSun.classList.remove('block'); iconSun.classList.add('hidden');
          iconMoon.classList.remove('hidden'); iconMoon.classList.add('block');
        }
      }

      // ---------- Initialize theme from localStorage or default (dark) ----------
      const savedTheme = localStorage.getItem(THEME_KEY) || 'dark';
      applyTheme(savedTheme);

      // Toggle button sets theme and persists choice
      themeToggle.addEventListener('click', function(e){
        const current = localStorage.getItem(THEME_KEY) || 'dark';
        const next = current === 'dark' ? 'light' : 'dark';
        localStorage.setItem(THEME_KEY, next);
        applyTheme(next);
      });

      // ---------- Language dropdown logic ----------
      langToggle.addEventListener('click', function(e){
        e.stopPropagation();
        const open = !langMenu.classList.contains('hidden');
        if(open) {
          langMenu.classList.add('hidden');
          langToggle.setAttribute('aria-expanded','false');
        } else {
          langMenu.classList.remove('hidden');
          langToggle.setAttribute('aria-expanded','true');
        }
      });

      // clicking a language option sets localStorage and reloads page
      langMenu.querySelectorAll('button[data-lang]').forEach(btn=>{
        btn.addEventListener('click', function(){
          const selected = btn.getAttribute('data-lang');
          localStorage.setItem(LANG_KEY, selected);
          // optional: send to backend via fetch to set session (left for backend)
          // For now we just reload so Blade helpers (if implemented) can read session or fallback to localStorage
          location.reload();
        });
      });

      // close menu if clicking outside
      document.addEventListener('click', function(){ 
        if(!langMenu.classList.contains('hidden')) {
          langMenu.classList.add('hidden');
          langToggle.setAttribute('aria-expanded','false');
        }
      });

      // ---------- Cart dot UI ----------
      function updateCartDot(){
        try {
          const c = JSON.parse(localStorage.getItem(CART_KEY) || '[]');
          if(c && c.length > 0) {
            cartDot.style.display = 'block';
          } else {
            cartDot.style.display = 'none';
          }
        } catch(e){
          cartDot.style.display = 'none';
        }
      }
      updateCartDot();
      if (cartBtn) {
        // clicking cart goes to /cart
        cartBtn && cartBtn.addEventListener('click', () => window.location.href = '/cart');
      }

      // ---------- Sticky navbar (D) show/hide on scroll ----------
      // Behavior: hide on scroll down, show on scroll up — sticky feel
      let lastScrollY = window.scrollY;
      let ticking = false;
      const NAV_HIDDEN_CLASS = 'nav-hidden'; // we will transform nav

      // Initial style: ensure nav is visible
      siteNav.style.transform = 'translateY(0)';

      window.addEventListener('scroll', function(){
        if(!ticking) {
          window.requestAnimationFrame(function(){
            const currentY = window.scrollY;
            if(currentY > lastScrollY && currentY > 80) {
              // scrolling down -> hide
              siteNav.style.transform = 'translateY(-100%)';
              siteNav.style.boxShadow = 'none';
            } else {
              // scrolling up -> show
              siteNav.style.transform = 'translateY(0)';
              siteNav.style.boxShadow = '0 8px 30px rgba(2,6,23,0.25)';
            }
            lastScrollY = currentY;
            ticking = false;
          });
          ticking = true;
        }
      });

      // ---------- Optional: Respect system preference on first load? (kept simple: default dark)
      // If you want to use system preference on first visit, uncomment:
      // if(!localStorage.getItem(THEME_KEY)) {
      //   const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
      //   localStorage.setItem(THEME_KEY, prefersDark ? 'dark' : 'light');
      //   applyTheme(prefersDark ? 'dark' : 'light');
      // }

      // ---------- Small debug helper exposed (use in console if needed) ----------
      window.__miniShop = {
        setTheme: function(t){ localStorage.setItem(THEME_KEY,t); applyTheme(t); },
        getTheme: function(){ return localStorage.getItem(THEME_KEY) || 'dark'; },
        setLang: function(l){ localStorage.setItem(LANG_KEY,l); location.reload(); },
        clearCart: function(){ localStorage.removeItem(CART_KEY); updateCartDot(); }
      };
const userBtn = document.getElementById('userBtn');
const dropdown = document.getElementById('dropdownMenu');

userBtn.addEventListener('click', (e) => {
    e.preventDefault();
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});

// إغلاقها عند الضغط خارج القائمة
document.addEventListener('click', (e) => {
    if (!userBtn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
    }
});
        document.querySelectorAll('.zoomable-image').forEach(img => {
            img.addEventListener('click', function () {
                const overlay = document.getElementById('imageoverlay');
                const overlayimg = document.getElementById('overlayimage');
                overlayimg.src = this.src;
                overlay.style.display = 'flex';
            });
        });
        document.getElementById('imageoverlay').addEventListener('click', function () {
            this.style.display = 'none';
        });

        const mobileToggle = document.getElementById('mobileToggle');
        const navLinks = document.querySelector('.nav-links');

        if (mobileToggle && navLinks) {
            mobileToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });
        }
    })();

            function handlepurchase(event) {
                event.preventDefault();
                window.location.href = "{{ route('purchase') }}";
            }
