<?PHP
session_start();
set_time_limit(30);
include("connect.inc");

function getAge($birthday) {
$then = strtotime($birthday);
return(floor((time()-$then)/31556926));
}

//------�Ѻ��ҷ��١����㹵����------//
$gethn = $_GET["hn"];  
$getlabnumber = $_GET["labnumber"];
$getlistlab = $_GET["listlab"];
$getdepart = $_GET["depart"];
$getdoctor = $_GET["doctor"];
if(isset($_GET["lab_date"])){
	$date_now = $_GET["lab_date"];  // �ѹ�����١���ҡ�˹�㹵���� $date_now
}else{
	$date_now = date("Y-m-d");   // �������դ���ѹ��� �����ѹ���Ѩ�غѹ��˹������ $date_now
}
//------------------------------------------//
?>
<html>
<head>
<title>������ LAB</title>
<style type="text/css">
body,td,th {font-family: "TH SarabunPSK";font-size: 18px;}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_head2 {background-color: #0C5A2F; color:#B9F2F7; font-weight: bold; text-align:center;  }
.tb_head3 {background-color:#FFFFFF; color:#000000; font-size:20px; font-weight: bold;font-family:"TH SarabunPSK"; text-align:center;  }
.tb_head3_2 {background-color:0000A0; color:#FFFF00; font-size:25px; font-weight: bold;font-family:"TH SarabunPSK"; text-align:center; font-weight: bold;width: 200px; }
.tb_head3_3 {background-color:#FFFFFF; color:#0000CC; font-size:25px; font-weight: bold;font-family:"TH SarabunPSK"; text-align:right;  }
.tb_head3_1 {color:#990000; font-size:20px; font-family:"TH SarabunPSK";  height:15px;  }
.tb_head4 {background-color: #99FFCC; color:#000099; font-size:25px;   font-family:"TH SarabunPSK";}
.tb_head4_1 {background-color: #99FFCC; color:#FF0033; font-size:25px;  font-weight: bold; font-family:"TH SarabunPSK";}


.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.style1 {font-size: 13px}


@media print{
	div.iBannerFix{
		position:fixed;
		left: 0;
  		bottom: 0;
	}
}

div.iBannerFix{
	/* height:100px;
	left: 0;
	bottom: 0; */
	background-color:#FFFFFF;
	width:100%;
	z-index: 99;
	
}
div.iBannerFix td{
	font-family:"TH SarabunPSK";
	font-size: 16px;
}
.style2 {font-size: 18px;font-weight: bold;}
.style3 {font-size: 18px}
hr {margin: 2px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<? 
$sqlop="select distinct(testgroupname) as newtestgroupname from resulthead where hn ='$gethn' AND labnumber = '$getlabnumber' ";
$queryop=mysql_query($sqlop);
while($rowsop=mysql_fetch_array($queryop)){
	$chktestgroupname=$rowsop["newtestgroupname"];

	// ��������ǡ�д��
	$sql = "Select date_format(orderdate,'%Y-%m-%d') as neworderdate,patientname,labnumber,sex,dob,comment From resulthead where hn = '$hn' AND labnumber = '$getlabnumber' limit 0,1";
	
	$result = mysql_query($sql);
	$rows = mysql_fetch_array($result);
	$neworderdate =$rows["neworderdate"];
	$dateB=$rows["dob"]; // ��������ѹ�Դ
	?>
	<div style="page-break-after: always">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="28%" align="center"><strong>�ç��Һ�Ť�������ѡ��������</strong></td>
			<td align="center"><strong>���§ҹ�ŷҧ��ͧ��Ժѵԡ��</strong></td>
		</tr>
		<tr>
			<td align="center">
				<img src="images/surasak.jpg" width="52" height="52"><br>
				<span class="style1">1 ���� 1 �.�Ԫ�� �.���ͧ �.�ӻҧ 52000 �� 054-839305</span>
			</td>
			<td align="center">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="12%" align="right"><strong>Name :</strong></td>
						<td width="27%" align="left"><?=$rows["patientname"];?></td>
						<td width="9%" align="right"><strong>HN :</strong></td>
						<td width="20%" align="left"><?=$gethn;?></td>
						<td width="15%" align="right"><strong>Lab Number :</strong></td>
						<td width="17%" align="left"><?=$getlabnumber;?></td>
					</tr>
					<tr>
						<td height="24" align="right">
							<strong>Ward : </strong>
						</td>
						<td align="left" colspan="5"><?=$getdepart;?>&nbsp;&nbsp;&nbsp;<strong>Test : </strong><?=$getlistlab;?></td>
					</tr>
					<tr>
						<td align="right"><strong>Age :</strong></td>
						<td align="left" colspan="5"><?=getAge($dateB)." ��";?>&nbsp;&nbsp;&nbsp;<strong>Doctor : </strong><?=$getdoctor;?> <strong>Comment : </strong><?=$rows["comment"];?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-bottom: solid 1px #000; border-top:solid 1px #000;">
		<tr>
			<td width="32%" align="center"><strong>Test</strong></td>
			<td width="28%"><strong>Result</strong></td>
			<td width="15%"><strong>Unit</strong></td>
			<td width="25%"><strong>Reference Range</strong></td>
		</tr>
	</table>
	<?php 
	$sqlloop="select distinct(testgroupname) as newtestgroupname 
	from resulthead 
	where hn ='$gethn' 
	AND labnumber = '$getlabnumber' 
	and testgroupname='$chktestgroupname' ";
	$queryloop=mysql_query($sqlloop);
	while($rowsloop=mysql_fetch_array($queryloop)){
		$newtestgroupname=$rowsloop["newtestgroupname"];
	?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="5" align="left">
				<strong style="font-size:16px;"><u><?=$newtestgroupname;?></u></strong>
			</td>
		</tr>
			<? 

			/**
			 * �� max �ҡ��� group by profilecode
			 */


			$sql1 = "SELECT b. * 
			FROM ( 
				SELECT MAX(`autonumber`) AS `latest_id` 
				FROM `resulthead` 
				WHERE `hn` ='$gethn' 
				AND `labnumber` = '$getlabnumber' 
				AND `testgroupname` ='$newtestgroupname' 
				GROUP BY `profilecode`
			) AS a 
			LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` ";

			
			// $sql1="select * 
			// from resulthead 
			// where hn ='$gethn' 
			// and labnumber = '$getlabnumber' 
			// and testgroupname='$newtestgroupname' 
			// GROUP BY `profilecode` ";
			
			$result1= mysql_query($sql1);
			while($arr1 = mysql_fetch_assoc($result1)){
			$autonumber = $arr1["autonumber"];
			$sql2 = "select * from resultdetail where autonumber = '$autonumber' ";
			$result2= mysql_query($sql2);
			$i=0;
			while($arr2 = mysql_fetch_assoc($result2)){
				if($arr2["flag"] != 'N'){
					$bgcolor="#FFDDDD"; 
				}else if($i%2==0){ //$bgcolor="#FFFFBB"; 
					$bgcolor="#FFFFFF"; 
				}else{
					$bgcolor="#FFFFFF";
				}
			?> 
		<tr bgcolor="<?php echo $bgcolor;?>">
			<td width="416"><font color="#000000" size ="2">&nbsp;&nbsp;&nbsp;<?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["labname"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></font></td>
			<td align="left" width="248"><font  size ="2"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo $arr2["result"];?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></font></td>
			<td align="center" width="117"><font color="red" size ="2"><B><?php if($arr2["flag"] != 'N'){  echo"[", $arr2["flag"],"]";};?></B></font></td>
			<td align="left" width="195"><font  size ="2"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php echo "". ($arr2["unit"] !=""?"".$arr2["unit"]."":"")."";?><?php if($arr2["flag"] != 'N'){ echo "</B>";};?></font></td>
			<td align="left" width="325"><font  size ="2"><?php if($arr2["flag"] != 'N'){ echo "<B>";};?><?php if($arr2["normalrange"] != ""){ echo "[",$arr2["normalrange"],"]" ;};?><?php if($arr2["flag"] != 'N'){ echo "</B>";}?></font></td>
		</tr>
		<?
			}  // while result detail
		}  // while result head
		?>
	</table>
	<?
		// echo "<br />";
		}
	?>
	<div class="iBannerFix">  
		<hr />
		<?php
		$sql3="select * from resulthead 
		inner join resultdetail on resulthead.autonumber=resultdetail.autonumber 
		where resulthead.hn ='$gethn' 
		and resulthead.labnumber = '$getlabnumber'";
		$result3= mysql_query($sql3);
		$arr3 = mysql_fetch_assoc($result3);
		?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="67%"><span class="">Reported by : <?=$arr3["releasename"];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorize by : <?=$arr3["authorisename"];?></span></td>
				<td width="6%" align="right"><span class="">�����˵�&nbsp;</span></td>
				<td width="27%"><span class=""><b>L, H</b> ���¶֧ ��ҷ���������٧���Ҥ����ҧ�ԧ㹤�</span></td>
			</tr>
			<tr>
				<td><span class="">Date Authorise : <?=$arr3["authorisedate"];?> &nbsp;&nbsp;&nbsp;Date Printed : <?=date("Y-m-d H:i:s");?></span></td>
				<td align="right"><span class=""></span></td>
				<td><span class=""><strong>LL, HH</strong> ���¶֧ ��ҷ������㹪�ǧ�ԡĵ</span></td>
			</tr>
		</table>
	</div>
</div>  
	<?
}
?>  
</body>
</html>
