<?php
session_start();
session_destroy();
include("connect.inc");

$_SESSION = array();

setcookie('shsLogin', '', -1, '/');
setcookie('shsLoginUser', '', -1, '/');
?>
<script language="JavaScript1.2">
  window.moveTo(0, 0);
  if (document.all) {
    top.window.resizeTo(screen.availWidth, screen.availHeight);
  } else if (document.layers || document.getElementById) {
    if (top.window.outerHeight < screen.availHeight || top.window.outerWidth < screen.availWidth) {
      top.window.outerHeight = screen.availHeight;
      top.window.outerWidth = screen.availWidth;
    }
  }
  if (top && top.frames["main"]) {
    top.frames["main"].location.reload(); // รีเฟรชเฉพาะ frame 'main'
  }
</script>
<?php
$sRowid = $_GET["user_id"];
mysql_query("UPDATE `inputm` SET `login_status`=0 WHERE (`row_id`='$sRowid');");
?>
<frameset framespacing="0" border="0" cols="270,*" frameborder="0">
  <frameset rows="120,*">
    <frame name="contents" target="main" src="banner.htm" marginwidth="0" marginheight="0" scrolling="no" noresize>
      <frame name="contents1" src="surasak3/login.php" marginwidth="0" marginheight="0" scrolling="yes" target="_self" noresize>
  </frameset>
  <frame name="main" src="display.php" id="mainDisplayPage" marginwidth="0" marginheight="0" scrolling="yes" target="_self">
    <noframes>
      <body>
        <p>This page uses frames, but your browser doesn't support them.</p>
      </body>
    </noframes>
</frameset>