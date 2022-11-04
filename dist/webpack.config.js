const path = require("path");

module.exports = {
  entry: {
    app: "./src/js/app.js",
  },
  output: {
    filename: "[name].[contenthash].js",
    path: path.resolve(__dirname, "resources/js"),
    clean: true,
  },
  devtool: "source-map",
};
