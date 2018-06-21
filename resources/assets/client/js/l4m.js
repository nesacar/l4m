import LazyImages from './components/lazy-images';
import * as Masthead from './components/masthead';
import Drawer from './components/drawer';
import SearchWidget from './components/search-widget';
import Accordion from './components/accordion';
import RevealAccordion from './components/reveal-accordion';
import Siema from './components/siema';
import { Toast } from './components/toast';
import InvertableImage from './components/invertable-image';
import InputField from './components/input-field';
import Currency from './currency';

import NavItem from './components/nav';
import app from './app/app';

export function init () {
  window.Toast = Toast;
  Drawer.init();
  LazyImages.init();
  Masthead.init();
  SearchWidget.init();
  Accordion.init();
  RevealAccordion.init();
  InputField.init();
  Currency.init();
  NavItem.init();

  window.addEventListener('load', () => {
    // Wait for evertything to load before applying images.
    InvertableImage.init();
    app.init();
  }, {once: true});

  const defaultOptions = {
    perPage: {
      0: 2,
      696: 3,
      1028: 4,
    },
  };

  document.querySelectorAll('.showcase_carousel')
    .forEach((carousel) => {
      return new Siema({
        selector: carousel,
        ...defaultOptions,
      });
    });
};
