<?php    
	
include("connect.inc");

$vn= $_GET["vn"];

$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
?>
<html>
<head></head>
<body>
<style>
.clearfix::after {
	content: "";
	clear: both;
	display: table;
}

@media print {
	#screen_hide_print{
		display: none;
	}
	#hemo_item_1, #hemo_item_2{
		float: none;
		width: 100%!important;
	}
}
</style>

<div id="screen_hide_print">
<?php
print "<font face='Angsana New'>ระบบเบิกยาห้องไตเทียม ";
print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยาจากแพทย์ VN : $vn ";
print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1datehd1.php'>&lt;&lt;เลือกวันที่ใหม่</a>";
?>
</div>


<SCRIPT LANGUAGE="JavaScript">
t = 1*1000;
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

function searchSuggest() {
	
	url = 'drxlisthd1.php?action=refresh&d=<?php echo $_GET["d"];?>&m=<?php echo $_GET["m"];?>&yr=<?php echo $_GET["yr"];?>&vn=<?php echo $_GET["vn"];?>';
	xmlhttp = newXmlHttp();
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("list").innerHTML = xmlhttp.responseText;
	tt = 20*1000;
	setTimeout("searchSuggest();",tt);
}

</SCRIPT>

<div class="clearfix">
	<div style="float:left; width: 50%;" id="hemo_item_1">
		<div style="text-align: center;">
			<h2>เบิกยาไตเทียม 1</h2>
		</div>
		<table>
			<tr>
				<th bgcolor=6495ED><font face='Angsana New'>#</th>
				<th bgcolor=6495ED><font face='Angsana New'>VN</th>
				<th bgcolor=6495ED><font face='Angsana New'>เวลา</th>
				<th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
				<th bgcolor=6495ED><font face='Angsana New'>HN</th>
				<th bgcolor=6495ED><font face='Angsana New'>ค่ายา</th>
				<th bgcolor=6495ED><font face='Angsana New'>สิทธิ</th>
				<th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
			</tr>
			<?php 

			$today_en = ($_GET["yr"]-543)."-".$_GET["m"]."-".$_GET["d"];

			$HD1="HD";
			$query = "SELECT tvn,date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin,whokey 
			FROM dphardep 
			WHERE 
			date LIKE '$today%' 
			AND dr_cancle is null 
			and doctor LIKE '$HD1%' 
			AND item >= 0 
			Order by hn DESC  ";
			//echo $query."<br>";

			$result = mysql_query($query) or die("Query failed");
			$num=mysql_num_rows($result);
			$i = 1;
			while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin,$whokey) = mysql_fetch_row ($result)) {


				$sql_hemo_1 = "SELECT * FROM `appoint` WHERE `appdate_en` = '$today_en' AND `detail` LIKE 'FU18%' AND `hn` = '$hn' ";
				//echo $sql_hemo_1."<br>";
				$q1 = mysql_query($sql_hemo_1);
				if(mysql_num_rows($q1) == 0)
				{
					continue;
				}

				$time=substr($date,11);
				if($stkcutdate == "")
					$bgcolor="#66CDAA";
				else
					$bgcolor="#FFFFFF";

				$whokey=substr($whokey,0,2);

				if($whokey == "HD")
					$bgcolor1="#00CCFF";
				else
					$bgcolor1="#66CDAA";

				if($bgcolor=="#FFFFFF")
					$bgcolor1="#FFFFFF";
				else
					$bgcolor1=$bgcolor1;

				print (" <tr>\n".
				"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$i</td>\n".
					"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$tvn</td>\n".
				"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$time</td>\n".
				"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'><a target=_BLANK  href=\"drxdetailhd.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
				"  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$hn</td>\n".
				"  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$price</td>\n".
				"  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$ptright</td>\n".
				"  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$doctor</td>\n".
					
				" </tr>\n");
				//    $num--;
				$i++;
			}
			?>
		</table>
	</div>

	<div style="float:left; width: 50%; " id="hemo_item_2">
		<div style="text-align: center;">
			<h2>เบิกยาไตเทียม 2</h2>
		</div>
		<table >
			<tr>
				<th bgcolor=6495ED><font face='Angsana New'>#</th>
				<th bgcolor=6495ED><font face='Angsana New'>VN</th>
				<th bgcolor=6495ED><font face='Angsana New'>เวลา</th>
				<th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
				<th bgcolor=6495ED><font face='Angsana New'>HN</th>
				<th bgcolor=6495ED><font face='Angsana New'>ค่ายา</th>
				<th bgcolor=6495ED><font face='Angsana New'>สิทธิ</th>
				<th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
			</tr>
			<?php 

			$HD1="HD";
			$query = "SELECT tvn,date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin,whokey 
			FROM dphardep 
			WHERE 
			date LIKE '$today%' 
			AND dr_cancle is null 
			and doctor LIKE '$HD1%' 
			and item >= 0
			Order by hn DESC  ";
			//echo $query;
			$result = mysql_query($query) or die("Query failed");
			$num=mysql_num_rows($result);
			$i = 1;
			while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin,$whokey) = mysql_fetch_row ($result)) {
			
				$sql_hemo_1 = "SELECT * FROM `appoint` WHERE `appdate_en` = '$today_en' AND `detail` LIKE 'FU39%' AND `hn` = '$hn' ";
				$q1 = mysql_query($sql_hemo_1);
				if(mysql_num_rows($q1) == 0)
				{
					continue;
				}
			
				$time=substr($date,11);
				if($stkcutdate == "")
					$bgcolor="#66CDAA";
				else
					$bgcolor="#FFFFFF";
			
				$whokey=substr($whokey,0,2);
					if($whokey == "HD")
						$bgcolor1="#00CCFF";
					else
						$bgcolor1="#66CDAA";
			
				if($bgcolor=="#FFFFFF")
					$bgcolor1="#FFFFFF";
				else
					$bgcolor1=$bgcolor1;
			
				print (" <tr>\n".
					"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$i</td>\n".
					"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$tvn</td>\n".
					"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$time</td>\n".
					"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'><a target=_BLANK  href=\"drxdetailhd.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
					"  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$hn</td>\n".
					"  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$price</td>\n".
					"  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$ptright</td>\n".
					"  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$doctor</td>\n".
					
					" </tr>\n");
				//  $num--;
				$i++;
			}
			?>

		</table>
	</div>
	
</div>





















</body>
</html>
<?php  include("unconnect.inc");?>
<FONT SIZE="5" COLOR="#000099">***หมายเหตุ***<BR>
<FONT SIZE="4" COLOR="#000000"><b>สีเขียวล้วน</b> คือ ยังไม่ได้ตัดสต๊อก ยังไม่ได้ส่งห้องยา สามารถแก้ไข / เพิ่มได้</FONT>
<BR>
<FONT SIZE="4" COLOR="#66CDAA"><b>สีเขียวล้วน+สีฟ้า</b> คือ ยังไม่ได้ตัดสต๊อก ส่งห้องยาแล้ว สามารถแก้ไข / เพิ่มได้</FONT>
<BR>
<FONT SIZE="4" COLOR="#FF0066"><b>สีขาว</b> คือ ได้ทำการตัดสต็อกแล้ว ไม่สามารถแก้ไข / เพิ่มได้</FONT></FONT>