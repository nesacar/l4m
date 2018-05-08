class InvertableImage {
  /**
   * @type {String} - WebWorker url.
   */
  static get WORKER_URL() {
    return `${window.app_url}/themes/l4m/js/image-processor.js`;
  }
  /**
   * @type {Number}
   */
  static get THRESHOLD () {
    return 186;
  }

  /**
   * @type {String}
   */
  static get TOGGLE_CLASS () {
    return 'light-context';
  }

  /**
   * Kick things off.
   */
  static init() {
    const images = document.querySelectorAll('.invertable-image');

    if (images.length < 1) {
      return;
    }
    // Wrap all invertable-image elements in helper class.
    const invertableImages = Array.from(images).map((image) => {
      return new InvertableImage(image);
    });

    Promise.all(Array.from(invertableImages)
      .map((image) => {
        return image.getAverageRGB();
      }))
      .catch((err) => {
        console.error(err);
      });
  }

  /**
   * Creates new helper class.
   *
   * @param {HTMLElement} image - Image wrapper container.
   */
  constructor(image) {
    this.elem = image.parentElement;
    this.image = image.firstElementChild;

    this.worker = new Worker(InvertableImage.WORKER_URL);
    this.worker.addEventListener('message', this.applyImage);

    this.applyImage = this.applyImage.bind(this);
    this.getAverageRGB = this.getAverageRGB.bind(this);
  }

  /**
   * Calculates average red, green, and blue values.
   *
   * @param {HTMLImageElement} image - Target image.
   */
  getAverageRGB() {
    const image = this.image;
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    canvas.height = image.height;
    canvas.width = image.width;
    ctx.drawImage(image, 0, 0);
    const imageData = ctx.getImageData(0, 0, image.width, image.height);

    return new Promise((resolve, reject) => {
      const worker = new Worker(InvertableImage.WORKER_URL);
      worker.postMessage(imageData, [imageData.data.buffer]);
      worker.onerror = reject;
      worker.onmessage = this.applyImage;
      resolve();
    });
  }

  /**
   * Applies proper class to the image container.
   *
   * @param {Object} d - Data from the worker.
   */
  applyImage(d) {
    const luma = d.data;
    (luma < InvertableImage.THRESHOLD)
      ? this.elem.classList.add(InvertableImage.TOGGLE_CLASS)
      : this.elem.classList.remove(InvertableImage.TOGGLE_CLASS);
  }
}

export default InvertableImage;
