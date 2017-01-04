var config = require('../config/svg');
var gulp = require('gulp');
var svgmin = require('gulp-svgmin');
var browserSync = require('browser-sync');

gulp.task('svg', function() {
  return gulp.src(config.src)
    .pipe(svgmin({ cleanupNumericValues: { floatPrecision: 1 } }))
    .pipe(gulp.dest(config.dest))
    .pipe(browserSync.reload({ stream:true }));
});