<style>
.font1{
	font-family:"Angsana New";
	font-size:13pt;
}
#tdindent{
text-indent:0cm;
}
#tdindent2{
text-indent:10cm;
}
</style>
<br />
<body onLoad="print();">
<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543);
	Function calcage($birth){
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
             }
      else{
            $pAge="$ageY �� $ageM ��͹";
                        }
      return $pAge;
          }
//
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
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
  
                  }  
   else {
      echo "��辺 HN : $cHn ";
           }   

if($sex =='�'){$sex1="���";} else {$sex1="˭ԧ";};
include("unconnect.inc");
?>
<table width="100%" border="0" align="center" class="font1" cellpadding="1" cellspacing="1">
      <tr>
        <td width="16%" id="tdindent"><img src="images/sso.png" alt="" width="100" height="100" /></td>
        <td colspan="2" valign="bottom" style="text-indent:3cm;"><span style="font-size:16pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>˹ѧ����Ѻ�ͧ�ͧᾷ�����ѡ��</u></strong></span></td>
        <td width="27%" align="right" valign="top">��.16/1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">��Ҿ���.................................................................................................... <!--
          <?// for($i=1;$i<=90;$i++){ echo "&nbsp;"; } ?>
          -->�Ţ����͹حҵ��Сͺ�ԪҪվ�Ǫ����<!--
            <?// for($i=1;$i<=45;$i++){ echo "&nbsp;"; } ?>
          -->........................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">ʶҹ����Ǩ�ѡ��<!-- &nbsp;&nbsp;&nbsp;&nbsp;-->
        &nbsp;&nbsp;�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ &nbsp;&nbsp;&nbsp;���Ѿ�� <!---->054-839305 <!---->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����� <!---->054-839310<!----></td>
      </tr>
      <tr>
        <td colspan="4"></td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">���Ǩ�ѡ�����Ǣ��Ѻ�ͧ �ѧ���</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"><span style="font-size:16pt; font-weight:bold;" >1. �����ª��� 
          <?=$ptname;?>
          &nbsp;&nbsp; �� 
            <?=$sex1;?>
             &nbsp;&nbsp;���� &nbsp;&nbsp;
              <?=$cAge;?></span>
            </td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"><span style="font-size:16pt;" >&nbsp;&nbsp;&nbsp;&nbsp;HN 
          <?=$vHN;?>
           &nbsp;&nbsp;AN
            <? for($i=1;$i<=20;$i++){ echo "&nbsp;"; } ?></span>
          </td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"><span style="font-size:16pt;" >2. ����Ѻ����ѡ�Ҥ����á�ѹ���  <?=date("d-m-").(date("Y")+543);?>&nbsp;&nbsp;����....................... 
          �.</td></span>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/image001.gif" width="13" height="13" />&nbsp;&nbsp;�纻��¨ҡ��÷ӧҹ <img src="images/image001.gif" width="13" height="13" />&nbsp;�óջ��ʺ�ѹ���¨ҡ��÷ӧҹ</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"> 3.���˵آͧ����纻��� /���ʺ�ѹ���� ........................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">4.����ѵԡ���纻�������ҡ�÷���Ӥѭ ............................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;(Pertinent Physical Exam)
          ..............................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">5.�š�õ�Ǩ�����  ............................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;(Investigation).................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">6.����ԹԨ����ä (����кت����ä ������ѡ��� ICD10) &nbsp;1.<span style="text-indent:7.2cm;">..........................................................................................................................................................</span></td>
      </tr>
      <tr>
        <td colspan="4" style="text-indent:7.2cm;">2...........................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" style="text-indent:7.2cm;">3...........................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;(Diagnosis) 
        .....................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;�ä�á
         
        .......................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">����ա�ü�ҵѴ 1..........................................................................................................................................................
           �ѹ��� 
            ................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2..........................................................................................................................................................
           �ѹ��� 
            ................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">8.���ѡ��(Treatment) <img src="images/image001.gif" width="13" height="13" />&nbsp; �й� <img src="images/image001.gif" width="13" height="13" /> &nbsp;��,�й� <img src="images/image001.gif" width="13" height="13" /> &nbsp;��ҵѴ <img src="images/image001.gif" width="13" height="13" /> &nbsp;�ѵ�������� �к� 
          ........................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">9. ����������ش�ѡ�ѡ�ҵ�� <img src="images/image001.gif" width="13" height="13" /> &nbsp;�ա�˹�
          ...................................��͹ 
            ...................................
             �ѹ ������ѹ��� 
              ...............................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">�ѹ����ش����ѡ��
          ....................................................
         <img src="images/image001.gif" width="13" height="13" />&nbsp;�ѧ�������ش����ѡ��</td>
      </tr>
      <tr>
        <td id="tdindent">10.�š���ѡ��</td>
        <td colspan="3"><img src="images/image001.gif" width="13" height="13" />&nbsp;�٭�������ö�Ҿ���ҧ���âͧ������ </td>
      </tr>
      <tr>
        <td id="tdindent">(Result)</td>
        <td width="10%">&nbsp;</td>
        <td colspan="2">1. 
          ............................................................................................
          ������ 
          ......................................................................</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">2. 
          ............................................................................................
          ������ 
            ......................................................................</td
  >
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">3. 
          ............................................................................................
          ������ 
            ......................................................................</td
  >
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><img src="images/image001.gif" width="13" height="13" />&nbsp;����ա���٭���� 
          ................................................................................................................................................................................
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><img src="images/image001.gif" width="13" height="13" /> ���ª��Ե�ҡ���˵� 
          ...........................................................................................................................................................................
        </td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">11.���������� 
          ................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;(Comments) 
          ..................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="right" id="tdindent2">&nbsp;ŧ����...................................................................ᾷ�����ѡ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="right" id="tdindent2">�ѹ��� ..................��͹ ..................................�.�....................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
    </table>
</body>