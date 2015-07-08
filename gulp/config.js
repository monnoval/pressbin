var project     = 'pressbin'
  , build       = './build/'
  , dist        = './dist/'
  , source      = './src/' // 'source' instead of 'src' to avoid confusion with gulp.src
  , lang        = 'languages/'
  , fonts       = 'fonts/'
  , bower       = './bower_components/'
;

var lazypipe     = require('lazypipe')
  , sass         = require('gulp-sass')
  , autoprefixer = require('gulp-autoprefixer')
  , rename       = require('gulp-rename')
  , minifyCss    = require('gulp-minify-css')
  , uglify       = require('gulp-uglify')
;

var css_sass = lazypipe()
  .pipe(sass, {includePaths: [bower, source+'scss'], errLogToConsole: true})
  .pipe(autoprefixer, 'last 2 versions', 'ie 9', 'ios 6', 'android 4');
var css_min = lazypipe()
  .pipe(rename, {suffix: '.min'})
  .pipe(minifyCss, { keepSpecialComments: 1 });
var js_min = lazypipe()
  .pipe(rename, {suffix: '.min'})
  .pipe(uglify);
var on_error = function(err) { console.log(err) }

var tpl = {
  home:     'tpl-home',
};

module.exports = {
  project: project,
  dir: {
    build:   build,
    dist:    dist,
    source:  source,
    lang:    lang,
    fonts:   fonts,
    bower:   bower,
  },
  fn: {
    css_sass: css_sass,
    css_min:  css_min,
    js_min:   js_min,
    on_error: on_error,
  },
  core: {
    js: { filename: 'core.js', js: [
      // bower+'codemirror/lib/codemirror.js',
      // bower+'codemirror/mode/xml/xml.js',
      // bower+'codemirror/mode/css/css.js',
      // bower+'codemirror/mode/javascript/javascript.js',
      // bower+'codemirror/mode/htmlmixed/htmlmixed.js',
      // bower+'layout/source/jquery/jquery-ui-1.11.0.js',
      // bower+'layout/source/stable/jquery.layout_and_plugins.js',
      // bower+'magnific-popup/dist/jquery.magnific-popup.js',
      bower+'bootstrap-sass/assets/javascripts/bootstrap/modal.js',
    ] },
  },
  tpl: {
    home:          { dir: tpl.home, js: [] },
  },
};
