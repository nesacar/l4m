const preloadImage = url => {
  return new Promise((resolve, reject) => {
    const image = new Image();
    image.src = url;
    image.onload = resolve;
    image.onerror = reject;
  });
};

const mapOverObject = (obj, fn) => {
  const res = {};

  Object.keys(obj).forEach(key => {
    res[key] = fn(obj[key], key);
  });

  return res;
};

const hasValue = (value) => {
  return value !== null && value !== undefined;
};

/**
 * Extends base object with the extension.
 * @param {Object} base - Base object
 * @param {Object} extension - The extension.
 */
const extend = (base, extension) => {
  for (let key in extension) {
    if (Object.prototype.hasOwnProperty.call(extension, key)) {
      base[key] = extension[key];
    }
  }
};

// Find the closest element in the chain with the given tag name:
const closest = (element, tagName) => {
  if (element.tagName.toLowerCase() === tagName.toLowerCase()) {
    return element;
  }
  return closest(element.parentNode, tagName);
};

export {
  preloadImage,
  mapOverObject,
  hasValue,
  extend,
  closest,
};