const mix = require('laravel-mix');
const path = require('path');
require('laravel-mix-tailwind');

mix.js('resources/js/app.js', 'public/js/app.js')
  .sass('resources/sass/app.scss', 'public/css/app.css')
  .tailwind('./tailwind.config.js')
  .webpackConfig({
    output: {
      chunkFilename: 'js/[name].js?id=[chunkhash]'
    },
    resolve: {
      alias: {
        '@': path.resolve('resources/js'),
      },
    },
  })
  .babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import'],
  });

if (mix.inProduction()) {
  mix.version();
} else {
  mix.sourceMaps();
}
