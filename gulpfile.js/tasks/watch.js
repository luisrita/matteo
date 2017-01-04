var gulp        = require('gulp');
var sass        = require('../config/sass');
var images      = require('../config/images');
var svg      		= require('../config/svg');
var fonts       = require('../config/fonts');
var javascript  = require('../config/javascript');
var browserSync = require('browser-sync');
var watch       = require('gulp-watch');

gulp.task('watch', ['browserSync'], function () {
  watch(fonts.src, function() { gulp.start('fonts'); });
  watch(images.src, function() { gulp.start('images'); });
  watch(svg.src, function() { gulp.start('svg'); });
  watch(sass.watch, function() { gulp.start('sass'); });
  watch(javascript.src, function() { gulp.start('js'); });
});
