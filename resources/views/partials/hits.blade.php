<div class="carousel xl:pt-2 xl:mt-0 md:mt-40 mt-36">
    <div class="list">
        @php
            $order = [10, 1, 2, 3, 4, 5, 6, 7, 8, 9];
            $pembuatBadgeColors = [
                'BPS RI' => '#EF4444',
                'BPS Provinsi' => '#8100D1',
                // 'BPS Kab-Kota Seprovinsi Lampung' => '#44A194',
                'BPS Kabupaten/Kota' => '#44A194',
                'KLDI' => '#57595B',
            ];
            $i = 0;
        @endphp
        @if (count($top_hits) > 0)
            @foreach ($top_hits as $item)
                <div class="item">
                    {{-- Gambar logo aplikasi --}}
                    <img src="{{ asset('img/' . $item['logo']) }}" alt="{{ $item['nama'] }}" class="item-img rounded-lg">

                    {{-- Bagian introduce untuk menampilkan informasi tentang top hits --}}
                    <div class="introduce">
                        @php
                            $pembuatKey =
                                $item['pembuat'] === 'BPS Provinsi Lampung' ? 'BPS Provinsi' : $item['pembuat'];
                            $pembuatColor = $pembuatBadgeColors[$pembuatKey] ?? '#57595B';
                        @endphp
                        <div class="title">#TOP HITS No. {{ $order[$i] }}</div>
                        <div class="topic">{{ $item['nama'] }}</div>
                        <span class="rounded-md px-2 text-white text-xs" @style(['background-color: ' . $pembuatColor])>
                            {{ $pembuatKey }}
                        </span>
                        <div class="des">
                            Hits: {{ $item['hits'] }}
                            <div class="text-sm text-black">{{ $item['deskripsi'] }}</div>
                        </div>
                        <a href="{{ $item['link'] }}" class="seeMore" target="_blank">Kunjungi &#8599</a>
                    </div>
                </div>
                @php $i++; @endphp
            @endforeach
        @endif
    </div>

    {{-- Dot indicators untuk navigasi di mobile/tablet --}}
    <div class="carousel-dots">
        @if (count($top_hits) > 0)
            @for ($d = 0; $d < count($top_hits); $d++)
                <button class="dot {{ $d === 0 ? 'active' : '' }}" data-index="{{ $d }}"
                    aria-label="Slide {{ $d + 1 }}"></button>
            @endfor
        @endif
    </div>

    {{-- Arrow buttons untuk navigasi di desktop --}}
    <div class="arrows">
        <button id="prev" class="p-2 rounded-full" aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="next" class="p-2 rounded-full" aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>
