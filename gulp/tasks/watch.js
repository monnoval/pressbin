var dir = require('../config').dir;
var tpl = require('../config').tpl;

var gulp        = require('gulp');

gulp.task('watch', ['build'], function() {
  gulp.watch(dir.source+'scss/**/*.scss', ['core-css', 'core-css-all']);
  gulp.watch([dir.source+'js/**/*.js', dir.bower+'**/*.js'], ['core-js']);
  gulp.watch(dir.source+'**/*(*.png|*.jpg|*.jpeg|*.gif)', ['images']);
  gulp.watch(dir.source+'/*.php', ['php']);
  gulp.watch(dir.source+'/inc/*.php', ['php-inc']);
  gulp.watch(dir.source+'/languages/*.pot', ['languages']);

  gulp.watch(dir.source+tpl.home.dir+'/'+tpl.home.dir+'.scss', [tpl.home.dir+'-css']);
  gulp.watch(dir.source+tpl.home.dir+'/'+tpl.home.dir+'.js',   [tpl.home.dir+'-js']);
  gulp.watch(dir.source+tpl.home.dir+'/'+tpl.home.dir+'*.php', [tpl.home.dir+'-php']);

});
