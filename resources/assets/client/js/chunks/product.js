import ImageZoomer from '../components/image-zoomer';
import ImageGallery from '../components/image-gallery';

(function() {
  
  const zoomer = new ImageZoomer();
  window.imgGallery = new ImageGallery({
    onChange,
  });

  function onChange() {
    zoomer.init();
  }
}());

