<body bgcolor="#C0C0C0">

<form method="POST" action="labadd.php">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &#3648;&#3614;&#3636;&#3656;&#3617;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&#3605;&#3619;&#3623;&#3592;-&#3619;&#3633;&#3585;&#3625;&#3634;</p>
  <p>&nbsp;&nbsp; &#3619;&#3627;&#3633;&#3626;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
  <input type="text" name="code" size="12"></p>
  <p>&nbsp;&nbsp; &#3649;&#3612;&#3609;&#3585;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <select size="1" name="depart">
    <option value="WARD">&#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;</option>
    <option value="PATHO">&#3649;&#3612;&#3609;&#3585;&#3614;&#3618;&#3634;&#3608;&#3636;</option>
    <option value="XRAY">&#3649;&#3612;&#3609;&#3585;&#3648;&#3629;&#3585;&#3595;&#3660;&#3648;&#3619;&#3618;&#3660;</option>
    <option value="DENTA">&#3649;&#3612;&#3609;&#3585;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
    <option value="EMER">&#3627;&#3657;&#3629;&#3591;&#3593;&#3640;&#3585;&#3648;&#3593;&#3636;&#3609;</option>
    <option value="SURG">&#3624;&#3633;&#3621;&#3618;&#3585;&#3619;&#3619;&#3617;</option>
    <option value="OTHER">&#3649;&#3612;&#3609;&#3585;&#3629;&#3639;&#3656;&#3609;&#3654;</option>
    <option selected>--&#3648;&#3621;&#3639;&#3629;&#3585;&#3649;&#3612;&#3609;&#3585;--</option>
  </select></p>
  <p>&nbsp;&nbsp;
  &#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="detail" size="40"></p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3588;&#3634; ��� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="text" name="price" size="12"></p>
<p>&nbsp;&nbsp; &#3619;&#3634;&#3588;&#3634;�ԡ��&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="text" name="yprice" size="12"> ����ԡ������������Ҥ��ԡ����ҡѺ�Ҥ����</p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3588;&#3634; �ԡ�����&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="text" name="nprice" size="12"></p>
  
  <p>&nbsp;&nbsp; &#3611;&#3619;&#3632;&#3648;&#3616;&#3607;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
  <select size="1" name="part">
    <option selected>--&#3648;&#3621;&#3639;&#3629;&#3585;&#3611;&#3619;&#3632;&#3648;&#3616;&#3607;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;---</option>
    <option value="NCARE">&#3588;&#3656;&#3634;&#3610;&#3619;&#3636;&#3585;&#3634;&#3619;&#3607;&#3634;&#3591;&#3585;&#3634;&#3619;&#3614;&#3618;&#3634;&#3610;&#3634;&#3621;&#3607;&#3633;&#3656;&#3623;&#3652;&#3611;</option>
    <option value="LAB">&#3588;&#3656;&#3634;&#3605;&#3619;&#3623;&#3592;&#3607;&#3634;&#3591;&#3648;&#3607;&#3588;&#3609;&#3636;&#3588;&#3585;&#3634;&#3619;&#3649;&#3614;&#3607;&#3618;&#3660;/&#3614;&#3618;&#3634;&#3608;&#3636;&#3623;&#3636;&#3607;&#3618;&#3634;</option>
    <option value="XRAY">&#3588;&#3656;&#3634;&#3605;&#3619;&#3623;&#3592;/&#3619;&#3633;&#3585;&#3625;&#3634;&#3607;&#3634;&#3591;&#3619;&#3633;&#3591;&#3626;&#3637;&#3623;&#3636;&#3607;&#3618;&#3634;</option>
    <option value="SURG">&#3588;&#3656;&#3634;&#3612;&#3656;&#3634;&#3605;&#3633;&#3604;/&#3607;&#3635;&#3588;&#3621;&#3629;&#3604;/&#3623;&#3636;&#3626;&#3633;&#3597;&#3597;&#3637;</option>
    <option value="PT">&#3588;&#3656;&#3634;&#3585;&#3634;&#3618;&#3616;&#3634;&#3614;&#3610;&#3635;&#3610;&#3633;&#3604;/&#3648;&#3623;&#3594;&#3585;&#3619;&#3619;&#3617;&#3615;&#3639;&#3657;&#3609;&#3615;&#3641;</option>
    <option value="DENTA">&#3588;&#3656;&#3634;&#3610;&#3619;&#3636;&#3585;&#3634;&#3619;&#3607;&#3634;&#3591;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
    <option value="MC">&#3588;&#3656;&#3634;&#3629;&#3639;&#3656;&#3609;&#3654;&#3652;&#3617;&#3656;&#3648;&#3585;&#3637;&#3656;&#3618;&#3623;&#3585;&#3633;&#3610;&#3585;&#3634;&#3619;&#3619;&#3633;&#3585;&#3625;&#3634;</option>
    <option value="BFY">&#3588;&#3656;&#3634;&#3627;&#3657;&#3629;&#3591;/&#3588;&#3656;&#3634;&#3629;&#3634;&#3627;&#3634;&#3619;(&#3648;&#3610;&#3636;&#3585;&#3652;&#3604;&#3657;)</option>
    <option value="BFN">&#3588;&#3656;&#3634;&#3627;&#3657;&#3629;&#3591;/&#3588;&#3656;&#3634;&#3629;&#3634;&#3627;&#3634;&#3619;(&#3626;&#3656;&#3623;&#3609;&#3648;&#3585;&#3636;&#3609;)</option>
  </select></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  " name="B2">&nbsp;&nbsp;&nbsp;&nbsp;<a target=_parent  href='../nindex.htm'><<�����</a></p>
</p>
  <p>&nbsp;</p>
</form>

</body>

