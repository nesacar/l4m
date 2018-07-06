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
  root.addEventListener('mouseover', pauseAutoPlay);
  root.addEventListener('mouseleave', startAutoPlay);
  startAutoPlay();
}

export function init () {
  const root = document.getElementById('masthead');

  if (!root) {
    return;
  }

  carousel = createCarousel(root.querySelector('.masthead-carousel'), OPTIONS);

  addAutoPlay(root);
  carousel.addArrows();
};
