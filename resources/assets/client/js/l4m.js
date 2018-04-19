import LazyImages from './components/lazy-images';
import SimpleCarousel from './components/simple-carousel';

export function init () {
  LazyImages.init();

  const carousel = document.querySelector('.simple-carousel');

  if (!carousel) {
    return;
  }

  const myCarousel = new SimpleCarousel(carousel);
};