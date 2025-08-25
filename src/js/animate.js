document.addEventListener("DOMContentLoaded", () => {
    // Check if an element is in the viewport
    Element.prototype.isInViewport = function (offset = 0) {
        const elementTop = this.getBoundingClientRect().top + offset;
        const elementBottom = elementTop + this.offsetHeight;
        const viewportTop = 0;
        const viewportBottom = window.innerHeight;

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    // Remove "no-js" class from the body
    document.body.classList.remove("no-js");

    // Function to handle animations for elements in viewport
    const elementEntranceFade = () => {
		console.log( 'Running' )
        document.querySelectorAll(".ews-animate").forEach((element) => {
            if (element.isInViewport()) {
                const delay = element.getAttribute("data-ews-delay") || 0;
                const anim = element.getAttribute("data-ews-animate") || "ani-fade";

                setTimeout(() => {
                    element.classList.remove("ews-animate");
                    element.classList.add(anim);
                }, delay);
            }
        });
    };

    // Attach scroll event to trigger animations
    document.addEventListener("scroll", elementEntranceFade);

    // Trigger animations on document ready
    elementEntranceFade();
});