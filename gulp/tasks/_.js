gulp        = require('gulp');
concat      = require('gulp-concat');
browserSync = require('browser-sync').create();
source      = require('../config').source;
build       = require('../config').build;
bower       = require('../config').bower;
tpl         = require('../config').tpl;
tasks       = require('../config').tasks;


tpl_watch = function( dir ) {
  tpl_php( dir );
  tpl_scripts( dir );
};

tpl_scripts = function( dir ) {
  gulp.watch(source+dir+'/'+dir+'.scss', [dir+'-css']);
  gulp.watch(source+dir+'/'+dir+'.js',   [dir+'-js']);
};

tpl_php = function( dir ) {
  gulp.watch(source+dir+'/'+dir+'*.php', [dir+'-php']);
};

tpl_list = function( type_of_watch ) {
  // console.log(' ------------------------------------------------');
  for(var index in tpl) {
    var attr = tpl[index];

    if ( type_of_watch == 'scripts' ) {
      tpl_scripts( attr.dir );
      console.log( '[scripts] ' + attr.dir );
    }
    else if ( type_of_watch == 'all' ) {
      tpl_watch( attr.dir );
      console.log( '[all] ' + attr.dir );
    }

  }
  // console.log(' ------------------------------------------------');
};

lazypipe     = require('lazypipe');
sass         = require('gulp-sass');
autoprefixer = require('gulp-autoprefixer');
rename       = require('gulp-rename');
minifyCss    = require('gulp-minify-css');
uglify       = require('gulp-uglify');

css_sass = lazypipe()
  .pipe(sass, {includePaths: [bower, source+'scss'], errLogToConsole: true})
  .pipe(autoprefixer, 'last 2 versions', 'ie 9', 'ios 6', 'android 4');
css_min = lazypipe()
  .pipe(rename, {suffix: '.min'})
  .pipe(minifyCss, { keepSpecialComments: 1 });
js_min = lazypipe()
  .pipe(rename, {suffix: '.min'})
  .pipe(uglify);
on_error = function(err) { console.log(err) }

run_css_task = function( name, src, dest ) {
  gulp.task(name, function() {
    return gulp.src(src) // Ignore partials
      .pipe(css_sass().on('error', on_error))
      .pipe(gulp.dest(dest))
      .pipe(css_min().on('error', on_error))
      .pipe(gulp.dest(dest))
      .pipe(browserSync.stream());
  });
};

run_js_min_task = function( name, deps, src, dest ) {
  gulp.task(name, deps, function() {
    return gulp.src(src)
      .pipe(js_min().on('error', on_error))
      .pipe(gulp.dest(dest))
      .pipe(browserSync.stream());
  });
};

run_js_task = function( name, src, dest, dir, js ) {
  gulp.task(name, function(){
    var default_js = src;
    js.push.apply(js, default_js);

    return gulp.src(js)
      .pipe(concat( dir +'.js'))
      .pipe(gulp.dest(dest));
  });
};

run_php_task = function( name, src, dest ) {
  gulp.task(name, function() {
    return gulp.src( src + '*.php' )
    .pipe(gulp.dest( dest ));
  });
};

run_tpl_task = function() {

  for(var index in tpl) {
    var template = tpl[index]
      , dir = template.dir
      , js  = template.js
      ;

    run_css_task(
        dir+'-css'
      , [source+dir+'/'+dir+'.scss', '!'+source+dir+'/_*.scss']
      , build+ dir
    );

    run_js_min_task(
        dir+'-js'
      , [dir+'-js-core']
      , [build+ dir +'/*.js', '!'+build+ dir +'/*.min.js']
      , build+ dir +'/'
    );

    run_js_task(
        dir+'-js-core'
      , [source+ dir +'/'+ dir +'.js']
      , build+ dir
      , dir
      , js
    );

    run_php_task(
        dir+'-php'
      , source+dir+'/'+dir
      , build+ dir
    );

  }

};
run_tpl_task();