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
    .js('resources/js/script.js', 'public/js')
    .js('resources/js/menu-handler.js', 'public/js')
    .js('resources/js/notice-handler.js', 'public/js')
    .js('resources/js/menuItems.js', 'public/js')
    .js('resources/js/payment.js', 'public/js')
    .js('resources/js/option.js', 'public/js')
    .js('resources/js/order-handler.js', 'public/js')
    .js('resources/js/orderMain.js', 'public/js')
    .js('resources/js/welcome.js', 'public/js')
    .vue()
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])
    .sass('resources/sass/app.scss', 'public/css');

