<?php

include("connect.inc");


$query = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";

$result = mysql_query($query) or die("Query pocompany fail");



for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {

if (!mysql_data_seek($result, $i)) {

echo "Cannot seek to row $i\n";

	continue;

}



if(!($row = mysql_fetch_object($result)))

	continue;

}

//31

$chn=$row->hn;

$can=$row->an;

$cptname=$row->ptname;

$cage=$row->age;

$cptright=$row->ptright;

$cbedcode=$row->bedcode;

$cdoctor=$row->doctor;
$cdiagnos=$row->diagnos;
$cBed1=$row->bed;
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
@media print{
#no_print{display:none;}
}
-->
</style>
<div><?="$cbedname&nbsp;&nbsp;$cBed1";?></div>
<div><?="AN:$can&nbsp;&nbsp;HN:$chn&nbsp;&nbsp;";?></div>
<div><?="$cptname&nbsp;&nbsp;อายุ&nbsp;$cage";?></div>
<div><?="โรค&nbsp;$cdiagnos &nbsp;สิทธิ&nbsp;$cptright &nbsp;&nbsp;";?></div>
<div><?="แพทย์&nbsp;$cdoctor";?></div>
<div style="left: 0; top: 100px;" id="no_print">
	<button onclick="printOut()" style="font-size:18px; font-family:'TH SarabunPSK';">พิมพ์สติ๊กเกอร์</button>
</div>

<script type="text/javascript">
	function printOut(){
		window.print();
	}
</script>
