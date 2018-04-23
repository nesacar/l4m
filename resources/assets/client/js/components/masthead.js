import Siema from "./siema";

const OPTIONS = {
  perPage: 1,
  loop: true
};

const LOADING_CLASS = 'is-loading';
const LOADED_CLASS = 'has-loaded';

function onInit () {
  this.selector.classList.remove(LOADING_CLASS);
  this.selector.classList.add(LOADED_CLASS);
}

export function init () {
  window.masthead = new Siema({
    selector: document.querySelector('.masthead-carousel'),
    onInit,
    ...OPTIONS
  })
};
