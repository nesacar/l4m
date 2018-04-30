import LazyImages from './components/lazy-images';
import * as Masthead from './components/masthead';
import Siema from './components/siema';
import Toolbar from './components/toolbar';

import DoubleSlider from './components/double-slider';
import Counter from './components/counter';

window.Counter = Counter;

export function init () {
  LazyImages.init();
  Masthead.init();
  Toolbar.init();

  // Testing Counter
  const ct = document.getElementById('counter-test');
  if (ct) {
    window.counter = new Counter(ct);
  }

  // Testing Siema
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