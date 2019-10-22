module.exports = {
  mode: 'development',
	entry: './assets/blocks/shop-page-wp-block-dev.js',
	output: {
		path: __dirname,
		filename: 'assets/blocks/shop-page-wp-block-build.js',
	},
	module: {
		rules: [
			{
				test: /.js$/,
        exclude: /node_modules/,
        use: [
          {
            loader: 'babel-loader'
          }
        ]
			},
		],
	},
};
