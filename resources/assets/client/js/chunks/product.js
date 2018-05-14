import ImageZoomer from '../components/image-zoomer';
import ImageGallery from '../components/image-gallery';

(function() {
  const zoomer = new ImageZoomer();
  ImageGallery.init((src) => {
    zoomer.init();
  });
}());

