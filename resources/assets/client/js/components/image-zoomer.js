/**
 * ImageZoomer helper class.
 */
class ImageZoomer {
  /**
   * @type {String}
   */
  set image(url) {
    this.host.classList.add('active');
    this.host.style.backgroundImage = `url(${url})`;
    this._render();
  }

  /**
   * @return {String}
   */
  get image() {
    return this.host.style.backgroundImage;
  }

  /**
   * Creates new ImageZoomer instance.
   *
   * @param {HTMLElement} host - hoast element.
   */
  constructor(host) {
    this.host = host;

    this._onStart = this._onStart.bind(this);
    this._onMove = this._onMove.bind(this);
    this._onEnd = this._onEnd.bind(this);
    this._onResize = this._onResize.bind(this);
    this._render = this._render.bind(this);

    this.host.addEventListener('mouseenter', this._onStart);
    this.host.addEventListener('touchstart', this._onStart);
    window.addEventListener('resize', this._onResize);
    this._init();
  }

  /**
   * Sets initial state, and calls render.
   */
  _init() {
    this.gBCR = this.host.getBoundingClientRect();
    this.x = this.gBCR.width / 2;
    this.y = this.gBCR.height / 2;
    this.trackingTouch = false;
    this._render();
  }

  /**
   * Updates the DOM
   */
  _render() {
    const x = this.x / this.gBCR.width * 100;
    const y = this.y / this.gBCR.height * 100;
    this.host.style.backgroundPosition = `${x}% ${y}%`;

    if (!this.trackingTouch) {
      return;
    }

    requestAnimationFrame(this._render);
  }

  /**
   * Touchstart/mouseenter event handler.
   *
   * @param {Event} evt
   */
  _onStart(evt) {
    this.x = evt.pageX || evt.touches[0].pageX;
    this.y = evt.pageY || evt.touches[0].pageY;
    this.trackingTouch = true;

    evt.preventDefault();
    this._addEventListeners();
    requestAnimationFrame(this._render);
  }

  /**
   * Mousemove/touchemove event handler.
   *
   * @param {Event} evt
   */
  _onMove(evt) {
    if (!this.trackingTouch) {
      return;
    }

    this.x = evt.pageX || evt.touches[0].pageX;
    this.y = evt.pageY || evt.touches[0].pageY;
  }

  /**
   * Mouseleave/touchend/touchecancel event handler.
   *
   * @param {Event} evt
   */
  _onEnd(evt) {
    this.trackingTouch = false;
    this._removeEventListeners();
  }

  /**
   * Resize handler.
   * Waits for resize to end, and then re-initializes
   * the component.
   */
  _onResize() {
    clearTimeout(this._resizeTimer);
    this._resizeTimer = setTimeout(() => {
      this._init();
    }, 250);
  }

  /**
   * Convinience method for adding event handlers.
   * Fires on mouseenter/touchstart.
   */
  _addEventListeners() {
    this.host.addEventListener('mousemove', this._onMove);
    this.host.addEventListener('mouseleave', this._onEnd);
    this.host.addEventListener('touchmove', this._onMove);
    this.host.addEventListener('touchend', this._onEnd);
    this.host.addEventListener('touchcancel', this._onEnd);
  }

  /**
   * Convinience method for removing event handlers.
   * Fires on mouseleave/touchend.
   */
  _removeEventListeners() {
    this.host.removeEventListener('mousemove', this._onMove);
    this.host.removeEventListener('mouseleave', this._onEnd);
    this.host.removeEventListener('touchmove', this._onMove);
    this.host.removeEventListener('touchend', this._onEnd);
    this.host.removeEventListener('touchcancel', this._onEnd);
  }
}

export default ImageZoomer;
