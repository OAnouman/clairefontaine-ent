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

mix.js(['resources/assets/js/app.js',

        'resources/assets/js/bootstrap-datepicker.min.js',

        'resources/assets/js/bootstrap-datepicker.fr.min.js',

        'resources/assets/js/bootstrap-tagsinput.min.js',

        'resources/assets/js/bootstrap-select.min.js',

        'resources/assets/js/defaults-fr_FR.js',

        'resources/assets/js/jquery.animateNumber.min.js',

        'resources/assets/js/bootstrap-filestyle.min.js',

        ],

    'public/js')

   .sass('resources/assets/sass/app.scss','public/css')

    .sass('resources/assets/sass/admin.scss', 'public/css')

    .sass('resources/assets/sass/teacher.scss', 'public/css')

    .sass('resources/assets/sass/parent.scss', 'public/css')

    .sass('resources/assets/sass/error.scss', 'public/css');
