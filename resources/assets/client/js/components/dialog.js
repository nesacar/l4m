/**
 * Dialog class definition.
 */
class Dialog {
  /**
   * @return {String}
   */
  static get ACTIVE_CLASS() {
    return 'open';
  }

  /**
   * @return {Number}
   */
  static get ESC() {
    return 27;
  }
  
  /**
   * Creates new Dialog instance.
   *
   * @param {HTMLElement} host - Host element.
   */
  constructor(host) {
    this.host = host;
    // State reflects the DOM.
    this._state = {
      visible: this.host.classList.contains(Dialog.ACTIVE_CLASS),
    };

    this.host.querySelector('.js-dialog-close-btn')
      .addEventListener('click', this.close.bind(this));
    window.addEventListener('keydown', this._onKeyDown.bind(this));
  }

  /**
   * Shows the dialog.
   * @public
   */
  showModal() {
    this._setState({
      visible: true,
    });
  }

  /**
   * Hides the dialog.
   * @public
   */
  close() {
    this._setState({
      visible: false,
    });
  }

  /**
   * Updates the appearance of the component to represent the state.
   */
  _render() {
    const {visible} = this._state;

    if (visible) {
      this.host.classList.add(Dialog.ACTIVE_CLASS);
    } else {
      this.host.classList.remove(Dialog.ACTIVE_CLASS);
    }
  }

  /**
   * Updates the state and forces re-render.
   *
   * @param {Object} partialState
   */
  _setState(partialState) {
    this._state = Object.assign({}, this._state, partialState);
    this._render();
  }

  /**
   * Keydown event handler.
   * Calls this.close() on Esc press.
   *
   * @param {Event} evt
   */
  _onKeyDown(evt) {
    // Ignore if its not an Esc key.
    if (evt.keyCode !== Dialog.ESC) {
      return;
    }
    this.close();
  }
}

export default Dialog;
