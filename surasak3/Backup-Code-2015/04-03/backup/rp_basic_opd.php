<?php

include("connect.inc");  
session_start();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--

.data_show{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#000000;
	}
.data_show1{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#000000;
	}
.data_show2{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#000000;
	background-color:#FFFF9D
	}
.data_drugreact{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#FF0000;
	
	}
.data_title{ 
	font-family:"MS Sans Serif"; 
	font-size:14px; 
	color:#FFFFFF;
	font-weight:bold;
	background-color:#0000FF
	}

body{ font-family:"MS Sans Serif";
font-size:16px;
}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="293" border="0">
    <tr class="data_show">
      <td align="right">�ѹ:</td>
      <td width="41"><select name="day" id="day">
	  <?php
	  for($i=1;$i<=31;$i++){
	  	echo '<option value="'.sprintf ("%02d",$i).'" ';
			if($i == date("d")) echo ' Selected ';
		echo '>'.$i.'</option>';
	  }
	  ?>
      </select></td>
      <td align="right">��͹ :</td>
      <td width="42"><select size="1" name="month">
    <option value="01" <?if(date("m")=="01"){ echo" Selected "; }?> >���Ҥ�</option>
    <option value="02" <?if(date("m")=="02"){ echo" Selected "; }?> >����Ҿѹ��</option>
    <option value="03" <?if(date("m")=="03"){ echo" Selected "; }?> >�չҤ�</option>
    <option value="04" <?if(date("m")=="04"){ echo" Selected "; }?> >����¹</option>
    <option value="05" <?if(date("m")=="05"){ echo" Selected "; }?> >����Ҥ�</option>
    <option value="06" <?if(date("m")=="06"){ echo" Selected "; }?> >�Զع�¹</option>
    <option value="07" <?if(date("m")=="07"){ echo" Selected "; }?> >�á�Ҥ�</option>
    <option value="08" <?if(date("m")=="08"){ echo" Selected "; }?> >�ԧ�Ҥ�</option>
    <option value="09" <?if(date("m")=="09"){ echo" Selected "; }?> >�ѹ��¹</option>
    <option value="10" <?if(date("m")=="10"){ echo" Selected "; }?> >���Ҥ�</option>
    <option value="11" <?if(date("m")=="11"){ echo" Selected "; }?> >��ɨԡ�¹</option>
    <option value="12" <?if(date("m")=="12"){ echo" Selected "; }?> >�ѹ�Ҥ�</option>
  </select></td>
      <td align="right">�� :</td>
      <td width="78"><select name="year" id="year">
	  <?php
	  for($i=(date("Y")+543)-5;$i<=(date("Y")+543)+5;$i++){
	  	echo '<option value="'.$i.'" ';
			if($i == (date("Y")+543)) echo ' Selected ';
		echo '>'.$i.'</option>';
	  }
	  ?>
      </select></td>
    </tr>
    <tr class="data_show">
      <td align="right">ᾷ�� : </td>
      <td colspan="5"><select name="doctor" id="doctor">
	   <?php 
		echo "<option value='' >---���¡�ٷ�����----</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
      </select>
	  <tr class="data_show">
      <td align="right">������ : </td>
      <td colspan="5">
	   <?php 
		print " <select  id='case1' name='case'>";
		print " <option value='' >---���¡�ٷ�����----</option>";
		print " <option value='EX01' ".($_POST["case"] =="EX01"?"Selected":"")." >�ѡ���ä�����������Ҫ���</option>";
		print " <option value='EX02' ".($_POST["case"] =="EX02"?"Selected":"")." >�����©ء�Թ</option>";
		print " <option value='EX04' ".($_POST["case"] =="EX04"?"Selected":"")." >�����¹Ѵ</option>";
		print " <option value='EX11' ".($_POST["case"] =="EX11"?"Selected":"")." >�ѡ���ä�͡�����Ҫ���</option>";
		print " </select>";
		?>
      
	  </td>
    </tr>
    <tr class="data_show">
      <td colspan="6"><input name="search" type="submit" id="search" value="��ŧ" /></td>
    </tr>
  </table>

</form>
<table width="900" border="1" cellpadding="0" cellspacing="0" bordercolor="#0000FF">
  <tr>
    <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
      <tr align="center" class="data_title">
        <td width="50">No.</td>
        <td width="116">�ѹ/����</td>
        <td width="116">hn</td>
        <td width="130">����-ʡ��</td>
        <td width="40">T</td>
        <td width="40">P</td>
        <td width="40">R</td>
        <td width="40">��.</td>
        <td width="40">BP</td>
		<td>�ҡ��</td>
        <td width="169">ᾷ��</td>
        <td width="169">���.</td>
        </tr>
		<?php
		if(empty($_POST["search"])){
			$search_date = (date("Y")+543).date("-m-d");
		}else{
			$search_date = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];
		}
			$sql = "Select thidate, hn, ptname,  temperature,  pause,  rate,  weight,  bp1,  bp2 ,  doctor , officer, date_format(thidate,'%d-%m-%Y'), organ  From opd where thidate like '".$search_date."%' AND doctor like '".$_POST["doctor"]."%'  AND toborow like '".$_POST["case"]."%' ";

			$result = Mysql_Query($sql);
			$no=1;
			$j=1;
			while(list($thidate, $hn, $ptname,  $temperature,  $pause,  $rate,  $weight,  $bp1,  $bp2 ,  $doctor , $officer, $thidate2, $organ) = mysql_fetch_row($result) ){

				if($j==1){
					$j = 2;
				}else{
					$j = 1;
				}
		?>
      <tr class="data_show<?php echo $j;?>">
        <td><?php echo $no;?></td>
        <td align="center"><?php echo $thidate;?></td>
        <td><A HREF="stk_basic_opd.php?dthn=<?php echo $thidate2.$hn;?>" target="_blank"><?php echo $hn;?></A></td>
        <td><A HREF="stk_basic_opd2.php?dthn=<?php echo $thidate2.$hn;?>" target="_blank"><?php echo $ptname;?></A></td>
        <td width="40" align="center"><?php echo $temperature;?></td>
        <td width="40" align="center"><?php echo $pause;?></td>
        <td width="40" align="center"><?php echo $rate;?></td>
        <td width="40" align="center"><?php echo $weight;?></td>
        <td width="40" align="center"><?php echo $bp1,'/',$bp2;?></td>
		<td align="left"><?php echo $organ;?></td>
        <td align="left"><?php echo $doctor;?></td>
        <td align="left"><?php echo $officer;?></td>
        </tr>
		<?php $no++;} ?>
    </table></td>
  </tr>
</table>
<?php 
include("unconnect.inc");
?>
</body>
</html>
