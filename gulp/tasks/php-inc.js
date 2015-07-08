var gulp = require('gulp');
var dir = require('../config').dir;

gulp.task('php-inc', function() {
  return gulp.src(dir.source+'/inc/*.php')
  .pipe(gulp.dest(dir.build+'/inc/'));
});
