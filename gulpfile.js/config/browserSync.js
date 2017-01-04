var config = require('./');

module.exports = {
	proxy: 'localhost/matteo', //add your site URL
	files: ['./assets/**', './*.php'],
	notify: true,
	port: 5001
};