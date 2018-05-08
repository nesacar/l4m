class Store {
  /**
   * @type {Array}
   */
  get products() {
    return this._products;
  }
  /**
   * Creates new store.
   *
   * @param {String} name - Store name.
   * @param {Array} products - Array of products.
   */
  constructor(name, products) {
    this._storeName = name;
    this._products = products || [];
  }

  /**
   * Adds product to the collection.
   *
   * @param {Object} product - Product object.
   * @param {String} product.id - Products id.
   * @param {Number} product.count - Amount of products.
   * @param {Function} callback - The callback to fire on add.
   */
  add(product, callback) {
    // Length of updated array.
    const length = this._products.push(product);

    callback(length);
  }

  /**
   * Removes the item from the collection.
   *
   * @param {String} id - The product id to remove.
   * @param {Function} callback - The callback to fire on removal
   * of product.
   */
  remove(id, callback) {
    const index = this._products.findIndex((product) => {
      return product.id === id;
    });

    if (index < 0) {
      return;
    }

    // Removed product.
    const product = this._products.splice(index, 1)[0];

    callback(product);
  }
}

export default Store;
