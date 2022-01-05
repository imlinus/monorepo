import SiteGenerator from './../../tools/site-generator/source/index.js'

new SiteGenerator({
	root: 'source',
	style: 'css',
	pages: 'pages',
	build: 'build'
})
