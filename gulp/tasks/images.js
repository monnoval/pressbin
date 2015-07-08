var gulp = require('gulp');
var dir = require('../config').dir;

gulp.task('images', function() {
  return gulp.src(dir.source+'**/*(*.png|*.jpg|*.jpeg|*.gif|*.ico)')
  .pipe(gulp.dest(dir.build));
});