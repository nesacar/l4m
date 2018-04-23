import Siema from "./siema";

const OPTIONS = {
  perPage: 1,
  loop: true,
  onInit
};

const LOADING_CLASS = 'is-loading';
const LOADED_CLASS = 'has-loaded';

let carousel;

function onInit () {
  this.selector.classList.remove(LOADING_CLASS);
  this.selector.classList.add(LOADED_CLASS);
}

function next () {
  carousel.next();
}

function prev () {
  carousel.prev();
}

export function init () {
  const masthead = document.getElementById('masthead');
  const btnElNext = masthead.querySelector('.masthead-carousel-control--next');
  const btnElPrev = masthead.querySelector('.masthead-carousel-control--prev');

  carousel = new Siema({
    selector: masthead.querySelector('.masthead-carousel'),
    ...OPTIONS
  });

  btnElNext.addEventListener('click', next);
  btnElPrev.addEventListener('click', prev);
};
