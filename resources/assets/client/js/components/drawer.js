import {closeHelper, bindTogglerWithTarget} from '../utils';

function init() {
  Array.from(document.querySelectorAll('.cc-drawer'))
    .forEach((drawer) => {
      const toggler =
        document.querySelector(`[aria-controls="#${drawer.id}"]`);
      
      // close on backdrop clicks/taps
      drawer.addEventListener('click', (evt) => {
        // ignore clicks on drawer surface
        if (evt.target.closest('.cc-drawer_drawer')) {
          return;
        }

        closeHelper(drawer, toggler, _close);
      });

      bindTogglerWithTarget(drawer, toggler, _open, _close);
    });
}

function _open(target) {
  target.classList.add('cc-drawer--open');
}

function _close(target) {
  target.classList.remove('cc-drawer--open');
}

export default {
  init,
};
