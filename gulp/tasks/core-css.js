var gulp        = require('gulp');

var dir = require('../config').dir;
var fn  = require('../config').fn;

gulp.task('core-css', function() {
  return gulp.src([dir.source+'scss/*.scss', '!'+dir.source+'scss/_*.scss']) // Ignore partials
    .pipe(fn.css_sass().on('error', fn.on_error))
    .pipe(gulp.dest(dir.build))
    .pipe(fn.css_min().on('error', fn.on_error))
    .pipe(gulp.dest(dir.build))
});


