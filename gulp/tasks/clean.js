var gulp = require('gulp')
  , del  = require('del')
;
var dir = require('../config').dir;

gulp.task('clean', ['build'], function(cb) {
  del([dir.build+'**/.DS_Store'], cb)
});