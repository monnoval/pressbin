setup_tasks_for_build = function() {
  for(var index in tpl) {
    var attr = tpl[index];
    var tpl_tasks = [
      attr.dir+'-css'
    , attr.dir+'-js'
    , attr.dir+'-php'
    ];
    tasks.push.apply(tasks, tpl_tasks)
  }
  console.log( tasks );
};
setup_tasks_for_build();

gulp.task('build', tasks);
