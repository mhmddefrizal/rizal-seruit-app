{{-- Embedded responsive styles — works independently of Tailwind --}}
<style>
    /* ========================================
       CSS Custom Properties — single source of truth
       ======================================== */
    :root {
        /* Fluid header height: 3.5rem (56px) → 4.75rem (76px) */
        --header-height: clamp(3.5rem, 3rem + 1.25vw, 4.75rem);
        /* Fluid header padding-x: 0.75rem → 2.5rem */
        --header-px: clamp(0.75rem, 0.25rem + 1.25vw, 2.5rem);
    }

    /* ========================================
       Base header
       ======================================== */
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
        padding: clamp(0.5rem, 0.4rem + 0.15vw, 0.625rem) var(--header-px);
        min-height: var(--header-height);
    }

    .seruit-logo-section {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-shrink: 0;
    }

    .seruit-logo-img {
        /* Fluid logo: 2.25rem (36px) → 3rem (48px) */
        height: clamp(2.25rem, 1.75rem + 1.25vw, 3rem);
        width: auto;
        object-fit: contain;
        flex-shrink: 0;
    }

    .seruit-logo-text {
        text-transform: uppercase;
        /* Fluid font: 0.75rem (12px) → 1.0625rem (17px) */
        font-size: clamp(0.75rem, 0.5rem + 0.625vw, 1.0625rem);
        font-weight: 600;
        line-height: 1.3;
    }

    .seruit-logo-text a {
        color: inherit;
        text-decoration: none;
    }

    .seruit-center {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: auto;
        display: none;
    }

    .seruit-center a {
        display: inline-block;
        color: inherit;
        text-decoration: none;
    }

    .seruit-title {
        /* Fluid title: 1.25rem (20px) → 2.25rem (36px) */
        font-size: clamp(1.25rem, 0.5rem + 1.875vw, 2.25rem);
        font-weight: 700;
        line-height: 1.1;
        margin: 0;
    }

    .seruit-subtitle {
        /* Fluid subtitle: 0.625rem (10px) → 1rem (16px) */
        font-size: clamp(0.625rem, 0.375rem + 0.625vw, 1rem);
        line-height: 1.2;
        margin: 0;
    }

    .seruit-right-menu {
        position: absolute;
        right: var(--header-px);
        top: 50%;
        transform: translateY(-50%);
        z-index: 20;
    }

    .seruit-nav-desktop {
        display: none;
        align-items: center;
        /* Fluid gap and font */
        gap: clamp(1.25rem, 1rem + 0.5vw, 1.5rem);
        font-size: clamp(0.875rem, 0.8rem + 0.2vw, 0.9375rem);
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
        width: 2.5rem;
        height: 2.5rem;
        background: transparent;
        border: none;
        border-radius: 0.375rem;
        cursor: pointer;
        padding: 0;
    }

    .seruit-hamburger-btn:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .seruit-hamburger-line {
        display: block;
        width: 1.25rem;
        height: 0.125rem;
        background: #fff;
        border-radius: 0.125rem;
        transition: all 0.3s ease;
    }

    .seruit-hamburger-line+.seruit-hamburger-line {
        margin-top: 0.3125rem;
    }

    /* ========================================
       Mobile dropdown
       ======================================== */
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
        padding: 0.5rem 0;
    }

    .seruit-mobile-menu a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.25rem;
        color: #fff;
        text-decoration: none;
        font-size: clamp(0.875rem, 0.8rem + 0.2vw, 1rem);
        font-weight: 500;
        transition: background 0.2s;
    }

    .seruit-mobile-menu a:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .seruit-mobile-menu svg {
        width: 1.125rem;
        height: 1.125rem;
        flex-shrink: 0;
    }

    /* ===== 900px+ — show center title ===== */
    @media (min-width: 900px) {
        .seruit-center {
            display: block;
        }
    }

    /* ===== lg: 1024px+ — show nav links, hide hamburger ===== */
    @media (min-width: 1024px) {
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
</style>

<div class="seruit-header-wrapper">
    <div class="seruit-header-bar">

        {{-- Logo kiri --}}
        <div class="seruit-logo-section">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/bpslogo1.png') }}" alt="BPS Logo" class="seruit-logo-img">
            </a>
            <span class="seruit-logo-text">
                <em>
                    <a href="{{ route('home') }}" aria-label="Badan Pusat Statistik Provinsi Lampung">
                        Badan Pusat Statistik
                        <br>
                        Provinsi Lampung
                    </a>
                </em>
            </span>

        </div>

        {{-- Teks tengah --}}
        <div class="seruit-center">
            <a href="{{ route('home') }}" aria-label="Kembali ke halaman utama SERUIT">
                <h3 class="seruit-title">SERUIT</h3>
                <p class="seruit-subtitle">Satu Ruang Informasi untuk Inovasi Terintegrasi</p>
            </a>
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
    function getMenuElements() {
        return {
            menu: document.getElementById('mobile-menu'),
            btn: document.getElementById('hamburger-btn'),
            line1: document.getElementById('hamburger-line-1'),
            line2: document.getElementById('hamburger-line-2'),
            line3: document.getElementById('hamburger-line-3')
        };
    }

    function setMenuState(isOpen) {
        var elements = getMenuElements();
        var menu = elements.menu;
        var btn = elements.btn;
        var line1 = elements.line1;
        var line2 = elements.line2;
        var line3 = elements.line3;

        if (!menu || !btn || !line1 || !line2 || !line3) {
            return;
        }

        if (isOpen) {
            menu.classList.add('menu-open');
            menu.style.maxHeight = menu.scrollHeight + 'px';
            menu.style.opacity = '1';
            btn.setAttribute('aria-expanded', 'true');
            line1.style.transform = 'translateY(7px) rotate(45deg)';
            line2.style.opacity = '0';
            line3.style.transform = 'translateY(-7px) rotate(-45deg)';
        } else {
            menu.style.maxHeight = '0';
            menu.style.opacity = '0';
            menu.classList.remove('menu-open');
            btn.setAttribute('aria-expanded', 'false');
            line1.style.transform = '';
            line2.style.opacity = '1';
            line3.style.transform = '';
        }
    }

    function toggleMobileMenu() {
        var menu = document.getElementById('mobile-menu');
        if (!menu) {
            return;
        }
        var isOpen = menu.classList.contains('menu-open');
        setMenuState(!isOpen);
    }

    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            var menu = document.getElementById('mobile-menu');
            if (menu && menu.classList.contains('menu-open')) {
                setMenuState(false);
            }
        }
    });
</script>
