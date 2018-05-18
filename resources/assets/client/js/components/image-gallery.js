class ImageGallery {
  /**
   * @type {String}
   */
  static get ACTIVE_CLASS() {
    return 'active';
  }

  /**
   * @type {Object}
   */
  static get CALLBACKS() {
    return {
      onChange: function() {},
    };
  }

  /**
   * Creates new ImageGallery instance.
   *
   * @param {Object} callbacks - Callbacks object.
   * @prop {Function} callbacks.onChange - Gets called on state change.
   */
  constructor(callbacks) {
    this.state = {
      activeIndex: 0,
    };

    this.callbacks = Object.assign(ImageGallery.CALLBACKS, callbacks);

    this.target = document.querySelector('.image-gallery_target');
    this.images = document.querySelectorAll('.image-gallery_thumbnails img');

    this.images.forEach((img, i) => {
      img.addEventListener('click', this._onClick(i));
    });
  }

  /**
   * Sets image at given index as active.
   * 
   * @param {Number} index - Index of image to render.
   */
  goTo(index) {
    const size = this.images.length;

    if (index >= size) {
      index = 0;
    } else if (index < 0) {
      index = size - 1;
    }

    this.setState({
      activeIndex: index,
    });
  }

  /**
   * Sets next image as active.
   */
  nextImage() {
    this.goTo(this.state.activeIndex + 1);
  }

  /**
   * Sets prev image as acitve.
   */
  prevImage() {
    this.goTo(this.state.activeIndex - 1);
  }

  /**
   * Image click handler.
   *
   * @param {Number} index - Index of the element.
   */
  _onClick(index) {
    return (evt) => {
      this.setState({
        activeIndex: index,
      });
    };
  }

  /**
   * Swaps the target image with the selected image.
   *
   * @private
   */
  _applyImage() {
    const index = this.state.activeIndex;
    const img = this.images[index];
    const src = img.dataset.large;
    // Apply small image first.
    this.target.src = img.src;

    const _img = new Image();
    _img.src = src;
    _img.onload = () => {
      this.target.src = src;
      this.callbacks.onChange();
    };
  }

  /**
   * Sets the styling to thumbnails to match the state.
   *
   * @private
   */
  _markActiveThumbnail() {
    const index = this.state.activeIndex;

    this.images.forEach((img, i) => {
      if (index === i) {
        img.classList.add(ImageGallery.ACTIVE_CLASS);
        return;
      }
      img.classList.remove(ImageGallery.ACTIVE_CLASS);
    });
  }

  /**
   * Fires on every state change, and updates the ui.
   */
  update() {
    this._markActiveThumbnail();
    this._applyImage();
  }

  /**
   * Updates the state of the component, and forces the
   * re-render.
   *
   * @param {any} obj - Sate change.
   */
  setState(obj) {
    this.state = Object.assign({}, this.state, obj);
    this.__render();
  }

  /**
   * @private
   */
  __render() {
    if (!this.update) {
      throw new Error('update method must be defined.');
    }
    this.update();
  }
}

export default ImageGallery;
