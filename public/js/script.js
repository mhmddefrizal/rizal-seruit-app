$("#search_0").on("keyup", function () {
    search($("#search_0").val());
});

$("#search_1").on("keyup", function () {
    search($("#search_1").val());
});

search();
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
        }
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
            <div class="rounded-lg border border-neutral-200 p-2 hit-button" data-id=${element.id}>
                <a href="info/${element.slug}" target="_blank">
                    <div class="flex flex-row justify-between items-center">
                        <img src="img/${element.logo}" alt="" class="rounded-lg h-8">
                        <span class="border-neutral-300 border text-[#282626] rounded-xl text-[10px] flex items-center justify-center px-2">${element.akses}</span>
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <p class="mt-4 text-base font-semibold">${element.nama}</p>
                        <p class="mt-4 text-xs text-gray-500" id="hits-count-${element.id}">Hits: ${element.hits}</p>
                    </div>
                    <p class="text-sm text-gray-500">${element.deskripsi}</p>
                </a>
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
            <div class="rounded-lg border border-neutral-200 p-2 hit-button" data-id=${element.id}>
                <a href="info/${element.slug}" target="_blank">
                    <div class="flex flex-row justify-between items-center">
                        <img src="img/${element.logo}" alt="" class="rounded-lg h-8">
                        <span class="border-neutral-300 border text-[#282626] rounded-xl text-[10px] flex items-center justify-center px-2">${element.akses}</span>
                    </div>
                    <div class="flex flex-row justify-between items-center">
                        <p class="mt-4 text-base font-semibold">${element.nama}</p>
                        <p class="mt-4 text-xs text-gray-500" id="hits-count-${element.id}">Hits: ${element.hits}</p>
                    </div>
                    <p class="text-sm text-gray-500">${element.deskripsi}</p>
                </a>
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
            <div class="rounded-lg border border-neutral-200 p-2 hit-button" data-id=${element.id}>
                <a href="info/${element.slug}" target="_blank">
                    <div class="flex flex-row justify-between items-center mb-2">
                        <img src="img/${element.logo}" alt="" class="rounded-lg h-8">
                        <span class="border-neutral-300 border text-[#282626] rounded-xl text-[10px] flex items-center justify-center px-2">${element.akses}</span>
                    </div>
                    <span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2">${element.pembuat}</span>
                    <div class="flex flex-row justify-between items-center">
                        <p class="text-base font-semibold w-3/4">${element.nama}</p>
                        <p class="mt-4 text-xs text-gray-500 w-1/4">
                            Hits: <span id="hits-count-${element.id}">${element.hits}</span>
                    </div>
                    <p class="text-sm text-gray-500">${element.deskripsi}</p>
                </a>
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
            <div class="rounded-lg border border-neutral-200 p-2 hit-button" data-id=${element.id}>
                <a href="info/${element.slug}" target="_blank">
                    <div class="flex flex-row justify-between items-center mb-2">
                        <img src="img/${element.logo}" alt="" class="rounded-lg h-8">
                        <span class="border-neutral-300 border text-[#282626] rounded-xl text-[10px] flex items-center justify-center px-2">${element.akses}</span>
                    </div>
                    <span class="bg-[#1EA05E] text-white rounded-xl text-[10px] px-2">${element.pembuat}</span>
                    <div class="flex flex-row justify-between items-center">
                        <p class="text-base font-semibold w-3/4">${element.nama}</p>
                        <p class="mt-4 text-xs text-gray-500 w-1/4">
                            Hits: <span id="hits-count-${element.id}">${element.hits}</span>
                    </div>
                    <p class="text-sm text-gray-500">${element.deskripsi}</p>
                </a>
            </div>
            `;
        });
    }

    $("#bps_kldi").html(bps_kldi);
}

$(document).ready(function () {
    $(document).on("click", ".hit-button", function (e) {
        e.preventDefault(); // Mencegah tindakan default sementara
        var id = $(this).data("id");
        var url = $(this).attr("href"); // Ambil URL dari atribut href

        $.ajax({
            url: "/update-hits", // Sesuaikan URL dengan rute Anda
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                item_id: id,
            },
            success: function (response) {
                const hitCountElement = $(`#hits-count-${response.id}`);
                if (hitCountElement.length > 0) {
                    hitCountElement.text(parseInt(response.hits));
                } else {
                    console.error(
                        `Element with ID hits-count-${response.id} not found`
                    );
                }
                // Setelah sukses, buka link di tab baru
                window.open(`info/${response.slug}`, "_blank");
            },
            error: function (xhr, status, error) {
                console.error("Error updating hit count:", xhr.responseText);
                // Jika ada error, tetap buka link di tab baru
                window.open(`info/${response.slug}`, "_blank");
            },
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    function setupToggle(toggleButtonId, contentId, isOpenInitially) {
        const toggleButton = document.getElementById(toggleButtonId);
        const content = document.getElementById(contentId);
        const chevronIcon = toggleButton.querySelector(".chevron");

        if (isOpenInitially) {
            content.classList.add("max-height-full");
            chevronIcon.classList.add("chevron-up");
        } else {
            content.classList.remove("max-height-full");
            chevronIcon.classList.add("chevron-down");
        }

        toggleButton.addEventListener("click", function () {
            if (content.classList.contains("max-height-full")) {
                content.classList.remove("max-height-full");
                chevronIcon.classList.remove("chevron-up");
                chevronIcon.classList.add("chevron-down");
            } else {
                content.classList.add("max-height-full");
                chevronIcon.classList.remove("chevron-down");
                chevronIcon.classList.add("chevron-up");
            }
        });
    }

    setupToggle("toggle-chevron", "bps_ri", false);
    setupToggle("toggle-chevron-lampung", "bps_lampung", false);
    setupToggle("toggle-chevron-kab", "bps_kabkota", false);
    setupToggle("toggle-chevron-kldi", "bps_kldi", false);
});
