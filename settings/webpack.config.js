const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: './src/index.js', // Your entry point
    output: {
        path: path.resolve(__dirname, '../dist'), // Output directory
        filename: 'bundle.js', // Output file name
    },
    optimization: {
        minimize: true,
        minimizer: [
            new TerserPlugin(), // Minify JavaScript
            new CssMinimizerPlugin(), // Minify CSS
        ],
    },
    module: {
        rules: [
// Add loaders for JavaScript, CSS, etc.
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader, // Extracts CSS into separate files
                    'css-loader',  // Translates CSS into CommonJS
                    'sass-loader'  // Compiles Sass to CSS
                ],
            },
        ],
    },
    plugins: [
        // Plugin for extracting CSS into separate files
        new MiniCssExtractPlugin({
            filename: '[name].css'
        }),
    ],
};