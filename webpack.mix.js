let mix = require('laravel-mix');
require('laravel-mix-purgecss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
    processCssUrls: false // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
});

mix.js('resources/assets/js/app.js', 'public/js')
  .js('resources/assets/client/js/index.js', 'public/themes/l4m/js')
  .js('resources/assets/client/js/image-processor.js', 'public/themes/l4m/js')
  .js('resources/assets/client/js/chunks/product.js', 'public/themes/l4m/js')
  .js('resources/assets/client/js/chunks/shop.js', 'public/themes/l4m/js');

mix.sass('resources/assets/sass/app.scss', 'public/css')
  .sass('resources/assets/client/scss/main.scss', 'public/themes/l4m/css')
  .options({
    postCss: [
      require('autoprefixer')({
        "browsers": [
          "> 1%",
          "last 2 versions",
          "IE 10"
        ]
      })
    ]
  })
  // .purgeCss();
