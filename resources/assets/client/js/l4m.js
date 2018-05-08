import LazyImages from './components/lazy-images';
import * as Masthead from './components/masthead';
import Emitter from './components/emitter';
import SearchWidget from './components/search-widget';
import Siema from './components/siema';
import Toolbar from './components/toolbar';
import { Toast } from './components/toast';
import Store from './store';
import View from './view';
import Controller from './controller';

import { product } from './components/product';
import { extend } from './utils';

export function init () {
  window.Toast = Toast;
  LazyImages.init();
  Masthead.init();
  SearchWidget.init();
  Toolbar.init();

  // Message bus.
  const emitter = new Emitter();
  window.store = new Store('cart', []);
  window.view = new View(emitter);
  window.controller = new Controller(store, view);

  // Toast bindings.
  emitter.on('product:add:cart', (product) => {
    Toast.create(`Product added to cart. ID: ${product.id}`);
  });
  emitter.on('product:add:wishlist', (product) => {
    Toast.create(`Product added to wishlist. ID: ${product.id}`);
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
