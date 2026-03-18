{{-- Embedded responsive styles — works independently of Tailwind --}}
<style>
    /* Base header */
    .seruit-header-wrapper {
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 50;
        background: #faf9f9;
    }

    .seruit-header-bar {
        position: relative;
        display: flex;
        align-items: stretch;
        background: #a51c31;
        color: #fff;
        padding: 8px 12px;
        min-height: 56px;
    }

    .seruit-logo-section {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .seruit-logo-img {
        height: 36px;
        width: auto;
        object-fit: contain;
        flex-shrink: 0;
    }

    .seruit-logo-text {
        font-size: 12px;
        font-weight: 600;
        line-height: 1.3;
    }

    .seruit-center {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: none;
    }

    .seruit-title {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.1;
        margin: 0;
    }

    .seruit-subtitle {
        font-size: 10px;
        line-height: 1.2;
        margin: 0;
    }

    .seruit-right-menu {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 20;
    }

    .seruit-nav-desktop {
        display: none;
        align-items: center;
        gap: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .seruit-nav-desktop a {
        color: #fff;
        text-decoration: none;
    }

    .seruit-nav-desktop a:hover {
        text-decoration: underline;
        text-underline-offset: 4px;
    }

    .seruit-hamburger-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: transparent;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        padding: 0;
    }

    .seruit-hamburger-btn:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .seruit-hamburger-line {
        display: block;
        width: 20px;
        height: 2px;
        background: #fff;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .seruit-hamburger-line+.seruit-hamburger-line {
        margin-top: 5px;
    }

    /* Mobile dropdown */
    .seruit-mobile-menu {
        background: #8b1728;
        color: #fff;
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transition: max-height 0.3s ease, opacity 0.3s ease;
    }

    .seruit-mobile-menu.menu-open {
        opacity: 1;
    }

    .seruit-mobile-menu nav {
        display: flex;
        flex-direction: column;
        padding: 8px 0;
    }

    .seruit-mobile-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.2s;
    }

    .seruit-mobile-menu a:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .seruit-mobile-menu svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    /* ===== sm: 640px+ ===== */
    @media (min-width: 640px) {
        .seruit-header-bar {
            padding: 8px 16px;
            min-height: 60px;
        }

        .seruit-logo-img {
            height: 38px;
        }

        .seruit-logo-text {
            font-size: 13px;
        }

        .seruit-title {
            font-size: 22px;
        }

        .seruit-subtitle {
            font-size: 11px;
        }

        .seruit-right-menu {
            right: 16px;
        }

        .seruit-mobile-menu a {
            font-size: 15px;
        }
    }

    /* ===== md: 768px+ ===== */
    @media (min-width: 768px) {
        .seruit-header-bar {
            padding: 8px 20px;
            min-height: 64px;
        }

        .seruit-logo-img {
            height: 40px;
        }

        .seruit-logo-text {
            font-size: 15px;
        }

        .seruit-title {
            font-size: 28px;
        }

        .seruit-subtitle {
            font-size: 13px;
        }

        .seruit-right-menu {
            right: 20px;
        }

        .seruit-mobile-menu a {
            font-size: 16px;
        }
    }

    /* ===== lg: 1024px+ — show nav links, hide hamburger ===== */
    @media (min-width: 1024px) {
        .seruit-header-bar {
            padding: 8px 32px;
            min-height: 72px;
        }

        .seruit-logo-img {
            height: 44px;
        }

        .seruit-logo-text {
            font-size: 16px;
        }

        .seruit-title {
            font-size: 32px;
        }

        .seruit-subtitle {
            font-size: 15px;
        }

        .seruit-right-menu {
            right: 32px;
        }

        .seruit-nav-desktop {
            display: flex;
        }

        .seruit-hamburger-btn {
            display: none;
        }

        .seruit-mobile-menu {
            display: none !important;
        }
    }

    /* ===== xl: 1280px+ ===== */
    @media (min-width: 1280px) {
        .seruit-header-bar {
            padding: 10px 40px;
            min-height: 76px;
        }

        .seruit-logo-img {
            height: 48px;
        }

        .seruit-logo-text {
            font-size: 17px;
        }

        .seruit-title {
            font-size: 36px;
        }

        .seruit-subtitle {
            font-size: 16px;
        }

        .seruit-right-menu {
            right: 40px;
        }

        .seruit-nav-desktop {
            font-size: 15px;
            gap: 24px;
        }
    }
</style>

<div class="seruit-header-wrapper">
    <div class="seruit-header-bar">

        {{-- Logo kiri --}}
        <div class="seruit-logo-section">
            <img src="{{ asset('img/bpslogo1.png') }}" alt="BPS Logo" class="seruit-logo-img">
            <span class="seruit-logo-text">Badan Pusat Statistik</span>
        </div>

        {{-- Teks tengah --}}
        <div class="seruit-center">
            <h3 class="seruit-title">SERUIT</h3>
            <p class="seruit-subtitle">Satu Ruang Informasi untuk Inovasi Terintegrasi</p>
        </div>

        {{-- Menu kanan --}}
        <div class="seruit-right-menu">
            {{-- Desktop nav links (lg+) --}}
            <nav class="seruit-nav-desktop">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('tentang') }}">Tentang Aplikasi</a>
            </nav>

            {{-- Hamburger button (<lg) --}}
            <button class="seruit-hamburger-btn" id="hamburger-btn" aria-label="Toggle menu" aria-expanded="false"
                onclick="toggleMobileMenu()">
                <span class="seruit-hamburger-line" id="hamburger-line-1"></span>
                <span class="seruit-hamburger-line" id="hamburger-line-2"></span>
                <span class="seruit-hamburger-line" id="hamburger-line-3"></span>
            </button>
        </div>
    </div>

    {{-- Mobile dropdown menu --}}
    <div class="seruit-mobile-menu" id="mobile-menu">
        <nav>
            <a href="{{ route('home') }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
            </a>
            <a href="{{ route('tentang') }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tentang Aplikasi
            </a>
        </nav>
    </div>
</div>

<script>
    function toggleMobileMenu() {
        var menu = document.getElementById('mobile-menu');
        var btn = document.getElementById('hamburger-btn');
        var line1 = document.getElementById('hamburger-line-1');
        var line2 = document.getElementById('hamburger-line-2');
        var line3 = document.getElementById('hamburger-line-3');
        var isOpen = menu.classList.contains('menu-open');

        if (isOpen) {
            menu.style.maxHeight = '0';
            menu.style.opacity = '0';
            menu.classList.remove('menu-open');
            btn.setAttribute('aria-expanded', 'false');
            line1.style.transform = '';
            line2.style.opacity = '1';
            line3.style.transform = '';
        } else {
            menu.classList.add('menu-open');
            menu.style.maxHeight = menu.scrollHeight + 'px';
            menu.style.opacity = '1';
            btn.setAttribute('aria-expanded', 'true');
            line1.style.transform = 'translateY(7px) rotate(45deg)';
            line2.style.opacity = '0';
            line3.style.transform = 'translateY(-7px) rotate(-45deg)';
        }
    }

    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            var menu = document.getElementById('mobile-menu');
            var btn = document.getElementById('hamburger-btn');
            var line1 = document.getElementById('hamburger-line-1');
            var line2 = document.getElementById('hamburger-line-2');
            var line3 = document.getElementById('hamburger-line-3');

            if (menu && menu.classList.contains('menu-open')) {
                menu.style.maxHeight = '0';
                menu.style.opacity = '0';
                menu.classList.remove('menu-open');
                btn.setAttribute('aria-expanded', 'false');
                line1.style.transform = '';
                line2.style.opacity = '1';
                line3.style.transform = '';
            }
        }
    });
</script>
