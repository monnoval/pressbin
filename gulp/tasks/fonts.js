var gulp = require('gulp');
var dir = require('../config').dir;

gulp.task('fonts', function() {
  return gulp.src(dir.source+dir.fonts+'**/*')
  .pipe(gulp.dest(dir.build+dir.fonts));
});