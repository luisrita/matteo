var gulp         = require('gulp');
var gulpSequence = require('gulp-sequence');

gulp.task('default', function(cb) {
  gulpSequence(
  	'clean', 
  	['fonts', 'images', 'svg'], 
  	['sass', 'js'], 
  	['watch', 'browserSync'], 
  	cb
  );
});