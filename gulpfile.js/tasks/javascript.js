var gulp            = require('gulp');
var concat          = require('gulp-concat');
var uglify          = require('gulp-uglify');
var handleErrors    = require('../lib/error-handling');
var config          = require('../config/javascript');
var browserSync     = require('browser-sync');

gulp.task('js', function () {
  return gulp.src(config.src)
    .pipe(concat('main.min.js'))
    //.pipe(uglify())
    .pipe(gulp.dest(config.dest))
    .pipe(browserSync.reload({stream: true}));
});