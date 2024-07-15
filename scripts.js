document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.getElementById('contact-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: form.method,
                body: formData
            });

            if (response.ok) {
                const modal = document.getElementById("success_tic");
                modal.style.display = "block";

                // Close modal when clicking on the close button
                const closeButton = modal.querySelector(".close");
                closeButton.onclick = function() {
                    modal.style.display = "none";
                };

                // Close modal when clicking outside of the modal
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                };
            }
        });
    });
document.addEventListener('DOMContentLoaded', function() {
    const leftArrow = document.querySelectorAll('.left-arrow');
    const rightArrow = document.querySelectorAll('.right-arrow');
    const certificateContainer = document.querySelector('.certificate-container');
    const portfolioItems = document.querySelector('.portfolio-items');

    let currentCertificateIndex = 0;
    let currentPortfolioIndex = 0;
    const totalCertificateCards = document.querySelectorAll('.certificate-container .card').length;
    const totalPortfolioCards = document.querySelectorAll('.portfolio-items .card').length;

    function updateScrollPosition(container, currentIndex, totalCards) {
        currentIndex = (currentIndex + totalCards) % totalCards;
        container.scrollTo({
            left: currentIndex * container.offsetWidth,
            behavior: 'smooth'
        });
        return currentIndex;
    }

    leftArrow.forEach(arrow => {
        arrow.addEventListener('click', function() {
            if (arrow.parentElement.contains(certificateContainer)) {
                currentCertificateIndex = updateScrollPosition(certificateContainer, currentCertificateIndex - 1, totalCertificateCards);
            } else {
                currentPortfolioIndex = updateScrollPosition(portfolioItems, currentPortfolioIndex - 1, totalPortfolioCards);
            }
        });
    });

    rightArrow.forEach(arrow => {
        arrow.addEventListener('click', function() {
            if (arrow.parentElement.contains(certificateContainer)) {
                currentCertificateIndex = updateScrollPosition(certificateContainer, currentCertificateIndex + 1, totalCertificateCards);
            } else {
                currentPortfolioIndex = updateScrollPosition(portfolioItems, currentPortfolioIndex + 1, totalPortfolioCards);
            }
        });
    });
});
function openModal(imageSrc) {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("fullImage");
    modal.style.display = "flex";
    modalImg.src = imageSrc;
}

function closeModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none";
}
document.addEventListener('DOMContentLoaded', function() {
    const leftArrows = document.querySelectorAll('.gallery-container .left-arrow');
    const rightArrows = document.querySelectorAll('.gallery-container .right-arrow');
    const galleryContainer = document.querySelector('.gallery-container');
    const galleryItems = document.querySelector('.gallery-items');

    let currentGalleryIndex = 0;
    const totalGalleryItems = document.querySelectorAll('.gallery-container .card').length;

    function updateGalleryScroll(container, currentIndex, totalItems) {
        currentIndex = (currentIndex + totalItems) % totalItems;
        container.scrollTo({
            left: currentIndex * container.offsetWidth,
            behavior: 'smooth'
        });
        return currentIndex;
    }

    leftArrows.forEach(arrow => {
        arrow.addEventListener('click', function() {
            currentGalleryIndex = updateGalleryScroll(galleryContainer, currentGalleryIndex - 1, totalGalleryItems);
        });
    });

    rightArrows.forEach(arrow => {
        arrow.addEventListener('click', function() {
            currentGalleryIndex = updateGalleryScroll(galleryContainer, currentGalleryIndex + 1, totalGalleryItems);
        });
    });
});
