import LazyImages from './components/lazy-images';
import * as Masthead from './components/masthead';
import Siema from './components/siema';
import Toolbar from './components/toolbar';
import { Toast } from './components/toast';

export function init () {
  window.Toast = Toast;
  LazyImages.init();
  Masthead.init();
  Toolbar.init();

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