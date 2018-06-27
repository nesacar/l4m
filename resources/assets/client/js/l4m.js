import LazyImages from './components/lazy-images';
import * as Masthead from './components/masthead';
import Drawer from './components/drawer';
import SearchWidget from './components/search-widget';
import Accordion from './components/accordion';
import RevealAccordion from './components/reveal-accordion';
import {createCarousel} from './components/carousel';
import { Toast } from './components/toast';
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

  window.addEventListener('load', app.init, {once: true});

  Array.from(document.querySelectorAll('.showcase_carousel'))
    .map(createCarousel);
};
