<?
session_start();
include("connect.inc");
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
?>
<script type="text/javascript">
window.onload= function () { window.print();window.close();   }
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style2 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {
	font-size: 20px;
	font-weight: bold;
}
.style4 {
	font-size: 32px;
	font-weight: bold;
}
-->
</style>
<?
$hn = $_GET["cHn"];
$vn = $_GET["cVn"];

$sql="select * from opcard where hn='$hn'";
$query=mysql_query($sql) or die ("Query fail on line 37");
$rows=mysql_fetch_array($query);


$yy=date("Y")+543;
$mm=date("m");
$dd=date("d");
$time=date('H:i:s');
$newdate="$yy$mm$dd";
$thaidate="$dd/$mm/$yy ".$time;
$thaidatehn="$dd-$mm-$yy".$hn;

$strSQL="select * from opday where hn='$hn' and vn='$vn' and thdatehn='$thaidatehn'";
$strQuery=mysql_query($strSQL) or die ("Query fail on line 50");
$strRows=mysql_fetch_array($strQuery);
$strlenvn=strlen($strRows["vn"]);
/*
if($strlenvn==1){
	$newvn="00".$strRows["vn"];
}else if($strlenvn==2){
	$newvn="0".$strRows["vn"];
}else{
	$newvn=$strRows["vn"];
}
*/

//$vn=sprintf('%03d',$vn);

$newtoborow=substr($strRows["toborow"],2,2);

$runnoopd=$newdate.$vn.$newtoborow."0001";
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td width="6%" height="600" valign="top">&nbsp;</td>
  <td width="94%" height="600" valign="top">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="28" colspan="3" align="center" class="style2"><strong>Ẻ�ѹ�֡��õ�Ǩ�ѡ�Ҽ����¹͡</strong></td>
    <td width="51%" rowspan="5" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">

      <tr>
        <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top"><? print "<img src = \"barcode/opdcard.php?runnoopd=$runnoopd\" height=\"50\" width=\"300\">"; ?></td>
            </tr>
          
        </table>        </td>
        </tr>
      <tr>
        <td align="center" class="style3"><span class="style4">VN : <?=$strRows["vn"];?></span> �ѹ��� : <?=$thaidate; time("hh");?></td>
        </tr>
      <tr>
        <td align="center"><span class="style2">�Է�� :
          <?=$strRows["ptright"];?></span>
           <?=$strRows["toborow"];?></td>
      </tr>
    </table></td>
  </tr>
  <tr class="style2">
    <td height="28" colspan="3" align="center" class="style3"><strong>�ç��Һ�Ť�������ѡ��������</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="style3"><strong>���� : </strong><?=$rows["yot"].$rows["name"]."  ".$rows["surname"];?></td>
    <td width="23%" align="left" valign="top"><strong>HN : </strong><?=$rows["hn"];?></td>
  </tr>
  <tr align="left" valign="top">
    <td width="14%"><strong>���� : </strong><?=calcage($rows["dbirth"]);?></td>
    <td width="12%"><strong>�� : </strong>
      <? if($rows["sex"]=="�" || $rows["sex"]=="1"){ echo "���";}else if($rows["sex"]=="�" || $rows["sex"]=="2"){ echo "˭ԧ";}else{ echo "������к�";}?></td>
    <td><?=$rows["idcard"];?></td>
  </tr>
</table>
<table width="100%" height="85%" border="0" cellpadding="0" cellspacing="0" style="border-top:1px solid #000000;">
  <tr>
    <td width="45%" height="405" align="left" valign="top"><table width="100%" height="189" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21" colspan="3"><strong>���� : </strong>.....................<strong>�ѡɳм����� : </strong>...........................................</td>
        </tr>
      <tr>
        <td width="28%" height="21"><strong>BW : </strong> ..........Kg.</td>
        <td width="30%"><strong>High : </strong>..........cm.</td>
        <td width="42%"><strong>BP : </strong>........../..........mmHg.</td>
      </tr>
      <tr>
        <td height="21"><strong>T : </strong>..........c</td>
        <td><strong>P : </strong>.............../min</td>
        <td><strong>R : </strong>.............../min</td>
      </tr>
      <tr>
        <td height="21" colspan="3"><strong>������ : </strong>...............<strong>���� : </strong>.................<strong>Pain Score : </strong>........................</td>
        </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top"><strong>�ä��Шӵ�� : </strong>...............................................................................</td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top"><strong>�ҡ�� : </strong>.............................................................................................</td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top">............................................................................................................</td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top">............................................................................................................</td>
      </tr>
    </table>
      <hr />
      <div style="margin-top:150px;" align="center">- ����Ѻ�Դʵ�������� -</div>
    </td>
   <td width="55%" rowspan="2" align="left" valign="top" style="border-left:1px solid #000000;">
    <div><strong>����Ѻᾷ�� : </strong></div>
    <div style="height:50px;">
        <?
        $tbsql = "Select tradname, advreact  From drugreact where hn = '$hn' ";
        $tbquery=mysql_query($tbsql) or die ("Query fail on line 70");
		$tbnum=mysql_num_rows($tbquery);
		if($tbnum < 1){
		echo "";
		}else{
		echo "<strong>���������� : </strong>";		
			while($tbrows=mysql_fetch_array($tbquery)){    
				$tradname=$tbrows["tradname"];
				 echo "$tradname, ";
			}
		}
        ?>    
    </div>
   <div style="margin-top:375px;"><strong>ᾷ�����Ǩ : </strong></div>
    <div><strong>���й� : </strong></div>
    </td>
  </tr>
</table>
  </td>
 </tr>
 </table>
	<?
/*    $ok = "S";
    $query ="UPDATE opday SET phaok='$ok'  WHERE thdatehn = '$thdatehn' AND vn = '".$vn."' ";
    $result = mysql_query($query) or die("Query failed,update opday");*/
    ?>  