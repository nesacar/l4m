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

export {
  preloadImage,
  mapOverObject,
  hasValue,
};