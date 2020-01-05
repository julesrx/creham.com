var slider = document.getElementById('slider');
var mask = slider.querySelector('.mask');

var imgs = mask.querySelectorAll('img.slider-img');

highlightText(0);

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

    var pos = Number(after.attributes['src'].value.match(/(?<=\/)\d(?=-)/g)[0]);
    console.log(after.attributes['src'].value);
    highlightText(pos - 1);
  }, 500);
}, 3000);

function highlightText(pos) {
  var texts = document.getElementsByClassName('slider-text')[0].querySelectorAll('span:not(.e)');

  var text = texts[pos];
  for (var i = 0; i < texts.length; i++) {
    texts[i].classList.remove('couleur');
  }
  text.classList.add('couleur');
}
