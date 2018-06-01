class ImageZoomer {
  constructor () {
    this.zoomer = document.querySelector('.js-zoomer');

    this._onStart = this._onStart.bind(this);
    this._onMove = this._onMove.bind(this);
    this._onEnd = this._onEnd.bind(this);
    this._update = this._update.bind(this);

    this.zoomer.addEventListener('mousedown', this._onStart);
    this.init();
  }

  init () {
    this.x = 0;
    this.y = 0;
    this.trackingTouch = false;
    this.gBCR = this.zoomer.getBoundingClientRect();
  }

  _onStart (evt) {
    this.x = evt.pageX || evt.touches[0].pageX;
    this.y = evt.pageY || evt.touches[0].pageY;
    this.trackingTouch = true;

    evt.preventDefault();
    this._addEventListeners();
    requestAnimationFrame(this._update);
  }

  _onMove (evt) {
    if (!this.trackingTouch) {
      return;
    }

    this.x = evt.pageX || evt.touches[0].pageX;
    this.y = evt.pageY || evt.touches[0].pageY;
  }

  _onEnd (evt) {
    this.trackingTouch = false;
    this._removeEventListeners();
  }

  _update () {
    const x = this.x / this.gBCR.width * 100;
    const y = this.y / this.gBCR.height * 100;
    this.zoomer.style.backgroundPosition = `${x}% ${y}%`;
    
    if (!this.trackingTouch) {
      return;
    }

    requestAnimationFrame(this._update);
  }

  _addEventListeners () {
    document.addEventListener('mousemove', this._onMove);
    document.addEventListener('mouseup', this._onEnd);
  }

  _removeEventListeners () {
    document.removeEventListener('mousemove', this._onMove);
    document.removeEventListener('mouseup', this._onEnd);
  }
}

export default ImageZoomer;
