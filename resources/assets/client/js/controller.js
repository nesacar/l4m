import axios from 'axios';
import * as types from './actions/action-types';

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

    this.view.bindAddItemToCart(this.addItem.bind(this));
    this.view.bindRemoveItemFromCart(this.removeItem.bind(this));
  }

  /**
   * Adds new product to store.
   *
   * @param {Object} product - Product to add to store.
   * @property {String} product.id - Product id.
   * @property {Number} product.count - Amount of items.
   */
  addItem(id) {
    this.store.add(id)
      .then((len) => {
        this.view.update({
          type: types.ADD_ITEM,
          payload: {
            id,
            len,
            message: `Proizvod dodat u korpu. ID: ${id}`,
          },
        });
      })
      .catch((err) => {
        // Show error massage.
        this.view.update({
          payload: {
            message: 'Something bad happend',
          },
        });
        console.error(err);
      });
  }

  /**
   * Removes item from the store.
   *
   * @param {String} id - The id of product to remove from the store.
   */
  removeItem(id) {
    this.store.remove(id)
      .then((id) => {
        this.view.update({
          type: types.REMOVE_ITEM,
          payload: {
            id,
            len: this.store.products.length,
            message: `Proizvod izbačen iz korpe. ID: ${id}`,
          },
        });
      })
      .catch((err) => {
        // Show error massage.
        this.view.update({
          payload: {
            message: 'Something bad happend',
          },
        });
        console.error(err);
      });
  }

  setView(data) {
    this.view.setView(data);
  }
}

export default Controller;
