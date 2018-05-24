import ImageZoomer from '../components/image-zoomer';
import ImageGallery from '../components/image-gallery';
import Siema from '../components/siema';

(function() {
  const ACTIVE_CLASS = 'active';
  const CONFIG = {
    selector: '.demo-siema',
    perPage: 1,
    onChange: _onChange,
  };

  const DEFAULT_STATE = {
    activeIndex: 0,
  };

  let state = null;
  let slider;
  let $thumbs;
  let $prev;
  let $next;

  _init();

  /**
   * Sets the stage up.
   */
  function _init() {
    slider = new Siema(CONFIG);
    $thumbs = document.querySelectorAll('.image-gallery_thumbnails img');
    $prev = document.querySelector('.js-arrow--prev');
    $next = document.querySelector('.js-arrow--next');
    $thumbs.forEach((img, i) => {
      img.addEventListener('click', () => {
        _setState({activeIndex: i});
      });
    });

    $prev.addEventListener('click', _prevImage);
    $next.addEventListener('click', _nextImage);

    _setState(DEFAULT_STATE);
  }

  /**
   * Updates state on each swipe.
   */
  function _onChange() {
    _setState({
      activeIndex: slider.currentSlide
    });
  }

  /**
   * Sets image with the given index as active.
   *
   * @param {Number} index - Next index.
   */
  function _goTo(index) {
    const size = $thumbs.length;

    if (index >= size) {
      index = size - 1;
    } else if (index < 0) {
      index = 0;
    }

    if (index === state.activeIndex) {
      return;
    }

    _setState({
      activeIndex: index,
    });
  }

  /**
   * Convinience function that sets prev image as active.
   */
  function _prevImage() {
    _goTo(state.activeIndex - 1);
  }

  /**
   * Convinience function that sets next image as active.
   */
  function _nextImage() {
    _goTo(state.activeIndex + 1);
  }

  /**
   * Updates the view.
   */
  function _render() {
    slider.goTo(state.activeIndex);
    _markActiveThumbnail();
  }

  /**
   * Sets styling to thumbs.
   */
  function _markActiveThumbnail() {
    const index = state.activeIndex;

    $thumbs.forEach((img, i) => {
      if (index === i) {
        img.classList.add(ACTIVE_CLASS);
        return;
      }

      img.classList.remove(ACTIVE_CLASS);
    });
  }

  /**
   * Updates the state and calls render.
   *
   * @param {Object} partialState - State update.
   */
  function _setState(partialState) {
    state = Object.assign({}, state, partialState);
    _render();
  }



  // const zoomer = new ImageZoomer();
  // window.imgGallery = new ImageGallery({
  //   onChange,
  // });
  // document.querySelector('.js-arrow--prev')
  //   .addEventListener('click', imgGallery.nextImage)
  // document.querySelector('.js-arrow--next')
  //   .addEventListener('click', imgGallery.prevImage);

  // function onChange() {
  //   zoomer.init();
  // }
}());

