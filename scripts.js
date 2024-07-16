// JavaScript for the image modal
function openModal(src) {
    document.getElementById("imageModal").style.display = "block";
    document.getElementById("fullImage").src = src;
}

function closeImageModal() {
    document.getElementById("imageModal").style.display = "none";
}

// JavaScript for the carousel
document.addEventListener('DOMContentLoaded', function() {
    const leftArrow = document.querySelectorAll('.left-arrow');
    const rightArrow = document.querySelectorAll('.right-arrow');
    const containers = document.querySelectorAll('.certificate-container, .portfolio-items');

    leftArrow.forEach((arrow, index) => {
        arrow.addEventListener('click', () => {
            containers[index].scrollLeft -= 300;
        });
    });

    rightArrow.forEach((arrow, index) => {
        arrow.addEventListener('click', () => {
            containers[index].scrollLeft += 300;
        });
    });
});