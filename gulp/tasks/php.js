var gulp = require('gulp');
var dir = require('../config').dir;

gulp.task('php', function() {
  return gulp.src(dir.source+'/*.php')
  .pipe(gulp.dest(dir.build));
});
