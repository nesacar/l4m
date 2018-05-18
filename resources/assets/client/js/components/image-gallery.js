class ImageGallery {
  /**
   * @type {String}
   */
  static get ACTIVE_CLASS() {
    return 'active';
  }

  /**
   * Sets up the image gallery.
   *
   * @param {Function} callback - Function to call on every image swap
   */
  static init(callback=function() {}) {
    new ImageGallery();
  }

  constructor() {
    this.state = {
      activeIndex: 0,
    };

    this.target = document.querySelector('.image-gallery_target');
    this.images = document.querySelectorAll('.image-gallery_thumbnails img');

    this.images.forEach((img, i) => {
      img.addEventListener('click', this._onClick(i));
    });
  }

  _onClick(index) {
    return (evt) => {
      this.setState({
        activeIndex: index,
      });
    };
  }

  update() {
    // TODO: Split in different methods.
    const index = this.state.activeIndex;

    this.images.forEach((img, i) => {
      if (index === i) {
        img.classList.add(ImageGallery.ACTIVE_CLASS);
        return;
      }
      img.classList.remove(ImageGallery.ACTIVE_CLASS);
    });

    const img = this.images[index];
    const src = img.dataset.large;

    // Apply small image first.
    this.target.src = img.src;

    const _img = new Image();
    _img.src = src;
    _img.onload = () => {
      this.target.src = src;
    };
  }

  setState(obj) {
    this.state = Object.assign({}, this.state, obj);
    this.__render();
  }

  __render() {
    if (!this.update) {
      throw new Error('update method must be defined.');
    }
    this.update();
  }
}

export default ImageGallery;
