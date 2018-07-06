import {classNames} from '../utils';

class InputField {
  /**
   * Grabs all input fields and wrapps them inside a InputField.
   */
  static init() {
    Array.from(document.querySelectorAll('.js-input-field'))
      .map((e) => new InputField(e));
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
    this._root.className = classNames(this._root, this.state);
  }
}

export default InputField;
