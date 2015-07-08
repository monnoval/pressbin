var gulp    = require('gulp')
  , concat  = require('gulp-concat')
  , folders = require('gulp-folders')
  , path    = require('path')
;
var dir = require('../config').dir;
var fn  = require('../config').fn;


gulp.task('core-css-all', folders(dir.source, function(folder){
  return gulp.src(path.join(dir.source, folder, folder+'.scss'))
    .pipe(fn.css_sass().on('error', fn.on_error))
    .pipe(concat(folder + '.css'))
    .pipe(gulp.dest(dir.build + folder))
    .pipe(concat(folder + '.css')) // concat first before rename + minify
    .pipe(fn.css_min().on('error', fn.on_error))
    .pipe(gulp.dest(dir.build + folder));
}));

