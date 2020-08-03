const mix = require('laravel-mix');
const path = require('path');
require('laravel-mix-tailwind');

mix.js('resources/js/app.js', 'public/js/app.js')
  .sass('resources/sass/app.scss', 'public/css/app.css')
  .tailwind('./tailwind.config.js')
  .webpackConfig({
    resolve: {
      alias: {
        ziggy: path.resolve('vendor/tightenco/ziggy/src/js/route.js'),
      },
    },
  });

if (mix.inProduction()) {
  mix.version();
} else {
  mix.sourceMaps();
}
