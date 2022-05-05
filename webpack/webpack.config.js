const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const CopyPlugin = require( 'copy-webpack-plugin' );

module.exports = {
    entry: './src/index.js',

    output: {
        filename: 'main.js',
        path: path.resolve( __dirname, '../assets' ),
        clean: true
    },

    plugins: [
        new MiniCssExtractPlugin( {
            filename: './css/main.css'
        } ),
        new CopyPlugin( {
            patterns: [
                {
                    from: 'src/vendor',
                    to: 'vendor',
                    noErrorOnMissing: true
                },
                {
                    from: 'src/img',
                    to: 'img'
                }
            ],
        } )
    ],

    module: {
        rules: [
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
                exclude: path.resolve( __dirname, '../', 'webpack/src/fonts/'),
                generator: {
                    filename: 'img/[name][ext]'
                }
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf|svg)$/i,
                type: 'asset/resource',
                exclude: path.resolve( __dirname, '../', 'webpack/src/img/'),
                generator: {
                    filename: 'fonts/[name][ext]'
                }
            },
            {
                test: /\.s[ac]ss$/i,
                use: [ MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader' ],
            }
        ]
    }
};