var gulp   = require('gulp')
  , filter = require('gulp-filter')
  , del    = require('del')
;
var dir = require('../config').dir;
var project = require('../config').project;


gulp.task('package', ['wipe'], function() {

  // Define filters
  var styleFilter = filter(['**/*.css', '!**/*.min.css'])
    , imageFilter = filter(['**/*.png', '**/*.jpg', '**/*.jpeg', '**/*.gif', '!screenshot.png'])
  ;

  // Take everything in the build folder
  return gulp.src([dir.build+'**/*', '!'+dir.build+'**/*.min.css'])

  // Compress existing stylesheets rather than duplicating previously compressed copies
  .pipe(styleFilter)
  .pipe(plugins.minifyCss({ keepSpecialComments: 1 }))
  .pipe(styleFilter.restore())

  // Compress images; @TODO: cache this
  // .pipe(imageFilter)
  // .pipe(plugins.imagemin({
  //   optimizationLevel: 7
  // , progressive: true
  // , interlaced: true
  // }))
  // .pipe(imageFilter.restore())

  // Send everything to the `dist/project` folder
  .pipe(gulp.dest(dir.dist+project+'/'));
});