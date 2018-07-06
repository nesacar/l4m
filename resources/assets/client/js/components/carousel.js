import Siema from 'siema';
import {div, button, span} from '../html';
import {classNames} from '../utils';

const DEFAULT_OPTIONS = {
  perPage: {
    0: 2,
    696: 3,
    1028: 4,
  },
};

/**
 * Carousel class, extends Siema slider, adds methods that support
 * easier styling of the component and slides.
 */
class Carousel extends Siema {
  /**
   * @type {number}
   */
  get timeOut() {
    return 3000;
  }

  /**
   * Creates new Carousel instance. Adds/remove loaded classes.
   * Useful for pre-loaded styling.
   *
   * @param {Object} config config object.
   */
  constructor(config) {
    super(config);

    this.selector.className = classNames(this.selector, {
      'is-loading': false,
      'has-loaded': true,
    });

    this.startAutoPlay = this.startAutoPlay.bind(this);
    this.pauseAutoPlay = this.pauseAutoPlay.bind(this);
  }

  /**
   * Adds `active` class name to current slide.
   */
  setActiveSlide() {
    const index = this.currentSlide;
    this.innerElements.forEach((el, i) => {
      if (i === index) {
        el.classList.add('active');
      } else {
        el.classList.remove('active');
      }
    });
  }

  /**
   * Moves sliders frame to position of currently active slide,
   *
   * @param {boolean} enableTransition
   */
  slideToCurrent(enableTransition) {
    super.slideToCurrent(enableTransition);
    this.setActiveSlide();
  }

  /**
   * Inserts the carousel controls.
   * https://codepen.io/pawelgrzybek/pen/yVxmEp
   */
  addArrows() {
    // controls container
    const ctrls = div({class: 'carousel-ctrls'});
    // create controls wrap with buttons.
    const wrap = ['prev', 'next']
      .map(createArrows)
      .map(createIconButtons)
      .map((btn) => {
        const action = getDir(btn);
        btn.addEventListener('click', () => {
          this[action]();
        });
        return btn;
      })
      .reduce(
        appendToWrapper,
        div({class: 'container carousel-ctrls_container'})
      );
    ctrls.appendChild(wrap);
    this.selector.appendChild(ctrls);
    return this;
  }

  /**
   * Add auto play to the carousel.
   */
  addAutoPlay() {
    this.selector.addEventListener('mouseover', this.pauseAutoPlay);
    this.selector.addEventListener('mouseleave', this.startAutoPlay);
    this.startAutoPlay();
    return this;
  }

  /**
   * Start autoplay.
   */
  startAutoPlay() {
    this._interval = setInterval(() => {
      this.next();
    }, this.timeOut);
  }

  /**
   * Pause autoplay.
   */
  pauseAutoPlay() {
    clearInterval(this._interval);
  }
}

/**
 * Creates an arrow icon pointing in the given direction.
 *
 * @param {string} dir Direction
 * @return {HTMLSpanElement} arrow icon
 */
function createArrows(dir) {
  return span({
    class: `arrow arrow--${dir}`,
    role: 'presentation',
    'data-dir': dir,
  });
}

/**
 * Creates an icon button with the given icon.
 *
 * @param {HTMLSpanElement} icon
 * @return {HTMLButtonElement} icon button
 */
function createIconButtons(icon) {
  const dir = getDir(icon);
  const btn = button({
    class: `carousel-ctrl carousel-ctrl--${dir}`,
    'aria-label': `${dir}-slide`,
    'data-dir': dir,
  });
  btn.appendChild(icon);
  return btn;
}

/**
 * Appends the element to the wrapper component.
 *
 * @param {HTMLElement} wrap wrapper element
 * @param {HTMLElement} element element to append
 * @return {HTMLElement} wrapper.
 */
function appendToWrapper(wrap, btn) {
  wrap.appendChild(btn);
  return wrap;
}

/**
 * Convinience function to get `data-dir` attribute.
 *
 * @param {HTMLElement} el
 * @return {string}
 */
function getDir(el) {
  return el.getAttribute('data-dir');
}

/**
 * Creates new Carousel instance.
 *
 * @param {(string|HTMLElement)} selector carousel root element.
 * @param {object} config configuration object.
 * @return {Carousel} new Carousel instance.
 */
export function createCarousel(selector, config={}) {
  const options = Object.assign({}, DEFAULT_OPTIONS, {selector}, config);
  return new Carousel(options);
}
