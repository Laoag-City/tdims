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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .scripts('resources/assets/js/custom/js/add_tricycle_driver.js', 'public/js/add_tricycle_driver.js')
   .scripts('resources/assets/js/custom/js/driver_list.js', 'public/js/driver_list.js')
   .scripts('resources/assets/js/custom/js/user_management.js', 'public/js/user_management.js')
   .scripts('resources/assets/js/custom/js/font_awesome_icons.js', 'public/js/font_awesome_icons.js')
   .version();
