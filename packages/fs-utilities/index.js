import fs from 'fs'
import path from 'path'

Array.prototype.forEachCallback = (callback, finishCallback) => {
	let current = 0
	let self = this

	const next = () => {
		if (!self) {
			console.log("Something went wrong...")
			throw('No self!')
			return
		}

		if (current >= self.length) {
			if (finishCallback) {
				var callback = finishCallback.bind(self)
				callback()
			}

			return
		}

		let currentItem = self[current++]
		let callback = callback.bind(currentItem)

		callback(currentItem, next)
	}

	next()
}

// Adapted from: http://lmws.net/making-directory-along-with-missing-parents-in-node-js
fs.mkdirParent = (dirPath, mode, callback) => {
	if (!callback && typeof(mode) == 'function') {
		callback = mode
		mode = 0o777
	}

	if (!mode) {
		mode = 0o777
	}

	// Call the standard fs.mkdir
	fs.mkdir(dirPath, mode, (error) => {
		// When it fail in this way, do the custom steps
		if (error && error.errno === 34) {
			// Create all the parents recursively
			fs.mkdirParent(path.dirname(dirPath), mode, callback)
			// And then the directory
			fs.mkdirParent(dirPath, mode, callback)
		}

		//Manually run the callback since we used our own callback to do all these
		callback && callback(error)
	})
}

// Adapted from: http://stackoverflow.com/a/14387791/488212
fs.copyFile = (source, destination, callback) => {
	let callbackCalled = false

	const rd = fs.createReadStream(source)

	rd.on('error', error => done(error))

	const wr = fs.createWriteStream(destination)

	wr.on('error', error => done(error))
	wr.on('close', () => done())

	rd.pipe(wr)

	function done (error) {
		if (!callbackCalled) {
			callbackCalled = true
			callback(error)
		}
	}
}

// Traverse filesystem (Async)
fs.traverse = (tPath, filecallback, callback) => {

	// Callback to invoke on each folder
	const traverse = (cPath, next) => {
		fs.readdir(cPath, (error, files) => {
			if (!files) {
				next()
				return
			}

			// Process each file
			files.forEachCallback((file, callback) => {
				var fn = path.join(cPath, file)

				fs.stat(fn, (error, stat) => {
					if (stat.isDirectory()) {
						traverse(fn, callback) // Recall ourselves if we found a directory
					} else {
						filecallback(fn) // Calls the file manipulator callback
						callback()
					}
				})
			}, next)
		})
	}

	// Starts with the given path
	traverse(tPath, callback)
}
