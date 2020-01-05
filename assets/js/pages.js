var slider = document.getElementById('slider');
var mask = slider.querySelector('.mask');

var imgs = mask.querySelectorAll('img.slider-img');

setInterval(function () {
  imgs = mask.querySelectorAll('img.slider-img');

  var current = imgs[0];
  var after = imgs[1];

  current.classList.add('moving');
  after.classList.add('moving');

  setTimeout(function () {
    mask.append(current);

    current.classList.remove('moving');
    after.classList.remove('moving');
  }, 1000);
}, 3000);
