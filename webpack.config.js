var webpack = require('webpack');
var node_dir = __dirname + '/node_modules';

module.exports = {
  entry: './src/app.js',
  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
    })
  ],
  output: {
    path: __dirname + '/public/js',
    filename: 'bundle.js'
  },
  module: {
    rules: [{
      test: /\.css$/,
      loaders: [
        'style-loader',
        'css-loader'
      ]
    }]
  }
}