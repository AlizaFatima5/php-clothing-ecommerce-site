window.onload = function() {
  const bannerContainer = document.getElementById('bannerContainer');
  const slides = bannerContainer.querySelectorAll('.slide-image');
  const totalSlides = slides.length;

  let currentIndex = 0;

  function showSlide(index) {
    if(index < 0) index = totalSlides - 1;
    if(index >= totalSlides) index = 0;
    currentIndex = index;
    bannerContainer.style.transform = `translateX(-${index * 100}%)`;
  }

  function moveSlide(step) {
    showSlide(currentIndex + step);
  }

  window.moveSlide = moveSlide;  // Taake buttons ke onclick work karein

  setInterval(() => {
    let randomIndex;
    do {
      randomIndex = Math.floor(Math.random() * totalSlides);
    } while(randomIndex === currentIndex);
    showSlide(randomIndex);
  }, 3000);

  showSlide(0);
};
