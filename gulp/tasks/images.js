gulp.task('images', function() {
  return gulp.src(source+'**/*(*.png|*.jpg|*.jpeg|*.gif|*.ico)')
  .pipe(gulp.dest(build));
});