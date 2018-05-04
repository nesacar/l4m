import LazyImages from './components/lazy-images';
import * as Masthead from './components/masthead';
import SearchWidget from './components/search-widget';
import Siema from './components/siema';
import Toolbar from './components/toolbar';
import { Toast } from './components/toast';

export function init () {
  window.Toast = Toast;
  LazyImages.init();
  Masthead.init();
  SearchWidget.init();
  Toolbar.init();

  document.querySelectorAll('.shop-item')
    .forEach((item, i) => {
      item.addEventListener('click', _clickHandler, true);
    });

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

function _clickHandler(evt) {
  const path = evt.composedPath();

  const $target = path.find((t) => {
    return t.tagName === 'BUTTON';
  });

  if (!$target) {
    return;
  }
  
  const action = $target.dataset.action;
  switch (action) {
    case 'add':
      $target.classList.toggle('active');
      Toast.create('Product added to cart!');
      break;
    case 'star':
      Toast.create('Product added to whishlist!');
      break;
    default:
      console.error(`Unknown action: ${action}, on target: ${$target}`);
      break;
  }

  evt.preventDefault();
}