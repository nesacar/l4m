import {toggles} from '../mixins/toggles';

function init() {
  document.querySelectorAll('.cc-drawer')
  .forEach((drawer) => {
    // extend with toggles mixin
    toggles(drawer, 'cc-drawer');
    
    // close on backdrop clicks/taps
    drawer.addEventListener('click', (evt) => {
      // ignore clicks on drawer surface
      if (evt.target.closest('.cc-drawer_drawer')) {
        return;
      }
      
      drawer.close();
    });
  }); 
}

export default {
  init,
};
