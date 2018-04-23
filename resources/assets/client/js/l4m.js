import LazyImages from './components/lazy-images';
import * as Masthead from './components/masthead';
import Siema from './components/siema';
import Toolbar from './components/toolbar';

export function init () {
  LazyImages.init();
  Masthead.init();
  Toolbar.init();

  const el = document.querySelector('.showcase_carousel');
  if (!el) {
    return;
  }
  const slider = new Siema({
    selector: el,
    perPage: {
      0: 2,
      696: 3,
      1028: 4
    }
  });
};