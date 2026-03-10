@props(['href', 'title', 'description', 'count', 'color' => '#1EA05E', 'icon' => 'default'])

@php
    // Generate a lighter shade for the secondary gradient color
    $colorSecondary = $color . '88';
@endphp

<a href="{{ $href }}" class="block group">
    <div
        class="rounded-2xl overflow-hidden
              shadow-sm hover:shadow-xl
              hover:-translate-y-1.5
              transition-all duration-500 ease-out
              border border-gray-100 bg-white h-full flex flex-col">

        {{-- ===== DECORATIVE HEADER AREA ===== --}}
        <div class="relative h-20 overflow-hidden"
            style="background: linear-gradient(160deg, {{ $color }}, {{ $colorSecondary }});">

            {{-- Geometric pattern overlay (like the reference image) --}}
            <svg class="absolute inset-0 w-full h-full opacity-[0.12]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-{{ Str::slug($title) }}" x="0" y="0" width="60" height="60"
                        patternUnits="userSpaceOnUse">
                        <rect x="5" y="5" width="25" height="25" fill="white" rx="4"
                            transform="rotate(15 17.5 17.5)" />
                        <rect x="30" y="30" width="20" height="20" fill="white" rx="3"
                            transform="rotate(-10 40 40)" />
                        <circle cx="50" cy="10" r="8" fill="white" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#pattern-{{ Str::slug($title) }})" />
            </svg>

            {{-- Animated floating circles --}}
            <div
                class="absolute -top-8 -right-8 w-32 h-32 rounded-full bg-white/10
                  group-hover:scale-125 group-hover:bg-white/15 transition-all duration-700 ease-out">
            </div>
            <div
                class="absolute -bottom-10 -left-6 w-28 h-28 rounded-full bg-white/[0.07]
                  group-hover:scale-110 transition-all duration-700 ease-out delay-100">
            </div>
            <div
                class="absolute top-6 left-8 w-16 h-16 rounded-full bg-white/[0.06]
                  group-hover:translate-y-1 transition-all duration-500">
            </div>

            {{-- Category icon (centered large) --}}
            <div class="absolute inset-0 flex items-center justify-center">
                <div
                    class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur-sm
                    flex items-center justify-center
                    group-hover:scale-110 group-hover:bg-white/20 group-hover:rotate-3
                    transition-all duration-500 ease-out border border-white/20 shadow-lg shadow-black/5">
                    @switch($icon)
                        @case('ri')
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path
                                    d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                            </svg>
                        @break

                        @case('provinsi')
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-4h6v4M9 9h.01M15 9h.01M9 13h.01M15 13h.01" />
                            </svg>
                        @break

                        @case('kabkota')
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" rx="1" />
                                <rect x="14" y="3" width="7" height="7" rx="1" />
                                <rect x="3" y="14" width="7" height="7" rx="1" />
                                <rect x="14" y="14" width="7" height="7" rx="1" />
                            </svg>
                        @break

                        @case('kldi')
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                        @break

                        @default
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                            </svg>
                    @endswitch
                </div>
            </div>

            {{-- Count badge (top-left like the reference) --}}
            <div class="absolute top-3 left-3">
                <span
                    class="bg-white/20 backdrop-blur-sm text-white text-[10px] font-semibold rounded-md px-2.5 py-1 border border-white/20">
                    {{ $count }} Aplikasi
                </span>
            </div>

        </div>

        {{-- ===== TEXT CONTENT AREA ===== --}}
        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                <h3
                    class="font-bold text-sm text-gray-800 leading-snug line-clamp-2
                    group-hover:text-gray-900 transition-colors duration-300">
                    {{ $title }}
                </h3>
                <p class="text-[11px] text-gray-400 mt-2 leading-relaxed line-clamp-2">
                    {{ $description }}
                </p>
            </div>

            {{-- "Lihat Semua" link --}}
            <div class="flex items-center gap-1.5 mt-3 text-xs font-semibold transition-all duration-300 group-hover:gap-2.5"
                style="color: {{ $color }};">
                <span>Lihat Semua</span>

            </div>
        </div>

    </div>
</a>
