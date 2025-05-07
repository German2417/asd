document.addEventListener("DOMContentLoaded", () => {
    const galleryItems = document.querySelectorAll(".gallery-item img");
    const lightbox = document.createElement("div");
    const lightboxImage = document.createElement("img");
    const nextButton = document.createElement("button");
    const backButton = document.createElement("button");

    // Lightbox setup
    lightbox.id = "lightbox";
    lightbox.style.display = "none";
    lightbox.style.position = "fixed";
    lightbox.style.top = "0";
    lightbox.style.left = "0";
    lightbox.style.width = "100%";
    lightbox.style.height = "100%";
    lightbox.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
    lightbox.style.justifyContent = "center";
    lightbox.style.alignItems = "center";
    lightbox.style.zIndex = "1000";

    lightboxImage.style.maxWidth = "90%";
    lightboxImage.style.maxHeight = "90%";
    lightboxImage.style.borderRadius = "10px";

    nextButton.textContent = "Next";
    nextButton.style.position = "absolute";
    nextButton.style.top = "50%";
    nextButton.style.right = "20px";
    nextButton.style.transform = "translateY(-50%)";
    nextButton.style.padding = "10px 20px";
    nextButton.style.backgroundColor = "#fff";
    nextButton.style.border = "none";
    nextButton.style.borderRadius = "5px";
    nextButton.style.cursor = "pointer";

    backButton.textContent = "Back";
    backButton.style.position = "absolute";
    backButton.style.top = "50%";
    backButton.style.left = "20px";
    backButton.style.transform = "translateY(-50%)";
    backButton.style.padding = "10px 20px";
    backButton.style.backgroundColor = "#fff";
    backButton.style.border = "none";
    backButton.style.borderRadius = "5px";
    backButton.style.cursor = "pointer";

    lightbox.appendChild(lightboxImage);
    lightbox.appendChild(nextButton);
    lightbox.appendChild(backButton);
    document.body.appendChild(lightbox);

    let currentIndex = 0;

    // Open lightbox
    galleryItems.forEach((img, index) => {
        img.addEventListener("click", () => {
            currentIndex = index;
            lightboxImage.src = img.src;
            lightbox.style.display = "flex";
        });
    });

    // Close lightbox on click outside the image
    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) {
            lightbox.style.display = "none";
        }
    });

    // Close lightbox with ESC key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            lightbox.style.display = "none";
        }
    });

    // Next button functionality
    nextButton.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % galleryItems.length;
        lightboxImage.src = galleryItems[currentIndex].src;
    });

    // Back button functionality
    backButton.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
        lightboxImage.src = galleryItems[currentIndex].src;
    });
});