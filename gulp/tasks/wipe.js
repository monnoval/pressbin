var gulp = require('gulp')
  , del         = require('del')
;
var dir = require('../config').dir;

gulp.task('wipe', ['clean'], function(cb) {
  del([dir.dist], cb)
});