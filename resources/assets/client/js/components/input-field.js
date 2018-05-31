class InputField {
  static init () {
    const fields = document.querySelectorAll('.js-input-field');
    fields.forEach(field => new InputField(field));
  }

  constructor (root) {
    this._root = root;
    this._input = this._root.querySelector('.js-input');

    this._onBlur = this._onBlur.bind(this);
    this._onFocus = this._onFocus.bind(this);

    if (this._input.value) {
      this._root.classList.add('float');
    }

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

export default InputField;