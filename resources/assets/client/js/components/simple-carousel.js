class SimpleCarousel {
  static get CLEARANCE () {
    return 0.25;
  }

  get activeSlideIndex () {
    return this._activeSlideIndex;
  }

  constructor (root, callback) {
    this._root = root;
    this._cb = callback || null;

    this._update = this._update.bind(this);
    this._addEventListeners = this._addEventListeners.bind(this);
    this._removeEventListeners = this._removeEventListeners.bind(this);
    this._onTransitionEnd = this._onTransitionEnd.bind(this);
    this._onStart = this._onStart.bind(this);
    this._onMove = this._onMove.bind(this);
    this._onEnd = this._onEnd.bind(this);
    this._onResize = this._onResize.bind(this);

    this._supportsPassive = undefined;

    this.reset(true);
    this._setActiveSlide();
    this._root.addEventListener('mousedown', this._onStart);
    this._root.addEventListener('touchstart', this._onStart);
    this._root.addEventListener('transitionend', this._onTransitionEnd);
    window.addEventListener('resize', this._onResize);
  }

  _applyPassive () {
    if (this._supportsPassive !== undefined) {
      return this._supportsPassive ? { passive: true } : false;
    }
    // feature detect
    let isSupported = false;
    try {
      let opts = Object.defineProperty({}, 'passive', {
        get: function () {
          isSupported = true;
        }
      });
      window.addEventListener('testPassive', null, opts);
      window.removeEventListener('testPassive', null, opts);
    } catch (e) { }
    this._supportsPassive = isSupported;
    return this._applyPassive();
  }

  _addEventListeners () {
    document.addEventListener('touchmove', this._onMove, this._applyPassive());
    document.addEventListener('touchend', this._onEnd);
    document.addEventListener('touchcancel', this._onEnd);

    document.addEventListener('mousemove', this._onMove);
    document.addEventListener('mouseup', this._onEnd);
  }

  _removeEventListeners () {
    document.removeEventListener('touchmove', this._onMove);
    document.removeEventListener('touchend', this._onEnd);
    document.removeEventListener('touchcancel', this._onEnd);

    document.removeEventListener('mousemove', this._onMove);
    document.removeEventListener('mouseup', this._onEnd);
  }

  _onStart (evt) {
    this._isTouching = true;

    this._startX = evt.pageX || evt.touches[0].pageX;
    this._delta = 0;

    this._addEventListeners();

    window.requestAnimationFrame(this._update);

    evt.preventDefault();
  }

  _onMove (evt) {
    this._delta = (evt.pageX || evt.touches[0].pageX) - this._startX;
  }

  _onEnd (evt) {
    this._isTouching = false;

    this._removeEventListeners();
  }

  _update () {
    if (this._isTouching) {
      window.requestAnimationFrame(this._update);
    }

    let screenX = this._delta + this._currentX;
    this._root.style.transform = `translateX(${screenX}px)`;

    if (this._isTouching) {
      return;
    }

    let activeSlideIndex = this._activeSlideIndex;
    let moved = Math.floor(Math.abs(this._delta / this._childWidth));

    if (this._delta < -this._clearance) {
      this.goToSlide(activeSlideIndex + (1 + moved));
    }
    else if (this._delta > this._clearance) {
      this.goToSlide(activeSlideIndex - (1 + moved));
    }
    else {
      this.goToSlide(activeSlideIndex);
    }
  }

  _onTransitionEnd (evt) {
    this._root.style.transition = '';
    this._setActiveSlide();

    if (typeof this._cb === 'function') {
      this._cb(this._activeSlideIndex);
    }
  }

  nextSlide () {
    this.goToSlide(this._activeSlideIndex + 1);
  }

  prevSlide () {
    this.goToSlide(this._activeSlideIndex - 1);
  }

  goToSlide (index) {
    let nextSlideIndex;
    const currentSlideIndex = this._activeSlideIndex;

    if (index < 0) {
      nextSlideIndex = 0;
    }
    else if (index > this._slideCount - this._slidesPerView) {
      nextSlideIndex = this._slideCount - this._slidesPerView;
    }
    else {
      nextSlideIndex = index;
    }

    if (nextSlideIndex !== currentSlideIndex) {
      this._children[currentSlideIndex].classList.remove('active');
    }

    this._activeSlideIndex = nextSlideIndex;

    // Update current position
    this._currentX = -(nextSlideIndex * this._childWidth);
    this._root.style.transition = 'transform 225ms cubic-bezier(0.0, 0.0, 0.2, 1)';
    this._root.style.transform = `translateX(${this._currentX}px)`;
  }

  reset (hard = false) {
    // If it's hard reset
    // scroll to the first slide
    this._currentX = !hard ? this._currentX : 0;
    this._activeSlideIndex = !hard ? this._activeSlideIndex : 0;
    this._children = this._root.children;
    this._slideCount = this._children.length;
    this._width = this._root.getBoundingClientRect().width;
    this._childWidth = this._children[0].getBoundingClientRect().width;
    this._slidesPerView = Math.round(this._width / this._childWidth);
    this._clearance = this._childWidth * SimpleCarousel.CLEARANCE;
    this.goToSlide(this._activeSlideIndex);
  }

  _setActiveSlide () {
    this._children[this._activeSlideIndex].classList.add('active');
  }

  _onResize () {
    clearTimeout(this._resizeTimer);
    this._resizeTimer = setTimeout(() => {
      // Soft reset
      // we want to preserve current state
      this.reset();
    }, 250);
  }
}

export default SimpleCarousel;