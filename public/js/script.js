$("#search_0").on("keyup", function () {
    search($("#search_0").val());
});

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
                        html += buildAppCard(el, true);
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

// ========================================
// Reusable Card Builder
// ========================================
function buildAppCard(el, showPembuat) {
    var borderColors = ['#3B82F6', '#EF4444', '#F59E0B', '#10B981', '#8B5CF6', '#EC4899', '#06B6D4', '#F97316'];
    var randomColor = borderColors[Math.floor(Math.random() * borderColors.length)];
    var badgeColor = el.akses === 'publik' ? '#1EA05E' : '#F59E0B';
    var aksesLabel = el.akses.charAt(0).toUpperCase() + el.akses.slice(1);
    var pembuatHtml = showPembuat && el.pembuat
        ? `<div class="px-3 pt-2"><span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2 py-0.5">${el.pembuat}</span></div>`
        : '';

    return `
    <div class="rounded-lg border border-neutral-200 hit-button
                hover:shadow-md hover:border-neutral-300 transition-shadow duration-200 cursor-pointer
                overflow-hidden flex flex-col"
         data-id="${el.id}" data-nama="${el.nama}" data-logo="/img/${el.logo}" data-slug="${el.slug}">
        <a href="/info/${el.slug}" target="_blank" class="flex flex-col flex-1 no-underline">
            <div class="p-3 pb-0">
                <div class="flex flex-row justify-between items-center">
                    <img src="/img/${el.logo}" alt="${el.nama}" class="rounded-lg h-10">
                    <span class="rounded-full text-[10px] font-semibold flex items-center justify-center"
                        style="background-color: ${badgeColor}; color: #fff; padding: 2px 12px;">
                        ${aksesLabel}
                    </span>
                </div>
            </div>
            ${pembuatHtml}
            <div class="px-3 pt-3 flex-1">
                <div class="flex flex-row justify-between items-start">
                    <p class="text-base font-bold text-gray-800 leading-tight">${el.nama}</p>
                    <div class="flex items-center gap-2 text-gray-400 shrink-0 ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                            <path d="M12 1a2 2 0 0 1 2 2v7h1V8a2 2 0 1 1 4 0v4h1V9a2 2 0 1 1 4 0v7a8 8 0 0 1-8 8h-2a6 6 0 0 1-5.2-3L4.35 13.53a2 2 0 0 1 3.46-2L10 15V3a2 2 0 0 1 2-2z" opacity="0.85"/>
                        </svg>
                        <span class="text-xs font-medium">
                            Hits: <span id="hits-count-${el.id}">${el.hits}</span>
                        </span>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-1 mb-3 leading-relaxed">${el.deskripsi}</p>
            </div>
            <div class="w-full rounded-b-lg" style="height: 2px; background-color: ${randomColor};"></div>
        </a>
    </div>`;
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
    let html = "";
    if (res.length <= 0) {
        html += `<p class="text-gray-500 relative col-span-5" style="width:500px">Aplikasi tidak ditemukan</p>`;
    } else {
        res.forEach((el) => { html += buildAppCard(el, false); });
    }
    $("#bps_ri").html(html);
}

function search_bps_lampung(res) {
    let html = "";
    if (res.length <= 0) {
        html += `<p class="text-gray-500 col-span-full" style="width:200px">Aplikasi tidak ditemukan</p>`;
    } else {
        res.forEach((el) => { html += buildAppCard(el, false); });
    }
    $("#bps_lampung").html(html);
}

function search_bps_kabkota(res) {
    let html = "";
    if (res.length <= 0) {
        html += `<p class="text-gray-500 col-span-full" style="width:200px">Aplikasi tidak ditemukan</p>`;
    } else {
        res.forEach((el) => { html += buildAppCard(el, true); });
    }
    $("#bps_kabkota").html(html);
}

function search_bps_kldi(res) {
    let html = "";
    if (res.length <= 0) {
        html += `<p class="text-gray-500 col-span-full" style="width:200px">Aplikasi tidak ditemukan</p>`;
    } else {
        res.forEach((el) => { html += buildAppCard(el, true); });
    }
    $("#bps_kldi").html(html);
}

// ========================================
// Confirmation Modal Logic
// ========================================
var pendingCardId = null;
var pendingCardSlug = null;

function showConfirmModal(id, nama, logo, slug) {
    pendingCardId = id;
    pendingCardSlug = slug;

    // Populate modal content
    $("#confirm-modal-logo").attr("src", logo);
    $("#confirm-modal-app-name").text(nama);

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
}

$(document).ready(function () {
    // === Card click → show confirmation modal ===
    $(document).on("click", ".hit-button", function (e) {
        e.preventDefault();
        e.stopPropagation();

        var $card = $(this);
        var id = $card.data("id");
        var nama = $card.data("nama") || $card.find(".font-semibold").first().text().trim();
        var logo = $card.data("logo") || $card.find("img").first().attr("src");
        var slug = $card.data("slug") || "";

        // Extract slug from href if not in data attribute
        if (!slug) {
            var href = $card.find("a").attr("href") || "";
            var match = href.match(/\/info\/(.+)/);
            if (match) slug = match[1];
        }

        showConfirmModal(id, nama, logo, slug);
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
        if (e.key === "Escape" && $("#confirm-modal-overlay").hasClass("active")) {
            hideConfirmModal();
        }
    });

    // === Modal: Confirm → update hits & navigate ===
    $("#confirm-modal-confirm").on("click", function () {
        if (!pendingCardId || !pendingCardSlug) return;

        var $btn = $(this);
        $btn.prop("disabled", true).css("opacity", "0.7");

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
                // Navigate to detail page
                window.open(`/info/${response.slug}`, "_blank");
            },
            error: function (xhr, status, error) {
                console.error("Error updating hit count:", xhr.responseText);
                // Still navigate even on error
                window.open(`/info/${pendingCardSlug}`, "_blank");
            },
            complete: function () {
                $btn.prop("disabled", false).css("opacity", "1");
                hideConfirmModal();
            },
        });
    });
});
