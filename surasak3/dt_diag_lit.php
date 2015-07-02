<?php 
session_start();
include("connect.inc");
include("checklogin.php");

?>
<html>
<head>
<title><?php echo $_SESSION["dt_doctor"];?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0C5A2F; color:#B9F2F7; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFFF;  }

-->
</style>
</head>
</body>
<?php include("dt_menu.php");?>
<BR><BR>

<?php

$sql = "Create Temporary table drugrx_2 Select * From drugrx where hn='".$_SESSION["hn_now"]."' ";
$result = mysql_query($sql);

$sql = "Create Temporary table patdata_2 Select * From patdata where hn='".$_SESSION["hn_now"]."' ";
$result = mysql_query($sql);

	$sql = "Select date_format(thidate,'%d/%m/%Y %H:%i') as date2, date_format(thidate,'%Y-%m-%d') as date3, diag, doctor, icd10 From opday where hn='".$_SESSION["hn_now"]."' Order by row_id DESC limit 0,10";
	
	$result = mysql_query($sql);
	while($arr = mysql_fetch_assoc($result)){
		$opdsign = "select * from opd where hn='".$_SESSION["hn_now"]."' and thidate like '".$arr["date3"]."%'";
		$result2 = mysql_query($opdsign);
		$arr2 = mysql_fetch_assoc($result2);

?>

<TABLE border="1" align="center" cellpadding="0" cellspacing="0" style="border-color: #33FF00" >
<TR>
	<TD>
<TABLE border='0' align="center" width="600">
<TR class="tb_head">
	<TD colspan="4" align="center"><strong>วันเวลาที่มา : <?php echo $arr["date2"];?></strong></TD>
</TR>
<TR>
  <TD colspan="4" align="right"><table width="85%" border="0" align="center">
  <tr>
    <td>T : <?php echo $arr2["temperature"]?> C&deg;</td>
    <td>P : <?php echo $arr2["pause"]?> ครั้ง/นาที&nbsp;</td>
    <td>R : <?php echo $arr2["rate"]?> ครั้ง/นาที</td>
    <td>BP : <?php echo $arr2["bp1"]."/".$arr2["bp2"]?> mmHg.&nbsp;</td>
  </tr>
  <tr>
    <td>Weight : <?php echo $arr2["weight"]?> กก.</td>
    <td>Height : <?php echo $arr2["height"]?> ซม.</td>
    <td>แพ้ยา : <?php if($arr2["drugreact"]=="0") echo "ไม่แพ้"; elseif($arr2["drugreact"]=="1"){
		$drugreact1 = "select * from drugreact where hn='".$_SESSION["hn_now"]."'";
		$result33 = mysql_query($drugreact1);
		$arr33 = mysql_fetch_assoc($result33);
		echo $arr33["tradname"];
		}?></td>
    <td>โรคประจำตัว : <?php echo $arr2["congenital_disease"]?></td>
  </tr>
  <tr>
    <td colspan="4">อาการ : <?php echo $arr2["organ"]?></td>
    </tr>
    </table> <hr></TD>
  </TR>
<TR>
	<TD align="right" width="85">Diag : </TD>
	<TD width="309"><?php echo $arr["diag"]?>&nbsp;</TD>
	<TD align="right" width="62">ICD10 : </TD>
	<TD width="126"><?php echo $arr["icd10"]?>&nbsp;</TD>
</TR>
<TR>
	<TD align="right" width="85">แพทย์ : </TD>
	<TD colspan="3"><?php echo $arr["doctor"]?>&nbsp;</TD>
</TR>
<TR>
	<TD align="right" width="85" valign="top" >ยาที่ได้รับ : </TD>
	<TD valign="top" colspan="3">
		<Table width="500">
	<?php
		$sql = "Select drugcode,  tradname , sum(amount) as amount  From drugrx_2 where date like '".$arr["date3"]."%' AND hn = '".$_SESSION["hn_now"]."' AND drugcode <> 'inj' Group by drugcode";
		//echo $sql;
		$resul_drugrx = mysql_query($sql);
		$i=0;
		while($arr_drugrx = mysql_fetch_assoc($resul_drugrx)){
			/*if($i==1){
				$i=0;
				$bgcolor = "#FFFFA6";
			}else{
				$bgcolor = "#FFFFFF";
				$i=1;
			}*/
			echo "<TR bgcolor='".$bgcolor."'>";
			echo "<TD width='400'>",$arr_drugrx["tradname"],"</TD>";
			echo "<TD width='100'>จำนวน : ",$arr_drugrx["amount"],"</TD>";
			echo "</TR>";
		}
	?>
		</Table>	</TD>
</TR>
<TR>
	<TD align="right" width="85" valign="top" >หัตถการที่ทำ : </TD>
	<TD valign="top" colspan="3">
		<Table width="500"  bgcolor="#CDF1FC">
	<?php
		$d = explode("-",$arr["date3"]);
		$dd = ($d[0]-543)."-".$d[1]."-".$d[2];
		
		$list_lab["TRI"] = "TRIG";
		$list_lab["BS"] = "GLU";
		$list_lab["CR"] = "CREA";
		$list_lab["CHOL"] = "CHOL";
		$list_lab["SGOT"] = "AST";
		$list_lab["SGPT"] = "ALT";
		$list_lab["ALK"] = "ALP";
		$list_lab["BUN"] = "BUN";
		$list_lab["URIC"] = "URIC";
			
		$sql = "Select  code , detail ,sum(amount) as amount  From patdata_2 where date like '".$arr["date3"]."%' AND hn = '".$_SESSION["hn_now"]."' Group by code ";
		$resul_drugrx = mysql_query($sql);
		$i=0;
		while($arr_drugrx = mysql_fetch_assoc($resul_drugrx)){
			$sql2 = "Select  result From resulthead as a , resultdetail as b  where a.hn='".$_SESSION["hn_now"]."' AND a.autonumber = b.autonumber AND a.orderdate like '".$dd."%' AND a.profilecode='".$list_lab[$arr_drugrx["code"]]."'";
			$resulthead = mysql_query($sql2);
			$arrhead = mysql_fetch_assoc($resulthead);
			
			/*if($i==1){
				$i=0;
				$bgcolor = "#FFFFA6";
			}else{
				$bgcolor = "#FFFFFF";
				$i=1;
			}*/
			echo "<TR>";
			echo "<TD width='300'>",$arr_drugrx["detail"],"</TD>";
			if($arr_drugrx["code"]=="CBC"){
				?>
			<TD width='100'><a onClick="window.open('dt_diag_lit_lab.php?code=CBC&dd=<?=$dd?>','ผลLAB','scrollbars=1,height=680,width=250')" title="ผลLAB"><u>กดเพื่อดูผล</u></a></TD>
            <?
			}elseif($arr_drugrx["code"]=="UA"){
			?>
			<TD width='100'><a onClick="window.open('dt_diag_lit_lab.php?code=UA&dd=<?=$dd?>','ผลLAB','scrollbars=1,height=680,width=250')" title="ผลLAB"><u>กดเพื่อดูผล</u></a></TD>
            <?
			}else{
			echo "<TD width='100'>",$arrhead["result"],"</TD>";
			}
			echo "<TD width='100'>จำนวน : ",$arr_drugrx["amount"],"</TD>";
			echo "</TR>";
		}
	?>
		</Table></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>

<BR>
<?php
	}	
?>
</body>

<?php include("unconnect.inc");?>
</html>