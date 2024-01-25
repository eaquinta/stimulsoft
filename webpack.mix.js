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

mix.js('resources/js/app.js', 'public/js')
    .scripts([
        'resources/js/aplication.js',
        'resources/js/jshelper.js'],               'public/js/site.js')
    .combine([
        'resources/css/aplication.css',
        'resources/css/common.css'],                'public/css/site.css')
    .copyDirectory('resources/css/crud', 'public/css/crud')
    .copyDirectory('resources/js/crud', 'public/js/crud')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
