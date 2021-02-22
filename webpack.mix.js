const mix = require("laravel-mix");
let publicPath = "../public/backend";

if (__dirname.indexOf("/modules/") >= 0) {
  publicPath = "../../public/backend";
} else if (__dirname.indexOf("/vendor/") >= 0) {
  publicPath = "../../../public/backend";
}

mix.setPublicPath(publicPath);

mix
  .setResourceRoot("../") // set resource path to /backend/
  .sass(__dirname + "/resources/assets/sass/common.scss", "css/common.css")
  .extract(
    {
      to: "js/vendor",
      test(mod) {
        const modules = ["axios", "lodash-es"];
        const name = mod.nameForCondition();
        return (
          /resources\/assets\/js\/common\//.test(name) ||
          !!modules.find((moduleName) =>
            new RegExp(`/node_modules/${moduleName}/`).test(name)
          )
        );
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
      "quasar",
    ],
    "js/quasar-vendor"
  )

  .js(__dirname + "/resources/assets/js/bootstrap/index.js", "js/bootstrap.js")
  .sass(
    __dirname + "/resources/assets/sass/bootstrap/index.scss",
    "css/bootstrap.css"
  )
  .extract(
    [
      // Bootstrap Common
      "jquery",
    ],
    "js/bootstrap-vendor"
  );

if (!mix.inProduction()) {
  mix.sourceMaps();
}
