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
  applyActiveSlide(this);
}

function onChange () {
  applyActiveSlide(this);
}

function applyActiveSlide (masthead) {
  const index = masthead.currentSlide + OPTIONS.perPage;

  Array.from(masthead.sliderFrame.children, (child, i) => {
    console.log(index, i)
    if (i === index) {
      child.classList.add('active');
    }
    else { 
      if (child.classList.contains('active')) {
        child.classList.remove('active');
      }
    }
  });
}

export function init () {
  window.masthead = new Siema({
    selector: document.querySelector('.masthead-carousel'),
    onInit,
    onChange,
    ...OPTIONS
  })
};
