<?  session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>

<style>
body{
	font-family:"TH SarabunPSK";
}
.textindent{
	text-indent:2.5cm;
}
.textindent2{
	text-indent:1cm;
}
.textindent3{
	text-indent:5cm;
}
.textindent5{
	text-indent:7cm;
}
.textindent4{
	text-indent:3cm;
}
.fonth1{
	font-size:18pt;
}
.font2{
	font-size:16pt;
}
.font3{
	font-size:10pt;
}
</style>
</head>
<?
 include("connect.inc");

    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   If ($result){
	$regisdate=$row->regisdate;
	$idcard =$row->idcard;
	$vHN =$row->hn;
	$yot=$row->yot;
	$name=$row->name;
	$surname =$row->surname;
    $ptname=$yot.' '.$name.'  '.$surname;
	$goup =$row->goup;
	$married =$row->married;
//	$cbirth (�ѹ�Դ��ͤ���������)
	$cbirth =$row->cbirth; // (�ѹ�Դ��ͤ���������)
	$dbirth =$row->dbirth;
	$guardian=$row->guardian;
	$idguard=$row->idguard;
	$nation =$row->nation;
	$religion =$row->religion;
	$career =$row->career;
	$ptright =$row->ptright;
	$address =$row->address;
	$tambol =$row->tambol;
	$ampur =$row->ampur;
	$changwat =$row->changwat;
	$phone =$row->phone;
	$phone2 =$row->phone2;
	$father =$row->father;
	$mother =$row->mother;
	$couple =$row->couple;
	$note=$row->note;
	$sex =$row->sex;
	$camp =$row->camp;
	$race=$row->race;
$ptf=$row->ptf;
$ptfadd=$row->ptfadd;
$ptffone=$row->ptffone;
$ptfmon=$row->ptfmon;
//  2494-05-28
    $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
 //   $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
  
                  }  
   else {
      echo "��辺 HN : $cHn ";
           }   

include("unconnect.inc");

$dateday=date("d");
$datem=date("m");
$dateyear=(date("Y")+543);


switch($datem){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}

?>
<body onload="window.print()">
<!--<table width="100%" border="0">
  <tr>
    <td class="textindent">--><table width="100%" border="0">
      <tr>
        <td class="textindent2">&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td width="35%" class="textindent2">&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td width="35%"  rowspan="3" class="textindent2"><img src="images/L83LVEIGXVK9GDJ.jpg" alt="" width="70" height="70" /></td>
        <td width="65%" ><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ç��Һ�Ť�������ѡ��������</strong></td>
      </tr>
      <tr>
        <td><strong>˹ѧ��͢����һ���ѵԡ���ѡ�Ҿ�Һ��</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center">�ѹ��� <?=$dateday;?>&nbsp;&nbsp;��͹ <?=$printmonth;?> �.�. <?=$dateyear;?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td colspan="2" class="textindent2">����ͧ �����һ���ѵԼ�����</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">���¹ ᾷ��������Ǣ�ͧ</td>
      </tr>
      <tr>
        <td height="32" colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">���¢�Ҿ���..............................................................................�����ҹ�Ţ��� .....................������..........................................</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">�Ӻ�......................................................�����...............................................�ѧ��Ѵ..........................................................</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">�����Ţ���Ѿ��..............................................�դ������ʧ������һ���ѵ�</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">�����ª���  <strong>
        <?=$ptname;?></strong>
        HN
          <strong>
          <?=$vHN?>
          </strong> &nbsp;�����Ţ��ЪҪ� <strong>
          <?=$idcard;?>
        </strong> &nbsp;&nbsp;����</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ��Сͺ���ѡ�ҵ�� � ʶҹ��Һ�����</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ��Сͺ��þԨ�ó� ����ǡѺ�Ԩ��û�Сѹ���Ե</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�к��˵ؼ�...............................................................................................................</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> �繾�ҹ�͡���</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ���� (�к�................................................................................................................)</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent">��觢�Ҿ������������Ǣ�ͧ�Ѻ��Ңͧ����ѵ�㹰ҹ�...........................................................................���</td>
      </tr>
      <tr>
        <td colspan="2" style="text-justify :newspaper; text-indent:1cm;"> ��Ҿ��ҷ�Һ����� ��â����һ���ѵԼ�����㹤��駹��ͧ��Ҿ��� �Ҩ������Դ��������µ�ͷҧ�ç��Һ�Ť�������ѡ�������� </td>
      </tr>
      <tr>
        <td colspan="2" style="text-justify :newspaper; text-indent:1cm;">����ᾷ��������Ǣ�ͧ�������˹�ҷ��������Ǣ�ͧ  ��Ҿ��Ң��Ѻ�ͧ����ҡ�Դ��������¨ҡ��â����һ���ѵԼ����¢ͧ��Ҿ���㹤��駹�� </td>
      </tr>
      <tr>
        <td colspan="2" style="text-justify :newspaper; text-indent:1cm;">��Ҿ����Թ���Ѻ�Դ �����з���Թ�����������Ҩ���Ѻ����������� ����˹ѧ����׹�ѹ��ͼ������Ǣ�ͧ����</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent">�֧���¹�������ô�Ԩ�ó�</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent5">���ʴ������Ѻ���</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ŧ����)............................................................................�����蹤���ͧ</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2"><u>�����˵�</u> &nbsp;&nbsp;<u>�͡��û�Сͺ </u></td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2"><span class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ���Һѵû�Шӵ�Ǽ���</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ���Һѵû�Шӵ�Ǽ�����</span></td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2"><span class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ���ҷ���¹��ҹ���� &nbsp;&nbsp;&nbsp;&nbsp;<img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ���ҷ���¹��ҹ������ &nbsp;&nbsp;&nbsp;<img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ˹ѧ����ͺ�ӹҨ </span></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="textindent3">(ŧ����)............................................................................ᾷ����͹حҵ</span></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="textindent3">(ŧ����)............................................................................���.�����Թ���</span></td>
      </tr>
      <tr>
        <td colspan="2" class="font3 textindent3">�ͧ��Ǩ�ä�����¹͡ �͡��������Ţ FR-OPD-002/15....��䢤��駷�� 02,1 �.�.52</td>
      </tr>
    </table><!--</td>
  </tr>
</table>-->
</body>
</html>