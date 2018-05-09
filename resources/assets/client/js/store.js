import { extend } from './utils';

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
   * @param {Function} callback - The callback to fire on instantiation.
   */
  constructor(name, products, callback=function() {}) {
    this._storeName = name;
    this._products = products || [];

    callback(this._products);
  }

  /**
   * Adds product to the collection.
   *
   * @param {Object} product - Product object.
   * @param {String} product.id - Products id.
   * @param {Number} product.count - Amount of products.
   * @param {Function} callback - The callback to fire on add.
   */
  add(product, callback=function() {}) {
    // TODO: Merge add and update to save.
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
  remove(id, callback=function() {}) {
    const index = this._products.findIndex((product) => {
      return product.id === id;
    });

    if (index < 0) {
      console.error(`Could not find the product with the ID: ${id}`);
      return;
    }

    // Removed product.
    const product = this._products.splice(index, 1)[0];

    callback(product);
  }

  /**
   * Updates the product with matched id.
   *
   * @param {Object} update - Object to update product with.
   * @param {Function} callback - The callback to fire on update completion.
   */
  update(update, callback=function() {}) {
    const product = this._products.find((product) => {
      return product.id === update.id;
    });

    if (!product) {
      console.error(`Could not find the product with the ID: ${update.id}`);
      return;
    }

    // Update the product.
    extend(product, params);

    callback(product);
  }

  /**
   * WARNING: Removes all the products, and starts clean.
   * 
   * @param {Function} callback - The callback to fire on fresh start.
   */
  drop(callback=function() {}) {
    this._products = [];

    callback();
  }
}

export default Store;
