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
    const el = document.getElementById('main-nav');
    this._offsetTop = el.offsetTop;
    this._ticking = false;

    this._onScroll = this._onScroll.bind(this);
    this._update = this._update.bind(this);

    window.addEventListener('scroll', this._onScroll);
    this._update();
  }

  _disconnect () {
    window.removeEventListener('scroll', this._onScroll);
  }

  _update () {
    this._ticking = false;

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
};

export default Toolbar;