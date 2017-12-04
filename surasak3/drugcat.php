<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
}
-->
</style>
</head>

<body class="font1">
<?
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname from druglst  where  drugcode like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute; width:500px; height:450px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td width=\"40\"><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td><td width=\"50\"><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td><td width=\"10\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td></tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr  ><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",$se["drugcode"],"';document.getElementById('list').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}

?>
<script>
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}
function searchSuggest(str,len,getto) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){

			url = 'drugcat.php?action=drugcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<a target=_top  href="../nindex.htm"><< ไปเมนู</a><br />
<strong><br />
โครงสร้างข้อมูลพื้นฐานสำหรับจัดส่งบัญชีรายการยาอ้างอิงของโรงพยาบาล</strong>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <Div id="list" style="left:100PX;top:70PX;position:absolute;"></Div>
รหัสยา <input name="drugcode" type="text" id="drugcode" onKeyPress="searchSuggest(this.value,2,'drugcode');"/><input type="submit" name="search" value=" ตกลง " />
</form>
<?
include("connect.inc");
if(isset($_POST['search2'])){
	$update = "update druglst SET dosecode = '".$_POST['dose']."' ,strength='".trim($_POST['strength'])."',content='".trim($_POST['content'])."',manufac='".trim($_POST['manufac'])."',unitsize='".trim($_POST['unitsize'])."',packsize='".trim($_POST['packing'])."',packprice='".trim($_POST['salepack'])."',code24='".trim($_POST['code24'])."',tradname='".trim($_POST['trad'])."',genname='".trim($_POST['gen'])."',unit='".trim($_POST['unit'])."',comname='".trim($_POST['comname'])."',ised='".trim($_POST['ised'])."'   where row_id = '".$_POST['rowid']."'  ";
	
	$result = mysql_query($update);
	if($result){
		echo "บันทึกข้อมูลเรียบร้อยแล้ว";
		echo "<meta http-equiv='refresh' content='3;url=drugcat.php' ";
	}
}elseif(isset($_POST['drugcode'])){
	$sql = "select * from druglst where drugcode = '".$_POST['drugcode']."' ";
	$row = mysql_query($sql);
	$result = mysql_fetch_array($row);
	
	$first = substr($result['drugcode'],0,1);
	$sec = substr($result['drugcode'],1,1);
	
	if(ord($sec)<48||ord($sec)>57){
		$dose = $first;
	}else{
		$dose = $first.$sec;
	}
?>
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
<hr />
<table>
	<tr>
    	<td width="227">รหัสยา</td><td width="241"><label>
    	  <input name="drug" type="text" id="drug" value="<?=$result['drugcode']?>" size="10" readonly="readonly" />
  	  </label></td>
    </tr>
	<tr>
	  <td>ชื่อสามัญทางยา</td>
	  <td><input name="gen" type="text" id="gen" value="<?=$result['genname']?>" size="40"/></td>
  </tr>
	<tr>
	  <td>ชื่อการค้า</td>
	  <td><input name="trad" type="text" id="trad" value="<?=$result['tradname']?>" size="40"/></td>
  </tr>
	<tr>
	  <td>รหัส Dose Form Strength</td>
	  <td><input name="dose" type="text" id="dose" value="<?=$dose?>" size="10" readonly="readonly"/></td>
  </tr>
	<tr>
	  <td>รูปแบบของยา</td>
	  <td><input name="unit" type="text" id="unit" value="<?=$result['unit']?>"/></td>
  </tr>
	<tr>
	  <td>ความแรงของยา</td>
	  <td><input type="text" name="strength" id="strength" value="<?=$result['strength']?>" /></td>
  </tr>
	<tr>
	  <td>ขนาดบรรจุ</td>
	  <td><input type="text" name="content" id="content" value="<?=$result['content']?>"/></td>
  </tr>
	<tr>
	  <td>ราคาขายต่อหน่วย</td>
	  <td><input name="salepri" type="text" id="salepri" value="<?=$result['salepri']?>" size="10" readonly="readonly"/></td>
  </tr>
	<tr>
	  <td>บริษัทผู้จัดจำหน่าย</td>
	  <td><input name="comname" type="text" id="comname" value="<?=$result['comname']?>" size="40"/></td>
  </tr>
	<tr>
	  <td>บริษัทผู้ผลิต</td>
	  <td><input name="manufac" type="text" id="manufac" size="40" value="<?=$result['manufac']?>"/></td>
  </tr>
	<tr>
	  <td>รหัสยา 24 หลัก</td>
	  <td><input name="code24" type="text" id="code24" value="<?=$result['code24']?>" size="30"/></td>
  </tr>
    <tr>
      <td>หน่วยบรรจุ</td>
      <td><input type="text" name="unitsize" id="unitsize" value="<? if(empty($result['unitsize'])){ echo "1";}else{ echo $result['unitsize'];}?>"/></td>
    </tr>
    <tr>
    	<td>ขนาด/บรรจุภัณฑ์</td><td><input type="text" name="packing" id="packing" value="<?=$result['packsize']?>"/></td>
    </tr>
    <tr>
    	<td>ราคาขายต่อ Pack</td><td><input type="text" name="salepack" id="salepack" value="<?=$result['packprice']?>"/></td>
    </tr>
    <tr>
      <td>ISED (เป็นยาในบัญชียาหลักหรือไม่)</td>
      <?
	  if($result['ised']==""){
		  if($result['part']=="DDL"){
				$result['ised']="E";
		  }elseif($result['part']=="DDY"||$result['part']=="DDN"){
			    $result['ised']="N";
		  }
	  }
	  ?>
      <td><input type="text" name="ised" id="ised" value="<?=$result['ised']?>"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="search2" value=" ตกลง " /></td>
    </tr>
    <input name="rowid" type="hidden" value="<?=$result['row_id']?>" />
</table>
</form>
<?			
}
?>
</body>
</html>