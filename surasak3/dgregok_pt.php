<?php
include("connect.inc");
/*
  date   comcode   comname   drugcode  tradname  genname   unit  part   bcode
*/

      $sql = "INSERT INTO druglst_pt(date,comcode,comname,drugcode,
	tradname,genname,unit,part,bcode)VALUES(now(),'$comcode',
               '$comname','".trim($drugcode)."','$tradname','$genname','$unit','$part','$bcode');";
      $result = mysql_query($sql);
if ($result){
        print "���ʺ���ѷ   :$comcode<br>";
        print "���ͺ���ѷ    :$comname<br>";
        print "������       :$drugcode<br>";
        print "���͡�ä��    :$tradname<br>";
        print "�������ѭ   :$genname<br>";
        print "˹��¹Ѻ   :$unit<br>";
        print "part         :$part<br>";
        print "bcode     :$bcode<br>";
        print "�ѹ�֡���������º����<br>";
		  print "<a target=_BLANK href='dgedit_pt.php?Dgcode=$drugcode'>����������</a><br>";
	}	
   else { 
        print "<br><br><br>������  :$drugcode  �Ҩ��Ӣͧ���! �ô���<br>";
           }
include("unconnect.inc");
?>








