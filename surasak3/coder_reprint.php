<?php
include("connect.inc");  
session_start();
?>
<style>
body {
	background-color: #FFFFF0;
    font-family: "TH SarabunPSK";
    font-size: 20px;
    }
.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	
.style2 {
	font-family:"TH SarabunPSK";
	font-size: 20px;
	}
</style>
<title>พิมพ์ใบตรวจโรคผู้ป่วยนอก</title>
<?php
    $today=date("d-m-").(date("Y")+543);
    print "<strong class=\"txtsarabun\">วันที่ $today  รายการใบตรวจโรคผู้ป่วยนอก</strong>";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
    $today=(date("Y")+543)."-".date("m-d");
?>
<div style="margin-left:50px; margin-top: 30px;">
<form method="post" action="opd_reprint.php">
    <p style="font-size:24px;"><b>ค้นหาจาก</b></p>
    <div>HN ผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="hn" type="text" class="txtsarabun" id="aLink"  size="50" height="40">
    </div>
	<div>หรือ</div>
    <div>ประเภท&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="case" id="case" class="txtsarabun">
              <?php 
		echo "<option value='' >------------เลือกดูข้อมูล------------</option>";
		$sql = "select type_name from typeopcard";
		$result = mysql_query($sql);
		while(list($typename) = mysql_fetch_row($result)){
		
		echo "<option value='".$typename."' >".$typename."</option>";
		
		}
		?>
            </select>
    </div> 	
    <p style="margin-left:100px;">
    <input name="B1" type="submit" class="txtsarabun" value="     ค้นหา     ">
    &nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="txtsarabun" value="     ยกเลิก     ">
    </p>
</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>
</div>
<div style="margin-left:50px;">
<table width="90%" bordercolor="#000000">
 <tr>
  <th bgcolor="#16A085">#</th>
  <th bgcolor="#16A085">เวลา</th>
  <th bgcolor="#16A085">ชื่อ</th>
  <th bgcolor="#16A085">HN</th>
  <th bgcolor="#16A085">VN</th>
  <th bgcolor="#16A085">AN</th>
  <th bgcolor="#16A085">รหัสโรค ICD10</th>  
  <th bgcolor="#16A085">ชื่อโรค</th>  
  <th bgcolor="#16A085">สิทธิ</th>
  <th bgcolor="#16A085">การมาโรงพยาบาล</th>
  <th bgcolor="#16A085">แพทย์</th>
  <th bgcolor="#16A085">คลินิก</th>
  <th bgcolor="#16A085">การคืน OPD</th>
  <th bgcolor="#16A085">ผู้บันทึกล่าสุด</th>
 </tr>

<?php
    $num=0;
	if(!empty($_POST["hn"])){
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd FROM opday WHERE hn='".$_POST["hn"]."' and thidate LIKE '$today%' ORDER BY row_id ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจาก HN ผู้ป่วย</div>";
	}else if(!empty($_POST["case"])){
		$case=substr($_POST["case"],0,4);
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd FROM opday WHERE toborow LIKE '".$case."%' and thidate LIKE '$today%' ORDER BY row_id ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจากประเภทการมาโรงพยาบาล</div>";
	}else{
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd FROM opday WHERE thidate LIKE '$today%' ORDER BY row_id ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลทั้งหมดที่ลงทะเบียนวันนี้</div>";
	}	
	//echo $query;
	$result = mysql_query($query)
        or die("Query failed");


    while (list ($thidate,$thdatehn,$ptname,$hn,$ptright,$doctor,$vn,$clinic,$toborow,$an,$icd10,$diag,$dxgroup,$goup,$okopd) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($thidate,11);

	$sql112 = "Select row_id From appoint where hn = '".$hn."' and apptime !='ยกเลิกการนัด'  and date LIKE '$today%' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	$numapp=mysql_num_rows($result112);
	list($row_id) = Mysql_fetch_row($result112);
	if($numapp > 0){
		$printapp="<A target=_BLANK HREF=\"appinsert2.php?row_id=".urlencode($row_id)."\">พิมพ์</A>";	
	}else{
		$printapp="";
	}		


	$sql112 = "Select office From diag where hn = '".$hn."' and svdate LIKE '$today%' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	$numapp=mysql_num_rows($result112);
	list($office) = Mysql_fetch_row($result112);


if($icd10==""){
	$statusicd10="#F5B7B1";
}else{
	if($office=="ศิริวรรณ ปันทะรส" || $office=="ศิริวรรณ ปันทะรส" || $office=="อัญชัญ  ฉิมทิม"  || $office=="ทิพย์วรรณ จันทราช"){
		$statusicd10="#76D7C4";
	}else{
		$statusicd10="#EAEDED";
	}	
}	
        print (" <tr BGCOLOR='$statusicd10'>\n".
           "  <td align='center'>$num</td>\n".
           "  <td>$time</td>\n".
           "  <td>$ptname</td>\n".
           "  <td><a  href=\"dxopedit.php? cTdatehn=".urlencode($thdatehn)."&cPtname=".urlencode($ptname)."&cHn=".urlencode($hn)."&cGoup=".urlencode($goup)."&cDxg=".urlencode($dxgroup)."&cIcd10=".urlencode($icd10)."&cVn=".urlencode($vn)."\" >$hn</a></td>\n".
           "  <td>$vn</td>\n".
		   "  <td>$an</td>\n".
		   "  <td align='center'><strong>$icd10</strong></td>\n".		   
		   "  <td>$diag</td>\n".
		   "  <td>$ptright</td>\n".
		   "  <td>$toborow</td>\n".
   		   "  <td>$doctor</td>\n".
		   "  <td>$clinic</td>\n".
		   "  <td>$okopd</td>\n".
		   "  <td>$office</td>\n".
		   " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>
</div>