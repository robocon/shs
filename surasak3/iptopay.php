<?php
session_start();
?>
<div>
    <a href="javascript:void(0);" onclick="window.history.back();">&lt;&lt;&nbsp;กลับไปเมนู</a><br><br>
</div>
<?php
echo "<b>เตียง:</b> $cBed<br>";
echo "<b>ชื่อ:</b> $cPtname <br>";
echo "<b>HN:</b> $cHn,   <b>AN:</b> $cAn<br>";
echo "<b>สิทธิการรักษา:</b> $cPtright<br>";
echo "<b>โรค:</b> $cDiag<br>";
echo "<b>แพทย์:</b> $cDoctor<br>";
?>
<style>
    #ipaccContainer{
        position: absolute;
        background: #ffffff;
        box-shadow: 2px 2px 7px #000000;
        border: 1px solid #000000;
        padding: 8px;
        top: 0;
        right: 0;
    }
</style>
<div style="position:relative;">
    <div>
        <p><button type="button" onclick="showIpacc();">ดูรายการค่ารักษาพยาบาล</button></p>
    </div>
     <div id="ipaccContainer" style="display:none;">
        <div id="ipaccContent"></div>
    </div>
</div>
<script>
    function showIpacc(){
        loadIpacc();
    }
    async function loadIpacc(){
        let data = await fetch('ipacc.php');
        const body = await data.text();
        document.getElementById('ipaccContainer').style.display = '';
        document.getElementById('ipaccContent').innerHTML = body;
    }
</script>
<form method="POST" action="ippaid.php">
    <blockquote>
        <p><b>&#3588;&#3656;&#3634;&#3610;&#3619;&#3636;&#3585;&#3634;&#3619;&#3629;&#3639;&#3656;&#3609;&#3607;&#3637;&#3656;&#3652;&#3617;&#3656;&#3648;&#3585;&#3637;&#3656;&#3618;&#3623;&#3586;&#3657;&#3629;&#3591;&#3585;&#3633;&#3610;&#3585;&#3634;&#3619;&#3619;&#3633;&#3585;&#3625;&#3634;(&#3648;&#3610;&#3636;&#3585;&#3652;&#3617;&#3656;&#3652;&#3604;&#3657;)</b><br>
            &nbsp;&nbsp;&nbsp;&nbsp;
            &#3588;&#3656;&#3634;&#3652;&#3615;&#3615;&#3657;&#3634;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--webbot bot="Validation" S-Data-Type="Number" S-Number-Separators="x." -->
            <input type="text" name="electric" size="10">&nbsp; &#3610;&#3634;&#3607;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;
            &#3588;&#3656;&#3634;&#3650;&#3607;&#3619;&#3624;&#3633;&#3614;&#3607;&#3660;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--webbot bot="Validation" S-Data-Type="Number" S-Number-Separators="x," -->
            <input type="text" name="phone" size="10">&nbsp; &#3610;&#3634;&#3607;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;
            &#3588;&#3656;&#3634;&#3626;&#3636;&#3656;&#3591;&#3629;&#3640;&#3611;&#3585;&#3619;&#3603;&#3660;&#3648;&#3626;&#3637;&#3618;&#3627;&#3634;&#3618;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--webbot bot="Validation" S-Data-Type="Number" S-Number-Separators="x." -->
            <input type="text" name="loss" size="10">&nbsp; &#3610;&#3634;&#3607;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;
            &#3588;&#3656;&#3634;&#3619;&#3606;&#3614;&#3618;&#3634;&#3610;&#3634;&#3621;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--webbot bot="Validation" S-Data-Type="Number" S-Number-Separators="x." -->
            <input type="text" name="ambulance" size="10">&nbsp; &#3610;&#3634;&#3607;<br>

            ค่าอาหาร <input type="text" name="food" size="10">บาท<br>

            &nbsp;&nbsp;&nbsp;
            <b>&#3585;&#3619;&#3603;&#3637;&#3648;&#3626;&#3637;&#3618;&#3594;&#3637;&#3623;&#3636;&#3605;:</b> &nbsp;
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &#3588;&#3656;&#3634;&#3610;&#3619;&#3636;&#3585;&#3634;&#3619;&#3624;&#3614;(300&#3610;&#3634;&#3607;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--webbot bot="Validation" S-Data-Type="Number" S-Number-Separators="x." -->
            <input type="text" name="death" size="10">&nbsp; &#3610;&#3634;&#3607;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &#3588;&#3656;&#3634;&#3593;&#3637;&#3604;&#3618;&#3634;&#3624;&#3614;(&#3586;&#3623;&#3604;&#3621;&#3632;120&#3610;&#3634;&#3607;)&nbsp;&nbsp;&nbsp;
            <!--webbot bot="Validation" S-Data-Type="Number" S-Number-Separators="x." -->
            <input type="text" name="preserve" size="10">&nbsp; &#3610;&#3634;&#3607;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &#3588;&#3656;&#3634;&#3605;&#3619;&#3634;&#3626;&#3633;&#3591;&#3586;&#3660;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!--webbot bot="Validation" S-Data-Type="Number" S-Number-Separators="x." -->
            <input type="text" name="robe" size="10">&nbsp; &#3610;&#3634;&#3607;
        </p>
        <p style="background-color: #fd7e14;padding: 8px; display: inline-block;">การยกเลิกรายการ สามารถคีย์ติดลบเข้าไปได้ เช่น<br> คิดค่าตราสังฃ์ไปแล้ว 1000 เวลายกเลิกก็ให้คีย์ -1000 เป็นต้น</p>
    </blockquote>
    <p>
        <font face="Angsana New">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="     &#3605;&#3585;&#3621;&#3591;     " name="B1">
        </font>
    </p>
</form>