// script.js
document.addEventListener('DOMContentLoaded', () => {
    const scroller = document.getElementById("portfolioScroller");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");

    if (!scroller || !nextBtn || !prevBtn) return;

    // 1. Triple the content to create a massive buffer in both directions
    const content = scroller.innerHTML;
    scroller.innerHTML = content + content + content;

    // 2. Center the scroller on the middle set
    const initScroller = () => {
        const sectionWidth = scroller.scrollWidth / 3;
        scroller.scrollLeft = sectionWidth;
    };

    // Run when all assets (images) are loaded to get correct widths
    window.addEventListener('load', initScroller);

    // 3. Precise scroll amount (400px image + 24px gap)
    const scrollAmount = 424;

    nextBtn.addEventListener("click", () => {
        scroller.scrollBy({left: scrollAmount, behavior: "smooth"});
    });

    prevBtn.addEventListener("click", () => {
        scroller.scrollBy({left: -scrollAmount, behavior: "smooth"});
    });

    // 4. The Seamless Reset
    scroller.addEventListener("scroll", () => {
        const sectionWidth = scroller.scrollWidth / 3;

        // If we wander into the last section, jump back to the middle section
        if (scroller.scrollLeft >= sectionWidth * 2) {
            scroller.scrollLeft -= sectionWidth;
        }
        // If we wander into the first section, jump back to the middle section
        else if (scroller.scrollLeft <= 5) { // Small buffer to prevent getting stuck at 0
            scroller.scrollLeft += sectionWidth;
        }
    });
});