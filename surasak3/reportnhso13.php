<form method="POST" action="reportnhso16_13.php">
<p>รายงานมาตรฐาน13ไฟล์ ตารางที่ 13 ราราง AERyymm แต่ละเดือน</p>
    <p><font face="Angsana New">&nbsp;&nbsp; &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;<select size="1" name="rptmo">
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

  </select><? 
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

    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;
    <input type="submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>
