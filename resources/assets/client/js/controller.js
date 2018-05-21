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
      ['add', (id) => `/${id}/add`],
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
      // Update view & show success message
      console.log(res);
    })
    .catch((err) => {
      // Show error massage.
      console.log('something bad happend', err)
    })
    // this.store.add(product, function(len) {
    //   console.log(len);
    // });
  }

  /**
   * Removes item from the store.
   *
   * @param {String} id - The id of product to remove from the store.
   */
  removeItem(id) {
    this.store.remove(id, function(product) {
      // Update the view with new info.
      console.log(product);
    });
  }
}

export default Controller;
