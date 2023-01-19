const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/scss/front/app.scss', 'public/css/front')
    .sass('resources/scss/admin/admin.scss','public/css/admin')
    .js('resources/js/admin/admin.js','public/js/admin')
    .js('resources/js/front/app.js','public/js/front')

