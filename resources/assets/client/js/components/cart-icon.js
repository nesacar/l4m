/**
 * CartIcon helper class. Provides minimal interface,
 * for easier manipulation.
 */
class CartIcon {
  /**
   * @type {number}
   */
  set value(n) {
    this._root.innerHTML = (n > 0) ? n : '';
  }

  /**
   * Creates new CartItem helper instance.
   */
  constructor() {
    this._root = document.querySelector('.js-basket-chip');
  }
}

export default new CartIcon();