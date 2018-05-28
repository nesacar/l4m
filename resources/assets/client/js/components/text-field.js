class TextField {
  static init () {
    const fields = document.querySelectorAll('.text-field');
    fields.forEach(field => new TextField(field));
  }

  constructor (root) {
    this._root = root;
    this._input = this._root.querySelector('.text-field_input');

    this._onBlur = this._onBlur.bind(this);
    this._onFocus = this._onFocus.bind(this);

    this._addEventListeners();
  }

  _addEventListeners () {
    this._input.addEventListener('focus', this._onFocus);
    this._input.addEventListener('blur', this._onBlur);
  }

  _onBlur (evt) {
    this._root.classList.remove('focus');

    if (this._input.value === '') {
      this._root.classList.remove('float');
    }
  }

  _onFocus (evt) {
    this._root.classList.add('focus', 'float');
  }
}

export default TextField;