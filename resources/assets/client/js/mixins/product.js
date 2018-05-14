import { closest } from '../utils';

/**
 * Creates a product extension.
 * @param {Object} emitter - Message bus.
 */
const product = (emitter) => {
  const IN_CART_CLASS = 'is-in-cart';
  const IN_WISHLIST_CLASS = 'is-in-whislist';

  return {
    init() {
      this.id = this.dataset.id;
      this.isInCart = this.classList.contains(IN_CART_CLASS);
      this.isInwishlist = this.classList.contains(IN_WISHLIST_CLASS);

      // Rename button class names to js-* format.
      this.addBtn = this.querySelector('button[data-event="cart"]');
      this.starBtn = this.querySelector('button[data-event="wishlist"]');
      this.addBtn.addEventListener('click', this._dispatchEvent.bind(this));
      this.starBtn.addEventListener('click', this._dispatchEvent.bind(this));
    },

    /**
     * Dispatches event.
     *
     * @param {Event} evt - Event object.
     */
    _dispatchEvent(evt) {
      evt.preventDefault();

      const btn = closest(evt.target, 'button');
      const target = btn.dataset.event;
      
      emitter.emit(`product:add:${target}`, {
        id: this.id,
        count: 1,
      });
    },
  };
};

export {
  product,
};
