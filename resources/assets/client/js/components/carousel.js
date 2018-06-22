import Siema from 'siema';

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
   * Creates new Carousel instance. Adds/remove loaded classes.
   * Useful for pre-loaded styling.
   *
   * @param {Object} config config object.
   */
  constructor(config) {
    super(config);

    this.selector.classList.remove('is-loading');
    this.selector.classList.add('has-loaded');
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
    super.slideToCurrent(enableTransition)
    this.setActiveSlide();
  }
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
