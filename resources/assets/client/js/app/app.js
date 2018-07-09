import {cart} from './store';
import {wishlist} from './wishlist';
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
  window.addEventListener('product:add:cart', addToCart);
  window.addEventListener('product:remove:cart', removeFromCart);
  window.addEventListener('product:add:wishlist', addToWishlist);
  window.addEventListener('product:remove:wishlist', removeFromWishlist);
}

/**
 * Adds the item to the cart, and updates the view.
 *
 * @param {CustomEvent} evt `product:add:cart`
 */
function addToCart(evt) {
  const product = evt.detail;
  const {id, size} = product;

  cart.add({id, size})
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
function removeFromCart(evt) {
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
 * Adds product to wishlist.
 *
 * @param {CustomEvent} evt `product:add:wishlist`
 */
function addToWishlist(evt) {
  const product = evt.detail;
  const {id} = product;

  wishlist.add({id})
    .then(() => {
      product.inWishlist = true;
      Toast.create(`Proizvod dodat u listu želja`);
    })
    .catch(errorHandler);
}

/**
 * Removes the product from the wishlist.
 *
 * @param {CustomEvent} evt `product:remove:wishlist`
 */
function removeFromWishlist(evt) {
  const product = evt.detail;

  wishlist.remove(product.id)
    .then(() => {
      product.inCart = false;
      Toast.create('Proizvod izbačen iz liste želja');
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
