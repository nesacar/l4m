import {toBool} from '../utils';

class Accordion {
  /**
   * Creates new Accordion instance.
   *
   * @param {HTMLElement} toggler toggler element.
   */
  constructor(toggler) {
    const id = toggler.getAttribute('aria-controls').slice(1);
    const visible = toBool(toggler.getAttribute('aria-expanded'));

    this.target = document.getElementById(id).firstElementChild;
    this.toggler = toggler;

    this.toggler.addEventListener('click', this.toggle.bind(this));

    this.state = {visible};
    this.render();
  }

  /**
   * Toggles the components state.
   * @public
   */
  toggle() {
    this.setState({
      visible: !this.state.visible,
    });
  }

  /**
   * Show the component.
   * @public
   */
  show() {
    this.setState({
      visible: true,
    });
  }

  /**
   * Hide the component.
   * @public
   */
  hide() {
    this.setState({
      visible: false,
    });
  }

  /**
   * Updates the DOM to represent state.
   */
  render() {
    const {visible} = this.state;
    this.target.setAttribute('aria-hidden', !visible);
    this.toggler.setAttribute('aria-expanded', visible);
    const action = visible ? '_show' : '_hide';
    this[action]();
  }

  /**
   * @private
   */
  _show() {
    this.target.style.marginTop = '0px';
  }

  /**
   * @private
   */
  _hide() {
    const {height} = this.target.getBoundingClientRect();
    this.target.style.marginTop = `-${height}px`;
  }

  /**
   * Updates the state and calls render.
   *
   * @param {Object} ps partial state
   */
  setState(ps) {
    this.state = Object.assign({}, this.state, ps);
    this.render();
  }
}

function init() {
  Array.from(document.querySelectorAll('.js-accordion_toggle'))
    .map((t) => new Accordion(t));
}

export default {
  init,
};
