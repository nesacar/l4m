import DoubleSlider from './components/double-slider';

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
 * Convenience funtion that checks if element has
 * any children.
 * 
 * @param {Element} element - DOM Element to test if it's empty.
 * @return {Boolean}
 */
function _isEmptyElement (element) {
  return element.children.length < 1;
}

(function () {
  /**
   * Convenience function that submits the form.
   */
  function submitForm () {
    form.submit();
  }

  const form =  document.getElementById('filters');
  form.addEventListener('change', submitForm);
  document.getElementById('sort')
    addEventListener('change', submitForm);
  
  _initSliders(form);
  _removeEmptyFilters(form);

  // Prevent content flashes
  form.classList.remove('filters--loading');
  form.classList.add('filters--has-loaded');
}());
