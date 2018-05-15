import {closeHelper, bindTogglerWithTarget} from '../utils';

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
  
  closeHelper(target, toggle, _close);
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
