import axios from 'axios';

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

    this._routes = new Map([
      ['add', (id) => `/korpa/${id}/add`],
      ['remove', (id) => `/korpa/${id}/remove`],
    ]);

    this._token = document.head.querySelector('meta[name="csrf-token"]');

    this.view.bindAddItemToCart(this.addItem.bind(this));
  }

  /**
   * Adds new product to store.
   *
   * @param {Object} product - Product to add to store.
   * @property {String} product.id - Product id.
   * @property {Number} product.count - Amount of items.
   */
  addItem(product) {
    axios.post(this._routes.get('add')(product.id), {
      id: product.id,
      _token: this._token,
    })
    .then((res) => {
      if (res.status !== 200 || res.statusText.toLowerCase() !== 'ok') {
        throw new Error(res.statusText);
      }
      
      // Update view & show success message
      this.store.add(product, (len) => {
        this.view.update({
          len,
          id: product.id,
          message: `Proizvod dodat u korpu. ID: ${product.id}`,
        });
      });
    })
    .catch((err) => {
      // Show error massage.
      console.log('something bad happend')
      console.error(err)
    });
  }

  /**
   * Removes item from the store.
   *
   * @param {String} id - The id of product to remove from the store.
   */
  removeItem(id) {
    axios.post(this._routes.get('remove')(id), {
      id,
      _token: this._token,
    })
    .then((res) => {
      this.store.remove(id, (product) => {
        this.view.update({
          len: this.store.products.length,
          id: product.id,
          message: `Proizvod izbačen iz korpe. ID: ${product.id}`,
        });
      });
    })
    .catch((err) => {
      console.log('something bad happend');
      console.error(err);
    });
  }
}

export default Controller;
