import * as Utils from '../utils';

class DoubleSlider {
  constructor (root) {
    this.el = root;

    this._animate = this._animate.bind(this);
    this._checkRange = this._checkRange.bind(this);
    this._onEnd = this._onEnd.bind(this);
    this._onMove = this._onMove.bind(this);
    this._onResize = this._onResize.bind(this);
    this._onStart = this._onStart.bind(this);
    this._addEventListeners = this._addEventListeners.bind(this);
    this._removeEventListeners = this._removeEventListeners.bind(this);

    // Order matters
    this._cacheDOM();
    this._setInitialState();
    this._bindEvents();
  }
  
  _cacheDOM () {
    const parrent = this.el.parentElement;

    this.track = this.el.querySelector('.js-double-slider_track');
    this.controls = {
      min: this.el.querySelector('[data-controls="min"]'),
      max: this.el.querySelector('[data-controls="max"]'),
    };
    this.outputs = {
      min: parrent.querySelector('[data-outputs="min"]'),
      max: parrent.querySelector('[data-outputs="max"]'),
    };
  }

  _setInitialState () {
    this._state = {};
    this._gBCR = this.el.getBoundingClientRect();
    const { min, max, range } = this.el.dataset;

    this._state.range = parseInt(range);

    this.setState({
      min: this.normalize(parseInt(min)),
      max: this.normalize(parseInt(max)),
    });
  }
  
  _bindEvents () {
    window.addEventListener('resize', this._onResize);
    this.el.addEventListener('touchstart', this._onStart);
    this.el.addEventListener('mousedown', this._onStart);
  }

  _addEventListeners () {
    document.addEventListener('touchmove', this._onMove);
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

  // Event handlers
  _onStart (evt) {
    if (this._eventTarget) {
      return;
    }

    if (!evt.target.classList.contains('js-knob')) {
      return;
    }

    this._addEventListeners();

    this._knob = evt.target.getAttribute('data-controls');
    this._eventTarget = this.controls[this._knob];
    // this._gBCR = this.el.getBoundingClientRect();

    const pageX = evt.pageX || evt.touches[0].pageX;
    this._left = this._eventTarget.offsetLeft;
    this._currentX = pageX - this._gBCR.left;

    this._rAF = requestAnimationFrame(this._animate);

    this._eventTarget.classList.add('double-slider_control--active');

    evt.preventDefault();
  }

  _onMove (evt) {
    if (!this._eventTarget) {
      return;
    }

    const pageX = evt.pageX || evt.touches[0].pageX;
    this._currentX = pageX - this._gBCR.left;
  }

  _onEnd (evt) {
    if (!this._eventTarget) {
      return;
    }

    this._eventTarget.classList.remove('double-slider_control--active');
    this._eventTarget = null;

    cancelAnimationFrame(this._rAF);
    
    this.dispatchEvent();
    this._removeEventListeners();
  }

  _onResize () {
    clearTimeout(this._resizeTimer);
    this._resizeTimer = setTimeout(_ => {
      this._gBCR = this.el.getBoundingClientRect();
      this._render();
    }, 250);
  }

  _animate () {
    this._rAF = requestAnimationFrame(this._animate);

    if (!this._eventTarget) {
      return;
    }

    this.setState({
      [this._knob]: this._currentX / this._gBCR.width
    });
  }

  _render () {
    const { width } = this._gBCR;
    const { max, min, range } = this._state;

    this.controls.max.style.transform =
      `translateX(${max * width}px) translate(-50%, -50%)`;
    this.controls.min.style.transform =
      `translateX(${min * width}px) translate(-50%, -50%)`;
    this.track.style.transform =
      `translateX(${min * width}px) scaleX(${max - min})`;

    this.outputs.min.value = this.denormalize(min);
    this.outputs.max.value = this.denormalize(max);
  }

  _checkRange (value, key) {
    const range = {
      min: {
        MINIMUM: 0,
        MAXIMUM: this._state.max,
      },
      max: {
        MINIMUM: this._state.min,
        MAXIMUM: 1,
      },
    };

    if (key.toLowerCase() === 'range') {
      return value;
    }

    if (value < range[key].MINIMUM) {
      return Math.max(value, range[key].MINIMUM);
    }
    else if (value > range[key].MAXIMUM) {
      return Math.min(value, range[key].MAXIMUM);
    }
    return value;
  }

  setState (obj) {
    let nextState = Utils.mapOverObject(obj, this._checkRange);
    this._state = Object.assign({}, this._state, nextState);
    this._render();
  }

  normalize (value) {
    return (value / this._state.range);
  }

  denormalize (value) {
    return Math.round(this._state.range * value);
  }

  dispatchEvent () {
    let event = new Event("change", {
      "bubbles":true,
      "cancelable":false,
    });
    this.el.dispatchEvent(event);
  }
}

export default DoubleSlider;
