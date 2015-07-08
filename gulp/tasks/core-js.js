var gulp   = require('gulp')
  , concat = require('gulp-concat')
;
var fname = require('../config').core.js.filename;
var js  = require('../config').core.js.js;
var dir = require('../config').dir;
var fn  = require('../config').fn;


gulp.task('core-js', ['core-js-lint', 'core-js-custom'], function(){
  return gulp.src([dir.build+'js/**/*.js', '!'+dir.build+'js/**/*.min.js']) // Avoid recursive min.min.min.js
  .pipe(fn.js_min().on('error', fn.on_error))
  .pipe(gulp.dest(dir.build+'js/'));
});

// Disable linting for faster compile
//
// Lint scripts for errors and sub-optimal formatting
gulp.task('core-js-lint', function() {
  // return gulp.src([source+'js/**/*.js', '!'+source+'js/{fbcmsv2,fbcmsv2/**}'])
  // .pipe(plugins.jshint('.jshintrc'))
  // .pipe(plugins.jshint.reporter('default'));
});

// These are the core custom scripts loaded on every page; pass an array to bundle several scripts in order
gulp.task('core-js-custom', function() {

  var default_js = [ dir.source+'js/'+fname ];
  js.push.apply(js, default_js)

  return gulp.src(js)
  .pipe(concat(fname))
  .pipe(gulp.dest(dir.build+'js/'));
});
