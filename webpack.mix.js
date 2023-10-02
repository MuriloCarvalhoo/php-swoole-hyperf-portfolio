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

mix.js('storage/js/app.js', 'public/js')
    .vue()

    .sass('storage/sass/app.scss', 'public/css')

    .styles([
        'storage/css/app.css',
    ],"public/css/app.css")


    .styles([
        'storage/css/matrix-tema.css',
    ],"public/css/matrix-tema.css")


    // .sourceMaps()
    // .browserSync('localhost:3000')
    .disableSuccessNotifications();
    mix.webpackConfig({
        output: {
            publicPath: `${process.env.MIX_BASE_URL}/public/`,
            chunkFilename: `public/js/[name].js?id=[chunkhash]`,
        },
    });