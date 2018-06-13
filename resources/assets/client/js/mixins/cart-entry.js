/**
 * @typedef {Object} CartEntry
 * @property {function} init - Initialises the helper.
 */

/**
 * Creates a cart item helper extension.
 *
 * @param {Object} emitter - Message bus.
 * @return {CartEntry}
 */
const cartEntry = (emitter) => {
  let _id;
  // for updating the count of items in cart.
  let _count = 0;
  let counter = null;
  let removeBtn = null;

  function init() {
    _id = this.dataset.id;
    counter = this.querySelector('.js-counter');
    removeBtn = this.querySelector('.js-remove-entry');
    _count = parseInt(counter.querySelector('input[type="text"]').value);
    removeBtn.addEventListener('click', _dispatchEvent);
  }

  /**
   * Dispatches synthetik event to remove the entry.
   *
   * @param {Event} evt - click event.
   */
  function _dispatchEvent(evt) {
    evt.preventDefault();
    emitter.emit(`product:remove:cart`, _id);
  }

  return {
    init,
  };
}

export {
  cartEntry,
};
