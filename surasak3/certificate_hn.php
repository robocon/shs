<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��ش����¹��Ѻ�ͧᾷ��</title>
<style type="text/css">
.font1 {
	font-family: "TH Niramit AS";
	font-size:20px;
}
.font2 {
	font-family: "TH Niramit AS";
	font-size:16px;
}
</style>
<link type="text/css" href="datepicker/dateopd/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="datepicker/dateopd/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="datepicker/dateopd/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
		<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);


		    $("#thaidate").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����'],
              dayNamesMin: ['��.','�.','�.','�.','��.','�.','�.'],
              monthNames: ['���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'],
              monthNamesShort: ['�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.']});

			});
		</script>
		<style type="text/css">

			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		</style>
</head>
<script language="javascript">
function fncSubmit(){
	if(document.form1.cHn.value==""){
		
		alert("��س��к� HN ���¤�Ѻ");
		document.form1.cHn.focus();
		return false;
	}
	document.form1.submit();
}

function fncSubmit2(){
	if(document.form2.doctor.value==""){
		
		alert("��س����͡���� doctor");
		document.form2.doctor.focus();
		return false;
	}
	document.form2.submit();
}


function chkvalue(){
	
	var name=document.getElementById('doctor').value;
	
	document.getElementById('name').value=name ;
	
}

</script>

<body>
<h1 class="font1">��ش����¹��Ѻ�ͧᾷ��</h1>

<fieldset class="font1" style="width:50%">
  <legend>�к� HN </legend><form id="form1" name="form1" method="post" >
  <table border="0" align="center">
    <tr>
      <td>HN:</td>
      <td>
      <input name="cHn" type="text" class="font1" id="cHn" value="<?=$_POST['cHn'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font1" id="button" value="��ŧ" />
    </td>
    </tr>
    <tr>
      <td colspan="2" align="center">  <a target=_self  href='../nindex.htm'> ����� </a> &nbsp;&nbsp;&nbsp; <a href='certificate_report.php' class='font1' target="_blank">��ش����¹��ͧᾷ��</a></td>
    </tr>
  </table>
</form>
</fieldset>
<br />

<?

if($_POST['button']=='��ŧ'){
	
include("connect.inc");


	
	$sql="select * from opcard where hn='".$_POST['cHn']."' ";
	$query=mysql_query($sql) or die (mysql_error());
	$numrow=mysql_num_rows($query);
	$arr=mysql_fetch_array($query);
	

	?>
    
<fieldset class="font1" style="width:100%">
  <legend>��ش����¹��Ѻ�ͧᾷ��</legend>
  <form id="form2" name="form2" method="post" onSubmit="JavaScript:return fncSubmit2();">
<? 	//if($numrow){ ?>
<table border="0" align="center">
  <tr>
    <td align="right">�������</td>
    <td><label for="bookid"></label>
      <input name="bookid" type="text" class="font1" id="bookid" size="10" /></td>
    </tr>
  <tr>
    <td align="right">�Ţ���</td>
    <td><input name="noid" type="text" class="font1" id="noid" size="10" /></td>
  </tr>
  <tr>
    <td align="right">����-ʡ��</td>
    <td><input name="ptname" type="text" class="font1" id="ptname" value="<?=$arr['yot'].$arr['name'].' '.$arr['surname'];?>" size="40" readonly="readonly" /></td>
  </tr>
  <tr>
    <td align="right">HN</td>
    <td><input name="hn" type="text" class="font1" id="hn"  value="<?=$arr['hn'];?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td align="right">����ԹԨ���</td>
    <td><textarea name="diag" cols="45" rows="2" class="font1" id="diag"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">�����Դ���</td>
    <td><label for="comment"></label>
      <textarea name="comment" cols="45" rows="5" class="font1" id="comment"></textarea></td>
  </tr>
  <tr>
    <td align="right">ᾷ��</td>
    <td><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
    </select></td>
  </tr>
  <tr>
    <td align="right">�ѹ/��͹/�� ����͡��Ѻ�ͧᾷ��</td>
    <td><input name="thaidate" type="text" class="font1" />
    �� *09/09/2555*</td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="font1"><input name="button2" type="submit" class="font1" id="button2" value="��ŧ" /></td>
  </tr>
  </table>
  <? //} else{
	 /* echo "<br>";
	  echo "<div class=\"font1\">��辺 HN :  ".$_POST['cHn']."  ��к�</div>";
	  echo "<br>";*/
 // }
  ?>

  </form>
</fieldset>
<?
 }
 
if($_POST['button2']){
 
 include("connect.inc");
 $thidate = (date("Y")+543).date("-m-d H:i:s"); 
 


	$str="INSERT INTO `certificate` ( `bookid` , `noid` , `hn` , `ptname` , `diag` , `doctor` , `comment` , `thaidate` , `regisdate`,status )
VALUES ('".$_POST['bookid']."','".$_POST['noid']."', '".$_POST['hn']."', '".$_POST['ptname']."', '".$_POST['diag']."','".$_POST['doctor']."', '".$_POST['comment']."', '".$_POST['thaidate']."', '".$thidate."','Y')";
			$strq=mysql_query($str)or die (mysql_error());
			
		//	$id=mysql_insert_id();
			
			
			if($strq){
				
				//echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=drugoutside_print.php?id=$id'>";
			 echo "<div align='center' class='font1'>�ѹ�֡���������º��������  ��Ǩ�ͺ���������� <a href='certificate_report.php' class='font1' target='_blank'>��ش��ͧᾷ��</a></div>";

			}else{
				
				echo "�������ö�ѹ�֡��������";
			}
			
}
?>
</body>
</html>