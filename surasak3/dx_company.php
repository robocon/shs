
<SCRIPT LANGUAGE="JavaScript">
		
		window.onload = function(){
			window.print();


		}
	</SCRIPT>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.tet {
	font-family:"Angsana New";
	font-size: 20px;
}
.tet1 {
	font-family: "TH SarabunPSK";
	font-size: 36px;
}
.text3 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.text {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.texthead {
	font-family: "TH SarabunPSK";
	font-size: 25px;
}
.text1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.text2 {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.textsub {
	font-size: 15px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
-->
</style>
</head>
<body>
<div id="no_print" > 
<a href ="../nindex.htm" >&lt;&lt; �����</a></p>
<form action="dx_company.php" method="post">
  <p>&nbsp;</p>
  <p><span class="tet1">�����ŵ�Ǩ�آ�Ҿ��Шӻպ���ѷ</span><br />
    <br />
    <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;��͡ HN : </span>
    <input name="hn" type="text" size="10" class="tet1" />
    <input type="submit" name="ok" value="��ŧ" />
    <br />
    <br />
  </p>
</form>
</div>
<?

if(isset($_POST['hn'])){
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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}
	include("connect.inc");
	$select = "select * from opcard where hn = '".$_POST['hn']."'";
	$row = mysql_query($select);
	$num = mysql_num_rows($row);
	if($num!=0){
		$rep1 = Mysql_fetch_assoc($row);
		$select = "select * from opcard where hn = '".$_POST['hn']."' ";
		
		$result = Mysql_Query($select);
		$arrs = Mysql_fetch_assoc($result);
	}else{
		echo "����բ����� HN �����";
		die;
	}
    
?>
<table width="100%">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>Ẻ��§ҹ��õ�Ǩ�آ�Ҿ ����ѷ �������� �Ũ�ʵԡ�� �ӡѴ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">��Ǩ������ѹ���
          <?
  $da = explode(" ",$arrs["thidate"]);
  $daten = explode("-",$da[0]);
  ?>
          <?=date("d")?>
          -
          <?=date("m")?>
          -
          <?=(date("Y")+543)?>
          &nbsp;
          <!--<?//$da[1]?>-->
        </span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="92%" >
      <tr>
        <td><table width="97%" class="text1">
          <tr>
            <td width="15%" valign="top" class="text2"><strong>HN :</strong>
              <?=$arrs['hn']?></td>
            <td colspan="3" valign="top" class="text2"><strong>���� :</strong> <span style="font-size:24px"><strong>
              <?=$arrs['yot'].'&nbsp;'.$arrs['name'].'&nbsp;'.$arrs['surname']?>
            </strong></span></td>
            <td valign="top" class="text2"><strong>���� :</strong>
              <?=calcage($rep1['dbirth'])?></td>
            <td valign="top" class="text3"><strong>�ѧ�Ѵ : </strong> <span style="font-size:24px"><strong>
              <?=$rep1['camp']?>
            </strong></span></td>
          </tr>
          <tr>
            <td valign="top"><span class="text3"><strong>���˹ѡ: </strong>
              ........
              ��.</span></td>
            <td width="14%" valign="top"><span class="text3"><strong>��ǹ�٧:</strong>
              .......
              ��.</span></td>
            <td width="10%" valign="top"><span class="text3"><strong>BMI: </strong> <u>
              ...........
            </u> </span></td>
            <td width="14%" valign="top"><span class="text3"><strong>�ͺ���:</strong>
              ...... ��.</span></td>
            <td width="19%" valign="top"><span class="text3"><strong>����:</strong>
              ..........................
            </span></td>
            <td width="28%" valign="top"><span class="text3"><strong>�ä��Шӵ��: </strong>
              .................................
            </span></td>
          </tr>
          <tr>
            <td valign="top"><span class="text3"><strong>������: </strong>
              ............
            </span></td>
            <td valign="top"><span class="text3"><strong>����: </strong>
              ................
            </span></td>
            <td valign="top"><span class="text3"><strong>T:</strong> <u>
              .........
            </u> C �</span></td>
            <td valign="top"><span class="text3"><strong>P: </strong>
              ........
              ����/�ҷ�</span></td>
            <td valign="top"><span class="text3"><strong>R: </strong>
              ..................
              ����/�ҷ�</span></td>
            <td valign="top"><span class="text3"><strong>BP:</strong> <u>
              ........
              /
              .......
              mmHg.</u></span></td>
          </tr>
          <tr>
            <td colspan="6" valign="top" class="text2"><strong class="text2">�š�õ�Ǩ��ҧ��·���� </strong>[&nbsp;&nbsp;&nbsp;] ���� <span class="text2">[&nbsp;&nbsp;&nbsp;] ��軡�� ............................................................................................</span></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <?
  $dr =explode(" ",$arrs['doctor']);
  ?>
</table>
<table width="100%" class="text">
  <tr>
    <td width="26%" valign="top" class="text3"><strong>��õ�Ǩ�������ʹ������� :</strong></td>
    <td width="9%" valign="top">[&nbsp;&nbsp;&nbsp;] ����</td>
    <td width="13%" valign="top" class="text">[&nbsp;&nbsp;&nbsp;] ��軡��</td>
    <td width="52%" valign="top" class="text"><strong>
      ............................................................................................</strong></td>
  </tr>
  <tr>
    <td valign="top" class="text3"><strong>��Ǩ������ʾ�Դ㹻������ :</strong></td>
    <td valign="top">[&nbsp;&nbsp;&nbsp;] ����</td>
    <td valign="top" class="text">[&nbsp;&nbsp;&nbsp;] ��軡��</td>
    <td valign="top" class="text"><strong>............................................................................................</strong></td>
  </tr>
  <tr>
    <td valign="top" class="text3"><strong>��Ǩ��µ����ͧ�� :</strong></td>
    <td valign="top"> [&nbsp;&nbsp;&nbsp;] ����</td>
    <td valign="top" class="text">[&nbsp;&nbsp;&nbsp;] ��軡��</td>
    <td valign="top" class="text"><strong>............................................................................................</strong></td>
  </tr>
  <tr>
    <td valign="top" class="text3"><strong>��Ǩ������Թ :</strong></td>
    <td valign="top"> [&nbsp;&nbsp;&nbsp;] ����</td>
    <td valign="top" class="text">[&nbsp;&nbsp;&nbsp;] ��軡��</td>
    <td valign="top" class="text"><strong>............................................................................................</strong></td>
  </tr>
  <tr>
    <td height="27" colspan="4" align="center" valign="top" class="text1"><hr />
      <strong>��ػ�š�õ�Ǩ�آ�Ҿ</strong>&nbsp;<u>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </u></td>
  </tr>
  <tr>
    <td height="27" colspan="4" valign="top" class="text1"><span class="text2"><strong>Diag</strong> :
        ...........................................................................................................................
        &nbsp;<strong > <br />
        �����Դ��繨ҡᾷ��</strong> &nbsp;
        .........................................................................................<br />
        .......................................................................................................................................<br />
        .......................................................................................................................................
    </span></td>
  </tr>
  <tr>
    <td align="right" valign="top" class="text2" colspan="4"><span class="text1">ᾷ�� <?=$result['doctor']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���Թ ������Ѳ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>

	

  </tr>
</table>
<div style='page-break-after: always'></div>
<center><span class="text1"><br /><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
<B>�š�õ�Ǩ�آ�Ҿ��Шӻ�</B><BR><B>����ѷ TLL Logistics.co.,Ltd</B><BR>
  <br />
  ���� <span style="font-size:24px"><strong>
              <?=$arrs['yot'].'&nbsp;'.$arrs['name'].'&nbsp;'.$arrs['surname']?>
            </strong>HN <span class="text2">
<?=$arrs['hn']?>
</span><br />
�ѹ��� <span class="text2">
<?
  $da = explode(" ",$arrs["thidate"]);
  $daten = explode("-",$da[0]);
  ?>
          <?=date("d")?>
          -
          <?=date("m")?>
          -
          <?=(date("Y")+543)?>
          &nbsp;
          <!--<?//$da[1]?>-->
 </span><br />
<U>��سҹ��觤׹����ѷ</U></span></center>
<?
}
?>
</body>
</html>