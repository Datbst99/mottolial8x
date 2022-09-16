const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.sass('resources/assets/sass/style.scss', 'public/assets/css')
    .copy('resources/assets/fonts', 'public/assets/fonts')
    .copy('resources/assets/images', 'public/assets/images')
    .copy('resources/assets/vendors', 'public/assets/vendors')
    .copy('resources/assets/js', 'public/assets/js')
