<?php
 $cDepart = 'WARD';
 $aDetail='��Һ�ԡ�÷ҧ��þ�Һ��';
 $cTitle="���ʤ�Һ�ԡ�÷ҧ��þ�Һ�ŷ����";
 session_register("cDepart");
 session_register("aDetail");
 session_register("cTitle");
?>
<frameset rows="13%,87%">
  <frame name="top" src="wardmenu.php" noresize scrolling="no">
<frameset cols="40%,60%">
  <frame name="left" src="labseek.php" scrolling="auto">
  <frame name="right" src="" scrolling="auto">
</frameset>
</frameset>


