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
      this.addBtn = this.querySelector('button[data-action="add"]');
      this.starBtn = this.querySelector('button[data-action="star"]');
      this.addBtn.addEventListener('click', this.addToCart.bind(this));
      this.starBtn.addEventListener('click', this.addToWishlist.bind(this));
    },

    /**
     * Add item to cart.
     * @param {Event} evt - event object.
     */
    addToCart(evt) {
      evt.preventDefault();

      if (this.isInCart) {
        // Remove from cart?
        return;
      }

      this.isInCart = true;
      this.classList.add(IN_CART_CLASS);
      emitter.emit('product:add:cart', {
        id: this.id,
        count: 1,
      });
    },

    /**
     * Add item to wishlist.
     * @param {Event} evt - event object.
     */
    addToWishlist(evt) {
      evt.preventDefault();

      this.isInwishlist = true;
      this.classList.add(IN_WISHLIST_CLASS);
      emitter.emit('product:add:wishlist', {
        id: this.id,
      });
    }
  };
};

export {
  product,
};
