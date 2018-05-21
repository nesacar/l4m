import { product } from "./mixins/product";
import Emitter from './components/emitter';
import { extend } from "./utils";
import { Toast } from "./components/toast";
import * as types from './actions/action-types';

class View {
  constructor() {
    this.emitter = new Emitter();

    this._chip = document.querySelector('.js-basket-chip');

    // Extend product elements with product helper.
    document.querySelectorAll('.js-product')
      .forEach((item, i) => {
        const ext = product(this.emitter);
        extend(item, ext);
        item.init();
      });
  }

  /**
   * Creates binding for addItem event.
   *
   * @param {Function} handler - The callback to fire on added product.
   */
  bindAddItemToCart(handler) {
    this.emitter.on('product:add:cart', handler);
  }

  /**
   * Creates binding for the removeItem event.
   *
   * @param {Function} handler - The callback to fire on remove product.
   */
  bindRemoveItemFromCart(handler) {
    this.emitter.on('product:remove:cart', handler);
  }

  /**
   * Updates the view on state change.
   *
   * @param {Object} action - action object.
   * @property {String} action.type - action type.
   * @property {Object} action.payload - action payload.
   * @property {Number} action.payload.len - Number of items in the cart.
   * @property {String} action.payload.id - ID of the item added to cart.
   * @property {String} action.payload.message - Message to display.
   */
  update(action) {
    const {type, payload} = action;

    switch(action.type) {
      case types.ADD_ITEM:
        this._addItem(payload);
        break;
      
      case types.REMOVE_ITEM:
        this._removeItem(payload);
        break;
    }

    if (payload.len) {
      let {len} = payload;
      this._chip.innerHTML = len > 0 ? len : '';
    }
    if (payload.message) {
      Toast.create(payload.message);
    }
  }

  /**
   * Updates the item that is added to the cart.
   *
   * @param {Object} data - Action payload.
   * @property {String|Number} data.id - item id
   */
  _addItem(data) {
    const el = document.querySelector(`[data-id="${data.id}"]`);
    if (!el) {
      return;
    }
    el.classList.add('is-in-cart');
  }

  /**
   * Updates the item that is removed from the cart.
   *
   * @param {Object} data - Action payload.
   * @property {Number|String} data.id - item id
   */
  _removeItem(data) {
    const el = document.querySelector(`[data-id="${data.id}"]`);
    if (!el) {
      return;
    }
    if (el.classList.contains('is-in-cart')) {
      el.classList.remove('is-in-cart');
    }
  }

  /**
   * Mark in cart products.
   *
   * @param {Array} data - IDs of in cart items.
   */
  setView(data) {
    data.forEach((id) => {
      const el = document.querySelector(`[data-id="${id}"]`);
      // Element not on this page.
      if (!el) {
        return;
      }

      el.classList.add('is-in-cart');
    });
  }
}

export default View;
