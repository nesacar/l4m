import { product } from "./mixins/product";
import { extend } from "./utils";

class View {
  constructor(emitter) {
    this.emitter = emitter;

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
}

export default View;
