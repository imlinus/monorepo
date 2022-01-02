import SiteGenerator from './index.js'

new SiteGenerator({
	root: "",
	pages: "pages",
	posts: "posts",
	destination: "dist",
	feed: {}
})

// destination folder relative to root (default is "dist")
// feed options (default is `{}`)