import axios from 'axios';

class Store {
  /**
   * @type {string}
   */
  static get token() {
    return document.head.querySelector('meta[name="csrf-token"]');
  }

  /**
   * @type {number[]}
   */
  get products() {
    return this._products;
  }

  /**
   * Creates new Store instance.
   *
   * @param {string} name name of the store, e.g. 'shop', 'wishlist', etc.
   * NOTE: <name> should match the api resource name.
   */
  constructor(name) {
    this._name = name;
    this._routes = new Map([
      ['all', `/${name}`],
      ['add', (id) => `/${name}/${id}/add`],
      ['remove', (id) => `/${name}/${id}/remove`],
    ]);
    this._products = [];
  }

  /**
   * Fetches all the products, and re-sets the state of the instance.
   *
   * @return {Promise}
   * @public
   */
  getAll() {
    return axios.post(this._routes.get('all'), {
      _token: Store.token,
    })
    .then((res) => {
      const {data} = res;
      this._products = data;
      return data;
    });
  }

  /**
   * Adds the product to collection.
   *
   * @param {Object} data
   * @property {number|string} data.id
   * @property {number|string} data.size
   * @returns {Promise}
   * @public
   */
  add(data) {
    return axios.post(this._routes.get('add')(data.id), {
      data,
      _token: Store.then,
    })
    .then(() => {
      data.id = parseInt(data.id);

      const index = this.products.findIndex((item) => {
        return item.id === data.id;
      });

      if (index < 0) {
        return this._products.push(data);
      }

      return true;
    });
  }

  /**
   * Removes the item from the collection.
   *
   * @param {(string|number)} id Product id.
   */
  remove(id) {
    return axios.post(this._routes.get('remove')(id), {
      id,
      _token: Store.token,
    })
    .then(() => {
      // index of the item in store.
      const index = this.products.findIndex((item) => {
        return item.id === parseInt(id);
      });

      if (index < 0) {
        throw new Error(`Could not fined the product with the ID: ${id}`);
      }
      // Removed products.
      return this._products.splice(index, 1)[0];
    });
  }
}

export default Store;
