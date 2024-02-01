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
mix.js('resources/js/admin/setting.js', 'public/js/admin');
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/web/home.js', 'public/js/web')
    .extract([
        'jquery',
        'bootstrap',
        'sweetalert2',
        'slick-carousel',
        'owl.carousel',
        'mmenu-js',
        'vanilla-lazyload'
    ]).webpackConfig(webpack => {
        return {
            plugins: [
                new webpack.ProvidePlugin({
                    $: 'jquery',
                    jQuery: 'jquery',
                    'window.jQuery': 'jquery'
                })
            ]
        };
    })
    .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js').sourceMaps().version();
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
