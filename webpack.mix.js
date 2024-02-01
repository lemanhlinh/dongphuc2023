const mix = require('laravel-mix');
require('laravel-mix-purgecss');


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
    .js('resources/js/web/main.js', 'public/js/web')
    .js('resources/js/admin/setting.js', 'public/js/admin');
mix.sass('resources/sass/home.scss', 'public/css/web')
    .sass('resources/sass/content.scss', 'public/css/web')
    .sass('resources/sass/contact.scss', 'public/css/web')
    .sass('resources/sass/article-list.scss', 'public/css/web')
    .sass('resources/sass/article-detail.scss', 'public/css/web')
    .sass('resources/sass/product-cat.scss', 'public/css/web')
    .sass('resources/sass/product-detail.scss', 'public/css/web')
    .sass('resources/sass/cart-checkout.scss', 'public/css/web')
    .purgeCss({
        enabled: true,
    })
    .sourceMaps().version();
