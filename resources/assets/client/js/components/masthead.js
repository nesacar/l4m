import Siema from "./siema";

const OPTIONS = {
  perPage: 1,
  duration: 400,
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

function addControls (root) {
  const btnElNext = root.querySelector('.masthead-carousel-control--next');
  const btnElPrev = root.querySelector('.masthead-carousel-control--prev');
  btnElNext.addEventListener('click', next);
  btnElPrev.addEventListener('click', prev);
}

function createCarousel (root) {
  const controls = root.querySelector('.masthead-carousel-controls');

  carousel = new Siema({
    selector: root.querySelector('.masthead-carousel'),
    ...OPTIONS
  });

  addControls(root);

  // TODO Set auto play timer
}

export function init () {
  const root = document.getElementById('masthead');

  if (!root) {
    return;
  }

  createCarousel(root);
};
