<form method="POST" action="reportnhso17_21_17.php">
<fieldset>
<legend>รายงานมาตรฐาน21ไฟล์ ตารางที่17 ตาราง MCH แต่ละเดือน</legend>
<table border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td height="50">เดือน</td>
    <td><select size="1" name="rptmo">
      <option selected>--&#3648;&#3621;&#3639;&#3629;&#3585;--</option>
      <option value="01">&#3617;&#3585;&#3619;&#3634;&#3588;&#3617;</option>
      <option value="02">&#3585;&#3640;&#3617;&#3616;&#3634;&#3614;&#3633;&#3609;&#3608;&#3660;</option>
      <option value="03">&#3617;&#3637;&#3609;&#3634;&#3588;&#3617;</option>
      <option value="04">&#3648;&#3617;&#3625;&#3634;&#3618;&#3609;</option>
      <option value="05">&#3614;&#3620;&#3625;&#3616;&#3634;&#3588;&#3617;</option>
      <option value="06">&#3617;&#3636;&#3606;&#3640;&#3609;&#3634;&#3618;&#3609;</option>
      <option value="07">&#3585;&#3619;&#3585;&#3598;&#3634;&#3588;&#3617;</option>
      <option value="08">&#3626;&#3636;&#3591;&#3627;&#3634;&#3588;&#3617;</option>
      <option value="09">&#3585;&#3633;&#3609;&#3618;&#3634;&#3618;&#3609;</option>
      <option value="10">&#3605;&#3640;&#3621;&#3634;&#3588;&#3617;</option>
      <option value="11">&#3614;&#3620;&#3625;&#3592;&#3636;&#3585;&#3634;&#3618;&#3609;</option>
      <option value="12">&#3608;&#3633;&#3609;&#3623;&#3634;&#3588;&#3617;</option>
    </select>
      <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
      </option>
      <?
				}
				echo "<select>";
				?></td>
  </tr>
  <tr>
    <td height="48">&nbsp;</td>
    <td><input type="checkbox" name="noid" value="1" />
      เลือกเฉพาะที่ไม่มี IDCARD</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1" />
      <a target=_self  href='../nindex.htm'><----ไปเมนู</a></td>
  </tr>
</table>

 </fieldset> 
</form>
