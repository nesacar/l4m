import {hasValue} from '../utils';
import {Toast} from './toast';

/**
 * Product helper class.
 */
class Product {
  /**
   * @type {string}
   */
  static get CART_CLASS() {
    return 'is-in-cart';
  }

  /**
   * @type {string}
   */
  static get WISHLIST_CLAS() {
    return 'is-in-wishlist';
  }

  /**
   * @type {string|number}
   */
  get id() {
    return parseInt(this._root.dataset.id);
  }

  /**
   * @type {Boolean}
   */
  get inCart() {
    return this._root.classList.contains(Product.CART_CLASS);
  }

  set inCart(val) {
    if (val) {
      this._root.classList.add(Product.CART_CLASS);
    } else {
      this._root.classList.remove(Product.CART_CLASS);
    }
  }

  /**
   * @type {boolean}
   */
  get hasSizes() {
    return this._root.querySelector('.js-sizes') !== null;
  }

  get size() {
    return [this._root.querySelector('.js-size-picker:checked')]
      .filter(hasValue)
      .map((e) => e.value)[0] || null;
  }

  /**
   * @type {Boolean}
   */
  get inWishlist() {
    return this._root.classList.contains(Product.WISHLIST_CLAS);
  }

  set inWishlist(val) {
    if (val) {
      this._root.classList.add(Product.WISHLIST_CLAS);
    } else {
      this._root.classList.remove(Product.WISHLIST_CLAS);
    }
  }
  
  /**
   * Creates new instance of the Product.
   *
   * @param {HTMLElement} root root element.
   */
  constructor(root) {
    this._root = root;
    // grab all buttons, and bind events to them.
    Array.from(root.querySelectorAll('button[data-event]'), (btn) => {
      btn.addEventListener('click', this._clickHandler.bind(this));
    });
  }

  /**
   * Handles `add` button clicks.
   *
   * @param {Event} evt
   */
  _clickHandler(evt) {
    evt.preventDefault();
    const type = evt.target.dataset.event;
    switch (type) {
      case 'add:cart':
        this.addToCart();
        break;
      
      case 'add:wishlist':
        this.addToWishlist();
        break;
      
      default:
        this._dispatch(`product:${type}`);
    }
  }

  /**
   * Dispatches product:add:cart custom event.
   * @public
   */
  addToCart() {
    if (this.hasSizes && !this.size) {
      Toast.create('Morate izabrati veličinu');
      return;
    }

    this._dispatch('product:add:cart');
  }

  /**
   * Dispatches product:remove:cart custom event.
   * @public
   */
  removeFromCart() {
    this._dispatch('product:remove:cart');
  }

  /**
   * Dispatches product:add:wishlist custom event.
   * @public
   */
  addToWishlist() {
    if (this.inWishlist) {
      this.removeFromWishlist();
      return;
    }
    this._dispatch('product:add:wishlist');
  }

  /**
   * Dispatches product:remove:wishlist custom event.
   * @public
   */
  removeFromWishlist() {
    this._dispatch('product:remove:wishlist');
  }

  /**
   * Dispatches custom event with the given type from the componetns root element.
   *
   * @param {string} type event type.
   * NOTE: naming convention for custom events, <target>:<action>:<destination>
   * e.g. product:add:wishlist
   * @private
   */
  _dispatch(type) {
    const event = new CustomEvent(type, {
      bubbles: true,
      detail: this,
    });
    this._root.dispatchEvent(event);
  }
}

export default Product;
