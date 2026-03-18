let nextButton = document.getElementById("next");
let prevButton = document.getElementById("prev");
let carousel = document.querySelector(".carousel");
let listHTML = document.querySelector(".carousel .list");
let backButton = document.getElementById("back");
let dots = document.querySelectorAll(".carousel-dots .dot");
let totalSlides = dots.length;
let currentIndex = 0;

// ========== ARROW NAVIGATION ==========
nextButton.onclick = function () {
    showSlider("next");
};
prevButton.onclick = function () {
    showSlider("prev");
};

// ========== DOT CLICK NAVIGATION ==========
dots.forEach((dot) => {
    dot.addEventListener("click", function () {
        let targetIndex = parseInt(this.dataset.index);
        if (targetIndex === currentIndex) return;

        let diff = targetIndex - currentIndex;
        let direction = diff > 0 ? "next" : "prev";
        let steps = Math.abs(diff);

        // Move slides one step at a time with small delay for smooth animation
        let stepCount = 0;
        function stepSlide() {
            if (stepCount < steps) {
                showSlider(direction, true); // skipDotUpdate during stepping
                stepCount++;
                if (stepCount < steps) {
                    setTimeout(stepSlide, 150);
                } else {
                    // Final step: update dots
                    currentIndex = targetIndex;
                    updateDots();
                }
            }
        }
        stepSlide();
    });
});

// ========== CORE SLIDER LOGIC ==========
let unAcceppClick;
const showSlider = (type, skipDotUpdate = false) => {
    nextButton.style.pointerEvents = "none";
    prevButton.style.pointerEvents = "none";

    carousel.classList.remove("next", "prev");
    let items = document.querySelectorAll(".carousel .list .item");
    if (type === "next") {
        listHTML.appendChild(items[0]);
        carousel.classList.add("next");
        if (!skipDotUpdate) {
            currentIndex = (currentIndex + 1) % totalSlides;
        }
    } else {
        listHTML.prepend(items[items.length - 1]);
        carousel.classList.add("prev");
        if (!skipDotUpdate) {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        }
    }

    if (!skipDotUpdate) {
        updateDots();
    }

    clearTimeout(unAcceppClick);
    unAcceppClick = setTimeout(() => {
        nextButton.style.pointerEvents = "auto";
        prevButton.style.pointerEvents = "auto";
    }, 2000);
};

// ========== DOT STATE SYNC ==========
function updateDots() {
    dots.forEach((dot, i) => {
        dot.classList.toggle("active", i === currentIndex);
    });
}

// ========== TOUCH / SWIPE SUPPORT ==========
let touchStartX = 0;
let touchEndX = 0;
const SWIPE_THRESHOLD = 50;

carousel.addEventListener(
    "touchstart",
    (e) => {
        touchStartX = e.changedTouches[0].screenX;
    },
    { passive: true }
);

carousel.addEventListener(
    "touchend",
    (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    },
    { passive: true }
);

function handleSwipe() {
    let diff = touchStartX - touchEndX;
    if (Math.abs(diff) < SWIPE_THRESHOLD) return;

    if (diff > 0) {
        showSlider("next"); // swipe left → next
    } else {
        showSlider("prev"); // swipe right → prev
    }
    // Reset auto-slide timer on manual swipe
    resetAutoSlide();
}

// ========== AUTO SLIDE ==========
let autoNextInterval = setInterval(() => {
    showSlider("next");
}, 7000);

function resetAutoSlide() {
    clearInterval(autoNextInterval);
    autoNextInterval = setInterval(() => {
        showSlider("next");
    }, 7000);
}

// Reset auto-slide on any manual navigation
nextButton.addEventListener("click", resetAutoSlide);
prevButton.addEventListener("click", resetAutoSlide);
