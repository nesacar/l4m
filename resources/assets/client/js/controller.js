class Controller {
  /**
   * Creates new controller instance.
   *
   * @param {Object} store - The store object.
   * @param {Object} view - The view object.
   */
  constructor(store, view) {
    this.store = store;
    this.view = view;

    this.view.bindAddItem(this.addItem.bind(this));
  }

  /**
   * Adds new product to store.
   *
   * @param {Object} product - Product to add to store.
   * @property {String} product.id - Product id.
   * @property {Number} product.count - Amount of items.
   */
  addItem(product) {
    this.store.add(product, function(len) {
      console.log(len);
    });
  }
}

export default Controller;
