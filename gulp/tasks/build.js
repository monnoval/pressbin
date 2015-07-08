var gulp = require('gulp');
var tpl = require('../config').tpl;


gulp.task( 'build',
  [ 'core-css'
  , 'core-js'
  , 'images'
  , 'languages'
  , 'fonts'
  , 'php'
  , 'php-inc'

  , tpl.home.dir+'-css'
  , tpl.home.dir+'-js'
  , tpl.home.dir+'-php'

  ] );
