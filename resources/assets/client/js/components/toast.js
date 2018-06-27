import {div} from '../html';

export class Toast {
  static create (msg, options) {
    let toastContainer = document.querySelector('.toast-container');

    if (!toastContainer) {
      toastContainer = document.createElement('div');
      toastContainer.classList.add('toast-container');
      document.body.appendChild(toastContainer);
    }

    options = options || {};
    const tag = options.tag || (Date.now().toString());
    Array.from(toastContainer.querySelectorAll(`.toast[data-tag="${tag}"]`))
      .forEach(t => {
        t.parentNode.removeChild(t);
      });

    // Make a toast
    const toast = div({class: 'toast'});
    const toastContent = div({class: 'toast_content'});
    toastContent.textContent = msg;
    toast.appendChild(toastContent);
    toast.dataset.tag = tag;
    toastContainer.appendChild(toast);

    // Wait a secund, than fade out
    const timeout = options.timeout || 3000;
    setTimeout(() => {
      toast.classList.add('toast--dismissed');
    }, timeout);

    // Than remove it
    toast.addEventListener('transitionend', evt => {
      evt.target.parentNode.removeChild(evt.target);
    });
  }
}