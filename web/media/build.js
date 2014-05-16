({
	// Directory to copy and minify
	appDir: './',
	// Base url for related paths
	baseUrl: './js',
	// Directory of the minified copied project
	dir: './build',
	// Remove comments
	preserveLicenseComments: false,
	// List of modules/divided parts of the app
	modules: [
		{
			name: 'main'
		}
	],
	// Exclude files
	fileExclusionRegExp: /^(r|build)\.js$/,
	// Optimize CSS files to base.css
	optimizeCss: 'standard',
	removeCombined: true,
	// Main Configuration
	mainConfigFile: 'js/main.js'
})