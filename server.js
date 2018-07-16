/**
 * @license
 * Everything in this repo is MIT License unless otherwise specified.
 *
 * Copyright (c) Addy Osmani, Sindre Sorhus, Pascal Hartig, Stephen  Sawchuk, Google, Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

	// set up ========================
	var express  = require('express');
	var app      = express(); 								// create our app w/ express
	var mongoose = require('mongoose'); 					// mongoose for mongodb
	var morgan = require('morgan'); 			// log requests to the console (express4)
	var bodyParser = require('body-parser'); 	// pull information from HTML POST (express4)
	var methodOverride = require('method-override'); // simulate DELETE and PUT (express4)
	var argv = require('optimist').argv;

	// configuration =================

	mongoose.connect('mongodb://' + argv.be_ip + ':80/my_database');

	app.use('/js', express.static(__dirname + '/js'));
	app.use('/css', express.static(__dirname + '/css'));
   	app.use('/bower_components', express.static(__dirname + '/bower_components'));
	app.use(morgan('dev')); 										// log every request to the console
	app.use(bodyParser.urlencoded({'extended':'true'})); 			// parse application/x-www-form-urlencoded
	app.use(bodyParser.json()); 									// parse application/json
	app.use(bodyParser.json({ type: 'application/vnd.api+json' })); // parse application/vnd.api+json as json
	app.use(methodOverride());

	// define model =================
// 	var Bookmark = mongoose.model('Bookmark', {
// 		title : String,
// 		completed: Boolean
// 	});

	var Bookmark = mongoose.model('Bookmark', {
		url: String,
		description: String,
		tags: Array,
		snippet: String
	});

	// routes ======================================================================

	// api ---------------------------------------------------------------------
	// get all bookmarks
	app.get('/api/bookmarks', function(req, res) {

		// use mongoose to get all bookmarks in the database
		Bookmark.find(function(err, bookmarks) {

			// if there is an error retrieving, send the error. nothing after res.send(err) will execute
			if (err)
				res.send(err)

			res.json(bookmarks); // return all bookmarks in JSON format
		});
	});

	// create bookmark and send back all bookmarks after creation
	app.post('/api/bookmarks', function(req, res) {

		// create a bookmark, information comes from AJAX request from Angular
		Bookmark.create({
			url: req.body.url,
			description: req.body.description,
			tags: req.body.tags,
			snippet: req.body.snippet
		}, function(err, bookmark) {
			if (err)
				res.send(err);

			// get and return all the bookmarks after you create another
			Bookmark.find(function(err, bookmarks) {
				if (err)
					res.send(err)

				bookmarks.push(req.body)
				res.json(req.body);
			});
		});

	});

	app.put('/api/bookmarks/:bookmark_id', function(req, res){
	  return Bookmark.findById(req.params.bookmark_id, function(err, bookmark) {

	    bookmark.url = req.body.url,
	    bookmark.description = req.body.description,
	    bookmark.tags = req.body.tags,
	    bookmark.snippet = req.body.snippet
	    return bookmark.save(function(err) {
	      if (err) {
	        res.send(err);
	      }
	      return res.send(bookmark);
	    });
	  });
	});

	// delete a bookmark
	app.delete('/api/bookmarks/:bookmark_id', function(req, res) {
		Bookmark.remove({
			_id : req.params.bookmark_id
		}, function(err, bookmark) {
			if (err)
				res.send(err);

			// get and return all the bookmarks after you create another
			Bookmark.find(function(err, bookmarks) {
				if (err)
					res.send(err)
				res.json(bookmarks);
			});
		});
	});

	// application -------------------------------------------------------------
	app.get('/', function(req, res) {
		res.sendfile('index.html'); // load the single view file (angular will handle the page changes on the front-end)
	});

	// listen (start app with node server.js) ======================================
	app.listen(80, argv.fe_ip);
	console.log("App listening on port 80");
