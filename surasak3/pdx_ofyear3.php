<?
include("connect.inc");
?>
<script>
	window.print();
</script>
<style type="text/css">
<!--
.pdx {	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.pdxhead {	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
</head>

<?
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

 $query="SELECT hn,company,program,idno FROM chkup_company WHERE company='$com'  and program = '$pro' ORDER by idno";
  $result = mysql_query($query)or die("Query failed");
    while (list ($hn,$company,$program,$idno) = mysql_fetch_row ($result)) {	
	
		$sql = "Select yot,name,surname,idcard,dbirth,address,tambol,ampur,changwat,phone  From opcard where hn = '$hn' ";
		list($yot,$name,$surname,$idcard,$dbirth,$address,$tambol,$ampur,$changwat,$phone)  = mysql_fetch_row(Mysql_Query($sql));
	
		$fullname=$yot.''.$name.'&nbsp;'.$surname;
		$birthday = substr($dbirth,8,2)."-".substr($dbirth,5,2)."-".substr($dbirth,0,4);
		$age = calcage($dbirth);
?>
<table width="100%">
  <tr>
    <td><table width="98%">
      <tr style='line-height:18px'>
        <td width="126" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td width="687" align="center" class="pdx"><strong><span class="pdxhead">แบบการตรวจสุขภาพ
          <?=$company?>
        </span></strong></td>
        <td width="13" rowspan="3" align="center" valign="top"></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
      </tr>
      <tr style='line-height:16px'>
        <td align="center" class="pdxhead">วันที่.................................เวลา...................</td>
      </tr>
    </table>
      <span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
        <strong>1. ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี</strong></span><br />
      <table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr>
          <td><table>
            <tr>
              <td class="pdxpro">HN : <strong>
                <?=$hn?>
                </strong> ชื่อ-สกุล : <strong>
                  <?=$fullname?>
                  </strong>
                อายุ :<?=$age?></td>
            </tr>
            <tr>
              <td class="pdx">เลขบัตรปชช :
                <?=$idcard?>
                &nbsp;ที่อยู่ :
                <?=$address." ".$tambol." ".$ampur." ".$changwat?>
                &nbsp;โทรศัพท์ :
                <?=$phone?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <?
	$ban = explode(" ",$program);

	$arrtype = array('ตรวจ x-ray ปอด','ตรวจความสมบูรณ์ของเม็ดเลือด(CBC)','ตรวจปัสสาวะ(UA)','ไขมัน(CHOL,TRI)','เบาหวาน(BS)','ตรวจหน้าที่ของตับ(SGOT,SGPT,ALK)','ตรวจหน้าที่ของไต(BUN,CR)','เก๊าท์(URIC)');
	$arrprice = array('170.00','90.00','50.00','120.00','40.00','150.00','100.00','60.00');
	?>
      <table width="756">
        <tr>
          <td class="pdxpro" colspan="2"><strong>รายการตรวจสุขภาพ
            <?=$program?>
          </strong></td>
        </tr>
        <? 
	  $sumpri=0;
	  	if($ban[1]=="1"){
			$q =1;
			for($r=0;$r<3;$r++){
				echo "<tr style='line-height:12px'><td class='pdx'>".$q.". ".$arrtype[$r]."</td><td class='pdx'>ราคา ".$arrprice[$r]." บาท</td></tr>";
				$q++;
				$sumpri+=$arrprice[$r];
			}	
			$sumpri = number_format(($sumpri+50),2);
			echo "<tr style='line-height:12px'><td class='pdx'>4. ค่าบริการ</td><td class='pdx'>ราคา 50.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>รวม</B></td><td class='pdx'><B>ราคา $sumpri บาท</B></td></tr>";
		}
		elseif($ban[1]=="2"){
			$q =1;
			for($r=0;$r<3;$r++){
				echo "<tr style='line-height:12px'><td class='pdx'>".$q.". ".$arrtype[$r]."</td><td class='pdx'>ราคา ".$arrprice[$r]." บาท</td></tr>";
				$q++;
				$sumpri+=$arrprice[$r];
			}	
			$sumpri = number_format(($sumpri+300),2);
			echo "<tr style='line-height:12px'><td class='pdx'>4. ตรวจมะเร็งปากมดลูก</td><td class='pdx'>ราคา 50.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>5. ค่าตรวจภายใน</td><td class='pdx'>ราคา 100.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>6. ค่าตรวจมะเร็งปากมดลูก</td><td class='pdx'>ราคา 100.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>7. ค่าบริการ</td><td class='pdx'>ราคา 50.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>รวม</B></td><td class='pdx'><B>ราคา $sumpri บาท</B></td>";
		}
		elseif($ban[1]=="3"){
			$q =1;
			for($r=0;$r<8;$r++){
				echo "<tr style='line-height:12px'><td class='pdx'>".$q.". ".$arrtype[$r]."</td><td class='pdx'>ราคา ".$arrprice[$r]." บาท</td></tr>";
				$q++;
				$sumpri+=$arrprice[$r];
			}	
			$sumpri = number_format(($sumpri+50),2);
			echo "<tr style='line-height:12px'><td class='pdx'>9. ค่าบริการ</td><td class='pdx'>ราคา 50.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>รวม</B></td><td class='pdx'><B>ราคา $sumpri บาท</B></td>";
		}
		elseif($ban[1]=="4"){
			$q =1;
			for($r=0;$r<8;$r++){
				echo "<tr style='line-height:12px'><td class='pdx'>".$q.". ".$arrtype[$r]."</td><td class='pdx'>ราคา ".$arrprice[$r]." บาท</td></tr>";
				$q++;
				$sumpri+=$arrprice[$r];
			}	
			$sumpri = number_format(($sumpri+300),2);
			echo "<tr style='line-height:12px'><td class='pdx'>9. ตรวจมะเร็งปากมดลูก</td><td class='pdx'>ราคา 50.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>10. ค่าตรวจภายใน</td><td class='pdx'>ราคา 100.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>11. ค่าตรวจมะเร็งปากมดลูก</td><td class='pdx'>ราคา 100.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>12. ค่าบริการ</td><td class='pdx'>ราคา 50.00 บาท</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>รวม</B></td><td class='pdx'><B>ราคา $sumpri บาท</B></td>";
		}
	  ?>
        <tr>
          <td class="pdx" colspan="2"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
        </tr>
        <tr>
          <td class="pdx" colspan="2"><? 
			echo "<table><tr style='line-height:16px'><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>สถานี 1<br>ทะเบียน<br>ลงทะเบียน<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>สถานี 2<br>คัดแยกผู้ป่วย<br>ซักประวัติ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>สถานี 3<br>X-ray<br>X-ray<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>สถานี 4<br>ห้องตรวจ 5<br>พบแพทย์<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>สถานี 5<br>จุดนัดที่1<br>รับผลการตรวจ<br>.............................</td></tr></table></td></tr></table>";
	  ?></td>
        </tr>
        <?
    if($ban[1]=="4"||$ban[1]=="2"){
	?>
        <tr>
          <td class="pdx" colspan="2">หมายเหตุ *กรณีตรวจมะเร็งปากมดลูกให้มาตรวจในเวลา 13.00 น. ณ.ห้องตรวจโรคผู้ป่วยสูติ ใต้ตึกกองบังคับการ</td>
        </tr>
        <?
	}
	?>
        <tr>
          <td class="pdx">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<div style="page-break-after:always"></div>
<?
	}
?>
