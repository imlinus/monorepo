import SiteGenerator from './index.js'

SiteGenerator({
	root: "",
	pages: "pages",
	posts: "posts",
	destination: "dist",
	feed: {}
})

// destination folder relative to root (default is "dist")
// feed options (default is `{}`)