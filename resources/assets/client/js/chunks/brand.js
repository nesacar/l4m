(function() {
  let toggleEl;
  let el;
  let content;
  let state = {
    expanded: false,
  };

  _init();

  /**
   * Kicks things out.
   */
  function _init() {
    toggleEl = document.querySelector('.js-collapse-toggle');
    el = document.querySelector('.js-collapse-container');
    content = el.querySelector('.js-collapse-content');
    toggleEl.addEventListener('click', _toggleCollapse);

    // Initial render.
    _setState({
      expanded: (toggleEl.dataset.expanded === 'true'),
    });
  }

  /**
   * Convinience function for toggling state.
   * 
   * @param {Event} e - event object.
   */
  function _toggleCollapse(e) {
    _setState({
      expanded: !state.expanded,
    });
  }

  /**
   * Updates the view.
   */
  function _render(e) {
    toggleEl.dataset.expanded = state.expanded;

    if (!state.expanded) {
      requestAnimationFrame(() => {
        el.style = '';
      });
      return;
    }
    // Else expand the container.
    const {height} = content.getBoundingClientRect();

    requestAnimationFrame(() => {
      el.style.paddingTop = `${height}px`;
    });
  }

  /**
   * Updates state and calls render.
   *
   * @param {Object} partialState - State update.
   */
  function _setState(partialState) {
    state = Object.assign({}, state, partialState);
    _render();
  }
}());
