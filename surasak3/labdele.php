<?php
session_start();
if (isset($sIdname)){} else {die;} //for security
    $n=$Delrow;
    $aDgcode[$n]=""; 
    $aTrade[$n]=""; 
    $aPrice[$n]=""; 

       $aYprice[$n]=""; 
       $aNprice[$n]=""; 
      $aSumYprice=array_sum($aYprice);
       $aSumNprice=array_sum($aNprice);

    $aPart[$n]=""; 
    $aAmount[$n]="";
    $money = "";
    $aMoney[$n]="";
    $Netprice=array_sum($aMoney);
	$aFilmsize[$n]="";
?>
<table>
 <tr>
  <th bgcolor=CD853F>ź</th>
  <th bgcolor=CD853F>#</th>
  <th bgcolor=CD853F>����</th>
  <th bgcolor=CD853F>��¡��</th>
  <th bgcolor=CD853F>�Ҥ�</th>
  <th bgcolor=CD853F>�ӹǹ</th>
  <th bgcolor=CD853F>����Թ</th>
 </tr>
<?php
   for ($n=1; $n<=$x; $n++){
        print("<tr>\n".
                "<td bgcolor=F5DEB3><a target='right'  href=\"labdele.php? Delrow=$n\">ź</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$n</td>\n".
                "<td bgcolor=F5DEB3>$aDgcode[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aTrade[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aPrice[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aAmount[$n]</td>\n".
                "<td bgcolor=F5DEB3>$aMoney[$n]</td>\n".
                " </tr>\n");
        }
?>
</table>
<?php
echo " <b>�Ҥ����  $Netprice �ҷ </b> <br>";
echo " �Ҥ��ԡ�� $aSumYprice �ҷ ";
echo " <font color =FF0000> <b> �Ҥ��ԡ�����   $aSumNprice �ҷ </b> ";
?>
    <br><a target=_BLANK href="labtranx.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>><font face='Angsana New' size='3'>�����¡��/���˹��</a>&nbsp;&nbsp; <a target=_BLANK href="labtranxlabno.php" <?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>>�����¡��/���˹�� LAB ����͡���</a><br><br>
   
<a target=_BLANK href="labslip4bc.php">ʵ������</a>&nbsp;&nbsp;
<a target=_BLANK href="labslip4.1.php">ʵ������LAB ����͡���</a>&nbsp;&nbsp;
<a target=_BLANK href="labslip4pdf.php">ʵ������LAB PDF</a>&nbsp;&nbsp;
<br><br>
<a target=_BLANK href="labslip4out.php">ʵ������ Lab �͡</a>&nbsp;&nbsp;
<a target=_BLANK href="labslip5out.php">ʵ������ Lab �͡ NAP</a>

<br><br>
<a target=_BLANK href="labtranxnid.php"<?php if($aSumNprice > 0){echo "Onclick=\"alert('��� �ѵ���� ����ǹ�Թ����������ö�ԡ�� �������ª����Թ��ǹ�Թ�����ǹ���Թ');\""; }?>>�����¡��/���˹��/��Ѻ�ͧᾷ�� �ѧ��� </a>
<br><br>
<a target=_BLANK href="labtranxnid1.php">��Ѻ�ͧᾷ�� �ѧ��� </a>
<br><br>
<a target=_BLANK href="labtranxnid1.php?subDoctor=1">��Ѻ�ͧᾷ�� �ѧ���(�Ҥ���� ���ط��ǧ��)</a>
<br><br>
<a target=_BLANK href="labtranxnid1.php?subDoctor=2">��Ѻ�ͧᾷ�� �ѧ���(����� �����ѵ��)</a>