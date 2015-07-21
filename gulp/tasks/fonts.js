var fonts = 'fonts/';

gulp.task('fonts', function() {
  return gulp.src(source+fonts+'**/*')
  .pipe(gulp.dest(build+fonts));
});