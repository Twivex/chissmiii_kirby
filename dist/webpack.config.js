const path = require('path');

module.exports = {
  entry: [
    './src/js/_bootstrap.js',
    './src/js/app.js',
  ],
  output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'resources/js')
  }
}