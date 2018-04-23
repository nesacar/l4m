import Siema from "./siema";

const OPTIONS = {
  perPage: 1,
  duration: 400,
  loop: true,
  onInit
};

const INTERVAL = 3000;

const LOADING_CLASS = 'is-loading';
const LOADED_CLASS = 'has-loaded';

let carousel;
let interval;

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

function startAutoPlay () {
  interval = setInterval(() => {
    next();
  }, INTERVAL);
}

function pauseAutoPlay () {
  clearInterval(interval);
}

function addAutoPlay (root) {
  root.addEventListener('mouseenter', pauseAutoPlay);
  root.addEventListener('mouseleave', startAutoPlay);
  startAutoPlay();
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
  addAutoPlay(root);
  // TODO Add paggination
}

export function init () {
  const root = document.getElementById('masthead');

  if (!root) {
    return;
  }

  createCarousel(root);
};
