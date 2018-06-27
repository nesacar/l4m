import {cart} from './store';
import Product from '../components/product';
import {Toast} from '../components/toast';
import cartIcon from '../components/cart-icon';

/**
 * Sets the stage. Wraps all product elements in Product class,
 * and updates the view. Attaches custm event handlers to the
 * window object.
 */
function init() {
  // Hidrate the store.
  cart.getAll()
    .then((products) => {
      cartIcon.value = products.length;
      // Wrap elements in Product class and update.
      Array.from(document.querySelectorAll('.js-product'))
        .map((item) => new Product(item))
    })
    .catch(errorHandler);

  // Add custom event handlers.
  window.addEventListener('product:add:cart', addItem);
  window.addEventListener('product:remove:cart', removeItem);
}

/**
 * Adds the item to the cart, and updates the view.
 *
 * @param {CustomEvent} evt `product:add:cart`
 */
function addItem(evt) {
  const product = evt.detail;

  cart.add(product.id)
    .then(() => {
      product.inCart = true;
      cartIcon.value = cart.products.length;
      Toast.create(`Proizvod dodat u korpu. ID: ${product.id}`);
    })
    .catch(errorHandler);
}

/**
 * Removes the item from the cart, and updates the view.
 *
 * @param {CustomEvent} evt `product:remove:cart`
 */
function removeItem(evt) {
  const product = evt.detail;

  cart.remove(product.id)
    .then(() => {
      product.inCart = false;
      cartIcon.value = cart.products.length;
      Toast.create(`Prouizoid izbačen iz korpe. ID: ${product.id}`);
    })
    .catch(errorHandler);
}

/**
 * Generic error handler. Shows and loggs the error message.
 *
 * @param {Error} err
 */
function errorHandler(err) {
  Toast.create('Something bad happend');
  console.error(err.message);
}

export default {
  init,
};
