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
    .sass('resources/sass/app.scss', 'public/css');

//custom
mix.js('resources/js/editor.js', 'public/js')
    .styles([
        'resources/css/custom-editor.css',
        'resources/css/custom-alert.css',
    ], 'public/css/style.css');
mix.postCss('resources/css/custom-admin.css', 'public/css');
mix.postCss('resources/css/font.css', 'public/css')
