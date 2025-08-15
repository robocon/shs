<?php 
session_start();
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
}
include("connect.inc");

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}

include("checklogin.php");

$_SESSION['close_popup'] = false;


// ถ้าไม่ใช่หมอเป้
if($_SESSION['sIdname'] != "md19921"){
	
$sql = "Select a.name From doctor as a INNER JOIN inputm as b ON a.doctorcode = b.codedoctor where idname = '".$_SESSION["sIdname"]."' limit 1";
list($doctorname) = Mysql_fetch_row(Mysql_Query($sql));

$thidate = date("d-m-").(date("Y")+543);
if($doctorname=="MD065 พิศาล ศิริชีพชัยยันต์" || $doctorname=="MD089  เลอปรัชญ์ มังกรกนกพงศ์"){
	$sql = "Select vn, hn, ptname, toborow,thidate,officer  From opd where thdatehn like '".$thidate."%' AND (doctor = '".$doctorname."' OR doctor ='MD204 จักษุแพทย์') AND dc_diag is NULL Order by vn ASC ";
}else{
	$sql = "Select vn, hn, ptname, toborow,thidate,officer  From opd where thdatehn like '".$thidate."%' AND doctor = '".$doctorname."' AND dc_diag is NULL Order by vn ASC ";	
}
//echo $sql;
$result_list_pt = Mysql_Query($sql);
$num_list_pt = Mysql_num_rows($result_list_pt );

$sql = "Select vn, hn, ptname, toborow ,thidate ,officer
From opd 
where thdatehn like '".$thidate."%' 
AND room like 'ห้อง%' 
AND dc_diag is NULL 
Order by vn ASC ";
$result_list_pt2 = Mysql_Query($sql);
$num_list_pt2 = Mysql_num_rows($result_list_pt2 );

}
?>
<html>
<head>
<title><?php echo $_SESSION["sOfficer"];?></title>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tahoma:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
  :root{
    --bg-start:#075F5A;      /* slate-900 */
    --bg-end:#5D7745;        /* blue-800 */
    --card:#0b3a2f;          /* teal deeper */
    --card-2:#0f513d;        /* teal */
    --accent:#22c55e;        /* green-500 */
    --accent-2:#38bdf8;      /* sky-400 */
    --warn:#fde047;          /* yellow-300 */
    --danger:#ef4444;        /* red-500 */
    --text:#f8fafc;          /* slate-50 */
    --muted:#cbd5e1;
    --line:#115e59;          /* teal-800 line */
    --shadow: 0 10px 24px rgba(0,0,0,.25);
    --radius: 14px;
  }

  html,body{
    height:100%;
  }
  body{
    margin:0;
    font-family: "Segoe UI","Tahoma",-apple-system,BlinkMacSystemFont,"Helvetica Neue",Arial,sans-serif;
    font-size:18px;
    line-height:1.6;
    color:var(--text);
    background: linear-gradient(135deg, var(--bg-start), var(--bg-end)) fixed;
  }

  /* Layout wrapper */
  .page{
    max-width: 1200px;
    margin: 24px auto 64px;
    padding: 16px;
  }

  /* Top bar title (จาก title เดิม) */
  .app-title{
    display:flex; align-items:center; gap:12px;
    font-weight:700; font-size:22px; letter-spacing:.2px;
    color:var(--text);
  }

  /* Notice/ข่าวสาร */
  .news{
    margin-top:18px;
	margin-bottom:18px;
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.12);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow:hidden;
  }
  .news-header{
    display:flex; align-items:center; gap:10px;
    padding:10px 14px;
    background: linear-gradient(90deg, rgba(56,189,248,.25), rgba(34,197,94,.25));
    font-weight:700;
  }
  .news-body{
    padding:10px 14px;
  }
  .news-item{
    padding:8px 0;
    border-bottom:1px dashed rgba(255,255,255,.12);
  }
  .news-item:last-child{ border-bottom:0; }

  /* Menu as modern cards */
  .menu-bar{
    display:flex; flex-wrap:wrap; gap:12px;
    margin: 10px 0 18px;
  }
  .menu-item{
    display:inline-flex; align-items:center; gap:10px;
    background: #36BBA7;
    border:1px solid rgba(255,255,255,.18);
    padding:12px 16px;
    border-radius: var(--radius);
    text-decoration:none;
    color:var(--text);
    font-weight:600;
    letter-spacing:.2px;
    box-shadow: var(--shadow);
    transition: transform .12s ease, box-shadow .12s ease, background .12s ease, border-color .12s ease;
    backdrop-filter: blur(6px);
  }
  .menu-item i{ font-size:18px; }
  .menu-item:hover{
    transform: translateY(-2px);
    box-shadow: 0 16px 28px rgba(0,0,0,.35);
    background: rgba(56,189,248,.12);
    border-color: rgba(56,189,248,.55);
  }
  .menu-item:active{ transform: translateY(0); }

  /* Form card */
  .card{
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.14);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding:16px;
  }
  .form-grid{
    display:flex; flex-wrap:wrap; gap:12px; align-items:center;
  }
  .input, .btn{
    font-family: inherit;
    font-size: 18px;
    border-radius: 12px;
    border:1px solid rgba(255,255,255,.2);
    padding: 10px 14px;
    outline:none;
  }
  .input{
    min-width: 220px;
    background: rgba(255,255,255,.9);
    color:#0b1220;
  }
  .input:focus{
    border-color: var(--accent-2);
    box-shadow: 0 0 0 3px rgba(56,189,248,.35);
  }
  .btn{
    cursor:pointer;
    background: linear-gradient(180deg,#22c55e,#16a34a);
    color:white;
    font-weight:700;
    border:none;
    transition: transform .1s ease, box-shadow .1s ease, filter .1s ease;
  }
  .btn:hover{ filter:brightness(1.05); transform: translateY(-1px); }
  .btn:active{ transform: translateY(0); }

  .btn-secondary{
    background: linear-gradient(180deg,#a78bfa,#7c3aed);
  }
  .btn-ghost{
    background: transparent;
    color: var(--warn);
    border:1px dashed rgba(253,224,71,.6);
  }

  /* Patient counter pill */
  .pill{
    display:inline-flex; align-items:center; gap:8px;
    background: rgba(253,224,71,.15);
    border:1px solid rgba(253,224,71,.55);
    color:#fff7cc;
    padding:8px 12px;
    border-radius: 999px;
    font-weight:700;
    box-shadow: var(--shadow);
  }

  /* Tabs (ลิงก์สลับรายชื่อ) */
  .tabs{
    margin-top:10px; display:flex; gap:8px; flex-wrap:wrap;
  }
  .tab{
    text-decoration:none; color:var(--text); font-weight:700;
    background: rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.18);
    padding:8px 12px; border-radius: 999px;
    transition: background .12s ease, transform .12s ease;
  }
  .tab:hover{ background: rgba(56,189,248,.18); transform: translateY(-1px); }
  #dt_other:target, #dt_room:target{ text-decoration: none; }

  /* Tables */
  table{ border-collapse: separate; border-spacing:0; width:100%; }
  .table-wrap{
    margin-top:10px;
    width:100%; max-width: 1200px; height:350px; overflow:auto;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    border:1px solid rgba(255,255,255,.14);
    background: rgba(255,255,255,.04);
  }
  .tb_head{
    position: sticky; top:0; z-index:1;
    background: #18786F;
    color: #fff;
    font-weight:700; text-align:left;
  }
  .tb_head > td{
    padding:10px 12px; border-bottom:1px solid rgba(255,255,255,.18);
  }
  .tb_detail, .tb_detail2{
    background: transparent; color: var(--text);
  }
  .tb_detail:nth-child(even), .tb_detail2:nth-child(even){
    background: rgba(255,255,255,.04);
  }
  td{
    padding:10px 12px; border-bottom:1px dashed rgba(255,255,255,.12);
    white-space: nowrap;
  }
  tr:hover td{
    background: rgba(56,189,248,.10);
  }

  /* Links inside table */
  a{ color: var(--accent-2); text-decoration:none; }
  a:hover{ text-decoration: underline; }

  /* Responsive */
  @media (max-width: 900px){
    .page{ padding: 12px; }
    .form-grid{ gap:8px; }
    .input{ min-width: 160px; font-size:16px; }
    .btn{ font-size:16px; padding:9px 12px; }
    td{ padding:8px 10px; }
    .menu-item{ padding:10px 12px; }
  }

  /* Utility font for small label */
  .txtsarabun{ font-family: "Segoe UI","Tahoma",sans-serif; font-size:18px; font-weight:700; }
</style>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.form_vn.vn_now.focus();

}

</SCRIPT>
</head>
</body>
<div class="page">
  <div class="app-title">
    <i class="fa-solid fa-stethoscope"></i>
    <div>เมนูแพทย์ : <?php echo $_SESSION["sOfficer"];?></div>
  </div>

  <!-- เมนูหลักเป็นการ์ด -->
  <nav class="menu-bar">
    <a class="menu-item" href="dt_emp_manual_index.php">
      <i class="fa-solid fa-id-card-clip"></i> ตรวจสุขภาพสิทธิประกันสังคม (ไม่ใช้ VN)
    </a>
    <a class="menu-item" href="dxdr_ofyear1_dr_manual.php">
      <i class="fa-solid fa-shield-heart"></i> ตรวจสุขภาพประจำปีกองทัพบก (ไม่ใช้ VN)
    </a>
    <a class="menu-item" href="dxdr_ofyearout_dr_hn.php">
      <i class="fa-solid fa-people-roof"></i> ฮักกันยามเฒ่า (ไม่ใช้ VN)
    </a>
    <a class="menu-item" href="Edt_index.php">
      <i class="fa-solid fa-file-signature"></i> ใบรับรองแพทย์อิเล็กทรอนิกส์
    </a>
    <a class="menu-item" href="dt_listpatient.php" target="_blank">
      <i class="fa-solid fa-user-injured"></i> รายชื่อผู้ป่วยตรวจโรควันนี้
    </a>
  </nav>
  <div class="card" style="margin-top:6px;">
    <form name="form_vn" method="POST" action="dt_add_patient.php">
      <div class="form-grid">
        <label for="vn_now" class="txtsarabun" style="min-width:60px;">VN :</label>
        <input type="text" name="vn_now" id="vn_now" class="input" autocomplete="off" inputmode="numeric" />
        <input type="submit" value="ตกลง" class="btn" />
        <input type="button" value="<< กลับไปเมนูหลัก" onclick="window.location='../nindex.htm'" class="btn btn-secondary" />
        <label class="txtsarabun" style="display:inline-flex;align-items:center;gap:8px;margin-left:6px;">
          <input type="checkbox" name="special" value="true" <?php if($_SESSION["dt_special"]) echo "Checked"; ?> />
          ค่าบริการคลินิกพิเศษ
        </label>

        <!-- ตัวนับคนไข้ -->
        <span class="pill" style="margin-left:auto;">
          <i class="fa-solid fa-users"></i> จำนวนคนไข้: <?php echo $num_list_pt;?> คน
        </span>
      </div>
    </form>
  </div>



  <div class="news">
    <div class="news-header">
      <i class="fa-solid fa-bullhorn"></i> ข่าวสาร
    </div>
    <div class="news-body">
      <?php
        // วนลูปข่าวสารเดิม แต่เรนเดอร์ให้เป็น .news-item
        $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
        $num = Y; $depart1=Y;
        $query = "SELECT row,depart,new,datetime FROM new WHERE status ='$num' and dr ='$depart1' ORDER BY row DESC";
        $result = mysql_query($query) or die("Query failed");
        while (list ($row,$depart,$new,$datetime) = mysql_fetch_row ($result)) {
          echo "<div class='news-item'><i class='fa-regular fa-star'></i> $new <span style='color:var(--muted)'>($depart • $datetime)</span></div>";
        }
      ?>
    </div>
  </div>

<SCRIPT LANGUAGE="JavaScript">

	function switch_div(xx){
		if(xx == '1'){
			document.getElementById('first').style.display = 'none';
			document.getElementById('sec').style.display = '';
		}else{
			document.getElementById('first').style.display = '';
			document.getElementById('sec').style.display = 'none';
		}
	}

</SCRIPT>
<A HREF="javascript:switch_div('2');" id="dt_room" >รายชื่อผู้ป่วยหน้าห้องตรวจ</A>  |  <A HREF="javascript:switch_div('1');" id="dt_other">รายชื่อผู้ป่วยตรวจโรคทั่วไป( <?php echo $num_list_pt2;?> )</A>

<div id="first" class="table-wrap">
<TABLE width='600'>
<TR class="tb_head">
  
	<TD>VN</TD>
	   <TD>เวลาซักประวัติ</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สถานะ</TD>
	<TD>ผู้ซักประวัติ</TD>
</TR>
<?php

while(list($vn, $hn, $ptname, $toborow,$thidate,$officer_opd) = Mysql_fetch_row($result_list_pt)){

	if(substr($toborow,-4) == "EX04"){
		$class = "tb_detail2";
	}else{
		$class = "tb_detail";
	}
?>
<TR class="<?php echo $class;?>">
	<TD><A HREF="javascript:document.form_vn.vn_now.value='<?php echo $vn;?>';form_vn.submit();" ><?php echo $vn;?></A></TD>
		<TD><?php echo substr($thidate,11,8);?></TD>
	<TD><?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD><?php echo $toborow;?></TD>
	<TD><?php echo $officer_opd;?></TD>
</TR>
<?php }?>
</TABLE>
</div>

<div id="sec" class="table-wrap" style="display:none;">
<TABLE width='600'>
<TR class="tb_head">

	<TD>VN</TD>
	<TD>เวลาซักประวัติ</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สถานะ</TD>
	<TD>ผู้ซักประวัติ</TD>
</TR>
<?php

while(list($vn, $hn, $ptname, $toborow,$thidate,$officer_opd) = Mysql_fetch_row($result_list_pt2)){

	if(substr($toborow,-4) == "EX04"){
		$class = "tb_detail2";
	}else{
		$class = "tb_detail";
	}
?>
<TR class="<?php echo $class;?>">
	<TD><A HREF="javascript:document.form_vn.vn_now.value='<?php echo $vn;?>';form_vn.submit();" ><?php echo $vn;?></A></TD>

		<TD><?php echo substr($thidate,11,8);?></TD>
	<TD><?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD><?php echo $toborow;?></TD>
	<TD><?php echo $officer_opd;?></TD>
</TR>
<?php }?>
</TABLE>
</div>

</body>

<?php include("unconnect.inc");?>
</html>