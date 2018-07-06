import {createCarousel} from "./carousel";

const OPTIONS = {
  perPage: 1,
  duration: 400,
  loop: true,
};

export function init() {
  Array.from(document.querySelectorAll('.js-carousel'))
    .map((el) => createCarousel(el, OPTIONS))
    .map((c) => c.addArrows())
    .map((c) => c.addAutoPlay());
};
