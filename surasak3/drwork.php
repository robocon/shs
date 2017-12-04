<form method="POST" action="drload.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="4"><b>
    รายงานจำนวนคนไข้ตรวจต่อเดือนของแพทย์</b></font></font></p>
  <font face="Angsana New">ตรวจเดือน&nbsp;&nbsp;
    <? $m=date('m'); ?>
      <select name="appmo" size="1">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select>

     <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></p>
  <p><font face="Angsana New">แพทย์ผู้ตรวจ&nbsp;
  <select size="1" name="doctor">
    <option selected><เลือกแพทย์></option>
    <option>MD022 (ไม่ทราบแพทย์)</option>
    <option>MD006 เลือก ด่านสว่าง</option>
    <option>MD007 ณรงค์ ปรีดาอนันทสุข</option>
    <option>MD008 อรรณพ ธรรมลักษมี</option>
    <option>MD009 นภสมร ธรรมลักษมี</option>
    <option>MD011 อนุพงษ์ รอดสาย</option>
    <option>MD013 ธนบดินทร์ ผลศรีนาค</option>
    <option>MD014 สมัชชา เบี้ยจรัส</option>
    <option>MD015 ศุภชัย คูสุวรรณ</option>
    <option>MD016 อัศวิน แก้วเนตร</option>
    <option>MD017 สิทธิชัย จิตสมจินต์</option>
    <option>MD020 หนึ่งฤทัย มหายศนันท์</option>
    <option>MD026 อชพร เพชรดี</option>
    <option>MD030 เกื้อกูล ผสมทรัพย์</option>
     <option>MD036 ศุภสิทธิ์  คงมีผล</option>
    <option>MD037 ปฏิพงค์  ศรีทิภัณฑ์</option>
    <option>MD038 วิทวัส  เกษรารัตน์</option>
    <option>MD039  ภูริพันธ์  จิรางกูร</option>
    <option>MD040  ณัฏฐากร  วงศ์สุรินทร์</option>
    <option>MD041  วรวิทย์ วงษ์มณี</option>
    <option>MD042  เพชร วัชรสินธุ์</option>
    </select></font> </p>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  </form>
