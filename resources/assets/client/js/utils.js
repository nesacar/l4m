export const preloadImage = url => {
  return new Promise((resolve, reject) => {
    const image = new Image();
    image.src = url;
    image.onload = resolve;
    image.onerror = reject;
  });
};

export const mapOverObject = (obj, fn) => {
  return Object.keys(obj).reduce((res, key) => {
    res[key] = fn(obj[key], key);
    return res;
  }, {});
};

export const hasValue = (value) => {
  return value !== null && value !== undefined;
};

/**
 * Extends base object with the extension.
 * @param {Object} base - Base object
 * @param {Object} extension - The extension.
 */
export const extend = (base, extension) => {
  for (let key in extension) {
    if (Object.prototype.hasOwnProperty.call(extension, key)) {
      base[key] = extension[key];
    }
  }
};

// Find the closest element in the chain with the given tag name:
export const closest = (element, tagName) => {
  if (element.tagName.toLowerCase() === tagName.toLowerCase()) {
    return element;
  }
  return closest(element.parentNode, tagName);
};

export const openHelper = (target, toggle, action) => {
  target.setAttribute('aria-hidden', false);
  toggle.setAttribute('aria-expanded', true);
  action(target, toggle);
};

export const closeHelper = (target, toggle, action) => {
  target.setAttribute('aria-hidden', true);
  toggle.setAttribute('aria-expanded', false);
  action(target, toggle)
};

/**
 * Convenience function that binds click event to the toggle element,
 * and handles aria attributes on target and toggle element.
 *
 * @param {HTMLElement} target - Target element.
 * @param {HTMLElement} toggle - Toggle element.
 * @param {Function} open - The function to open/expand the target element.
 * @param {Function} close - The function to close/collapse the target
 * element.
 * @return {Function} - Function to remove event listener.
 */
export const bindTogglerWithTarget = (target, toggle, open, close) => {
  function handler(evt) {
    const expanded =
      (toggle.getAttribute('aria-expanded') === 'true');

    if (expanded) {
      closeHelper(target, toggle, close);
      return;
    }

    openHelper(target, toggle, open);
  }

  toggle.addEventListener('click', handler);

  return () => {
    toggle.removeEventListener('click', handler);
  };
};

/**
 * Logging middleware.
 *
 * @param {any} x
 * @return {any}
 */
export const log = (x) => {
  console.log(x)
  return x;
};

export const dispatch = (type, detail) => {
  const event = new CustomEvent(type, {
    bubbles: true,
    detail,
  });
  window.dispatchEvent(event);
};
