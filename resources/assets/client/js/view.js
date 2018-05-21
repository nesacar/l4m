import { product } from "./mixins/product";
import Emitter from './components/emitter';
import { extend } from "./utils";
import { Toast } from "./components/toast";

class View {
  constructor() {
    this.emitter = new Emitter();

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
   * @param {String} id - The of item to remove.
   */
  bindRemoveItemFromCart(id) {
    this.emitter.on('product:remove:cart', handler);
  }

  /**
   * Updates the view on state change.
   *
   * @param {Object} data - Data to render.
   * @property {Number} data.len - Number of items in the cart.
   * @property {String} data.id - ID of the item added to cart.
   * @property {String} data.message - Message to display.
   */
  update(data) {
    Toast.create(data.message);
  }
}

export default View;
