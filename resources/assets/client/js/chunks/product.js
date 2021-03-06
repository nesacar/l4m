import ImageZoomer from '../components/image-zoomer';
import Dialog from '../components/dialog';
import {createCarousel} from '../components/carousel';

(function() {
  const ACTIVE_CLASS = 'active';
  const CONFIG = {
    perPage: 1,
    onChange: _onChange,
  };

  const DEFAULT_STATE = {
    activeIndex: 0,
  };

  let state = null;
  let $zoomTrigger;
  let dialog;
  let zoomer;
  let slider;
  let $thumbs;
  let $prev;
  let $next;

  _init();

  /**
   * Sets the stage up.
   */
  function _init() {
    zoomer = new ImageZoomer(document.querySelector('.js-zoomer'));
    slider = createCarousel('.demo-siema', CONFIG);

    dialog = new Dialog(document.querySelector('.js-dialog'));
    $zoomTrigger = document.querySelector('.js-zoomer-trigger');
    // tmp
    $zoomTrigger.addEventListener('click', function() {
      const index = state.activeIndex;
      const url = $thumbs[index].dataset.large;
      zoomer.image = url;
      dialog.showModal();
    });

    $thumbs = Array.from(document.querySelectorAll('.image-gallery_thumbnails img'));
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
    const index = state.activeIndex;
    slider.goTo(index);
    _updateControls();
    _markActiveThumbnail();
  }
  
  /**
   * Updates the control buttons to match state.
   * https://github.com/pawelgrzybek/siema/issues/68
   */
  function _updateControls() {
    const index = state.activeIndex;

    $prev.disabled = (0 === index);
    $next.disabled = (
      index === slider.innerElements.length + 1 ||
      index + 1 >= slider.innerElements.length
    );
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
}());

