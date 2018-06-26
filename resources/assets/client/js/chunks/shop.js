import DoubleSlider from '../components/double-slider';
import {button, div, li} from '../html';

// Prevent content flashes
// form.classList.remove('filters--loading');
// form.classList.add('filters--has-loaded');

/**
 * Helper class for controling filter drawer.
 */
class FilterDrawer {
  /**
   * @type {string}
   */
  static get ACTIVE_CLASS() {
    return 'active';
  }
  
  /**
   * Creates new instance of the FilterDrawer helper component.
   */
  constructor() {
    this.btn = document.querySelector('.js-filter-btn');
    this.el = document.querySelector('.js-filters-container');
    this.backdrop = document.querySelector('.js-filters-backdrop');

    this.state = {
      active: this.el.classList.contains(FilterDrawer.ACTIVE_CLASS),
    };

    this.btn.addEventListener('click', this.open.bind(this));
    this.backdrop.addEventListener('click', this.close.bind(this));
  }

  /**
   * opens the components el.
   */
  open() {
    this.setState({
      active: true,
    });
  }

  /**
   * closes the compoents el.
   */
  close() {
    this.setState({
      active: false,
    });
  }

  /**
   * Updates the state and calls render.
   *
   * @param {Object} partialState
   */
  setState(partialState) {
    this.state = Object.assign({}, this.state, partialState);
    this.render();
  }

  /**
   * Updates the DOM to represent the state.
   */
  render() {
    const {active} = this.state;

    if (active) {
      this.el.classList.add(FilterDrawer.ACTIVE_CLASS);
    } else {
      this.el.classList.remove(FilterDrawer.ACTIVE_CLASS);
    }
  }
}

/**
 * Checks if element has any child elements.
 *
 * @param {HTMLElement} el
 * @return {Boolean}
 */
const isEmpty = (el) => el.children.length < 1;

/**
 * Removes the element from the DOM.
 *
 * @param {HTMLElement} el
 * @return {HTMLElement}
 */
const removeElement = (el) => el.parentElement.removeChild(el);

/**
 * Returns elements parent element.
 *
 * @param {HTMLElement} el
 * @return {HTMLElement}
 */
const parentElement = (el) => el.parentElement;

/**
 * Creates DoubleSlider wrapper.
 *
 * @param {HTMLElement} el
 * @return {DoubleSlider}
 */
const createSlider = (el) => new DoubleSlider(el);

/**
 * Extract values from the dataset.
 *
 * @param {HTMLElement} el
 * @return {Object}
 */
const extractData = (el) => el.dataset;

/**
 * Creates applied filter.
 *
 * @param {Object} dataset
 * @property {string} dataset.id
 * @property {string} dataset.value
 * @property {string} dataset.category
 * @return {string}
 */
const createAppliedFilter = (dataset) => {
  const {id, value, category} = dataset;
  const item = li({class: 'applied-filter-list_item', 'data-id': id});
  const wrap = div();
  const cat = div({class: 'text--xs text--bold text--uppercase text--hint'});
  cat.innerHTML = category;
  const val = div({class: 'text--s text--bold'});
  val.innerHTML = value;
  wrap.appendChild(cat);
  wrap.appendChild(val);
  const btn = button({class: 'icon-btn'});
  btn.innerHTML = '&times;';
  item.appendChild(wrap);
  item.appendChild(btn);
  return item;
};

/**
 * unchecks the filter with the given id.
 *
 * @param {string} id
 * @return {Function} event handler.
 */
const removeFilter = (id) => () => {
  document.getElementById(id).checked = false;
};

/**
 * Attaches event listener that removes the filter.
 *
 * @param {HTMLElement} el
 * @return {HTMLElement}
 */
const bindEvents = (el) => {
  const btn = el.querySelector('.icon-btn');
  const id = el.dataset.id;
  btn.addEventListener('click', removeFilter(id));
  return el;
};

const formEl = document.querySelector('#filters');
const sortEl = document.querySelector('#sort');
const listEl = document.querySelector('.js-applied-list');

new FilterDrawer();

// submit form on change.
[formEl, sortEl].map((el) => {
  el.addEventListener('change', formEl.submit);
  return el;
});

// init sliders.
Array.from(formEl.querySelectorAll('.double-slider'))
  .map(createSlider);

// remove the filters without values.
Array.from(formEl.querySelectorAll('.filter-list'))
  .filter(isEmpty)
  .map(parentElement)
  .map(removeElement);

// render applied filters.
Array.from(formEl.querySelectorAll('[data-checked]'))
  .map(extractData)
  .map(createAppliedFilter)
  .map(bindEvents)
  .map((el) => listEl.appendChild(el));

// remove listEl if is empty.
[listEl].filter(isEmpty)
  .map(parentElement)
  .map(removeElement);
