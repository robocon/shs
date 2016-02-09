<? session_start();?>
<body>
<style>
.font{
	font-family:"TH SarabunPSK";
	font-size:20px;
}
</style>
<h2 align="center" class="font"><?=$_GET['vPtname'];?> AN :<?=$_GET['vAn'];?> HN : <?=$_GET['vHn'];?> </h2>
<form name="f1" action="ipchkbil_part.php" method="post">
<table class="font" border="1" align="center" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>PART</td>
    <td>จำนวน/รายการ</td>
    <td>จำนวนเงิน</td>
    <td>เลือก</td>
  </tr>
<?
include("connect.inc");
$queryp = "SELECT count(part)as count ,part,sum(price) as price FROM ipacc WHERE  an = '".$_GET['vAn']."'  and ( paid ='' or paid  is null) Group by part ORDER BY date ASC ";
$resultp = mysql_query($queryp)or die("Query failed ipacc");

$i=1;
while($rs=mysql_fetch_array($resultp)){
	?>

  <tr>
    <td><?=$rs['part'];?></td>
    <td><?=$rs['count'];?></td>
    <td><?=$rs['price'];?>&nbsp;</td>
    <td align="center"><input type="checkbox" name="check<?=$i?>" id="check<?=$i?>" value="<?=$rs['part'];?>">
     <input type="hidden" name="max"  value="<?=$i;?>">
     
     
    </td>
  </tr>
  <? 
  $i++;
  } ?>
    <tr>
    <td colspan="4" align="center">
    <input type="hidden" name="vAn"  value="<?=$_GET['vAn'];?>">
    <input type="hidden" name="vHn"  value="<?=$_GET['vHn'];?>">
    <input type="hidden" name="vAccno"  value="<?=$_GET['vAccno'];?>>">
    <input type="hidden" name="vDate"  value="<?=$_GET['vDate'];?>">
    <input type="hidden" name="vDays"  value="<?=$_GET['vDays'];?>">
    <input type="hidden" name="vPtright"  value="<?=$_GET['vPtright'];?>">
    <input type="hidden" name="vPtname"  value="<?=$_GET['vPtname'];?>">
    <input type="hidden" name="vDiag"  value="<?=$_GET['vDiag'];?>">
    
    <input type="submit" name="button" id="button" value="ตกลง ทำรายการ" class="font"></td>
    </tr>
</table>
</form>
<? 
/*if(isset($_POST['button'])){
	

	
for($i=1;$i<=$_POST["max"];$i++){
	if($_POST['check'.$i]!=""){
		$a.="part = '".$_POST['check'.$i]."' or ";
	}
}
$a .= " part=1";
	
	$query = "SELECT * FROM ipacc WHERE an = '$vAn' and ( ".$a." )";
    $result = mysql_query($query)or die("Query failed ipacc");
	
	echo $query."<BR>";
} 

<a target='_BLANK'  href="ipchkbil_part.php?vPart=<?=$rs['part'];?>&vAn=<?=$_GET['vAn'];?>&vHn=<?=$_GET['vHn'];?>&vAccno=<?=$_GET['vAccno'];?>&vDate=<?=$_GET['vDate'];?>&vDcdate=<?=$_GET['vDcdate'];?>&vDays=<?=$_GET['vDays'];?>&vPtright=<?=$_GET['vPtright'];?>&vPtname=<?=$_GET['vPtname'];?>&vDiag=<?=$_GET['vDiag'];?>"><?=$rs['part'];?></a>
*/

?>

</body>