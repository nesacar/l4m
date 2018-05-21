import axios from 'axios';
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
   * @param {Function} callback - The callback to fire on instantiation.
   */
  constructor(name, callback=function() {}) {
    this._routes = new Map([
      ['all', '/korpa'],
      ['add', (id) => `/korpa/${id}/add`],
      ['remove', (id) => `/korpa/${id}/remove`],
    ]);
    
    this._token = document.head.querySelector('meta[name="csrf-token"]');

    this._storeName = name;

    axios.post(this._routes.get('all'), {
      _token: this._token,
    }).then((res) => {
      this._products = res.data;
      callback(this._products);
    });
  }

  /**
   * Adds product to the collection.
   *
   * @param {String} id - Products id.
   * @return {Promise}
   */
  add(id) {
    return axios.post(this._routes.get('add')(id), {
      id,
      _token: this._token,
    })
    .then((res) => {
      return this._products.push(parseInt(id));
    });
  }

  /**
   * Removes the item from the collection.
   *
   * @param {String} id - The product id to remove.
   * @return {Promise}
   * of product.
   */
  remove(id) {
    return axios.post(this._routes.get('remove')(id), {
      id,
      _token: this._token,
    })
    .then((res) => {
      const index = this._products.indexOf(parseInt(id));

      if (index < 0) {
        throw new Error(`Could not find the product with the ID: ${id}`);
      }
  
      // Removed product.
      return this._products.splice(index, 1)[0];
    });
  }
}

export default Store;
