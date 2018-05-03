class SearchWidget {
  static get ACTIVE_CLASS () {
    return 'search-open';
  }

  static init () {
    new SearchWidget();
  }

  constructor () {
    this._formEl = document.getElementById('search-form');
    this._inputEl = this._formEl.querySelector('input[type="text"]');
    this._closehBtnEl = this._formEl.querySelector('.search-widget_close-btn');

    this._onSubmit = this._onSubmit.bind(this);
    this.hide = this.hide.bind(this);

    this._addEventListeners();
  }

  _addEventListeners () {
    this._formEl.addEventListener('submit', this._onSubmit);
    this._closehBtnEl.addEventListener('click', this.hide);
  }

  _onSubmit (evt) {
    if (this._inputEl.value === '') {
      evt.preventDefault();
      this.show();
    }
  }

  show () {
    document.body.classList.add(SearchWidget.ACTIVE_CLASS);
    this._inputEl.focus();
  }

  hide () {
    document.body.classList.remove(SearchWidget.ACTIVE_CLASS);
  }
}

export default SearchWidget;
