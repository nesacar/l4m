/**
 * Sets up the image gallery.
 *
 * @param {Function} callback - Function to call on every image swap
 */
function init(callback=function() {}) {
  const target = document.querySelector('.image-gallery_target');
  const thumbnails = 
    document.querySelector('.image-gallery_thumbnails');

  thumbnails.addEventListener('click', function(evt) {
    if (evt.target.tagName.toLowerCase() !== 'img') {
      return;
    }

    // TODO: Use data-src to hold ref to bigger image.
    const src = evt.target.src;
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
