<?php
    session_start();
    include("connect.inc");
/*
  date date 
  hn char(12)
  xn char(12)
  name char(20)
  surname char(20)
*/
   $sql = "INSERT INTO xrayno (date,hn,xn,name,surname)
                VALUES(now(),'$sHn','$xn','$sName','$sSurname');";

   $result = mysql_query($sql);

   If (!$result){
        echo "���ѹ�֡  �����Ţ�Ҩ������";
                    }
   else {
        echo "HN: $sHn<br>";
        echo "����:$sName $sSurname<br>";
        echo "�����Ţ XN :$xn <br>";
        echo "�ѹ�֡���º����";
          }
include("unconnect.inc");
    session_unregister("sHn");
    session_unregister("sName");
    session_unregister("sSurname");

?>


