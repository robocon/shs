<?
session_start();
include("connect.inc");

    $query = "SELECT * FROM ipcard WHERE an='".$_GET['an']."'" ;
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
		 
   if($result){
	  	$cDate=$row->date;	
        $cHn=$row->hn;
        $cAn= $row->an;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;
        $cGoup=$row->goup;
        $cCamp=$row->camp;
        $cDiag=$row->diag;
        $cIcd10=$row->icd10;
        $cComorbid=$row->comorbid;
        $cComplica=$row->complica;
	  	$cOther=$row->other;
 	 	$cExtcause=$row->extcause;
        $cIcd9=$row->icd9cm;
        $cSecond=$row->second;
        $cResult=$row->result;
	  	$cDctype=$row->dctype; 
        $cDoctor=$row->doctor;
     	$cClaimcipn=$row->claimcipn;
		$cAdjrw=$row->adjrw;
		$cClaimamt=$row->claimamt;
		$cClaimup=$row->claimup;
		$cClaimexport_date=$row->claimexport_date;
		$cReccount=$row->reccount;
   }
   
if($_POST["act"]=="edit"){
	$edit="UPDATE ipcard SET claimcipn='".$_POST["claimcipn"]."',
										 adjrw='".$_POST["adjrw"]."',
										 claimamt='".$_POST["claimamt"]."',
										 claimup='".$_POST["claimup"]."',
										 claimedit_date='".date('Y-m-d H:i:s')."',
										 reccount='".$_POST["reccount"]."' WHERE an='".$_POST['an']."'" ;
	if(mysql_query($edit)){
		echo "<script>alert('ปรับปรุงสถานะเรียบร้อย');window.location='exportaipn_data.php';</script>";
	}else{
		echo "<script>alert('ผิดพลาด...ปรับปรุงสถานะไม่สำเร็จ !!!');window.location='exportaipn_data.php';</script>";
	}
}   	 
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
body {
	background-color: #FFFFF0;
}
-->
</style>
<form action="updatedataaipn.php" method="post" name="form">
<input name="act" type="hidden" value="edit">
<input name="an" type="hidden" value="<?=$cAn;?>">
<table width="60%" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#20B2AA">
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFF0"><strong>ข้อมูลผู้ป่วย</strong></td>
    </tr>
  <tr>
    <td align="right"><strong>AN</strong></td>
    <td><strong>:</strong></td>
    <td><?=$cAn;?></td>
  </tr>
  <tr>
    <td align="right"><strong>HN</strong></td>
    <td><strong>:</strong></td>
    <td><?=$cHn;?></td>
  </tr>
  <tr>
    <td align="right"><strong>ชื่อ-นามสกุล</strong></td>
    <td><strong>:</strong></td>
    <td><?=$cPtname;?></td>
  </tr>
  <tr>
    <td align="right"><strong>วินิจฉัยโรค</strong></td>
    <td><strong>:</strong></td>
    <td><?=$cDiag;?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFF0"><strong>ปรับปรุงสถานะการเบิกจ่าย</strong></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#3CB371"><strong>วันที่ส่งข้อมูล</strong></td>
    <td bgcolor="#3CB371"><strong>:</strong></td>
    <td bgcolor="#3CB371"><?=$cClaimexport_date;?></td>
  </tr>
  <tr>
    <td width="25%" align="right" bgcolor="#3CB371"><strong>สถานะการส่งข้อมูล</strong></td>
    <td width="3%" bgcolor="#3CB371"><strong>:</strong></td>
    <td width="72%" bgcolor="#3CB371"><label>
      <input name="claimcipn" type="radio" id="claimcipn1" value="y" <? if($cClaimcipn=="y"){ echo "checked";}?>>
      ส่งข้อมูลผ่าน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="claimcipn" type="radio" id="claimcipn2" value="n" <? if($cClaimcipn=="n"){ echo "checked";}?>>
      ส่งข้อมูลไม่ผ่าน
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="claimcipn" type="radio" id="claimcipn3" value="c" <? if($cClaimcipn=="c"){ echo "checked";}?> />
ผลตอบกลับติด C</label></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#3CB371"><strong>จำนวน Reccount</strong></td>
    <td bgcolor="#3CB371"><strong>:</strong></td>
    <td bgcolor="#3CB371"><input name="reccount" type="text" class="txt" id="reccount" value="<?=$cReccount;?>" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#3CB371"><strong>AdjRw</strong></td>
    <td bgcolor="#3CB371"><strong>:</strong></td>
    <td bgcolor="#3CB371"><label>
      <input name="adjrw" type="text" class="txt" id="adjrw" value="<?=$cAdjrw;?>">
    </label></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#3CB371"><strong>ยอดที่ส่งเบิก</strong></td>
    <td bgcolor="#3CB371"><strong>:</strong></td>
    <td bgcolor="#3CB371"><label>
      <input name="claimamt" type="text" class="txt" id="claimamt" value="<?=$cClaimamt;?>">
    </label></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#3CB371"><strong>ยอดที่จ่าย</strong></td>
    <td bgcolor="#3CB371"><strong>:</strong></td>
    <td bgcolor="#3CB371"><label>
      <input name="claimup" type="text" class="txt" id="claimup" value="<?=$cClaimup;?>">
    </label></td>
  </tr>
  <tr>
    <td bgcolor="#3CB371">&nbsp;</td>
    <td bgcolor="#3CB371">&nbsp;</td>
    <td bgcolor="#3CB371"><label>
      <input name="submit" type="submit" class="txt" id="submit" value="ปรับปรุงสถานะ">&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" name="button" id="button" value="เรียกดูข้อมูล" onclick="window.location='exportaipn_data.php' " class="txt" />&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="txt" />
    </label></td>
  </tr>
</table>

</form>
