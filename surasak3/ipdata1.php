
<script language="JavaScript1.2">
<!--
window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
top.window.outerHeight = screen.availHeight;
top.window.outerWidth = screen.availWidth;
}
}
//-->
</script>

<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
//    session_destroy();
    //wardpage.php
	$_SESSION["cBedcode"] = $_GET["cBedcode"];
    session_unregister("cDepart");
    session_unregister("aDetail");
    session_unregister("cTitle");
    //ipdata.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister('cDate');
    session_unregister('cBedcode');
	  session_unregister('oBedcode');
    session_unregister('cBed');
    session_unregister('cPtname');
    session_unregister('cAge');
    session_unregister('cPtright');
    session_unregister('cDoctor');
    session_unregister('cHn');
    session_unregister('cAn');
    session_unregister('cDiag');
    session_unregister('cBedpri');
    session_unregister('cChgdate');
	session_unregister('cChgwdate');
    session_unregister('cBedname');
    session_unregister('cAccno');
    session_unregister("nRunno");
////
	
    $Bedcode=$cBedcode;
    session_register("Bedcode");

    $x=0;
    $aDgcode = array("����");
    $aTrade  = array("��¡��");
    $aPrice  = array("�Ҥ� ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aMoney= array("       ����Թ   ");
    $Netprice="";  

    $cDate="";
    $cBed="";
    $cPtname="";
    $cAge="";
    $cPtright="";
    $cDoctor="";
    $cHn="";
    $cAn="";
    $cDiag="";
    $cBedpri="";
    $cChgdate="";
	$cChgwdate="";
    $cBedname="";
    $cAccno="";

    $nRunno="";
    session_register("nRunno");

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");

    session_register('cDate');
    session_register('cBedcode');
	  session_register('oBedcode');
    session_register('cBed');
    session_register('cPtname');
    session_register('cAge');
    session_register('cPtright');
    session_register('cDoctor');
    session_register('cHn');
    session_register('cAn');
    session_register('cDiag');
    session_register('cBedpri');
    session_register('cChgdate');
	session_register('cChgwdate');
    session_register('cBedname');
    session_register('cAccno');



global $row ;
global  $idcard,$camp,$gang,$dbirth ,$address,$tambol,$ampur,$changwat;
include("connect.inc");

   $query = "SELECT * FROM bed WHERE bedcode = '$cBedcode'";
   $result = mysql_query($query)
       or die("Query failed bed");

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
  	      if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	                                                            }

    	    if(!($row = mysql_fetch_object($result)))
    	        continue;
    	     }

 If ($result){
       $cDate=$row->date;
       $cBedcode=$row->bedcode;
       $cBed=$row->bed;
       $cPtname=$row->ptname;
       $cAge=$row->age;
       $cPtright=$row->ptright;
       $cDoctor=$row->doctor;
       $cHn=$row->hn;
       $cAn=$row->an;
       $cDiag=$row->diagnos;
       $cBedpri=$row->bedpri;
       $cChgdate=$row->chgdate;
       $cBedname=$row->bedname;
       $cAccno=$row->accno;
//runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $nRunno=$row->runno;
    $nRunno++;

    $query ="update runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
                }  
   else {
      echo "��辺 HN : $cBedcode";
           } 

//  mysql_free_result($result); 
/* 
print <<<END
��§ $cBed,  ����: $cPtname <br>
����: $cAge,  HN: $cHn,  AN: $cAn <br>
�Է�ԡ���ѡ��: $cPtright <br>
�ä: $cDiag,  ᾷ��: $cDoctor <br>
END;
*/

   echo"��§: $cBed<br>";
   echo "����: $cPtname,���� $cAge <br>";
   echo "HN: $cHn,   AN: $cAn<br>";
   echo "�Է�ԡ���ѡ��: $cPtright<br>";
   echo "�ä: $cDiag<br>";
   echo "ᾷ��: $cDoctor<br>";
   $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$chgdate=(substr($cDate,0,4)-543).substr($cDate,4); //�ѹ�͹
	$datenow=date("Y-m-d H:i:s"); //�ѹ���
	$s = strtotime($datenow)-strtotime($chgdate);
	//echo $s."<br>";
	$d = intval($s/86400);//day
	$s -= $d*86400;
	$h  = intval($s/3600);//hour
	echo "�ѹ��� admit : $cDate <br>";
	echo "�ӹǹ�ѹ�͹ : $d �ѹ $h �������<br>";
//   echo "$cAddress<br>";
//   echo "$cMuang<br>";

$sql = "Select * From opcard where hn = '$cHn' limit 1";
//echo "<!-- ",$sql," -->";
$result2 = mysql_query($sql) or die(mysql_error());
$arr = mysql_fetch_array($result2);

echo"<br>�Ţ���ѵû�ЪҪ�: $arr[idcard]<br>";
echo"�������: $arr[address]  �.$arr[tambol]  �.$arr[ampur]  �.$arr[changwat]<br>";
echo"�Դ�: $arr[father]     ��ô�:  $arr[mother]<br>";

echo"���������ö�Դ�����:  $arr[ptf]     ����Ǣ�ͧ�Ѻ������:  $arr[ptfadd]  <br>";
echo"���Ѿ��:  $arr[ptffone]<br>";

  /* print " <br><a target=_self href='wardpage.php'>�ѹ�֡��Һ�ԡ�÷ҧ���ᾷ��</a>";
    print " &nbsp;&nbsp;&nbsp;<a target=_self href='iptopay.php'>��Һ�ԡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��</a>";
	 print " <br><FONT SIZE='3' COLOR='#FF0000'><B>�����Դ��Һ�ԡ�÷ҧ��þ�Һ�����Ф���ФԴ�͹�������ͨ�˹���</B></FONT>";
   print "<br><BR><a target=_self href='ipacc.php'>�ٺѭ�դ���ѡ��</a>";
   print "&nbsp;&nbsp;&nbsp;<a target=_self href='ipaccrep.php'>����Թ����ѡ�Ҿ�Һ��</a>";
   print "&nbsp;&nbsp;&nbsp;<a target=_self  href=\"returndrug.php?cAn=$cAn&Bed=$cBedcode\">㺤׹��</a>";

 
   if($dcdate == '' || $dcdate =='0000-00-00 00:00:00'){ print "<br><BR><a target=_self href='ipdc_confirm.php'>��˹���(discharge)��ҹ��</a>";}else{print " <br><BR><BR><FONT SIZE='' COLOR='FF0000'>����͹! �ͼ�������ӡ�è�˹��¼��������� <BR>��Ҩ�˹����ա���駨з����Դ��Һ�ԡ����Ф����ͧ������� ���ӡ��ź������᷹</FONT> ";}
   print " <br><BR><br><a target=_self href='erasbed.php'>*ź�����Ũҡ��§������?��㹡óվ����</a>";*/
  include("unconnect.inc");
?>
