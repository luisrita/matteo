var browserSync  	= require('browser-sync');
var config       	= require('../config/sass');
var gulp         	= require('gulp');
var handleErrors 	= require('../lib/handleErrors');
var autoprefixer 	= require('gulp-autoprefixer');
var sass         	= require('gulp-sass');
var cssnano				= require('gulp-cssnano');

gulp.task('sass', function () {
  return gulp.src(config.src)
    .pipe(sass(config.settings))
    .on('error', handleErrors)
    .pipe(autoprefixer(config.autoprefixer))
    .pipe(cssnano())
    .pipe(gulp.dest(config.dest))
    .pipe(browserSync.reload({stream:true}));
});
