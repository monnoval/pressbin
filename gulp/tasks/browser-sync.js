var project = require('../config').project
  , proxy   = require('../config').proxy
;


gulp.task('browser-sync', ['build'], function() {

  browserSync.init({
    proxy: proxy,
    browser: ["google chrome"]
  });

  gulp.watch(source+'scss/*.scss', ['core-css']);
  gulp.watch(source+"**/*.php").on("change", browserSync.reload);

  tpl_list( 'scripts' );

});