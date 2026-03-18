@props(['href', 'title', 'description', 'count', 'color' => '#1EA05E', 'icon' => 'default'])

@php
    // Map icon prop to image filename
    $imageMap = [
        'ri' => 'image-category-bps-ri.jpg',
        'provinsi' => 'image-category-bps-prov-lpg.jpg',
        'kabkota' => 'image-category-bps-kab-lpg.jpg',
        'kldi' => 'image-category-kementerian.jpg',
    ];
    $imagePath = isset($imageMap[$icon]) ? asset('img/category/' . $imageMap[$icon]) : '';
@endphp

<a href="{{ $href }}" class="block group min-w-0" style="height: 100%;">
    <div class="rounded-2xl overflow-hidden
              shadow-sm hover:shadow-xl
              hover:-translate-y-1.5
              transition-all duration-500 ease-out
              border border-gray-100 bg-white"
        style="height: 100%; display: flex; flex-direction: column;">

        {{-- ===== IMAGE HEADER AREA ===== --}}
        <div class="relative overflow-hidden" style="height: 140px;">

            {{-- Category image --}}
            @if ($imagePath)
                <img src="{{ $imagePath }}" alt="{{ $title }}"
                    class="group-hover:scale-110 transition-transform duration-500 ease-out"
                    style="width: 100%; height: 100%; object-fit: cover;">
            @endif

            {{-- Count badge (top-right) --}}
            <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                <span
                    style="background: rgba(255,255,255,0.92); color: #1f2937; font-size: 10px; font-weight: 600; border-radius: 6px; padding: 4px 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.15);">
                    {{ $count }} Aplikasi
                </span>
            </div>

        </div>

        {{-- ===== TEXT CONTENT AREA ===== --}}
        <div class="p-4" style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-snug line-clamp-2
                    group-hover:text-gray-900 transition-colors duration-300"
                    style="overflow-wrap: break-word;">
                    {{ $title }}
                </h3>
                <p class="text-[11px] text-gray-400 mt-2 leading-relaxed line-clamp-2">
                    {{ $description }}
                </p>
            </div>

            <div class="mt-3">
                <span
                    class="inline-block text-xs font-bold text-white px-3 py-2 rounded-md transition-all duration-300 group-hover:opacity-90"
                    style="background-color: #2563EB;">
                    Lihat Semua
                </span>
            </div>
        </div>

    </div>
</a>
