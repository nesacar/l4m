export function toggles(element, base) {
  const CLASS = `${base}--open`;

  element.open = function _open() {
    this.classList.add(CLASS);
  };

  element.close = function _close() {
    this.classList.remove(CLASS);
  };

  element.toggle = function _toggle() {
    this.classList.toggle(CLASS);
  };
}
