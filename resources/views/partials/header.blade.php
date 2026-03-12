<div class="fixed w-full top-0 z-50 bg-[#A51C31]">
    <!-- Desktop Version -->
    <div class="hidden xl:flex items-center justify-between px-8 py-3">
        <!-- Kiri: Logo + Badan Pusat Statistik -->
        <div class="flex items-center gap-3 flex-shrink-0 min-w-fit">
            <img src="{{ asset('img/bpslogo1.png') }}" alt="BPS Logo" class="h-12 w-12 object-contain">
            <p class="text-xs font-semibold italic text-white whitespace-nowrap">Badan Pusat Statistik</p>
        </div>

        <!-- Tengah: SERUIT -->
        <div class="flex-1 text-center px-8">
            <h3 class="text-3xl font-bold text-white tracking-wider">SERUIT</h3>
            <p class="text-xs text-white leading-tight">
                Satu Ruang Informasi untuk Inovasi Terintegrasi
            </p>
        </div>

        <!-- Kanan: Informasi dengan Dropdown -->
        <div class="flex-shrink-0 relative min-w-fit">
            <button id="infoDropdownBtn" class="flex items-center gap-1 text-white hover:text-gray-200 transition px-4 py-2">
                <span class="text-xs font-medium whitespace-nowrap">Informasi</span>
                <svg class="w-4 h-4 transition-transform flex-shrink-0" id="dropdownIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="infoDropdown" class="hidden absolute right-0 mt-1 w-72 bg-white rounded-lg shadow-xl py-3 z-20">
                <div class="px-4 py-3 border-b border-gray-200">
                    <h4 class="font-bold text-gray-800 mb-2">Tentang Aplikasi SERUIT</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        SERUIT (Satu Ruang Informasi untuk Inovasi Terintegrasi) adalah platform informasi terintegrasi dari 
                        Badan Pusat Statistik. Platform ini dirancang untuk memfasilitasi inovasi dan integrasi data statistik 
                        dalam satu ruang yang komprehensif dan mudah diakses.
                    </p>
                </div>
                <div class="px-4 py-2">
                    <a href="#" class="text-[#A51C31] text-sm font-medium hover:underline">Pelajari lebih lanjut →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Version -->
    <div class="xl:hidden flex items-center justify-between px-4 py-3 gap-2">
        <!-- Kiri Mobile: Logo + BPS -->
        <div class="flex items-center gap-2 flex-shrink-0">
            <img src="{{ asset('img/bpslogo1.png') }}" alt="BPS Logo" class="h-10 w-10 object-contain flex-shrink-0">
            <span class="text-xs font-semibold italic text-white whitespace-nowrap">Badan Pusat Statistik</span>
        </div>

        <!-- Tengah Mobile: SERUIT -->
        <div class="flex-1 text-center min-w-0">
            <h3 class="text-lg font-bold text-white leading-tight">SERUItttttT</h3>
            <p class="text-xs text-white leading-tight truncate">
                Satu Ruang Informasi
            </p>
        </div>

        <!-- Kanan Mobile: Dropdown -->
        <div class="flex-shrink-0 relative">
            <button id="infoDropdownBtnMobile" class="flex items-center justify-center text-white hover:text-gray-100 transition p-2">
                <svg class="w-4 h-4 transition-transform" id="dropdownIconMobile" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </button>
            <div id="infoDropdownMobile" class="hidden absolute right-0 mt-1 w-64 bg-white rounded-lg shadow-xl py-3 z-20">
                <div class="px-4 py-3 border-b border-gray-200">
                    <h4 class="font-bold text-gray-800 mb-2 text-sm">Tentang Aplikasi SERUIT</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        SERUIT (Satu Ruang Informasi untuk Inovasi Terintegrasi) adalah platform informasi terintegrasi dari 
                        Badan Pusat Statistik.
                    </p>
                </div>
                <div class="px-4 py-2">
                    <a href="#" class="text-[#A51C31] text-xs font-medium hover:underline">Pelajari lebih lanjut →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Desktop Dropdown
    const infoDropdownBtn = document.getElementById('infoDropdownBtn');
    const infoDropdown = document.getElementById('infoDropdown');
    const dropdownIcon = document.getElementById('dropdownIcon');

    if (infoDropdownBtn) {
        infoDropdownBtn.addEventListener('click', function() {
            infoDropdown.classList.toggle('hidden');
            dropdownIcon.classList.toggle('rotate-180');
        });

        document.addEventListener('click', function(event) {
            if (!infoDropdownBtn.contains(event.target) && !infoDropdown.contains(event.target)) {
                infoDropdown.classList.add('hidden');
                dropdownIcon.classList.remove('rotate-180');
            }
        });
    }

    // Mobile Dropdown
    const infoDropdownBtnMobile = document.getElementById('infoDropdownBtnMobile');
    const infoDropdownMobile = document.getElementById('infoDropdownMobile');
    const dropdownIconMobile = document.getElementById('dropdownIconMobile');

    if (infoDropdownBtnMobile) {
        infoDropdownBtnMobile.addEventListener('click', function() {
            infoDropdownMobile.classList.toggle('hidden');
            dropdownIconMobile.classList.toggle('rotate-180');
        });

        document.addEventListener('click', function(event) {
            if (!infoDropdownBtnMobile.contains(event.target) && !infoDropdownMobile.contains(event.target)) {
                infoDropdownMobile.classList.add('hidden');
                dropdownIconMobile.classList.remove('rotate-180');
            }
        });
    }
</script>
