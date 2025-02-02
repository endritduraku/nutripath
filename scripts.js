let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

console.log(`Total slides found: ${totalSlides}`);

function showSlide(index) {
    console.log(`Showing slide ${index}`);
    slides.forEach((slide, i) => {
        slide.style.transform = `translateX(-${index * 100}%)`;
    });
}

setInterval(() => {
    currentSlide = (currentSlide + 1) % totalSlides;
    showSlide(currentSlide);
}, 3000);
