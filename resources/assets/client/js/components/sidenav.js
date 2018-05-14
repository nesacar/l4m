function init() {
  document.querySelectorAll('.side-nav')
    .forEach((sidenav, i) => {
      sidenav.querySelectorAll('.side-nav_toggle')
        .forEach(_initMenu);

      // Set "All Done" flag.
      sidenav.classList.add('initialized');
    });
}

function _initMenu(_toggleEl, index) {
  const _id = _toggleEl.getAttribute('aria-controls').slice(1);

  // If target is not set, just return.
  if (!_id) {
    return;
  }

  const _targetEl = document.getElementById(_id).firstElementChild;

  if (!_targetEl) {
    throw new Error(`Could not find the submenu with the id: ${_id}`);
  }
  
  _collapseMenu(_toggleEl, _targetEl);

  _toggleEl.addEventListener('click', function(evt) {
    // Convert to bool
    const expanded = (_toggleEl.getAttribute('aria-expanded') === 'true');
    // If it's expanded, collapse the menu.
    if (expanded) {
      _collapseMenu(_toggleEl, _targetEl);
      return;
    }
    _expandMenu(_toggleEl, _targetEl);
  });
}

function _expandMenu(toggleEl, targetEl) {
  requestAnimationFrame(() => {
    targetEl.style.marginTop = '0px';
    targetEl.setAttribute('aria-hidden', false);
    toggleEl.setAttribute('aria-expanded', true);
  });
}

function _collapseMenu(toggleEl, targetEl) {
  requestAnimationFrame(() => {
    const height = targetEl.getBoundingClientRect().height;
    targetEl.style.marginTop = `-${height}px`;
    targetEl.setAttribute('aria-hidden', true);
    toggleEl.setAttribute('aria-expanded', false);
  });
}

export default {
  init,
};
