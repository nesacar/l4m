class ImageZoomer {
  static init () {
    const zoomer = document.querySelector('.zoomer');

    if (!zoomer) {
      return;
    }
    new ImageZoomer();
  }

  constructor () {
    this.target = document.querySelector('.zoomer-target');
    this.canvas = document.querySelector('.zoomer');
    this.ctx = this.canvas.getContext('2d');

    this._onStart = this._onStart.bind(this);
    this._onMove = this._onMove.bind(this);
    this._onEnd = this._onEnd.bind(this);
    this._update = this._update.bind(this);

    this.target.addEventListener('load', () => {
      this.targetBCR = this.target.getBoundingClientRect();
      this.initCanvas();
    });

    this.x = 0;
    this.y = 0;
    this.trackingTouch = false;

    this.target.addEventListener('mousedown', this._onStart);
  }

  initCanvas () {
    const { width, height } = this.targetBCR;
    const dPR = window.devicePixelRatio || 1;

    this.canvas.width = width * dPR;
    this.canvas.height = height * dPR;

    this.canvas.style.width = `${width}px`;
    this.canvas.style.height = `${height}px`;

    this.ctx.scale(dPR, dPR);
  }

  _onStart (evt) {
    if (evt.target !== this.target) {
      return;
    }
    
    this.x = evt.pageX || evt.touches[0].pageX;
    this.y = evt.pageY || evt.touches[0].pageY;
    this.trackingTouch = true;

    evt.preventDefault();
    this._addEventListeners();

    this.canvas.style.opacity = 1;
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
    this.canvas.style.opacity = 0;
    this._removeEventListeners();
  }

  _update () {
    const targetX = (this.x - this.targetBCR.left) / this.targetBCR.width;
    const targetY = (this.y - this.targetBCR.top) / this.targetBCR.height;
    const imageScale = 2;
    const scaledTargetWidth = this.targetBCR.width * imageScale;
    const scaledTargetHeight = this.targetBCR.height * imageScale;

    this.ctx.drawImage(this.target,
      (-targetX * scaledTargetWidth) / 2, (-targetY * scaledTargetHeight) / 2,
      scaledTargetWidth, scaledTargetHeight);

    if (!this.trackingTouch) {
      return;
    }

    requestAnimationFrame(this._update)
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
