module.exports = {
	entry: './assets/blocks/shop-page-wp-block-dev.js',
	output: {
		path: __dirname,
		filename: 'assets/blocks/shop-page-wp-block-build.js',
	},
	module: {
		loaders: [
			{
				test: /.js$/,
				loader: 'babel-loader',
				exclude: /node_modules/,
			},
		],
	},
};
