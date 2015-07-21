var fname = require('../config').core.js.filename;
var js  = require('../config').core.js.js;

run_js_min_task(
    'core-js'
  , ['core-js-custom']
  , [build+'js/**/*.js', '!'+build+'js/**/*.min.js']
  , build+'js/'
);

run_js_task(
    'core-js-custom'
  , [source+'js/'+fname+'.js']
  , build+'js/'
  , fname
  , js
);
