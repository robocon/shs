<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>���㺨ͧ��§</title>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	
</head>

<style>
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}

</style>
<body>
<script type="text/javascript">
		  $(function () {
		    // Datepicker
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);
		    $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����'],
		      dayNamesMin: ['��.', '�.', '�.', '�.', '��.', '�.', '�.'],
		      monthNames: ['���Ҥ�', '����Ҿѹ��', '�չҤ�', '����¹', '����Ҥ�', '�Զع�¹', '�á�Ҥ�', '�ԧ�Ҥ�', '�ѹ��¹', '���Ҥ�', '��Ȩԡ�¹', '�ѹ�Ҥ�'],
		      monthNamesShort: ['�.�.', '�.�.', '��.�.', '��.�.', '�.�.', '��.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.', '�.�.']
		    });
		  });
		</script>
<script>
function fncSubmit()
{
	if(document.f2.ptname.value=="")
	{
		alert('��س������ͼ�����');
		document.f2.ptname.focus();
		return false;
	}
	if(document.f2.doctor.selectedIndex==0) {
		alert("��س����͡ᾷ��") ;
		document.f2.doctor.focus() ;
		return false ;
	}		

	if(document.f2.ward.selectedIndex==0)
	{
		alert('��س����͡�ͼ�����');
		document.f2.ward.focus();		
		return false;
	}
	if(document.f2.bed.selectedIndex==0)
	{
		alert('��س����͡ ��§/��ͧ');
		document.f2.bed.focus();		
		return false;
	}	
	
	document.f2.submit();
}

</script>

<? 
	include("../Connections/connect.inc.php"); 
	
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
	
	$row_id=trim($_GET['row_id']);
	
	$sql="SELECT * FROM  booking  WHERE  row_id ='".$row_id."' ";
    $query = mysql_query($sql); 
	$dbarr=mysql_fetch_array($query);
	
	$str1=explode("-",$dbarr['date_in']);
	$date_in=$str1[2].'/'.$str1[1].'/'.$str1[0];
	
	//$ptname=$dbarr['yot'].''.$dbarr['name'].' '.$dbarr['surname'];
	
?>

<form name="f2" method="post" action="booking_edit.php?do=save" onsubmit="JavaScript:return fncSubmit();">
 <table  border="0" class="forntsarabun">
  <tr>
    <td colspan="7" align="center" bgcolor="#CCCCCC">㺨ͧ��§�������</td>
   </tr>
  <tr>
    <td>����-ʡ��</td>
    <td><label for="ptname"></label>
      <input name="ptname" type="text" class="forntsarabun" id="ptname" value="<?=$dbarr['ptname'];?>"/></td>
    <td>����</td>
    <td colspan="3"><label for="age"></label>
      <input name="age" type="text" class="forntsarabun" id="age"  value="<?=calcage($dbarr['dbirth']);?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>HN</td>
    <td><input name="hn" type="text" class="forntsarabun" id="hn" value="<?=$dbarr['hn'];?>" readonly="readonly"/></td>
    <td>�Ѻ���������</td>
    <td colspan="3">
    <input name="date_in" type="text" class="forntsarabun" id="datepicker-th-2"  value="<?=$date_in;?>"/>
 
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DX</td>
    <td><input name="diag" type="text" class="forntsarabun" id="diag"  value="<?=$dbarr['diag'];?>"/></td>
    <td>ᾷ��</td>
    <td><select name="doctor" id="doctor" class="forntsarabun">
            <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		?>
		<option value='��ͧ��Ǩ�ä�����' <? if($dbarr['doctor']=="��ͧ��Ǩ�ä�����"){ echo "selected"; }?>>��ͧ��Ǩ�ä�����</option>
        <?
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){
		
		if($dbarr['doctor']==$dbarr2['name']){
		echo "<option value='".$dbarr2['name']."' selected='selected'>".$dbarr2['name']."</option>";	
		}else{
		echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
		}
		}
		?></select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>��§/��ͧ</td>
    <td>
      <select name="bed" id="bed" class="forntsarabun"> 
      <option value="">---���͡��§/��ͧ---</option>
      <option value="������" <? if($dbarr['bed']=="������"){ echo "selected"; }?>>������</option>
      <option value="�����1000" <? if($dbarr['bed']=="�����1000"){ echo "selected"; }?>>�����1000</option>
      <option value="�����1200" <? if($dbarr['bed']=="�����1200"){ echo "selected"; }?>>�����1200</option>
      <option value="�����1600" <? if($dbarr['bed']=="�����1600"){ echo "selected"; }?>>�����1600</option>
      
      </select></td>
    <td>�ͼ�����</td>
    <td><select name="ward" id="ward" class="forntsarabun">
      <option value="">---���͡�ͼ�����---</option>
      <option value="�ͼ��������" <? if($dbarr['ward']=="�ͼ��������"){ echo "selected"; }?>>�ͼ��������</option>
      <option value="�ͼ�����˹ѡ(icu)" <? if($dbarr['ward']=="�ͼ�����˹ѡ(icu)"){ echo "selected"; }?>>�ͼ�����˹ѡ(icu)</option>
      <option value="�ͼ����¾����" <? if($dbarr['ward']=="�ͼ����¾����"){ echo "selected"; }?>>�ͼ����¾����</option>
      <option value="�ͼ������ٵԹ��" <? if($dbarr['ward']=="�ͼ������ٵԹ��"){ echo "selected"; }?>>�ͼ������ٵԹ��</option>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="7"><input name="b2" type="submit" class="forntsarabun" id="button" value="��㺨ͧ��§" />
       <a href='booking_chk.php' class='forntsarabun'>��͹��Ѻ</a>
      <a href='../../nindex.htm' class='forntsarabun'>��Ѻ������ѡ</a>
      <input type="hidden" name="bdate" value="<?=$dbarr['bdate'];?>" />
      <input type="hidden" name="row_id" value="<?=$dbarr['row_id'];?>" />
      </td>
    </tr>
 </table>
  </form> 
    
<?

if($_REQUEST['do']=="save"){
include("../Connections/connect.inc.php"); 

	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$y.'-'.$m.'-'.$d.' '.date('H:i:s');
	///////////////////////////////
	
	$strdate=explode("/",$_POST['date_in']);
	$date_in=$strdate[2].'-'.$strdate[1].'-'.$strdate[0];


	
$strSQL = "UPDATE booking SET ";
$strSQL .="hn = '".$_POST["hn"]."' ";
$strSQL .=",ptname = '".$_POST["ptname"]."' ";
$strSQL .=",bdate = '".$_POST["bdate"]."' ";
$strSQL .=",age = '".$_POST["age"]."' ";
$strSQL .=",diag = '".$_POST["diag"]."' ";
$strSQL .=",doctor = '".$_POST["doctor"]."' ";
$strSQL .=",bed = '".$_POST["bed"]."' ";
$strSQL .=",ward = '".$_POST["ward"]."' ";
$strSQL .=",date_in = '".$date_in."' ";
$strSQL .=",status = '' ";
$strSQL .=",comment = '' ";
$strSQL .=",officer_con = '' ";
$strSQL .="WHERE row_id = '".$_POST["row_id"]."' ";
$objQuery = mysql_query($strSQL);

//echo $strSQL;

if($objQuery){
echo "���㺨ͧ��§���º��������";	
echo "<meta http-equiv='refresh' content='2; url=booking_chk.php'>" ;
}

}

?>
</body>
</html>