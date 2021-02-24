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
  .extract({
    to: "vendor/common",
    test(mod) {
      const modules = ["axios", "lodash-es", "jquery", "vue"];
      const name = mod.nameForCondition();
      return (
        /resources\/assets\/js\/common\//.test(name) ||
        !!modules.find((moduleName) =>
          new RegExp(`/node_modules/${moduleName}/`).test(name)
        )
      );
    },
  })
  .vue({ version: 3 })

  // Quasar
  .js(__dirname + "/resources/assets/js/quasar/index.js", "js/quasar.js")
  .sass(
    __dirname + "/resources/assets/sass/quasar/index.scss",
    "css/quasar.css"
  )
  .extract(["quasar"], "vendor/quasar")

  // Bootstrap
  .js(__dirname + "/resources/assets/js/bootstrap/index.js", "js/bootstrap.js")
  .sass(
    __dirname + "/resources/assets/sass/bootstrap/index.scss",
    "css/bootstrap.css"
  )
  .extract([], "vendor/bootstrap")

  // Layui
  .js(__dirname + "/resources/assets/js/layui/index.js", "js/layui.js")
  .sass(__dirname + "/resources/assets/sass/layui/index.scss", "css/layui.css")
  .extract(["layui-src"], "vendor/layui");

if (!mix.inProduction()) {
  mix.sourceMaps();
}
