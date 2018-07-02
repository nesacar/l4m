/**
 * CartIcon helper class. Provides minimal interface,
 * for easier manipulation.
 */
class CartIcon {
  /**
   * @type {number}
   */
  set value(n) {
    let html = (n > 0) ? n : '';
    Array.from(this._els, (el) => {
      el.innerHTML = html;
      return el;
    });
  }

  /**
   * Creates new CartItem helper instance.
   */
  constructor() {
    this._els = document.querySelectorAll('.js-basket-chip');
  }
}

export default new CartIcon();