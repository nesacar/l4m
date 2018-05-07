class Toolbar {
  static get HIDDEN_CLASS () {
    return 'sticky';
  }

  static get THRESHOLD () {
    return 80;
  }

  static init () {
    if (this._instance) {
      this._instance._disconnect();
    }

    this._instance = new Toolbar();
  }

  constructor () {
    this._el = document.getElementById('main-nav');
    this._ticking = false;

    this._onScroll = this._onScroll.bind(this);
    this._onResize = this._onResize.bind(this);
    this._update = this._update.bind(this);

    window.addEventListener('scroll', this._onScroll);
    window.addEventListener('resize', this._onResize);
    this._update();
  }

  _disconnect () {
    window.removeEventListener('scroll', this._onScroll);
    window.removeEventListener('resize', this._onResize);
  }

  _update () {
    this._ticking = false;
    const currentPosition =
      document.body.scrollTop || document.documentElement.scrollTop;

    if ((currentPosition > Toolbar.THRESHOLD)) {
      document.body.classList.add(Toolbar.HIDDEN_CLASS);
    }
    else {
      document.body.classList.remove(Toolbar.HIDDEN_CLASS);
    }
  }

  _onScroll () {
    this._requestTick();
  }
  
  _requestTick () {
    if (!this._ticking) {
      window.requestAnimationFrame(this._update);
    }

    this._ticking = true;
  }

  _onResize () {
    clearTimeout(this._resizeTimer);
    this._resizeTimer = setTimeout(() => {
      this._update();
    }, 250);
  }
};

export default Toolbar;