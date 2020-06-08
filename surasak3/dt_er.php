<?php 
session_start();
include("connect.inc");
include("checklogin.php");


$sql = "Select a.name From doctor as a INNER JOIN inputm as b ON a.doctorcode = b.codedoctor where idname = '".$_SESSION["sIdname"]."' limit 1";


list($doctorname) = Mysql_fetch_row(Mysql_Query($sql));

$thidate = date("d-m-").(date("Y")+543);
$sql = "Select vn, hn, ptname, toborow  From opd where thdatehn like '".$thidate."%' AND (toborow like 'EX02%'  || toborow like 'EX19%' || toborow like 'EX23%') AND dc_diag is NULL Order by vn ASC ";

$result_list_pt = Mysql_Query($sql);

$num_list_pt = Mysql_num_rows($result_list_pt );
?>
<html>
<head>
<title></title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFFF;  }

-->
</style>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.form_vn.vn_now.focus();

}

</SCRIPT>
</head>
</body>
<a href='../nindex.htm'>&lt;&lt;ไปเมนู</a>
<BR>
<table width="100%" border="0">
  <tr>
    <td>
	<FORM name="form_vn" METHOD=POST ACTION="dt_add_patient.php">
<TABLE>
<TR>
	<TD>
		<TABLE>
		<TR>
		  <TD align="center">&nbsp;</TD>
		  <TD colspan="2" align="left"><strong>แพทย์ห้องฉุกเฉิน</strong></TD>
		  </TR>
		<TR>
			<TD><font face=''>VN : </font></TD>
			<TD align="left"><INPUT TYPE="text" NAME="vn_now"></TD>
			<TD>&nbsp;</TD>
		</TR>
		<TR>
			<TD><font face=''>แพทย์ : </font></TD>
			<TD align="left">
			<?php
			//echo $_SESSION["smenucode"];
				
				//if( $_SESSION["smenucode"] == "ADMDEN")
					$where = "AND (a.row_id = '160' || a.row_id = '161' || a.row_id = '162' || a.row_id = '163' || a.row_id = '164' )";
				//else
					//$where = " AND  menucode like '%%' ";

				$sql = "Select a.name From doctor as a where status = 'y' AND left(a.name,2) = 'MD' AND a.name <> '' ".$where;
				//echo $sql;
				$result = mysql_query($sql);
				echo "<Select name='doctor'>";
				while($arr = mysql_fetch_assoc($result)){
					$sql = "Select name From inputm where mdcode = '".substr($arr["name"],0,5)."' limit 1 ";
					$r = mysql_query($sql);
					$a = mysql_fetch_assoc($r);
					if(mysql_num_rows($r) > 0)
						echo "<option value='".$a["name"]."'>".$a["name"]."</option>";
				}
				echo "</Select>";
			?></TD>
			<TD><INPUT TYPE="submit" value="ตกลง"></TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
</td>
    <td align="right">
	<table border="1"  bordercolor="#FF0000" cellpadding="5" cellspacing="0">
  <tr>
    <td>จำนวนคนไข้ : <?php echo $num_list_pt;?> คน </td>
  </tr>
</table>

	</td>
  </tr>
</table>


<BR><FONT SIZE="4" COLOR="#990033"><B>ข่าวสาร</B></FONT><BR>
<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$num = Y;
$depart1=dr;
   $query = "SELECT  row,depart,new,datetime FROM new  WHERE status ='$num' and depart  ='$depart1' ORDER BY row DESC  ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($row,$depart,$new,$datetime) = mysql_fetch_row ($result)) {

        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><br>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=15 src='new.gif' width=30>&nbsp;***&nbsp$new</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>($depart</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>&nbsp$datetime)&nbsp*** <br></td>\n".

           " </tr>\n");
        }
    print "</table>";


?>
<BR>
<div  style="text-align: left; width:650px; height:350px; overflow:auto; ">
<TABLE width='600'>
<TR class="tb_head">
	<TD>VN</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สถานะ</TD>
</TR>
<?php

while(list($vn, $hn, $ptname, $toborow) = Mysql_fetch_row($result_list_pt)){

	if(substr($toborow,-4) == "EX02" || substr($toborow,-4) == "EX19" || substr($toborow,-4) == "EX23"){
		$class = "tb_detail2";
	}else{
		$class = "tb_detail";
	}
?>
<TR class="<?php echo $class;?>">
	<TD><A HREF="javascript:document.form_vn.vn_now.value='<?php echo $vn;?>';form_vn.submit();" ><?php echo $vn;?></A></TD>
	<TD><?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD><?php echo $toborow;?></TD>
</TR>
<?php }?>
</TABLE>
</div>

</body>

<?php include("unconnect.inc");?>
</html>