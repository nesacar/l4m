export const html = (name) => (attrs={}) => {
  const el = document.createElement(name);
  Object.entries(attrs).forEach((attr) => {
    el.setAttribute(attr[0], attr[1]);
  });
  return el;
}

export const button = html('button');
export const div = html('div');
export const li = html('li');
export const span = html('span');
