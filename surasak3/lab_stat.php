<?php
session_start();
 include("connect.inc");   
	$month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฏาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";

	?>
<html>
<head>
<style>
	body{
		font-family:"Angsana New";font-size:20px;
	}
	.font_tb{ 
		font-family:"Angsana New"; font-size:20px; text-align:center;
		}
</style>
<style media="print">
	.tb_search{
		display:none;
	}
</style>
<style>

@font-face {
 font-family: THSarabunPSK;
 src: url("/sm3/surasak3/THSarabun.eot") /* EOT file for IE */
}
@font-face {
 font-family: THSarabunPSK;
 src: url("/sm3/surasak3/THSarabun.ttf") /* TTF file for CSS3 browsers */
}

.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
</style>
</head>
<body>
	<form method="post" action="<?php echo $PHP_SELF ?>" class="tb_search">
 <?php
	
	if(isset($_POST["start_day"])){
		$start_day_def = $_POST["start_day"];
	}else{
		$start_day_def = date("d");
	}

	if(isset($_POST["start_month"])){
		$start_month_def = $_POST["start_month"];
	}else{
		$start_month_def = date("m");
	}

	if(isset($_POST["start_year"])){
		$start_year_def = $_POST["start_year"];
	}else{
		$start_year_def = date("Y");
	}
 
 
 ?>
 <TABLE id="f_search" >
<TR>
	<TD align="right">วันที่ :</TD>
	<TD>
		<INPUT TYPE="text" NAME="start_day" value="<?php echo $start_day_def;?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<OPTION VALUE="" >ดูทั้งหมด</Option>
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if($start_month_def == $value) echo " Selected ";
			echo ">",$index,"</Option>";
			
			}	?>
			
		</SELECT> / 
		<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='start_year'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
		
	</TD>
</TR>
<TR>
	<TD colspan="2">Code : <INPUT TYPE="text" NAME="code" value="<?php echo $_POST["code"];?>"></TD>
</TR>
</TABLE>

 <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>
 </p>
<INPUT TYPE="hidden" name="select_date" value="1">
</form>


    <p>
      <?php
	if(!empty($_POST["select_date"])){
		
		if($_POST["start_month"] == ""){
			$where = " AND date like '".$_POST["start_year"]."%' ";
			$title = "ปี ".$_POST["start_year"];
		}else{
			$where = " AND date like '".$_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"]."%' ";
			$title = "".$_POST["start_day"]."  ".$month[$_POST["start_month"]]." ".$_POST["start_year"];

			if(!empty($_POST["start_day"]))
				$title = " วัน ".$title;

		}
		
		if($_POST["code"] != ""){
			$where .= " AND code = '".$_POST["code"]."' ";
		}

		$sql = "CREATE TEMPORARY TABLE patdata_2 Select date_format(date,'%Y-%m-%d') as datelst, date_format(date,'%H:%i:%s') as timelst, code,detail,amount,status, ( CASE WHEN amount >0 THEN 1  ELSE ( CASE WHEN amount <0 THEN -1 ELSE 0  END  ) END  ) AS stat From patdata where depart ='PATHO' ".$where."  order by detail ";
		//echo $sql;
		$result = mysql_query($sql) or die(mysql_error());

		
?>
      <style>
	.tb_head{ background-color: #336699; color:#FFFFFF; font-weight:bold;}
    </style>
</p>
&nbsp;&nbsp;<?php echo $title;?>
    <table border="1" cellpadding="0" cellspacing="0" bordercolor="#336699">
      <tr>
        <td><TABLE width="700" border="0" cellpadding="2" cellspacing="2">
          <TR align="center" class="tb_head">
            <TD>Code</TD>
			<TD>Detail</TD>
			<TD>ก่อนเช้า</TD>
            <TD>เช้า</TD>
            <TD>บ่าย</TD>
            <TD>ดึก</TD>
			<TD>รวม</TD>
          </TR>
          <?php
	
	$sql = "Select distinct code From patdata_2 ";
	$result = mysql_query($sql);
	while(list($code) = mysql_fetch_row($result)){

		list($code_name) = mysql_fetch_row(mysql_query("Select detail From labcare where code = '".$code."' limit 0,1 "));
	if($bgcolor =="#FFFFFF")
		$bgcolor = "#FFFFBB";
	else
		$bgcolor = "#FFFFFF";

	$sum4=0;
?>
          <TR bgcolor="<?php echo $bgcolor;?>">
            <TD><?php echo $code;?></TD>
			<TD><?php echo $code_name;?></TD>
			<TD align="right"><?php $sql = "Select sum(stat) From patdata_2 where code = '".$code."' AND timelst between '07:00:00' AND '07:59:59' ";
					$result2 = mysql_query($sql) or die(mysql_error());
					list($sum) = mysql_fetch_row($result2);
					echo $sum;
					$sum0 += $sum; 
					$sum4 += $sum;
		?>
              &nbsp; </TD>
            <TD align="right"><?php $sql = "Select sum(stat) From patdata_2 where code = '".$code."' AND timelst between '08:00:00' AND '16:00:00' ";
					$result2 = mysql_query($sql) or die(mysql_error());
					list($sum) = mysql_fetch_row($result2);
					echo $sum;
					$sum1 += $sum; 
					$sum4 += $sum;
		?>
              &nbsp; </TD>
            <TD align="right"><?php $sql = "Select sum(stat) From patdata_2 where code = '".$code."' AND timelst between '16:00:01' AND '23:59:59' ";
					$result2 = mysql_query($sql);
					list($sum) = mysql_fetch_row($result2);
					echo $sum;
					$sum2 += $sum;
					$sum4 += $sum;
		?>
              &nbsp; </TD>
            <TD align="right"><?php $sql = "Select sum(stat) From patdata_2 where code = '".$code."' AND timelst between '00:00:00' AND '06:59:59' ";
					$result2 = mysql_query($sql);
					list($sum) = mysql_fetch_row($result2);
					echo $sum;
					$sum3 += $sum;
					$sum4 += $sum;
		?>
              &nbsp; </TD>
			  <TD align="right"><?php
					echo $sum4;

		?>
              &nbsp; </TD>
          </TR>
          <?php } ?>
		  <TR>
            <TD colspan="3">รวม</TD>
			<TD align="right"><?php 
					echo $sum0;
		?>
              &nbsp; </TD>
            <TD align="right"><?php 
					echo $sum1;
		?>
              &nbsp; </TD>
            <TD align="right"><?php echo $sum2;
		?>
              &nbsp; </TD>
            <TD align="right">
		<?php 
					echo $sum3;
		?>
              &nbsp; </TD>
			  <TD align="right">
		<?php 
					echo $sum3+$sum2+$sum1+$sum0;
		?>
              &nbsp; </TD>
          </TR>
        </TABLE></td>
      </tr>
    </table>
    <p>&nbsp;    </p>
    <?php
	}	
?>
</body>
</html>