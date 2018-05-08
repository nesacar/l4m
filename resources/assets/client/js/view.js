import { product } from "./components/product";
import { extend } from "./utils";

class View {
  constructor(emitter) {
    this.emitter = emitter;

    // Extend product elements with product helper.
    document.querySelectorAll('.shop-item')
      .forEach((item, i) => {
        const ext = product(this.emitter);
        extend(item, ext);
        item.init();
      });
  }

  /**
   * Creates bind for addItem event.
   *
   * @param {Function} handler - The callback to fire on added product.
   */
  bindAddItem(handler) {
    this.emitter.on('product:add:cart', handler);
  }
}

export default View;
