$("#search_0").on("keyup", function () {
    search($("#search_0").val());
});

function escapeHtml(value) {
    return String(value ?? "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/\"/g, "&quot;")
        .replace(/'/g, "&#39;");
}

function renderAppCard(el, options) {
    var opts = options || {};
    var showPembuat = !!opts.showPembuat;
    var borderColors = "#EF4444";
    var akses = (el.akses || "").toLowerCase();
    var aksesBg = akses === "publik" ? "#1EA05E" : "#F59E0B";
    var nama = escapeHtml(el.nama || "-");
    var deskripsi = escapeHtml(el.deskripsi || "-");
    var pembuat = escapeHtml(el.pembuat || "");
    var pengguna = escapeHtml(el.pengguna || "");
    var slug = escapeHtml(el.slug || "");
    var logo = escapeHtml(el.logo || "");
    var link = escapeHtml(el.link || "");
    var hits = Number.isFinite(parseInt(el.hits, 10))
        ? parseInt(el.hits, 10)
        : 0;

    return `
        <div class="rounded-lg border border-neutral-200 hit-button
                    hover:shadow-md hover:border-neutral-300 transition-shadow duration-200 cursor-pointer
                    overflow-hidden flex flex-col"
            data-id="${el.id}" data-nama="${nama}" data-logo="/img/${logo}"
            data-slug="${slug}" data-deskripsi="${deskripsi}" data-akses="${akses}"
            data-pengguna="${pengguna}" data-link="${link}">
            <a href="/info/${slug}" target="_blank" class="flex flex-col flex-1 no-underline">
                <div class="p-3 pb-0">
                    <div class="flex flex-row justify-between items-center">
                        <img src="/img/${logo}" alt="${nama}" class="rounded-lg h-10">
                        <span class="rounded-full text-[10px] font-semibold flex items-center justify-center"
                            style="background-color: ${aksesBg}; color: #fff; padding: 2px 12px;">
                            ${akses}
                        </span>
                    </div>
                </div>

                ${showPembuat && pembuat ? `<div class="px-3 pt-2"><span class="text-white rounded-xl text-[10px] px-2 py-0.5" style="background-color: #1EA05E;">${pembuat}</span></div>` : ""}

                <div class="px-3 pt-3 flex-1">
                    <div class="flex flex-row justify-between items-start gap-2">
                        <p class="text-base font-bold text-gray-800 leading-tight">${nama}</p>
                        <div class="flex items-center gap-2 text-gray-400 shrink-0 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                <path d="M12 1a2 2 0 0 1 2 2v7h1V8a2 2 0 1 1 4 0v4h1V9a2 2 0 1 1 4 0v7a8 8 0 0 1-8 8h-2a6 6 0 0 1-5.2-3L4.35 13.53a2 2 0 0 1 3.46-2L10 15V3a2 2 0 0 1 2-2z" opacity="0.85" />
                            </svg>
                            <span class="text-xs font-medium">
                                Hits: <span id="hits-count-${el.id}">${hits}</span>
                            </span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1 mb-3 leading-relaxed">${deskripsi}</p>
                </div>

                <div class="w-full rounded-b-lg" style="height: 2px; background-color: ${borderColors};"></div>
            </a>
        </div>`;
}

// === Homepage search with debounce ===
var searchTimer = null;
$("#search_1").on("keyup", function () {
    var keyword = $(this).val().trim();
    clearTimeout(searchTimer);

    // If we're on a kategori page, use the local filter logic instead of AJAX
    if ($("#filter_akses").length) {
        // Sync the global search value into the local search field
        $("#search_kategori").val(keyword);
        // Always keep main content visible on kategori pages
        $("#search-results").addClass("hidden");
        $("#main-content").removeClass("hidden");
        applyKategoriFilters();
        return;
    }

    if (keyword === "") {
        // No keyword: show main content, hide search results
        $("#search-results").addClass("hidden");
        $("#main-content").removeClass("hidden");
        return;
    }

    searchTimer = setTimeout(function () {
        // Show search results area, hide main content
        $("#search-results").removeClass("hidden");
        $("#main-content").addClass("hidden");
        $("#search-info").text('Mencari "' + keyword + '"...');
        $("#search-results-grid").html(
            '<p class="text-gray-400 col-span-full text-center py-8">Memuat...</p>',
        );

        $.post(
            "/search",
            {
                _token: $('meta[name="csrf-token"]').attr("content"),
                keyword: keyword,
            },
            function (data) {
                // Merge all categories into one flat array
                var allResults = []
                    .concat(data.list_bps_ri || [])
                    .concat(data.list_bps_lampung || [])
                    .concat(data.list_bps_kabkota || [])
                    .concat(data.list_kldi || []);

                var html = "";
                if (allResults.length === 0) {
                    html =
                        '<p class="text-gray-500 col-span-full text-center py-8">Aplikasi tidak ditemukan untuk "<strong>' +
                        keyword +
                        '</strong>"</p>';
                    $("#search-info").text("0 aplikasi ditemukan");
                } else {
                    $("#search-info").text(
                        allResults.length +
                            ' aplikasi ditemukan untuk "' +
                            keyword +
                            '"',
                    );
                    allResults.forEach(function (el) {
                        html += renderAppCard(el, {
                            showPembuat: !!el.pembuat,
                        });
                    });
                }
                $("#search-results-grid").html(html);
            },
        );
    }, 300);
});

// === Kategori page: combined search + akses filter ===
function applyKategoriFilters() {
    var keyword = ($("#search_kategori").val() || "").toLowerCase();
    var akses = ($("#filter_akses").val() || "semua").toLowerCase();
    var visibleCount = 0;
    var totalCount = 0;
    var searchMatchCount = 0; // matches search keyword (ignoring filter)
    var filterMatchCount = 0; // matches filter (ignoring search)

    $("#app_grid .hit-button").each(function () {
        totalCount++;
        var text = $(this).text().toLowerCase();
        var cardAkses = ($(this).data("akses") || "").toLowerCase();

        var matchesSearch = keyword === "" || text.indexOf(keyword) > -1;
        var matchesFilter = akses === "semua" || cardAkses === akses;

        if (matchesSearch) searchMatchCount++;
        if (matchesFilter) filterMatchCount++;

        if (matchesSearch && matchesFilter) {
            $(this).show();
            visibleCount++;
        } else {
            $(this).hide();
        }
    });

    // Show/hide filter info
    if (akses !== "semua" || keyword !== "") {
        $("#filter_info").removeClass("hidden");
        $("#filter_count").text(visibleCount);
    } else {
        $("#filter_info").addClass("hidden");
    }

    // Smart empty state message
    var $empty = $("#filter_empty");
    var $emptyIcon = $("#filter_empty_icon");
    var $emptyText = $("#filter_empty_text");
    var $emptyHint = $("#filter_empty_hint");

    if (
        visibleCount === 0 &&
        totalCount > 0 &&
        (keyword !== "" || akses !== "semua")
    ) {
        $empty.removeClass("hidden");

        // Case: user searched something that exists but doesn't match the active filter
        if (keyword !== "" && akses !== "semua" && searchMatchCount > 0) {
            var aksesLabel = akses === "vpn" ? "VPN" : "Publik";
            $emptyIcon.html(
                '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-amber-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>',
            );
            $emptyText.html(
                'Aplikasi <strong>"' +
                    keyword +
                    '"</strong> tidak ditemukan di akses <strong>' +
                    aksesLabel +
                    "</strong>",
            );
            $emptyHint
                .removeClass("hidden")
                .html(
                    '💡 Mungkin filter akses tidak sesuai? Coba pilih <strong>"Semua"</strong> atau ganti filter akses.',
                );
        }
        // Case: search keyword doesn't match anything at all
        else if (keyword !== "" && searchMatchCount === 0) {
            $emptyIcon.html(
                '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>',
            );
            $emptyText.html(
                'Aplikasi <strong>"' + keyword + '"</strong> tidak ditemukan.',
            );
            $emptyHint.addClass("hidden").html("");
        }
        // Case: filter active, no search, but no apps match the filter
        else {
            var aksesLabel2 = akses === "vpn" ? "VPN" : "Publik";
            $emptyIcon.html(
                '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" /></svg>',
            );
            $emptyText.html(
                "Tidak ada aplikasi dengan akses <strong>" +
                    aksesLabel2 +
                    "</strong>.",
            );
            $emptyHint.addClass("hidden").html("");
        }
    } else {
        $empty.addClass("hidden");
    }
}

$("#search_kategori").on("keyup", function () {
    applyKategoriFilters();
});

$("#filter_akses").on("change", function () {
    applyKategoriFilters();
});

// Only run AJAX search if target elements exist (kategori sections on page)
if ($("#bps_ri").length) {
    search();
}

function search(val) {
    var keyword = val;
    $.post(
        "/search",
        {
            _token: $('meta[name="csrf-token"]').attr("content"),
            keyword: keyword,
        },
        function (data) {
            search_bps_ri(data.list_bps_ri);
            search_bps_lampung(data.list_bps_lampung);
            search_bps_kabkota(data.list_bps_kabkota);
            search_bps_kldi(data.list_kldi);
        },
    );
}

// table row with ajax
function search_bps_ri(res) {
    let bps_ri = "";

    if (res.length <= 0) {
        bps_ri += `
            <p class="text-gray-500 relative col-span-5" style="width:500px">Aplikasi tidak ditemukan</p>
        `;
    } else {
        res.forEach((element) => {
            bps_ri += renderAppCard(element, { showPembuat: true });
        });
    }

    $("#bps_ri").html(bps_ri);
}

function search_bps_lampung(res) {
    let bps_lampung = "";

    if (res.length <= 0) {
        bps_lampung += `
            <p class="text-gray-500 col-span-full" style="width:200px">Aplikasi tidak ditemukan</p>
        `;
    } else {
        res.forEach((element) => {
            bps_lampung += renderAppCard(element, { showPembuat: true });
        });
    }

    $("#bps_lampung").html(bps_lampung);
}

function search_bps_kabkota(res) {
    let bps_kabkota = "";

    if (res.length <= 0) {
        bps_kabkota += `
            <p class="text-gray-500 col-span-full" style="width:200px">Aplikasi tidak ditemukan</p>
        `;
    } else {
        res.forEach((element) => {
            bps_kabkota += renderAppCard(element, { showPembuat: true });
        });
    }

    $("#bps_kabkota").html(bps_kabkota);
}

function search_bps_kldi(res) {
    let bps_kldi = "";

    if (res.length <= 0) {
        bps_kldi += `
            <p class="text-gray-500 col-span-full" style="width:200px">Aplikasi tidak ditemukan</p>
        `;
    } else {
        res.forEach((element) => {
            bps_kldi += renderAppCard(element, { showPembuat: true });
        });
    }

    $("#bps_kldi").html(bps_kldi);
}

// ========================================
// Confirmation Modal Logic
// ========================================
var pendingCardId = null;
var pendingCardSlug = null;
var pendingCardLink = null;

function showConfirmModal(
    id,
    nama,
    logo,
    slug,
    deskripsi,
    akses,
    pengguna,
    link,
) {
    pendingCardId = id;
    pendingCardSlug = slug;
    pendingCardLink = link;

    // Populate modal content
    $("#confirm-modal-logo").attr("src", logo);
    $("#confirm-modal-app-name").text(nama);
    $("#confirm-modal-deskripsi").text(deskripsi || "-");
    $("#confirm-modal-pengguna").text(pengguna || "-");

    // Set akses badge
    var $akses = $("#confirm-modal-akses");
    $akses.text(akses || "-");
    $akses.removeClass("badge-publik badge-internal");
    if (akses === "publik") {
        $akses.addClass("badge-publik");
    } else {
        $akses.addClass("badge-internal");
    }

    // Set link on Kunjungi button
    $("#confirm-modal-link").attr("href", link || "#");

    // Show modal with animation
    var $overlay = $("#confirm-modal-overlay");
    $overlay.css("display", "flex");
    // Force reflow so the transition triggers
    $overlay[0].offsetHeight;
    $overlay.addClass("active");

    // Prevent body scroll
    $("body").css("overflow", "hidden");
}

function hideConfirmModal() {
    var $overlay = $("#confirm-modal-overlay");
    $overlay.removeClass("active");
    setTimeout(function () {
        $overlay.css("display", "none");
    }, 300);

    // Restore body scroll
    $("body").css("overflow", "");

    pendingCardId = null;
    pendingCardSlug = null;
    pendingCardLink = null;
}

$(document).ready(function () {
    // === Card click → show confirmation modal ===
    $(document).on("click", ".hit-button", function (e) {
        e.preventDefault();
        e.stopPropagation();

        var $card = $(this);
        var id = $card.data("id");
        var nama =
            $card.data("nama") ||
            $card.find(".font-semibold").first().text().trim();
        var logo = $card.data("logo") || $card.find("img").first().attr("src");
        var slug = $card.data("slug") || "";
        var deskripsi = $card.data("deskripsi") || "";
        var akses = $card.data("akses") || "";
        var pengguna = $card.data("pengguna") || "";
        var link = $card.data("link") || "";

        // Extract slug from href if not in data attribute
        if (!slug) {
            var href = $card.find("a").attr("href") || "";
            var match = href.match(/\/info\/(.+)/);
            if (match) slug = match[1];
        }

        showConfirmModal(
            id,
            nama,
            logo,
            slug,
            deskripsi,
            akses,
            pengguna,
            link,
        );
    });

    // === Modal: Cancel / Close ===
    $("#confirm-modal-cancel, #confirm-modal-close").on("click", function () {
        hideConfirmModal();
    });

    // === Modal: Click overlay to close ===
    $("#confirm-modal-overlay").on("click", function (e) {
        if (e.target === this) {
            hideConfirmModal();
        }
    });

    // === Modal: Escape key to close ===
    $(document).on("keydown", function (e) {
        if (
            e.key === "Escape" &&
            $("#confirm-modal-overlay").hasClass("active")
        ) {
            hideConfirmModal();
        }
    });

    // === Modal: Kunjungi link click → update hits & navigate ===
    $(document).on("click", "#confirm-modal-link", function (e) {
        if (!pendingCardId) return;

        // Update hits via AJAX (fire and forget)
        $.ajax({
            url: "/update-hits",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                item_id: pendingCardId,
            },
            success: function (response) {
                const hitCountElement = $(`#hits-count-${response.id}`);
                if (hitCountElement.length > 0) {
                    hitCountElement.text(parseInt(response.hits));
                }
            },
            error: function (xhr, status, error) {
                console.error("Error updating hit count:", xhr.responseText);
            },
            complete: function () {
                hideConfirmModal();
            },
        });
    });
});
