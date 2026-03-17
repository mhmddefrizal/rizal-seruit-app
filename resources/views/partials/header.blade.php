<div class="fixed w-full top-0 z-50 bg-[#faf9f9]">
    <div class="xl:hidden relative flex items-stretch py-2 bg-[#a51c31] text-white px-4"
        style="display: flex; align-items: stretch; min-height: 72px;">

        <!-- Logo kiri -->
        <div class="flex items-center gap-2 flex-shrink-0 self-stretch"
            style="display: flex; align-items: center; flex-shrink: 0;">
            <img src="{{ asset('img/bpslogo1.png') }}" alt="BPS Logo" class="h-11 w-auto object-contain flex-shrink-0"
                style="height: 40px; width: auto;">
            <span class="text-md sm:text-sm md:text-base font-semibold leading-tight">Badan Pusat Statistik</span>
        </div>

        <div aria-hidden="true" style="width: 2px; background: #ffffff; margin: 0 0 0 64px; align-self: stretch;">
        </div>

        <!-- Teks tengah -->
        <div class="text-center flex flex-col justify-center"
            style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            <h3 class="md:text-4xl text-2xl font-bold" style="font-size: 2rem; line-height: 1.1;">
                SERUIT
            </h3>

            <p class="md:text-base text-sm mt-0" style="font-size: 1rem; line-height: 1.25;">
                Satu Ruang Informasi untuk Inovasi Terintegrasi
            </p>
        </div>

        {{-- Buat menu di sebelah kanan header --}}
        <div class="flex items-center justify-end gap-6 text-sm sm:text-base font-semibold"
            style="position: absolute; right: 64px; top: 50%; transform: translateY(-50%); z-index: 20;">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <a href="{{ route('info', ['slug' => 'tentang-aplikasi']) }}" class="hover:underline">Tentang Aplikasi</a>
        </div>
    </div>
</div>
