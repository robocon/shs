<?php
session_start();
include("connect.inc");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�ç��Һ�Ť������ѡ��������</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th { 
	font-family:"MS Sans Serif";
	font-size:14px;
}

.font_title{
	font-family:  "MS Sans Serif"; font-size:14px;
	
	color:#FFFFFF;
	font-weight: bold;
	background-color:#0000FF

}
</style>
</head>

<body>
<?php

if(isset($_GET["del"])){
	
	$sql = "Update appoint  set diag=Null , remark = Null where row_id = '".$_GET["row_id"]."' limit 1 ";
	$result = Mysql_Query($sql);
	echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"0;URL=nc_appoilst.php\">";
	
}else if(isset($_POST["Save_app"])){

	$sql = "Update appoint  set diag='".$_POST["diag"]."' , remark = '".$_POST["remark"]."' where row_id = '".$_POST["row_id"]."' limit 1 ";

	$result = Mysql_Query($sql);
	echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"0;URL=nc_appoilst.php\">";

exit();
}
		
		if(isset($_REQUEST["appdate"]) && $_REQUEST["appdate"] != ""){
			$day = $_REQUEST["appdate"];
		}else{	
			$day = date("d");
		}
		
		if(isset($_REQUEST["appdate"]) && $_REQUEST["appdate"] != ""){
			$day = $_REQUEST["appdate"];
		}else{	
			$day = date("d");
		}
		
		if(isset($_REQUEST["appmo"]) && $_REQUEST["appmo"] != ""){
			$month = $_REQUEST["appmo"];
		}else{	
			$month = date("m");
		}
		
		if(isset($_REQUEST["thiyr"]) && $_REQUEST["thiyr"] != ""){
			$year = $_REQUEST["thiyr"];
		}else{	
			$year = date("Y")+543;
		}
	
	if(  $month == "01"){$month2 = "���Ҥ�" ; }
    else if( $month == "02"){ $month2 = "����Ҿѹ��" ; }
    else if( $month == "03"){$month2 = "�չҤ�"  ; }
    else if(  $month == "04"){ $month2 = "����¹"; }
    else if(  $month == "05"){ $month2 = "����Ҥ�"; }
    else if(  $month == "06"){ $month2 = "�Զع�¹"; }
    else if(  $month == "07"){ $month2 = "�á�Ҥ�"; }
    else if(  $month == "08"){ $month2 = "�ԧ�Ҥ�"; }
    else if( $month == "09"){ $month2 = "�ѹ��¹" ; }
    else if( $month == "10"){$month2 = "���Ҥ�"  ; }
    else if(  $month == "11"){ $month2 = "��Ȩԡ�¹"; }
    else if(  $month == "12"){$month2 = "�ѹ�Ҥ�" ; }
	else {$month2 = $month;}
	
	$appd2=$day.' '.$month2.' '.$year;

?>

<a href="../nindex.htm">&lt;&lt; ����</a><br /> 
<table width="855" border="0" >
  <tr valign="top">
    <td width="326" height="219" align="center"><form id="form1" name="form1" method="get" action="">
      <table border="0">
        <tr>
          <td width="53" align="right">�ѹ���Ѵ : </td>
          <td width="19" align="left"><input name="appdate" type="text" size="2" maxlength="2" value="<?php echo $day;?>"></td>
          <td width="34" align="right">��͹ : </td>
          <td width="101" align="center"><select size="1" name="appmo">
    <option selected>--���͡--</option>
    <option value="���Ҥ�" <?php if($month == "���Ҥ�" || $month == "01"){ echo " Selected "; }?>>���Ҥ�</option>
    <option value="����Ҿѹ��" <?php if($month == "����Ҿѹ��" || $month == "02"){ echo " Selected "; }?>>����Ҿѹ��</option>
    <option value="�չҤ�" <?php if($month == "�չҤ�" || $month == "03"){ echo " Selected "; }?>>�չҤ�</option>
    <option value="����¹" <?php if($month == "����¹" || $month == "04"){ echo " Selected "; }?>>����¹</option>
    <option value="����Ҥ�" <?php if($month == "����Ҥ�" || $month == "05"){ echo " Selected "; }?>>����Ҥ�</option>
    <option value="�Զع�¹" <?php if($month == "�Զع�¹" || $month == "06"){ echo " Selected "; }?>>�Զع�¹</option>
    <option value="�á�Ҥ�" <?php if($month == "�á�Ҥ�" || $month == "07"){ echo " Selected "; }?>>�á�Ҥ�</option>
    <option value="�ԧ�Ҥ�" <?php if($month == "�ԧ�Ҥ�" || $month == "08"){ echo " Selected "; }?>>�ԧ�Ҥ�</option>
    <option value="�ѹ��¹" <?php if($month == "�ѹ��¹" || $month == "09"){ echo " Selected "; }?>>�ѹ��¹</option>
    <option value="���Ҥ�" <?php if($month == "���Ҥ�" || $month == "10"){ echo " Selected "; }?>>���Ҥ�</option>
    <option value="��Ȩԡ�¹" <?php if($month == "��Ȩԡ�¹" || $month == "11"){ echo " Selected "; }?>>��Ȩԡ�¹</option>
    <option value="�ѹ�Ҥ�" <?php if($month == "�ѹ�Ҥ�" || $month == "12"){ echo " Selected "; }?>>�ѹ�Ҥ�</option>
  </select></td>
          <td width="14" align="right">�� : </td>
          <td width="61" align="left"><input name="thiyr" type="text" value="<?php echo $year;?>" size="4" maxlength="4"></td>
        </tr>
        <tr>
          <td align="right">HN : </td>
          <td colspan="5" align="left"><input name="hn" type="text" id="hn" /></td>
        </tr>
        <tr>
          <td colspan="6" align="center"><input name="Select_hn" type="submit" value="��ŧ" /></td>
        </tr>
      </table>
          </form>  
		  <?php if(!empty($_REQUEST["Select_hn"]) && $_REQUEST["Select_hn"] == "��ŧ" ){
		  
		  $appd=$_REQUEST["appdate"].' '.$_REQUEST["appmo"].' '.$_REQUEST["thiyr"];
		  
		  $sql = "Select row_id, hn, ptname, appdate, apptime, diag, remark From appoint where appdate = '".$appd."' AND hn='".$_REQUEST["hn"]."' limit 1 ";
		  $result = Mysql_Query($sql);
		  
		  if(Mysql_num_rows($result) <=0){
		  	echo "<center>��������������¡�ùѴ�ѹ���</center>";
		  }else{
		  
		  list($row_id, $hn, $ptname, $appdate, $apptime, $diag, $remark) = Mysql_fetch_row($result);
		  
		  ?>
      <table align="center" border="1" cellpadding="0" cellspacing="0" style="BORDER-COLLAPSE: collapse" bordercolor="#0000A6">
        <tr>
          <td><form action="" method="post" name="f2">
            <table width="310" border="0">
              <tr class="font_title">
                <td colspan="2" align="center">�ѹ�֡������</td>
                </tr>
              <tr>
                <td align="right">HN : </td>
                <td align="left"><?php echo $hn;?></td>
              </tr>
              <tr>
                <td width="56" align="right">���� - ʡ�� : </td>
                <td width="254" align="left"><?php echo $ptname;?></td>
              </tr>
              <tr>
                <td align="right">�ѹ���Ѵ : </td>
                <td align="left"><?php echo $appdate;?></td>
              </tr>
              <tr>
                <td align="right">���ҷ��Ѵ : </td>
                <td align="left"><?php echo $apptime;?></td>
              </tr>
              <tr>
                <td align="right">�ä : </td>
                <td align="left"><input name="diag" type="text" id="diag" value="<?php echo $diag;?>" /></td>
              </tr>
              <tr>
                <td align="right">�����˵� : </td>
                <td align="left"><input name="remark" type="text" id="remark" value="<?php echo $remark;?>" /></td>
              </tr>
              <tr align="right">
                <td colspan="2" align="center"><input name="Save_app" type="submit" id="Save_app" value="��ŧ" /></td>
              </tr>
            </table>
			<input name="row_id" type="hidden" value="<?php echo $row_id;?>" />
          </form></td>
        </tr>
      </table>
	  <?php }} ?>
      <br />  </td>
    <td  align="left"><form id="form2" name="form2" method="post" action="nc_appoilst.php">
      <table border="0">
        <tr>
          <?php
  
 		
		if(isset($_REQUEST["appdate2"]) && $_REQUEST["appdate2"] != ""){
			$day3 = $_REQUEST["appdate2"];
		}else{	
			$day3 = date("d");
		}
		
		if(isset($_REQUEST["appmo2"]) && $_REQUEST["appmo2"] != ""){
			$month3 = $_REQUEST["appmo2"];
		}else{	
			$month3 = date("m");
			
			if(  date("m") == "01"){$month3 = "���Ҥ�" ; }
    else if( date("m") == "02"){ $month3 = "����Ҿѹ��" ; }
    else if( date("m") == "03"){$month3 = "�չҤ�"  ; }
    else if(  date("m") == "04"){ $month3 = "����¹"; }
    else if(  date("m") == "05"){ $month3 = "����Ҥ�"; }
    else if(  date("m") == "06"){ $month3 = "�Զع�¹"; }
    else if(  date("m") == "07"){ $month3 = "�á�Ҥ�"; }
    else if(  date("m") == "08"){ $month3 = "�ԧ�Ҥ�"; }
    else if( date("m") == "09"){ $month3 = "�ѹ��¹" ; }
    else if( date("m") == "10"){$month3 = "���Ҥ�"  ; }
    else if(  date("m") == "11"){ $month3 = "��Ȩԡ�¹"; }
    else if(  date("m") == "12"){$month3 = "�ѹ�Ҥ�" ; }

		}
		
		if(isset($_REQUEST["thiyr2"]) && $_REQUEST["thiyr2"] != ""){
			$year3 = $_REQUEST["thiyr2"];
		}else{	
			$year3 = date("Y")+543;
		}
		
		$appd2=$day3.' '.$month3.' '.$year3;
?>
          <td width="53" align="right">���� : </td>
          <td width="19" align="left"><input name="appdate2" type="text" id="appdate2" value="<?php echo $day3;?>" size="2" maxlength="2" /></td>
          <td width="34" align="right">��͹ : </td>
          <td width="101" align="center"><select name="appmo2" size="1" id="appmo2">
              <option selected>--���͡--</option>
              <option value="���Ҥ�" <?php if($month3 == "���Ҥ�" || $month3 == "01"){ echo " Selected "; }?>>���Ҥ�</option>
              <option value="����Ҿѹ��" <?php if($month3 == "����Ҿѹ��" || $month3 == "02"){ echo " Selected "; }?>>����Ҿѹ��</option>
              <option value="�չҤ�" <?php if($month3 == "�չҤ�" || $month3 == "03"){ echo " Selected "; }?>>�չҤ�</option>
              <option value="����¹" <?php if($month3 == "����¹" || $month3 == "04"){ echo " Selected "; }?>>����¹</option>
              <option value="����Ҥ�" <?php if($month3 == "����Ҥ�" || $month3 == "05"){ echo " Selected "; }?>>����Ҥ�</option>
              <option value="�Զع�¹" <?php if($month3 == "�Զع�¹" || $month3 == "06"){ echo " Selected "; }?>>�Զع�¹</option>
              <option value="�á�Ҥ�" <?php if($month3 == "�á�Ҥ�" || $month3 == "07"){ echo " Selected "; }?>>�á�Ҥ�</option>
              <option value="�ԧ�Ҥ�" <?php if($month3 == "�ԧ�Ҥ�" || $month3 == "08"){ echo " Selected "; }?>>�ԧ�Ҥ�</option>
              <option value="�ѹ��¹" <?php if($month3 == "�ѹ��¹" || $month3 == "09"){ echo " Selected "; }?>>�ѹ��¹</option>
              <option value="���Ҥ�" <?php if($month3 == "���Ҥ�" || $month3 == "10"){ echo " Selected "; }?>>���Ҥ�</option>
              <option value="��Ȩԡ�¹" <?php if($month3 == "��Ȩԡ�¹" || $month3 == "11"){ echo " Selected "; }?>>��Ȩԡ�¹</option>
              <option value="�ѹ�Ҥ�" <?php if($month3 == "�ѹ�Ҥ�" || $month3 == "12"){ echo " Selected "; }?>>�ѹ�Ҥ�</option>
          </select></td>
          <td width="14" align="right">�� : </td>
          <td width="42" align="left"><input name="thiyr2" type="text" value="<?php echo $year3;?>" size="4" maxlength="4" /></td>
          <td width="80" align="left"><input name="Search_date" type="submit" id="Search_date" value="��ŧ" /></td>
        </tr>
      </table>
          </form>
	  <table width="100%" align="center" border="1" cellpadding="0" cellspacing="0" style="BORDER-COLLAPSE: collapse" bordercolor="#0000A6">
        <tr>
        <tr>
          <td><table width="100%" border="0">
            <tr align="center" class="font_title">
              <td width="50">No.</td>
              <td width="50">HN</td>
              <td width="100">����-ʡ��</td>
              <td >�ä</td>
              <td width="100">ᾷ��</td>
              <td width="100">�����˵�</td>
            </tr>
<?php 
	$sql = "Select * From appoint where appdate = '".$appd2."' AND diag is not NULL and diag !='' ";
	$result = Mysql_Query($sql);
	$i=1;
	while($arr = Mysql_fetch_assoc($result)){
	$xxx = explode(" ",$arr["appdate"]);
	$arr["doctor"] = substr($arr["doctor"],5);
?>			
            <tr>
              <td width="50"><a href="?appdate=<?php echo $xxx[0];?>&appmo=<?php echo urlencode($xxx[1]);?>&thiyr=<?php echo $xxx[2];?>&hn=<?php echo $arr["hn"];?>&Select_hn=%B5%A1%C5%A7">���</a>&nbsp;<a href="?del=true&row_id=<?php echo $arr["row_id"];?>">ź</a>&nbsp;<?php echo $i;$i++;?>.</td>
              <td width="50"><?php echo $arr["hn"];?></td>
              <td width="100"><?php echo $arr["ptname"];?></td>
              <td><?php echo $arr["diag"];?></td>
              <td width="100"><?php echo $arr["doctor"];?></td>
              <td width="100"><?php echo $arr["remark"];?></td>
            </tr>
<?php } ?>
<tr align="center">
              <td colspan="8"><input name="print" type="button" value="�����" Onclick="window.open('print_nc_appoilst.php?appdate2=<?php echo $day3;?>&appmo2=<?php echo $month3;?>&thiyr2=<?php echo $year3;?>');"/></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
<?php
include("unconnect.inc");
?>
