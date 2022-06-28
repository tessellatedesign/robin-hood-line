const mix = require("laravel-mix");
mix.js("assets/js/bootstrap.js", "assets/js/javascript/")
mix.js("assets/js/functions.js", "assets/js/javascript/")

mix.sass("assets/scss/style.scss", "assets/scss/css/").options({
    processCssUrls: false
}).sourceMaps(true, 'source-map')


// mix.browserSync({
//     proxy: 'my-domain.test'
// });