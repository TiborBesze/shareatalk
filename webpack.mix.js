let mix = require('laravel-mix');

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

mix.scripts([
    'resources/assets/js/jquery.min.js',
    'resources/assets/js/bootstrap.min.js',
    'resources/assets/js/app.js'
], 'public/js/shareatalk.js')
.styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/app.css'
], 'public/css/shareatalk.css')
.version();
