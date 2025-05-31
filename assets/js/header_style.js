
document.querySelector('.hamburger').addEventListener('click', function () {
  this.classList.toggle('active');
  document.querySelector('.main-menu').classList.toggle('active');
});


document.querySelectorAll('.menu-item > a').forEach(item => {
  item.addEventListener('click', function (e) {
    if (window.innerWidth <= 768) {
      e.preventDefault();
      const parent = this.parentElement;
      document.querySelectorAll('.menu-item').forEach(sibling => {
        if (sibling !== parent) sibling.classList.remove('active');
      });
      parent.classList.toggle('active');
    }
  });
});


document.querySelectorAll('.sub-menu-item > a').forEach(item => {
  item.addEventListener('click', function (e) {
    if (window.innerWidth <= 768) {
      e.preventDefault();
      const parent = this.parentElement;
      document.querySelectorAll('.sub-menu-item').forEach(sibling => {
        if (sibling !== parent) sibling.classList.remove('active');
      });
      parent.classList.toggle('active');
    }
  });
});