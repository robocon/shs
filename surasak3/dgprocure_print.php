<?php
    session_start();
If (!empty($_GET["id"])){
    include("connect.inc");
    

	$sql = "Select * From combill where row_id = '".$_GET["id"]."' limit 0,1 ";
	$result = mysql_query($sql);
	$arr = mysql_fetch_assoc($result);
	
	$sql = "Select packpri_vat From druglst where drugcode= '".$arr["drugcode"]."' limit 0,1";
	list($arr["packpri_vat"]) = mysql_fetch_row(mysql_query($sql));


    include("unconnect.inc");
 }
///////
print "<body onload=\"window.print();\">";

print "<div align='center'>";
print "  <center>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='80%'>";
print "    <tr>";
print "      <td width='3%'></td>";
print "      <td width='97%'>";

print "          <div align='center'>";
print "            <table border='0' cellpadding='0' cellspacing='0' width='701'>";
print "              <tr>";
print "                <td width='699'><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  <b>�����š�ë������Ǫ�ѳ����Ҥ�ѧ</b></font>";
print "                  <p align='right'><font face='Angsana New'>�ѹ���ѹ�֡ : ".$arr["date"]."</font></p>";
print "                </td>";
print "              </tr>";
print "            </table>";
print "          </div>";
print "          <div align='center'>";
print "            <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "              <tr>";
print "                <td width='33%'><font face='Angsana New'>�Ţ����Ѻ : ";
print "                  ".$arr["stkno"]."<br>";
print "                  �͡��ë��� : ";
print "                  ".$arr["docno"]."</font></td>";
print "                <td width='35%'><font face='Angsana New'>�Ţ�����觢ͧ : ";
print "                  ".$arr["billno"]." <br>";
print "                  �ѹ�����觢ͧ : ";
print "                  ".$arr["billdate"]." </font></td>";
print "                <td width='32%'><font face='Angsana New'>�ѹ����Ѻ�Թ��� : ";
print "                  ".$arr["getdate"]."";
print "                  <br>";
print "                  ���ʺ���ѷ : ";
print "                  ";
print "                  ".$arr["comcode"]."";
print "                  </font>";
print "                </td>";
print "              </tr>";
print "            </table>";
print "          </div>";
print "          <div align='center'>";
print "            <table border='0' cellpadding='0' cellspacing='0' width='705'>";
print "              <tr>";
print "                <td width='703'><font face='Angsana New'>����ѷ : ".$cComname."</font>";
print "                  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  &nbsp;&nbsp;";
print "                  &gt;&gt;&gt;&gt;&gt; <b> ��¡�ë��� </b> &lt;&lt;&lt;&lt;&lt;</font></p>";
print "                </td>";
print "              </tr>";
print "            </table>";
print "          </div>";
print "          <div align='center'>";
print "            <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "              <tr>";
print "                <td width='33%'><font face='Angsana New'>&#3619;&#3627;&#3633;&#3626;&#3618;&#3634;<a target=_BLANK href='drugcode.php'>(&#3594;&#3656;&#3623;&#3618;)</a>&nbsp;".$arr["drugcode"]."<br>";
print "                  &#3594;&#3639;&#3656;&#3629;&#3585;&#3634;&#3619;&#3588;&#3657;&#3634;&nbsp;";
print "                  ".$arr["tradname"]."<br>";
print "                  &#3594;&#3639;&#3656;&#3629;&#3626;&#3634;&#3617;&#3633;&#3597;&nbsp;";
print "                  ".$arr["genname"]."<br>";
print "                  packing&nbsp;&nbsp;&nbsp; ".$arr["packing"]."<br>";
print "                  &#3627;&#3609;&#3656;&#3623;&#3618;&#3618;&#3656;&#3629;&#3618;";
print "            ".$arr["unit"]." </font></td>";
print "                <td width='35%'><font face='Angsana New'>&#3648;&#3621;&#3586;&#3607;&#3637;&#3656;&#3612;&#3621;&#3636;&#3605;(LotNo)&nbsp;";
print "                  ".$arr["lotno"]."<br>";
print "                  &#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&#3612;&#3621;&#3636;&#3605;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "                  ".$arr["mfdate"]."<br>";
print "                  &#3623;&#3633;&#3609;&#3627;&#3617;&#3604;&#3629;&#3634;&#3618;&#3640;&nbsp;&nbsp;&nbsp;";
print "                  ".$arr["expdate"]."<br>";
print "                  �ӹǹ pack&nbsp; ".$arr["packamt"]."<br>";
print "                  &#3592;&#3635;&#3609;&#3623;&#3609;&#3607;&#3633;&#3657;&#3591;&#3626;&#3636;&#3657;&#3609;";
print "                  ".$arr["amount"]."";
print "                 </font></td>";
print "                <td width='32%'><font face='Angsana New'>&#3619;&#3634;&#3588;&#3634;&#3607;&#3640;&#3609;/&#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;&nbsp;";
print "                  ".$arr["unitpri"]."<br>";
print "                  &#3619;&#3634;&#3588;&#3634;&#3586;&#3634;&#3618;/&#3627;&#3609;&#3656;&#3623;&#3618;&nbsp;";
print "                  ".$arr["salepri"]."<br>";
print "                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &gt;&gt;&#3619;&#3634;&#3588;&#3634;&#3595;&#3639;&#3657;&#3629;&lt;&lt;<br>";
print "                  &#3619;&#3634;&#3588;&#3634;/pack&nbsp;&nbsp;&nbsp;&nbsp; ".$arr["packpri"]." �Ҥ������� VAT<br>";
print "                  &#3619;&#3634;&#3588;&#3634;/pack&nbsp;&nbsp;&nbsp;&nbsp; ".$arr["packpri_vat"]." �Ҥ���� VAT<br>";
print "                  &#3619;&#3634;&#3588;&#3634;&#3607;&#3633;&#3657;&#3591;&#3626;&#3636;&#3657;&#3609;&nbsp;&nbsp;&nbsp;";
print "                  ".$arr["price"]."</font></td>";
print "              </tr>";
print "            </table>";
print "          </div>";


print "        <p><font face='Angsana New'>&nbsp;</font></td>";
print "    </tr>";
print "  </table>";
print "  </center>";
print "</div>";
print "</body>";

?>




