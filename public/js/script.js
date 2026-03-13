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
                        var aksesClass =
                            el.akses === "publik"
                                ? "border-[#43a4d4]"
                                : "border-[#e7a861]";
                        html += `
                        <div class="rounded-lg border border-neutral-200 p-2 hit-button cursor-pointer
                                    hover:shadow-md hover:border-neutral-300 transition-shadow duration-200"
                             data-id="${el.id}" data-nama="${el.nama}" data-logo="/img/${el.logo}" data-slug="${el.slug}"
                             data-deskripsi="${el.deskripsi}" data-akses="${el.akses}" data-pengguna="${el.pengguna}" data-link="${el.link}">
                                <div class="flex flex-row justify-between items-center mb-2">
                                    <img src="/img/${el.logo}" alt="${el.nama}" class="rounded-lg h-10">
                                    <span class="${aksesClass} border text-black rounded-xl text-[10px] flex items-center justify-center px-2">${el.akses}</span>
                                </div>
                                <span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2">${el.pembuat}</span>
                                <div class="flex flex-row justify-between items-center">
                                    <p class="text-base font-semibold">${el.nama}</p>
                                    <p class="mt-4 text-xs text-gray-500 w-1/4">
                                        Hits: <span id="hits-count-${el.id}">${el.hits}</span>
                                    </p>
                                </div>
                                <p class="text-sm text-gray-500">${el.deskripsi}</p>
                        </div>`;
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
            bg_akses = bps_ri += `
            <div class="rounded-lg border border-neutral-200 p-2 hit-button cursor-pointer"
                 data-id="${element.id}" data-nama="${element.nama}" data-logo="/img/${element.logo}" data-slug="${element.slug}"
                 data-deskripsi="${element.deskripsi}" data-akses="${element.akses}" data-pengguna="${element.pengguna}" data-link="${element.link}">
                    <div class="flex flex-row justify-between items-center">
                        <img src="/img/${element.logo}" alt="" class="rounded-lg h-8">
                        <span class="border-neutral-300 border text-[#282626] rounded-xl text-[10px] flex items-center justify-center px-2">${element.akses}</span>
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <p class="mt-4 text-base font-semibold">${element.nama}</p>
                        <p class="mt-4 text-xs text-gray-500" id="hits-count-${element.id}">Hits: ${element.hits}</p>
                    </div>
                    <p class="text-sm text-gray-500">${element.deskripsi}</p>
            </div>
            `;
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
            bps_lampung += `
            <div class="rounded-lg border border-neutral-200 p-2 hit-button cursor-pointer"
                 data-id="${element.id}" data-nama="${element.nama}" data-logo="/img/${element.logo}" data-slug="${element.slug}"
                 data-deskripsi="${element.deskripsi}" data-akses="${element.akses}" data-pengguna="${element.pengguna}" data-link="${element.link}">
                    <div class="flex flex-row justify-between items-center">
                        <img src="/img/${element.logo}" alt="" class="rounded-lg h-8">
                        <span class="border-neutral-300 border text-[#282626] rounded-xl text-[10px] flex items-center justify-center px-2">${element.akses}</span>
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <p class="mt-4 text-base font-semibold">${element.nama}</p>
                        <p class="mt-4 text-xs text-gray-500" id="hits-count-${element.id}">Hits: ${element.hits}</p>
                    </div>
                    <p class="text-sm text-gray-500">${element.deskripsi}</p>
            </div>
            `;
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
            bps_kabkota += `
            <div class="rounded-lg border border-neutral-200 p-2 hit-button cursor-pointer"
                 data-id="${element.id}" data-nama="${element.nama}" data-logo="/img/${element.logo}" data-slug="${element.slug}"
                 data-deskripsi="${element.deskripsi}" data-akses="${element.akses}" data-pengguna="${element.pengguna}" data-link="${element.link}">
                    <div class="flex flex-row justify-between items-center mb-2">
                        <img src="/img/${element.logo}" alt="" class="rounded-lg h-8">
                        <span class="border-neutral-300 border text-[#282626] rounded-xl text-[10px] flex items-center justify-center px-2">${element.akses}</span>
                    </div>
                    <span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2">${element.pembuat}</span>
                    <div class="flex flex-row justify-between items-center">
                        <p class="text-base font-semibold w-3/4">${element.nama}</p>
                        <p class="mt-4 text-xs text-gray-500 w-1/4">
                            Hits: <span id="hits-count-${element.id}">${element.hits}</span>
                    </div>
                    <p class="text-sm text-gray-500">${element.deskripsi}</p>
            </div>
            `;
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
            bps_kldi += `
            <div class="rounded-lg border border-neutral-200 p-2 hit-button cursor-pointer"
                 data-id="${element.id}" data-nama="${element.nama}" data-logo="/img/${element.logo}" data-slug="${element.slug}"
                 data-deskripsi="${element.deskripsi}" data-akses="${element.akses}" data-pengguna="${element.pengguna}" data-link="${element.link}">
                    <div class="flex flex-row justify-between items-center mb-2">
                        <img src="/img/${element.logo}" alt="" class="rounded-lg h-8">
                        <span class="border-neutral-300 border text-[#282626] rounded-xl text-[10px] flex items-center justify-center px-2">${element.akses}</span>
                    </div>
                    <span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2">${element.pembuat}</span>
                    <div class="flex flex-row justify-between items-center">
                        <p class="text-base font-semibold w-3/4">${element.nama}</p>
                        <p class="mt-4 text-xs text-gray-500 w-1/4">
                            Hits: <span id="hits-count-${element.id}">${element.hits}</span>
                    </div>
                    <p class="text-sm text-gray-500">${element.deskripsi}</p>
            </div>
            `;
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
