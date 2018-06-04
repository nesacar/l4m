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

    this._hide = this._hide.bind(this);
    this._show = this._show.bind(this);

    this.host.addEventListener('click', this._show);
  }

  /**
   * Show the NavItem sub-menu, and attach event listener on the
   * document object.
   *
   * @param {Event} evt
   */
  _show(evt) {
    // If it is allready visibile, just return.
    if (this.visible) {
      return;
    }

    this.visible = true;
    // Quick Fix:
    // When calling evt.stopPropagation(), alot of bugs appear
    // when clicking on sibling elements. This seams to be the
    // best (at the moment) solution. It pushes the event binding
    // to the end of the callstack, after the visible attribute
    // is set. Not sure about the possible drawbacks, though :/
    setTimeout(() => {
      document.addEventListener('click', this._hide);
    }, 0);
  }

  /**
   * Hide the NavItem sub-menu, and remove event lister from the
   * document object.
   *
   * @param {Event} evt
   */
  _hide(evt) {
    const target = evt.target;
    const isInside = target.closest('.js-mega-menu');

    // If the click is inside sub-menu, do nothing
    if (isInside) {
      return;
    }
    // Else, hide it.
    this.visible = false;
    document.removeEventListener('click', this._hide);
  }
}

export default NavItem;
