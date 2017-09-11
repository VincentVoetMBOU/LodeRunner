<?php
	// session_start();
    if(!isset($_SESSION['id'])){
        echo '<meta http-equiv="refresh" content="0; url=/" />';
        //echo '<script>window.location.href="/user/'.$_SESSION['username'].'"</script>';
        die();
    }
?>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Unity WebGL Player | Lode Runner</title>
    <link rel="stylesheet" href="TemplateData/style.css">
    <link rel="shortcut icon" href="TemplateData/favicon.ico" />
    <script src="TemplateData/UnityProgress.js"></script>
  </head>
  <body class="template">
    <div class="template-wrap clear">
      <canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault()" height="600px" width="960px"></canvas>
      <br>
      <div class="logo"></div>
      <div class="fullscreen"><img src="TemplateData/fullscreen.png" width="38" height="38" alt="Fullscreen" title="Fullscreen" onclick="SetFullscreen(1);" /></div>
      <div class="title">Lode Runner</div>
    </div>
    <script type='text/javascript'>
  var Module = {
    TOTAL_MEMORY: 268435456,
    errorhandler: null,			// arguments: err, url, line. This function must return 'true' if the error is handled, otherwise 'false'
    compatibilitycheck: null,
    backgroundColor: "#222C36",
    splashStyle: "Light",
    dataUrl: "Release/Release.data",
    codeUrl: "Release/Release.js",
    asmUrl: "Release/Release.asm.js",
    memUrl: "Release/Release.mem",
  };
</script>
<script src="Release/UnityLoader.js"></script>
    <script>
        onkeydown = function(e){
            if((e.ctrlKey && e.keyCode == 'O'.charCodeAt(0)) || (e.ctrlKey && e.keyCode == 'T'.charCodeAt(0)) || (e.ctrlKey && e.keyCode == 187) || (e.ctrlKey && e.keyCode == 189)) {
                e.preventDefault();
            }
        }
    </script>
  </body>
</html>
