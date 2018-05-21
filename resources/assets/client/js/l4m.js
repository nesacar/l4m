import LazyImages from './components/lazy-images';
import * as Masthead from './components/masthead';
import Drawer from './components/drawer';
import SearchWidget from './components/search-widget';
import Accordion from './components/accordion';
import Siema from './components/siema';
import { Toast } from './components/toast';
import Store from './store';
import View from './view';
import Controller from './controller';
import InvertableImage from './components/invertable-image';
import accordion from './components/accordion';

export function init () {
  window.Toast = Toast;
  Drawer.init();
  LazyImages.init();
  Masthead.init();
  SearchWidget.init();
  Accordion.init();

  // Get initial state from the session
  window.store = new Store('cart', window.cartItems);
  window.view = new View();
  window.cartController = new Controller(store, view);

  window.addEventListener('load', function() {
    // Wait for evertything to load before applying images.
    InvertableImage.init();
  });

  const defaultOptions = {
    perPage: {
      0: 2,
      696: 3,
      1028: 4,
    },
  };

  document.querySelectorAll('.showcase_carousel')
    .forEach((carousel) => {
      return new Siema({
        selector: carousel,
        ...defaultOptions,
      });
    });
};
