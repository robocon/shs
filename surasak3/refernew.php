
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����<br></a>

<?php
    session_start();
    include("connect.inc");
$hospital2="$hospital"."$hospital1";
 $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
/*
  date date 
  hn char(12)
  xn char(12)
  name char(20)
  surname char(20)
*/
   $sql = "INSERT INTO refer (dateopd,hn,an,name,sname,clinic,referh,refertype,idcard,pttype,diag,ptnote,exrefer,refercar,office,doctor)
                VALUES(now(),'$sHn','$an','$sName','$sSurname','$clinic','$hospital2','$refertype','$sIdcard','$pttype','$diag','$ptnote','$exrefer','$erfercar','$office','$doctor');";

   $result = mysql_query($sql);

   If (!$result){
        echo "���ѹ�֡  ����Ѻ�ѹ�֡����";
                    }
   else {
        

echo "Ẻ�ѹ�֡��� �Ѻ - �� Refer ������ �ç��Һ�Ť�������ѡ��������<br>";
echo "����-ʡ�� &nbsp;&nbsp;$sName &nbsp;$sSurname&nbsp;&nbsp;HN:$sHn&nbsp;&nbsp;AN:$an <br>";
echo "�ѹ/��͹/��  $Thaidate<br>";
echo "ᾷ��&nbsp;&nbsp;$doctor<br>";
echo "����ԹԨ����ä&nbsp;&nbsp;$diag<br>";
echo "�������Ӥѭ&nbsp;&nbsp;$ptnote<br>";
echo "���˵ء�� Refer &nbsp;&nbsp;$exrefer<br>";
echo "�ç��Һ�� &nbsp;&nbsp;$hospital2<br>";
echo "����Թ�ҧ&nbsp;&nbsp;$refercar<br>";
echo "������&nbsp;&nbsp;$office<br>";
       
          }
include("unconnect.inc");
    session_unregister("sHn");
    session_unregister("sName");
    session_unregister("sSurname");

?>


