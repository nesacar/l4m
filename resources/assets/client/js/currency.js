let form;

/**
 * Caches DOM, attaches event listeners...
 */
function init() {
  form = document.getElementById('currency_form');
  form.addEventListener('change', _onChange);
}

/**
 * Change event handler.
 *
 * @param {Event} evt - 'change' event object.
 */
function _onChange(evt) {
  form.submit();
}

export default {init};
  