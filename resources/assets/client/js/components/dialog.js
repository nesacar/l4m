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
   * Creates new Dialog instance.
   *
   * @param {HTMLElement} host - Host element.
   */
  constructor(host) {
    this.host = host;
    this.host.querySelector('.js-dialog-close-btn')
      .addEventListener('click', this.close.bind(this));
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
}

export default Dialog;
