@props(['item', 'showPembuat' => false, 'borderColor' => '#EF4444'])

<div class="rounded-lg border border-neutral-200 hit-button
            hover:shadow-md hover:border-neutral-300 transition-shadow duration-200 cursor-pointer
            overflow-hidden flex flex-col" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
  data-logo="{{ asset('img/' . $item->logo) }}" data-slug="{{ $item->slug }}" data-deskripsi="{{ $item->deskripsi }}"
  data-akses="{{ $item->akses }}" data-pengguna="{{ $item->pengguna }}" data-link="{{ $item->link }}">
  <a href="{{ route('info', $item->slug) }}" target="_blank" class="flex flex-col flex-1 no-underline">
    {{-- Top section: Logo + Badge --}}
    <div class="p-3 pb-0">
      <div class="flex flex-row justify-between items-center">
        <img src="{{ asset('img/' . $item->logo) }}" alt="{{ $item->nama }}" class="rounded-lg h-10">
        <span class="rounded-full text-[10px] font-semibold flex items-center justify-center" @if ($item->akses ==
          'publik')
          style="background-color: #1EA05E; color: #fff; padding: 2px 12px;"
          @else
          style="background-color: #F59E0B; color: #fff; padding: 2px 12px;"
          @endif>
          {{ $item->akses }}
        </span>
      </div>
    </div>

    {{-- Pembuat badge --}}
    @if ($showPembuat)
    <div class="px-3 pt-2">
      <span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2 py-0.5">{{ $item->pembuat }}</span>
    </div>
    @endif

    {{-- Title + Hits on same row --}}
    <div class="px-3 pt-3 flex-1">
      <div class="flex flex-row justify-between items-start">
        <p class="text-base font-bold text-gray-800 leading-tight">{{ $item->nama }}</p>
        <div class="flex items-center gap-2 text-gray-400 shrink-0 ml-2">
          {{-- Touch/Hand icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" stroke="none">
            <path
              d="M12 1a2 2 0 0 1 2 2v7h1V8a2 2 0 1 1 4 0v4h1V9a2 2 0 1 1 4 0v7a8 8 0 0 1-8 8h-2a6 6 0 0 1-5.2-3L4.35 13.53a2 2 0 0 1 3.46-2L10 15V3a2 2 0 0 1 2-2z"
              opacity="0.85" />
          </svg>
          <span class="text-xs font-medium">
            Hits: <span id="hits-count-{{ $item->id }}">{{ $item->hits }}</span>
          </span>
        </div>
      </div>
      <p class="text-xs text-gray-400 mt-1 mb-3 leading-relaxed">{{ $item->deskripsi }}</p>
    </div>

    {{-- Bottom colored line --}}
    <div class="w-full rounded-b-lg" @style(['height: 2px', 'background-color: ' . $borderColor])></div>
  </a>
</div>