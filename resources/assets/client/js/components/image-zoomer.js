class ImageZoomer {
  constructor () {
    this.target = document.querySelector('.zoomer-target');
    this.canvas = document.querySelector('.zoomer');
    this.ctx = this.canvas.getContext('2d');

    this._onStart = this._onStart.bind(this);
    this._onMove = this._onMove.bind(this);
    this._onEnd = this._onEnd.bind(this);
    this._update = this._update.bind(this);

    this.target.addEventListener('load', () => {
      this.targetBCR = {};
      this.targetBCR.width = this.target.naturalWidth;
      this.targetBCR.height = this.target.naturalHeight;
      this.containerBCR = this.target.getBoundingClientRect();
      this.initCanvas();
    });

    this.x = 0;
    this.y = 0;
    this.trackingTouch = false;

    this.target.addEventListener('mousedown', this._onStart);
  }

  initCanvas () {
    const { width, height } = this.containerBCR;
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
    const imageScale = 1;

    // Image crop dimensions
    const croppedTargetWidth = this.containerBCR.width / imageScale;
    const croppedTargetHeight = this.containerBCR.height / imageScale;

    // Get the client's position (mouse x and y) in the container.
    const clientX = Math.min(
      Math.max(0, this.x - this.containerBCR.left),
      this.containerBCR.width);
    const clientY = Math.min(
      Math.max(0, this.y - this.containerBCR.top),
      this.containerBCR.height);

    // Map client position to the source image position.
    const targetX = clientX * this.targetBCR.width / this.containerBCR.width;
    const targetY = clientY * this.targetBCR.height / this.containerBCR.height;

    // Source coordinates to crop image from
    const sX = Math.min(
      Math.max(0, targetX - (croppedTargetWidth / 2)),
      this.targetBCR.width - croppedTargetWidth);
    const sY = Math.min(
      Math.max(0, targetY - (croppedTargetHeight / 2)),
      this.targetBCR.height - croppedTargetHeight);

    this.ctx.drawImage(this.target,
      sX, sY,
      croppedTargetWidth, croppedTargetHeight,
      0, 0,
      this.canvas.width, this.canvas.height,
    );

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
