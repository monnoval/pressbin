var gulp   = require('gulp')
  , concat = require('gulp-concat')
;
var tpl = require('../config').tpl.home.dir;
var js  = require('../config').tpl.home.js;
var dir = require('../config').dir;
var fn  = require('../config').fn;


gulp.task(tpl+'-css', function() {
  return gulp.src([dir.source+tpl+'/'+tpl+'.scss', '!'+dir.source+tpl+'/_*.scss']) // Ignore partials
    .pipe(fn.css_sass().on('error', fn.on_error))
    .pipe(gulp.dest(dir.build+ tpl))
    .pipe(fn.css_min().on('error', fn.on_error))
    .pipe(gulp.dest(dir.build+ tpl))
});

gulp.task(tpl+'-js', [tpl+'-js-core'], function() {
  return gulp.src([dir.build+ tpl +'/*.js', '!'+dir.build+ tpl +'/*.min.js'])
    .pipe(fn.js_min().on('error', fn.on_error))
    .pipe(gulp.dest(dir.build+ tpl +'/'));
});


gulp.task(tpl+'-js-core', function(){

  var default_js = [ dir.source+ tpl +'/'+ tpl +'.js' ];
  js.push.apply(js, default_js)

  return gulp.src(js)
    .pipe(concat( tpl +'.js'))
    .pipe(gulp.dest(dir.build+ tpl ));
});

gulp.task(tpl+'-php', function() {
  return gulp.src(dir.source+tpl+'/'+tpl+'*.php')
  .pipe(gulp.dest(dir.build+ tpl));
});

