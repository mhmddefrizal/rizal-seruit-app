@props(['href', 'title', 'description', 'count', 'color' => '#1EA05E'])

<a href="{{ $href }}" class="block group">
  <div class="rounded-xl border border-neutral-200 overflow-hidden
              hover:shadow-lg hover:-translate-y-1
              transition-all duration-300 ease-in-out">
    {{-- Top background area --}}
    <div class="h-24 relative" style="background: linear-gradient(135deg, {{ $color }}, {{ $color }}cc);">
      <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 200 100" preserveAspectRatio="none">
          <circle cx="170" cy="15" r="40" fill="white" />
          <circle cx="30" cy="80" r="25" fill="white" />
        </svg>
      </div>
      <div class="absolute top-3 left-4">
        <span class="bg-white/20 text-white text-[10px] font-medium rounded-full px-3 py-1 backdrop-blur-sm">
          {{ $count }} aplikasi
        </span>
      </div>
      <div class="absolute bottom-3 right-4">
        <div class="bg-white/20 rounded-full p-2 backdrop-blur-sm group-hover:bg-white/30 transition-colors">
          <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </div>
    </div>
    {{-- Bottom text area --}}
    <div class="p-4 bg-white">
      <h3 class="font-semibold md:text-base text-sm text-gray-800 group-hover:text-[{{ $color }}] transition-colors">
        {{ $title }}
      </h3>
      <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $description }}</p>
    </div>
  </div>
</a>
