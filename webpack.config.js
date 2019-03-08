const path = require('path');
const webpack = require('webpack');

const VueLoaderPlugin = require('vue-loader/lib/plugin');

var config = {
  entry: './assets/js/main.js',
  output: {
    path: path.resolve(__dirname, './assets/js'),
    filename: 'build.js'
  },
  mode: 'development',
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          loaders: {
            scss: [
              'vue-style-loader',
              'css-loader',
              'sass-loader'
            ]
          }
        }
      },
      {
        test: /\.css$/,
        use: [
          'vue-style-loader',
          'css-loader'
        ],
        exclude: [
          path.resolve(__dirname, './assets/css'),
          path.resolve(__dirname, './_sass'),
        ]
      }
    ]
  },
  resolve: {
    alias: {
      vue$: 'vue/dist/vue.esm.js'
    },
    extensions: [
      '.js',
      '.vue',
      '.json'
    ]
  },
  plugins: [
    new VueLoaderPlugin()
  ]
}

if (process.env.NODE_ENV === 'production') {
  config.mode = 'production'
}

module.exports = config;
