import {createCarousel} from "./carousel";

const OPTIONS = {
  perPage: 1,
  duration: 400,
  loop: true,
};

const INTERVAL = 3000;

let carousel;
let interval;

function startAutoPlay () {
  interval = setInterval(() => {
    carousel.next();
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

function next() {
  carousel.next();
}

function prev() {
  carousel.prev();
}

function addControls (root) {
  const btnElNext = root.querySelector('.masthead-carousel-control--next');
  const btnElPrev = root.querySelector('.masthead-carousel-control--prev');
  btnElNext.addEventListener('click', next);
  btnElPrev.addEventListener('click', prev);
}

export function init () {
  const root = document.getElementById('masthead');

  if (!root) {
    return;
  }

  carousel = createCarousel(root.querySelector('.masthead-carousel'), OPTIONS);

  addControls(root);
  addAutoPlay(root);
};
