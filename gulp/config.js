var project = 'pressbin'
  , source  = './src/'
  , bower   = './bower_components/'
  , build   = './build/'
  , proxy   = 'fbpatternlab.dev'
;

module.exports = {
  project: project,
  source:  source,
  bower:   bower,
  build:   build,
  proxy:   proxy,
  tasks: [ 'core-css'
         , 'core-js'
         , 'images'
         , 'languages'
         , 'fonts'
         , 'php'
         , 'php-inc'
         , 'php-code' ],
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
    home:          { dir: 'tpl-home', js: [] },
  },
};
