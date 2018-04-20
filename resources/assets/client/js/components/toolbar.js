class Toolbar {
  static get HIDDEN_CLASS () {
    return 'sticky';
  }

  static init () {
    if (this._instance) {
      this._instance._disconnect();
    }

    this._instance = new Toolbar();
  }

  constructor () {
    this._el = document.getElementById('main-nav');
    this._offsetTop = this._el.offsetTop;
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
    if (!document.body.classList.contains(Toolbar.HIDDEN_CLASS)) {
      this.offsetTop = this._el.offsetTop;
    }

    const currentPosition = document.body.scrollTop || document.documentElement.scrollTop;

    if (currentPosition >= this._offsetTop) {
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
      if (!document.body.classList.contains(Toolbar.HIDDEN_CLASS)) {
        this.offsetTop = this._el.offsetTop;
      }
      this._update();
    }, 250);
  }
};

export default Toolbar;