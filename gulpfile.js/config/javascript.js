var config = require('./');
var assets = [
		//'vendor/jquery/dist/jquery.min.js',
		//'vendor/jquery-gallerybox-master/jquery.gallerybox.js',
    'js/controls/*.js',
    'js/main.js',
    'js/utils.js'
];

module.exports = {
  src : assets.map(function(asset) {
    return config.sourceAssets + '/' + asset;
  }),
  dest: config.publicAssets + '/javascript'
};