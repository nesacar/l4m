/**
 * ImageZoomer helper class.
 */
class ImageZoomer {
  /**
   * @type {String}
   */
  set image(url) {
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

    this.gBCR = this.host.getBoundingClientRect();
    this.x = this.gBCR.width / 2;
    this.y = this.gBCR.height / 2;
    this.trackingTouch = false;

    this._onStart = this._onStart.bind(this);
    this._onMove = this._onMove.bind(this);
    this._onEnd = this._onEnd.bind(this);
    this._render = this._render.bind(this);

    this.host.addEventListener('mouseenter', this._onStart);
    this._render();
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
   * Convinience method for adding event handlers.
   * Fires on mouseenter/touchstart.
   */
  _addEventListeners() {
    document.addEventListener('mousemove', this._onMove);
    document.addEventListener('mouseleave', this._onEnd);
  }

  /**
   * Convinience method for removing event handlers.
   * Fires on mouseleave/touchend.
   */
  _removeEventListeners() {
    document.removeEventListener('mousemove', this._onMove);
    document.removeEventListener('mouseleave', this._onEnd);
  }
}

export default ImageZoomer;
