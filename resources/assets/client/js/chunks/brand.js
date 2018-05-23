(function() {
  const toggleEl = document.querySelector('.js-collapse-toggle');
  const el = document.querySelector('.js-collapse-container');
  const content = el.querySelector('.js-collapse-content');

  toggleEl.addEventListener('click', _toggleElement);

  /**
   * Toggles the container visibility.
   *
   * @param {Event} e - Click event object.
   */
  function _toggleElement(e) {
    // Transform to boolean.
    const expanded = (toggleEl.dataset.expanded === 'true');

    if (expanded) {
      requestAnimationFrame(() => {
        el.style = '';
        toggleEl.dataset.expanded = false;
      });
      return;
    }
    // Else expand the container.
    const {height} = content.getBoundingClientRect();

    requestAnimationFrame(() => {
      el.style.paddingTop = `${height}px`;
      toggleEl.dataset.expanded = true;
    });
  }
}());
