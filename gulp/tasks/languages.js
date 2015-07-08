var gulp = require('gulp');
var dir = require('../config').dir;

gulp.task('languages', function() {
  return gulp.src(dir.source+dir.lang+'**/*')
  .pipe(gulp.dest(dir.build+dir.lang));
});