<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
    session_unregister("nRunno");  
    session_unregister("vAN");
    session_unregister("thdatehn");  
    session_unregister("cNote");  
//    session_destroy();
?>
<style>
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>ลงทะเบียนผู้ป่วยบำนาญทหาร</p>
    <p>ให้ใส่เลขบัตรประจำตัวประชาชน</p>

  <p>เลขบัตรประจำตัว
  <input name="idcard" type="text" id="idcard" size="25" maxlength="13"> 
  *13 หลัก</p>
<p>หรือ HN 
  <input name="hnid" type="text" id="hnid" size="25" maxlength="13"> 
  </p> <script type="text/javascript">
document.getElementById('idcard').focus();
</script>
 
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"> 
  
   <a href="http://192.168.1.2/sm3/nindex.htm">กลับเมนู</a>
</p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ยศ</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>สกุล</th>
  <th bgcolor=6495ED>ว/ด/ป เกิด</th>
  <th bgcolor=6495ED>บัตร ปชช.</th>
  <!--<th bgcolor=6495ED>มา รพ.</th>
  <th bgcolor=6495ED>ตรวจนัด</th>
  <th bgcolor=6495ED>ตรวจนอน</th>-->
  <th bgcolor=6495ED>สถานะผู้ป่วยบำนาญ</th>
  <th bgcolor=6495ED>ลงทะเบียน</th>
 </tr>

<?php
If (!empty($idcard)||!empty($hnid)){
    include("connect.inc");
    global $idcard;
	global $hnid;
    $query = "SELECT row_id,hn,yot,name,surname,dbirth,idcard,pension_status  FROM opcard WHERE idcard = '$idcard'";
	if($hnid!=""){
		$query = "SELECT row_id,hn,yot,name,surname,dbirth,idcard,pension_status  FROM opcard WHERE hn = '$hnid'";
	}
	//echo $query;
    $result = mysql_query($query)or die("Query failed");

    while (list ($row_id,$hn,$yot,$name,$surname,$dbirth,$idcard,$pension_status ) = mysql_fetch_row ($result)) {
		
		if($pension_status=='' or $pension_status=='N'){
			$pension="<a  target='_self' href=\"update_pension_save.php?status=Y&row_id=$row_id\">ลงทะเบียน<a>";	
			$status="ยังไม่ได้ลงทะเบียน";
		}elseif($pension_status=='Y'){
			$pension="<a target='_self' href=\"update_pension_save.php?status=N&row_id=$row_id\">ยกเลิกลงทะเบียน<a>";
			$status="ลงทะเบียนแล้ว";
		}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"seopcard.php?cHn=$hn \">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA>$yot</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
         "  <td BGCOLOR=66CDAA>$dbirth</td>\n".
         "  <td BGCOLOR=66CDAA>$idcard</td>\n".
         /*"  <td BGCOLOR=66CDAA><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">มา รพ.<a></td>\n".
         "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">ตรวจนัด<a></td>\n".
   	  "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"ancheck.php?hn=$hn\">ตรวจนอน<a></td>\n".*/
	  "  <td BGCOLOR=66CDAA>$status</td>\n".
	  "  <td BGCOLOR=66CDAA>$pension</td>\n".
           " </tr>\n");
           }
		   include("unconnect.inc"); 
          }
?>

</table>


<br />
<hr />

<h4 class="forntsarabun1">รายชื่อผู้ป่วยบำนาญที่ลงทะเบียนแล้ว</h4>
<?
include("connect.inc");
$tempsql2="CREATE TEMPORARY TABLE opcard1  Select * from  opcard  WHERE pension_status='Y' ";
$tempquery2 =mysql_query($tempsql2);	  

$sql2="Select  *,concat(yot,' ',name,' ',surname) as ptname from opcard1 ";
$query2=mysql_query($sql2);

$i=1;
?>

<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun1" bordercolor="#000000" style="border-collapse:collapse" >
  <tr align="center">
    <td bgcolor="#CCCCCC">ลำดับ</td>
    <td bgcolor="#CCCCCC">HN</td>
    <td bgcolor="#CCCCCC">ชื่อ-สกุล</td>
    <td bgcolor="#CCCCCC">ที่อยู่</td>
    <td bgcolor="#CCCCCC">เบอร์โทรศัพท์</td>
  </tr>
  <?
 while($arr2=mysql_fetch_array($query2)){
  ?>
  <tr>
    <td><?=$i;?></td>
    <td><a target=_BLANK  href="seopcard.php?cHn=<?=$arr2['hn'];?>"><?=$arr2['hn'];?></a></td>
    <td><?=$arr2['ptname'];?></td>
    <td><?=$arr2['address'];?>&nbsp;ต.<?=$arr2['tambol'];?>&nbsp;อ.<?=$arr2['ampur'];?>&nbsp;จ.<?=$arr2['changwat'];?> </td>
    <td><?=$arr2['phone'];?></td>
  </tr>
  <?
  $i++;
 }

  ?>
</table>