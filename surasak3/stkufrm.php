<form method="POST" action="preustk.php">
  <p><font face="Angsana New">&nbsp;</font>&nbsp;&nbsp;&nbsp; <b>&#3592;&#3656;&#3634;&#3618;&#3618;&#3634;&#3648;&#3623;&#3594;&#3616;&#3633;&#3603;&#3601;&#3660;&#3651;&#3627;&#3657;&#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;</b>&nbsp;&nbsp;</p>
  <p><font face="Angsana New">&#3627;&#3609;&#3656;&#3623;&#3618;&#3648;&#3610;&#3636;&#3585;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select size="1" name="depcode">
    <option selected>��ͧ������</option>
    <option>U01&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3594;&#3634;&#3618;</option>
    <option>U02&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3597;&#3636;&#3591;</option>
    <option>U03&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3626;&#3641;&#3605;&#3636;&#3609;&#3619;&#3637;</option>
    <option>U04&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3609;&#3633;&#3585;ICU</option>
    <option>U05&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3612;&#3656;&#3634;&#3605;&#3633;&#3604;</option>
    <option>U06&nbsp; &#3623;&#3636;&#3626;&#3633;&#3597;&#3597;&#3637;</option>
    <option>U07&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3592;&#3656;&#3634;&#3618;&#3585;&#3621;&#3634;&#3591;CMS</option>
    <option>U08&nbsp;
    &#3585;&#3629;&#3591;&#3648;&#3616;&#3626;&#3633;&#3594;&#3585;&#3619;&#3619;&#3617;</option>
    <option>U09&nbsp;
    &#3585;&#3629;&#3591;&#3631;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3609;&#3629;&#3585;</option>
    <option>U10&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3614;&#3618;&#3634;&#3608;&#3636;</option>
    <option>U11&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3648;&#3629;&#3585;&#3595;&#3660;&#3648;&#3619;&#3618;&#3660;</option>
    <option>U12&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3652;&#3605;&#3648;&#3607;&#3637;&#3618;&#3617;</option>
    <option>U13&nbsp;
    &#3585;&#3629;&#3591;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
    <option>U14&nbsp;
    &#3648;&#3623;&#3594;&#3585;&#3619;&#3619;&#3617;&#3611;&#3657;&#3629;&#3591;&#3585;&#3633;&#3609;</option>
    <option>U15&nbsp;
    &#3626;&#3609;&#3633;&#3610;&#3626;&#3609;&#3640;&#3609;&#3609;&#3629;&#3585;&#3627;&#3609;&#3656;&#3623;&#3618;</option>
    <option>U16&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3593;&#3640;&#3585;&#3648;&#3593;&#3636;&#3609;</option>
    <option>U17&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3626;&#3656;&#3591;&#3585;&#3635;&#3621;&#3633;&#3591;</option>
    <option>U18&nbsp; &#3650;&#3616;&#3594;&#3609;&#3634;&#3585;&#3634;&#3619;</option>
    <option>U19&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3614;&#3636;&#3648;&#3624;&#3625;3</option>
    <option>U20&nbsp; ����Ҿ�ӺѴ</option>
        <option>U21&nbsp; �ѡ��</option>
          <option>U22&nbsp; ��ͧ������</option>
          <option>U23&nbsp; �š����¹����ѷ/�������</option>
  </select>&nbsp;&nbsp;&nbsp;</font></p>
  <p><font face="Angsana New">&#3648;&#3621;&#3586;&#3607;&#3637;&#3656;&#3651;&#3610;&#3648;&#3610;&#3636;&#3585;&nbsp;&nbsp;
 <input type="text" name="billno" size="12"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1"></font>
 
</form>

<?php
include("connect.inc");  

	$sql = "Select * From bring Order by row_id DESC limit 10";
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
	echo "�Ţ�����ԡ : <Select id='bring_id' name='bring_id' >";

	while($arr = Mysql_fetch_assoc($result)){
		echo "<Option value='".$arr["row_id"]."'>".$arr["bring_no"]."</Option>";
	}

	echo "</Select>&nbsp;";

include("unconnect.inc");
?><INPUT TYPE="button" value="���¡������" Onclick="window.location.href='stkufrm2.php?id='+document.getElementById('bring_id').value;">

<BR>
<a target=_top  href="../nindex.htm">&lt;&lt; �����</a></font></p>
