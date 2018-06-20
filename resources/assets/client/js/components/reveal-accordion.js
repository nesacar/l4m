// TODO: Extract to class.
/**
 * RevealAccordion reveals first few lines of its content when collapsed.
 * When expanded, shows the rest of the content.
 *
 * Pges using RevealAccordion: [brand, product]
 */
class RevealAccordion {
  /**
   * @type {boolean}
   */
  get expanded() {
    return this.state.expanded;
  }

  set expanded(val) {
    this._setState({
      expanded: val,
    });
  }

  /**
   * Convinience method, that grabs all the required elements,
   * and returns new instance of the RevealAccordion. If any of the
   * required element is missing, the method will stop executing
   * without throwing an error.
   * 
   * @return {RevealAccordion}
   * @public
   */
  static init() {
    // grab required elements.
    const toggler = document.querySelector('.js-collapse-toggle');
    const wrapper = document.querySelector('.js-collapse-container');
    const content = document.querySelector('.js-collapse-content');
    
    // If any of the elements is missing, just return.
    if (!toggler && !wrapper && !content) {
      return;
    }
    
    return new RevealAccordion(toggler, wrapper, content);
  }

  /**
   * Creates new instance of RevealAccordion.
   * 
   * @param {HTMLElement} toggler element that toggles the component.
   * @param {HTMLElement} wrapper content wrapper element.
   * @param {HTMLElement} content components content.
   */
  constructor(toggler, wrapper, content) {
    this.toggler = toggler;
    this.wrapper = wrapper;
    this.content = content;

    // set initial state.
    this.state = {expanded: false};

    // bind methods to instance.
    this.toggle = this.toggle.bind(this);

    this.toggler.addEventListener('click', this.toggle);

    // update the state to match the DOM.
    this._setState({
      expanded: (this.toggler.dataset.expanded === 'true'),
    });
  }

  /**
   * Toggles the components state. From `expanded: true` to `expanded: false`,
   * and viceversa.
   * @public
   */
  toggle() {
    this._setState({
      expanded: !this.state.expanded,
    });
  }

  /**
   * Updates the state, and calls render.
   *
   * @param {Object} partialState state update.
   * @private
   */
  _setState(partialState) {
    this.state = Object.assign({}, this.state, partialState);
    this._render();
  }

  /**
   * Update the DOM.
   * @private
   */
  _render() {
    const {expanded} = this.state;
    this.toggler.dataset.expanded = expanded;

    if (!expanded) {
      this.wrapper.style.paddingTop = '';
      return;
    }
    // Else expand the container.
    const {height} = this.content.getBoundingClientRect();

    requestAnimationFrame(() => {
      this.wrapper.style.paddingTop = `${height}px`;
    });
  }
}

export default RevealAccordion;
