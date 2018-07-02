// -- polyfills -- //
// NOTE: polyfills must be imported frist. 
import 'core-js/features/array/from';
import 'core-js/features/array/for-each';
import 'core-js/features/array/includes';
import 'core-js/features/object/assign';
import 'core-js/features/object/entries';
import 'core-js/features/promise';
// -- /polyfills -- //

// lib
import * as l4m from './l4m';

(function () {
  l4m.init();
}());