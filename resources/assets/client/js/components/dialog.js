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
    this.host.querySelector('.js-dialog-close-btn')
      .addEventListener('click', this.close.bind(this));
    window.addEventListener('keydown', this._onKeyDown.bind(this));
  }

  /**
   * Shows the dialog.
   */
  showModal() {
    this.host.classList.add(Dialog.ACTIVE_CLASS);
  }

  /**
   * Hides the dialog.
   */
  close() {
    this.host.classList.remove(Dialog.ACTIVE_CLASS);
  }

  /**
   * Keydown event handler.
   * Calls this.close() on Esc press.
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
