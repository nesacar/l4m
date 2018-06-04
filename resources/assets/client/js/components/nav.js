/**
 * NavItem class definition.
 */
class NavItem {
  /**
   * Kicks things off.
   * Collects all of the nav-item elements that have sub-menu
   * and extends them with NavItem helper class.
   */
  static init() {
    const items = document.querySelectorAll('.js-nav-item');
    Array.from(items)
      .map((item) => new NavItem(item));
  }

  /**
   * @type {String}
   */
  static get ACTIVE_CLASS() {
    return 'active';
  }

  /**
   * @type {Boolean}
   */
  get visible() {
    return this.host.hasAttribute('data-visible');
  }

  /**
   * Sets the value of the visible attribute
   * 
   * @param {Boolean} value
   */
  set visible(value) {
    if (value) {
      this.host.setAttribute('data-visible', '');
    } else {
      this.host.removeAttribute('data-visible');
    }
  }

  /**
   * Creates a new NavItem helper instance.
   *
   * @param {HTMLElement} host - dom element.
   */
  constructor(host) {
    this.host = host;
    this.host.addEventListener('click', this._onClick.bind(this));
  }

  /**
   * NavItem click handler.
   *
   * @param {Event} evt
   */
  _onClick(evt) {
    this.update();
  }

  /**
   * Updates the host element based on the current state.
   */
  update() {
    this.visible = !this.visible;
  }
}

export default NavItem;
