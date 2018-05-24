import ImageZoomer from '../components/image-zoomer';
import ImageGallery from '../components/image-gallery';
import Siema from '../components/siema';

(function() {
  const slider = new  Siema({
    selector: '.demo-siema',
    perPage: 1,
  });
  return;

  const zoomer = new ImageZoomer();
  window.imgGallery = new ImageGallery({
    onChange,
  });
  document.querySelector('.js-arrow--prev')
    .addEventListener('click', imgGallery.nextImage)
  document.querySelector('.js-arrow--next')
    .addEventListener('click', imgGallery.prevImage);

  function onChange() {
    zoomer.init();
  }
}());

