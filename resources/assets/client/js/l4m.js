import LazyImages from './components/lazy-images';
import SimpleCarousel from './components/simple-carousel';
import Toolbar from './components/toolbar';

export function init () {
  LazyImages.init();
  Toolbar.init();

  const carousel = document.querySelector('.simple-carousel');

  if (!carousel) {
    return;
  }

  const myCarousel = new SimpleCarousel(carousel);
};