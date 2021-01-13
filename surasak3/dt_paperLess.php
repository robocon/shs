<?php 
$hn = $_GET['hn'];
?>
<frameset cols="25%,75%">
  <frame name="left" src="dt_paperLessName.php?hn=<?=$hn;?>" scrolling="auto">
  <frame name="right" src="" scrolling="auto">
</frameset>