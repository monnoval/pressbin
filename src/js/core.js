var myLayout;

$(document).ready(function () {
  if( $( 'body' ).hasClass( 'single' ) ) {
    myLayout = $('body').layout({
        applyDemoStyles:  true
      , north__resizable: false
      , north__closable:  false
      , north__spacing_open: 0
      , west__initClosed: true
      , west__spacing_closed: 0
      , east__size:      .4
      , east__minSize:   .25
      , east__maxSize:   .6
      , center__maskIframesOnResize: true
    });
  }

  if ( document.getElementById( "js__code__panel" ) != null )
    innerLayout = $("#js__code__panel").layout( layoutSettings_Inner );

  if ( document.getElementById( "js__code--html" ) != null )
    editor('js__code--html', 'text/html');
  if ( document.getElementById( "js__code--css" ) != null )
    editor('js__code--css',  'css');
  if ( document.getElementById( "js__code--js" ) != null )
    editor('js__code--js',   'javascript');

});

function editor(id, mode) {
  CodeMirror.fromTextArea(document.getElementById(id), {
    viewportMargin: Infinity,
    theme: "default",
    mode:  mode,
    lineNumbers: true,
    readOnly:true,
    autoClearEmptyLines: true,
    lineWrapping: true,
  });
}
