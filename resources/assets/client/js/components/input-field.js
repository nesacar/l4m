class InputField {
  /**
   * Grabs all input fields and wrapps them inside a InputField.
   */
  static init() {
    document.querySelectorAll('.js-input-field')
      .forEach((e) => new InputField(e));
  }

  /**
   * Creates new instance of the InputField.
   *
   * @param {HTMLElement} root root element
   */
  constructor(root) {
    this._root = root;
    this._input = this._root.querySelector('.js-input');

    // initial state.
    this.state = {
      float: this._input.value !== '',
      focus: false,
    };

    this._input.addEventListener('focus', this._onFocus.bind(this));
    this._input.addEventListener('blur', this._onBlur.bind(this));
   
    // initial render.
    this.update();
  }

  /**
   * blur event handler.
   */
  _onBlur() {
    this.setState({
      focus: false,
      float: this._input.value !== '',
    });
  }

  /**
   * focus event handler.
   */
  _onFocus() {
    this.setState({
      focus: true,
      float: true,
    });
  }

  /**
   * Updates the state with partial state and calls update.
   *
   * @param {Object} update partial state.
   */
  setState(update) {
    this.state = Object.assign({}, this.state, update);
    this.update();
  }

  /**
   * Updates the root element to represent the state.
   */
  update() {
    const state = Object.keys(this.state);
    const classname = Array.from(this._root.classList)
      .filter((cn) => !state.includes(cn)) // constant class names.
      .concat(state.filter((cn) => this.state[cn])) // attach state classes.
      .join(' '); // turn to string.

    this._root.className = classname;
  }
}

export default InputField;
