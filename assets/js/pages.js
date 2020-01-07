var slider = document.getElementById('slider'),
  mask = slider.querySelector('.mask'),
  imgs = getSliderImages(),
  moving = 'moving';

highlightText(0);

setInterval(function () {
  var current = imgs[0],
    after = imgs[1];

  current.classList.add(moving);
  after.classList.add(moving);

  setTimeout(function () {
    mask.append(current);

    current.classList.remove(moving);
    after.classList.remove(moving);

    var pos = Number(after.attributes['src'].value.match(/\d(?=-)/g)[0]);
    highlightText(pos - 1);

    imgs = getSliderImages();
  }, 600);
}, 3000);

function highlightText(pos) {
  var texts = document.getElementsByClassName('slider-text')[0].querySelectorAll('span:not(.e)');
  var text = texts[pos];

  for (var i = 0; i < texts.length; i++) {
    texts[i].classList.remove('couleur');
  }

  text.classList.add('couleur');
}

function getSliderImages() {
  return mask.querySelectorAll('img.slider-img');
}
