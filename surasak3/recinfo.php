<?php
    session_start();
    include("connect.inc");
	if(isset($_POST['B2'])){
	$dr_date = (date("Y")+543)."".date("-m-d H:i:s");
	$Thidate =$dr_date;
	$item=0;
	if($_POST['npri']==''){
		$_POST['count']=0;
		$_POST['npri']=0;
	}else{
		$item++;
	}
	if($_POST['npri2']==''){
		$_POST['count2']=0;
		$_POST['npri2']=0;
	}else{
		$item++;
	}
	$prisum = ($_POST['npri']*$_POST['count'])+($_POST['npri2']*$_POST['count2']);
	$query = "INSERT INTO phardep(chktranx,date,ptname,hn,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright, phapt,datedr)VALUES('".$_SESSION["sChktranx"]."','$Thidate','$cPtname','$cHn','$prisum','".$_POST['doctor']."','$item','$sOfficer','����������ѧ','0','0','$prisum','0','0','0','0','$tvn','R01 �Թʴ','$sOfficer','$dr_date');";

	$result = mysql_query($query) or die("�������ö�ѹ�֡�������� ��سҷ���¡������");
	$idno=mysql_insert_id();
	 
	if($_POST['npri']!=''){
		$query = "INSERT INTO drugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno,datedr )VALUES('$Thidate','$cHn','2RECO','RECORMON 5000 IU, 0.3 ML.','".$_POST['count']."','".($_POST['npri']*$_POST['count'])."','1','b','DDN','$idno','$dr_date');";
		$result = mysql_query($query) or die("Query failed,insert into drugrxr1");
	}
	 
	if($_POST['npri2']!=''){
		$query = "INSERT INTO drugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno,datedr )VALUES('$Thidate','$cHn','2ESPOVI','ESPOGEN 1 ml.(���.)','".$_POST['count2']."','".($_POST['npri2']*$_POST['count2'])."','1','b','DDN','$idno','$dr_date');";
		$result = mysql_query($query) or die("Query failed,insert into drugrxr1");
	}
	
	$Thdhn = date("d-m")."-".(date("Y")+543).$cHn;
	$query ="UPDATE opday SET phar= phar+".$prisum." WHERE thdatehn= '$Thdhn' AND vn = '$tvn' ";
	//14-05-254847-1
    $result = mysql_query($query) or die("Query failed,update opday");
	print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"8;URL=reco_mon.php\">";

}
else{
    ////////// ��Ǩ�ͺ��� ��.���ʹ��ҧ�����������
	$strsql="select * from accrued where hn = '$cHn' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);
	


	if($strrow>0){
		echo "<script>alert('���������ʹ��ҧ����  ��سҵԴ�����ǹ���Թ�����') </script>";
		//echo "&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>���ʹ��ҧ����</a></b></font>";

	}
//////////////////////////////////////////
   
   function calcage($birth){
		$today = getdate();   
		$nY  = $today['year']; 
		$nM = $today['mon'] ;
		$bY=substr($birth,0,4)-543;
		$bM=substr($birth,5,2);
		$ageY=$nY-$bY;
		$ageM=$nM-$bM;
	
		if ($ageM<0) {
			$ageY=$ageY-1;
			$ageM=12+$ageM;
		}
	
		if ($ageM==0){
			$pAge="$ageY ��";
		}else{
			$pAge="$ageY �� $ageM ��͹";
		}
	
	return $pAge;
}
		$sqlage = "select idcard,dbirth from opcard where hn ='".$cHn."'";
		$arr_age = mysql_fetch_array(mysql_query($sqlage));
		$age = calcage($arr_age['dbirth']);
		
		
		$idcard=$arr_age['idcard'];
		
		if($idcard=="" || $idcard=="-"){
		$img=$cHn.'.jpg';
		}else{
		$img=$idcard.'.jpg';
		}
	
	if(file_exists("../image_patient/$img")){
		
		$image="<IMG SRC='../image_patient/$img' WIDTH='100' HEIGHT='150' BORDER='1' ALT=''>";
	}else{
		$image="";
	}
	
?>
<style type="text/css">
<!--
.font1 {
	font-size: 24px;
}
-->
</style>
<a href="../nindex.htm" class="forntsarabun"><<����� </a>
<u><p>�ԡ��ǹ�Թ�� RECORMON</p></u>
<table  border="0">
  <tr>
    <td>�����¹͡</td>
   <td rowspan="5" valign="top">
   <?=$image;?>
 
 </td>
  </tr>
  <tr>
     <td>HN :<?=$cHn;?></td>
    </tr>
  <tr>
    <td>VN :<?=$tvn;?></td>
    </tr>
  <tr>
   <td><?=$cPtname;?></td>
    </tr>
  <tr>
    <td><font color='#FF0000' style='font-size:18px'>����: <?=$age;?></font></td>
    </tr>
  <tr>
    <td>�Է�� : <?=$cPtright?></td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<br />
<fieldset>
  <br />
   <form method="POST" action="" onsubmit="return check();">
    <p><font face="Angsana New" class="font1">&#3649;&#3614;&#3607;&#3618;&#3660;&nbsp;&nbsp;
        <?php
   include("connect.inc");
   $month = array("","���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
   
   $dd = date("d")." ".$month[date("n")]." ".(date("Y")+543);
   $sqlappoint = "select doctor from appoint where hn = '".$cHn."' and appdate like '$dd%'";
   $app1 = mysql_fetch_array(mysql_query($sqlappoint));
   ////////////////////////////////////
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));


$strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?></font><font face="Angsana New">
        <select name="doctor" id="doctor">
          <?
  	while($objResult = mysql_fetch_array($objQuery)) {
		if($app1['doctor']==$objResult["name"]){
			 ?>
          <option value="<?=$objResult["name"]?>" selected="selected">
            <?=$objResult["name"]?>
          </option>
          <?
		}
		else{
			?>
          <option value="<?=$objResult["name"];?>" <? if($objResult["name"]=="MD022 (����Һᾷ��)"&&$_SESSION["until_login"] == "LAB") echo "selected='selected'";?>>
            <?=$objResult["name"];?>
          </option>
          <?
		}
	}
?>
        </select>
        </font><br />
    <font face="Angsana New" class="font1">�ԡ��ǹ�Թ�� RECORMON �Ҥҵ��˹���
    <input name="npri" type="text" size="10" /> 
    �ҷ</font>  �ӹǹ <font face="Angsana New" class="font1">
      <input name="count" type="text" size="10" />
    </font><br />
    <font face="Angsana New" class="font1">�ԡ��ǹ�Թ�� ESPOGEN �Ҥҵ��˹���
    <input name="npri2" type="text" size="10" />
�ҷ</font> �ӹǹ <font face="Angsana New" class="font1">
<input name="count2" type="text" size="10" />
</font></p>
    <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
     <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B2"></font></p>
</form>
</fieldset>

<?
}


if(isset($result)){
?>
<script>
window.print();
</script>
<?
//���˹��
  print "���˹��<br>";
     print "<font face='Angsana New'>$cPtname HN:$cHn VN:$tvn  �Է��: R01 �Թʴ<br>";
//    print "�Է��: $cPtright<br>";
    print "�ä: ����������ѧ ᾷ��:".$_POST['doctor']."<br>";
//    print "ᾷ��:$cDoctor<br>";
      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>��¡��</th>";
      print "  <th>�ӹǹ</th>";
      print "  <th>�Ҥ�</th>";
      print "  <th>�ԡ�����</th>";
      print " </tr>";
	$b=0;
	if($_POST['npri']!=''){
		$b++;
      print (" <tr>\n".
           "  <td>$b</td>\n".
           "  <td>RECORMON 5000 IU, 0.3 ML. 	</td>\n".
           "  <td>$_POST[count]</td>\n".
           "  <td>".($_POST['npri']*$_POST['count'])."</td>\n".
           "  <td>".($_POST['npri']*$_POST['count'])."</td>\n".
           " </tr>\n");
	}
	if($_POST['npri2']!=''){
		$b++;
	  print (" <tr>\n".
           "  <td>$b</td>\n".
           "  <td>ESPOGEN 1 ml.(���.) 	</td>\n".
           "  <td>$_POST[count2]</td>\n".
           "  <td>".($_POST['npri2']*$_POST['count2'])."</td>\n".
           "  <td>".($_POST['npri2']*$_POST['count2'])."</td>\n".
           " </tr>\n");
	}
      print "</table>";
   	  print "<B>�Ҥ���� ".$prisum." �ҷ </B><br>";
   if ($aSumNprice>0){
			print"<B>(�ԡ����� ".$prisum." �ҷ )</B><br>";
					   }
   print "���. $sOfficer";  
      print "<font face='Angsana New'>&nbsp;&nbsp;$Thaidate<br>";
      print "***************************************************<br>";  
	     print "<B>�����˹��仪����Թ�����ͧ���Թ</B>";  
//�����˹��
}
?>