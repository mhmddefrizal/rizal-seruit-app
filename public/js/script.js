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

                ${showPembuat && pembuat ? `<div class="px-3 pt-2"><span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2 py-0.5">${pembuat}</span></div>` : ""}

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

$("#search_kategori").on("keyup", function () {
    var keyword = $(this).val().toLowerCase();
    $("#app_grid .hit-button").each(function () {
        var text = $(this).text().toLowerCase();
        $(this).toggle(text.indexOf(keyword) > -1);
    });
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
            bps_ri += renderAppCard(element, { showPembuat: false });
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
            bps_lampung += renderAppCard(element, { showPembuat: false });
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
