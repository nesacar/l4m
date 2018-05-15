import {closeHelper, bindTogglerWithTarget, openHelper} from '../utils';

function init() {
  document.querySelectorAll('.js-accordion_toggle')
    .forEach(_initMenu);
}

function _initMenu(toggle, index) {
  if (!toggle.hasAttribute('aria-controls')) {
    return;
  }

  const id = toggle.getAttribute('aria-controls').slice(1);
  const target = document.getElementById(id).firstElementChild;

  if (!target) {
    throw new Error(`Could not find the submenu with the id: ${id}`);
  }
  
  // Sets the initial state.
  const _state = toggle.getAttribute('aria-expanded');
  // If aria-expanded is set and has value of 'true'
  if (_state === 'true') {
    openHelper(target, toggle, _open);
  } else { 
    closeHelper(target, toggle, _close);
  }

  bindTogglerWithTarget(target, toggle, _open, _close);
}

function _open(target) {
  target.style.marginTop = '0px';
}

function _close(target) {
  const height = target.getBoundingClientRect().height;
  target.style.marginTop = `-${height}px`;
}

export default {
  init,
};
