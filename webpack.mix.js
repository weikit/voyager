const mix = require("laravel-mix");
let publicPath = "../public/backend";

if (__dirname.indexOf("/modules/") >= 0) {
  publicPath = "../../public/backend";
} else if (__dirname.indexOf("/vendor/") >= 0) {
  publicPath = "../../../public/backend";
}

mix.setPublicPath(publicPath);

mix
  .sass(__dirname + "/resources/assets/sass/common.scss", "css/common.css")
  .extract(
    {
      to: "js/vendor",
      test(mod) {
        return /common/.test(mod.nameForCondition());
      },
    },
    "js/vendor"
  )

  .js(__dirname + "/resources/assets/js/quasar/index.js", "js/quasar.js")
  .sass(
    __dirname + "/resources/assets/sass/quasar/index.scss",
    "css/quasar.css"
  )
  .vue({ version: 3 })
  .extract(
    [
      // Vue Common
      "vue",
      "axios",
      "quasar",
    ],
    "js/quasar-vendor"
  )

  .js(__dirname + "/resources/assets/js/bootstrap/index.js", "js/bootstrap.js")
  .sass(
    __dirname + "/resources/assets/sass/bootstrap/index.scss",
    "css/bootstrap.css"
  )
  .extract(["jquery"], "js/bootstrap-vendor");

if (!mix.inProduction()) {
  mix.sourceMaps();
}

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

mix;

// .js('resources/assets/js/app.js', 'publishable/assets/js')
// .vue({ version: 3 })
// .sass('resources/assets/sass/app.scss', 'publishable/assets/css')
// .copy('node_modules/tinymce/skins', 'publishable/assets/js/skins')
// .copy('resources/assets/js/skins', 'publishable/assets/js/skins')
// .copy('node_modules/tinymce/themes/modern', 'publishable/assets/js/themes/modern')
// .copy('node_modules/ace-builds/src-noconflict', 'publishable/assets/js/ace/libs');
