@props(['item', 'showPembuat' => false])

<div class="rounded-lg border border-neutral-200 p-2 hit-button
            hover:shadow-md hover:border-neutral-300 transition-shadow duration-200 cursor-pointer"
    data-id="{{ $item->id }}"
    data-nama="{{ $item->nama }}"
    data-logo="{{ asset('img/' . $item->logo) }}"
    data-slug="{{ $item->slug }}"
    data-deskripsi="{{ $item->deskripsi }}"
    data-akses="{{ $item->akses }}"
    data-pengguna="{{ $item->pengguna }}"
    data-link="{{ $item->link }}">
    <div class="flex flex-row justify-between items-center {{ $showPembuat ? 'mb-2' : '' }}">
        <img src="{{ asset('img/' . $item->logo) }}" alt="{{ $item->nama }}" class="rounded-lg h-10">
        <span
            class="{{ $item->akses == 'publik' ? 'border-[#43a4d4]' : 'border-[#e7a861]' }}
                    border text-black rounded-xl text-[10px] flex items-center justify-center px-2">
            {{ $item->akses }}
        </span>
    </div>
    @if ($showPembuat)
        <span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2">{{ $item->pembuat }}</span>
    @endif
    <div class="flex flex-row justify-between items-center">
        <p class="{{ $showPembuat ? '' : 'mt-4' }} text-base font-semibold">{{ $item->nama }}</p>
        <p class="mt-4 text-xs text-gray-500 w-1/4">
            Hits: <span id="hits-count-{{ $item->id }}">{{ $item->hits }}</span>
        </p>
    </div>
    <p class="text-sm text-gray-500">{{ $item->deskripsi }}</p>
</div>
