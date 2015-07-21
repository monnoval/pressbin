gulp.task('watch', ['browser-sync'], function() {

  gulp.watch(source+'scss/**/*.scss', ['core-css', 'core-css-all']);
  gulp.watch([source+'js/**/*.js', bower+'**/*.js'], ['core-js']);
  gulp.watch(source+'**/*(*.png|*.jpg|*.jpeg|*.gif)', ['images']);
  gulp.watch(source+'/*.php', ['php']);
  gulp.watch(source+'/inc/*.php', ['php-inc']);
  gulp.watch(source+'/languages/*.pot', ['languages']);

  tpl_list( 'all' );

});
