class Product {
  /**
   * @type {string}
   */
  get id() {
    return this._id;
  }
  
  /**
   * Creates new instance of the Product.
   *
   * @param {string} id product id.
   */
  constructor(id) {
    this._id = id;
  }

  addToCart() {

  }

  addToWishlist() {

  }
}

export default Product;
