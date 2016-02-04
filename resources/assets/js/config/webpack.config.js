var webpack = require('webpack');

module.exports = {
    entry: {
        main: './resources/assets/js/main.js',
        vendor: ['vue', 'vue-resource']
    },
    output: {
        path: './public/js',
        filename: 'build.js'
    },
    module: {
        loaders: [
            {
                test: /\.vue$/,
                loaders: ['vue-loader']
            },
            {
                test: /\.js$/,
                loaders: ['babel-loader'],
                // make sure to exclude 3rd party code in node_modules
                exclude: /node_modules/
            }
        ]
    },
    // vue-loader config:
    // lint all JavaScript inside *.vue files with ESLint
    // make sure to adjust your .eslintrc
    vue: {
        loaders: {
            js: 'babel'
        }
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin(/* chunkName= */'vendor', /* filename= */'vendor.bundle.js')
    ]
};
