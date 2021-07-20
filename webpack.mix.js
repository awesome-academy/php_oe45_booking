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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])

mix.styles('resources/assets/template/css/style.css', 'public/assets/template/css/style.css');
mix.styles('resources/assets/template/css/style2.css', 'public/assets/template/css/style2.css');
mix.styles('resources/assets/template/css/custom-heart.css', 'public/assets/template/css/custom-heart.css');
mix.styles('resources/assets/template/css/header.css', 'public/assets/template/css/header.css');
mix.styles('resources/assets/template/css/sb-admin-2.css', 'public/assets/template/css/sb-admin-2.css');
mix.styles('resources/assets/template/css/superfish.css', 'public/assets/template/css/superfish.css');
mix.styles('resources/assets/template/css/bookingForm.css', 'public/assets/template/css/bookingForm.css');
mix.styles('resources/assets/template/css/create-tour.css', 'public/assets/template/css/create-tour.css');
mix.styles('resources/assets/template/css/bootstrap.css', 'public/assets/template/css/bootstrap.css');
mix.styles('resources/assets/template/css/sb-admin-2.css', 'public/assets/template/css/sb-admin-2.css');
mix.styles('resources/assets/template/css/user_profile.css', 'public/assets/template/css/user_profile.css');
// mix.styles('resources/assets/system/css/tour.css', 'public/assets/system/css/tour.css');

mix.js('resources/assets/template/js/superfish.js', 'public/assets/template/js/superfish.js');
mix.js('resources/assets/template/js/hoverIntent.js', 'public/assets/template/js/hoverIntent.js');
mix.js('resources/assets/template/js/sb-admin-2.min.js', 'public/assets/template/js/sb-admin-2.min.js');
mix.js('resources/assets/template/js/main.js', 'public/assets/template/js/main.js');
mix.js('resources/assets/template/js/modernizr-2.6.2.min.js', 'public/assets/template/js/modernizr-2.6.2.min.js');
