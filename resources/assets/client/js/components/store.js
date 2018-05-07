class Store {
  /**
   * @type {Array}
   */
  get products() {
    return this._products;
  }
  /**
   * Creates new store.
   * @param {Array} products - Array of products.
   * @param {Object} emitter - Event emitter.
   */
  constructor(products, emitter) {
    this._products = products || [];
    this._emitter = emitter;

    this._emitter.on('product:add:cart', this.addProduct.bind(this));
  }

  /**
   * 
   * @param {Object} product - Product object.
   * @param {String} product.id - Products id.
   * @param {Number} product.count - Amount of products.
   */
  addProduct(product) {
    this._products.push(product);
  }
}

export default Store;
