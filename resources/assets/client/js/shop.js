import DoubleSlider from './components/double-slider';

// document.getElementById('sort').addEventListener('change', function () {
//     form.submit();
// });

/**
 * Instantiate all the sliders.
 */
function _initSliders (el) {
  Array.from(el.querySelectorAll('.double-slider'))
    .forEach((slider) => {
      return new DoubleSlider(slider);
    });
}

/**
 * Goes through all the filters, and removes the ones
 * without values.
 */
function _removeEmptyFilters (el) {
  Array.from(el.querySelectorAll('.filter'))
    .forEach((filter) => {
      let filterList = filter.querySelector('.filter-list');
      // Ignore if it's slider.
      if (!filterList) {
        return;
      }

      if (_isEmptyElement(filterList)) {
        filter.parentElement.removeChild(filter);
      }
    });
}

/**
 * Checks if element has any children.
 * 
 * @param {Element} element - DOM Element to test if it's empty.
 * @return {Boolean}
 */
function _isEmptyElement (element) {
  return element.children.length < 1;
}

(function () {
  const form =  document.getElementById('filters');
  form.addEventListener('change', function () {
    this.submit();
  });

  _initSliders(form);
  _removeEmptyFilters(form);
}());
