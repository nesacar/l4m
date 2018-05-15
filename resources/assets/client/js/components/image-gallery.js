const ACTIVE_CLASS = 'active';
/**
 * Sets up the image gallery.
 *
 * @param {Function} callback - Function to call on every image swap
 */
function init(callback=function() {}) {
  const target = document.querySelector('.image-gallery_target');
  const thumbnails = 
    document.querySelector('.image-gallery_thumbnails');
  let currentImage = thumbnails.querySelector('img.active');

  thumbnails.addEventListener('click', function(evt) {
    if (evt.target.tagName.toLowerCase() !== 'img') {
      return;
    }

    currentImage.classList.remove(ACTIVE_CLASS);
    currentImage = evt.target;
    currentImage.classList.add(ACTIVE_CLASS);

    const src = evt.target.dataset.large;
    // Show small image before big arives.
    target.src = evt.target.src;

    const img = new Image();
    img.src = src;
    img.onload = () => {
      target.src = src;
      callback(src);
    };
  });
}

export default {
  init,
};
