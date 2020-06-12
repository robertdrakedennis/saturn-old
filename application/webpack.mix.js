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
mix.setPublicPath('..');

// Default Bootstrap
mix.js('resources/assets/js/bootstrap.js', 'js/bootstrap.js')
    .sass('resources/assets/sass/bootstrap-reboot.scss', 'css/bootstrap-reboot.css')
    .sass('resources/assets/sass/bootstrap-grid.scss', 'css/bootstrap-grid.css')
    .sass('resources/assets/sass/bootstrap.scss', 'css/bootstrap.css');

//Materialize Bootstrap
mix.js('resources/assets/js/bootstrap-material-design.min.js', 'js/bootstrap-material.js');
//    .sass('resources/assets/sass/themes/material_bootstrap/material.scss', 'public/css/bootstrap-material.css');

// JQUERY
mix.scripts('resources/assets/js/jquery.js', 'js/jquery.js');

//Animate css library

mix.styles('resources/assets/css/animate.css', 'css/animate.css');

// Sweet alert 2
mix.scripts('resources/assets/js/sweetalert2.all.min.js', 'js/swal.js')
    .styles('resources/assets/css/sweetalert2.min.css', 'css/swal.css');

//Font Awesome
mix.styles('resources/assets/css/all.min.css', 'css/fa.css');

// Spectrum (color picker)
mix.styles('resources/assets/css/spectrum.css', 'css/spectrum.css')
    .scripts('resources/assets/js/spectrum.js', 'js/spectrum.js');

// Theme: Admin Assets
mix.babel([
    'resources/assets/js/themes/admin/admin.js',
    'resources/assets/js/themes/admin/general.js'
], 'js/argon.js')

    .sass('resources/assets/sass/themes/admin/app.scss', 'css/argon.css');


mix.sass('resources/assets/sass/themes/orion/app.scss', 'css/orion/app.css');


mix.sass('resources/assets/sass/themes/lunar_index/app.scss', 'css/lunar_index/app.css');

if (mix.inProduction()) {
    mix.version();
}

// Theme: EXAMPLE
// mix.scripts('resources/assets/js/themes/YOURTHEMENAMEEXACTLY/app.js', 'public/admin/js/YOURTHEMENAMEEXACTLY.js')
//  .sass('resources/assets/sass/themes/YOURTHEMENAMEEXACTLY/app.scss', 'public/test/css/YOURTHEMENAMEEXACTLY.css');
