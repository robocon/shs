<?php
    include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style1 {
	font-size: 20px;
	font-weight: bold;
}
-->
</style>
<table width="100%" border="0">
  <tr>
    <td colspan="3" align="center" valign="middle"><span class="style1">Ẻ��ػ��§ҹ��õ�Ǩ�آ�Ҿ��Шӻ� 2557</span></td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="middle"><span class="style1">˹��� �.�.��������ѡ��������</span></td>
  </tr>
  <tr>
    <td width="3%" align="right" valign="middle">1. </td>
    <td colspan="2" valign="middle">�ӹǹ˹��·���㹤����Ѻ�Դ�ͺ ������ 33 ˹���</td>
  </tr>
	<?
    $sql="SELECT age, substring( age, 1, 2 ) AS subage, stat_bmi, reason_bmi, summary 
    FROM `condxofyear_so`
    WHERE status_dr =  'Y' AND `yearcheck`
    LIKE '%2557%'";
    $query=mysql_query($sql);
	$num=mysql_num_rows($query);
   // echo $sql;
    $i=0;
    while($rows=mysql_fetch_array($query)){
    $i++;
    $age = $rows["subage"];
    if($age >= 35){
    $sum35 =count($age);
    $total35 = $total35 + $sum35;
    //echo "$i || 35 || $sum35 <br />";

		//------------------ �Ѫ����š�� -------------------------//	
		if($rows["stat_bmi"]=="����"){
			$sumbmi35 =count($rows["stat_bmi"]);
			$totalbmi35 = $totalbmi35 + $sumbmi35;
		}else{  // �Դ����
			if($rows["reason_bmi"]=="��ҹ�չ��˹ѡ�Թ����������ǹ"){
				$sumbmifat35 =count($rows["reason_bmi"]);
				$totalbmifat35 = $totalbmifat35 + $sumbmifat35;			
			}else if($rows["reason_bmi"]=="��ҹ��������ǹ��͹��ҧ�ҡ" || $rows["reason_bmi"]=="��ҹ��������ǹ�ع�ç"){
				$sumbmivfat35 =count($rows["reason_bmi"]);
				$totalbmivfat35 = $totalbmivfat35 + $sumbmivfat35;						
			}else if($rows["reason_bmi"]=="��ҹ�չ��˹ѡ�����Թ�"){
				$sumbmilow35 =count($rows["reason_bmi"]);
				$totalbmilow35 = $totalbmilow35 + $sumbmilow35;					
			}
		}  // close else �Դ����
		//------------------ ���Ѫ����š�� -------------------------//			
		
		//------------------ �š�õ�Ǩ�آ�Ҿ -------------------------//
		if($rows["summary"]=="����" || $rows["summary"]==""){
			$summary35 =count($rows["summary"]);
			$totalsummary35 = $totalsummary35 + $summary35;
		}else{  // �Դ����
			$summaryesc35 =count($rows["summary"]);
			$totalsummaryesc35 = $totalsummaryesc35 + $summaryesc35;		
		}  // close else �Դ����
		//------------------ ���š�õ�Ǩ�آ�Ҿ -------------------------//				
		
    }else{  // else age 34
    $sum34=count($age);
    $total34 = $total34 + $sum34;
   // echo "$i || 34 || $sum34 <br />";
 
		//------------------ �Ѫ����š�� -------------------------//	   
		if($rows["stat_bmi"]=="����" || $rows["stat_bmi"]=="NULL"){
			$sumbmi34 =count($rows["stat_bmi"]);
			$totalbmi34 = $totalbmi34 + $sumbmi34;
		}else{
			if($rows["reason_bmi"]=="��ҹ�չ��˹ѡ�Թ����������ǹ"){
				$sumbmifat34 =count($rows["reason_bmi"]);
				$totalbmifat34 = $totalbmifat34 + $sumbmifat34;			
			}else if($rows["reason_bmi"]=="��ҹ��������ǹ��͹��ҧ�ҡ" || $rows["reason_bmi"]=="��ҹ��������ǹ�ع�ç"){
				$sumbmivfat34 =count($rows["reason_bmi"]);
				$totalbmivfat34 = $totalbmivfat34 + $sumbmivfat34;						
			}else if($rows["reason_bmi"]=="��ҹ�չ��˹ѡ�����Թ�"){
				$sumbmilow34 =count($rows["reason_bmi"]);
				$totalbmilow34 = $totalbmilow34 + $sumbmilow34;				
			}	
		}  // close else �Դ����
		//------------------ ���Ѫ����š�� -------------------------//			
		
		//------------------ �š�õ�Ǩ�آ�Ҿ -------------------------//
		if($rows["summary"]=="����" || $rows["summary"]==""){
			$summary34 =count($rows["summary"]);
			$totalsummary34 = $totalsummary34 + $summary34;
		}else{  // �Դ����
			$summaryesc34 =count($rows["summary"]);
			$totalsummaryesc34 = $totalsummaryesc34 + $summaryesc34;		
		}  // close else �Դ����
		//------------------ ���š�õ�Ǩ�آ�Ҿ -------------------------//		
		
				
    }  //close age 34
    }  // close while
    //echo "==>$total35 <br />";
   // echo "-->$total34 <br />";
    ?>    
  <tr>
    <td align="right" valign="middle">2. </td>
    <td colspan="2" valign="middle">�ӹǹ���ѧ�� ��. ������ <strong><?=$total=$num+57;?></strong> ��� ����</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td width="4%" align="right" valign="middle">2.1 </td>
    <td width="93%" valign="middle">���ѧ�ŷ�������ص���� 35 �բ���&nbsp;&nbsp;�ӹǹ <strong><?=$total35+37;?></strong> ���</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">2.2 </td>
    <td valign="middle">���ѧ�ŷ�������ع��¡��� 35 ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ӹǹ <strong><?=$total34+20;?></strong> ���</td>
  </tr>
  <tr>
    <td align="right" valign="middle">3. </td>
    <td colspan="2" align="left" valign="middle">�ӹǹ���ѧ�ŷ������Ѻ��á�õ�Ǩ�آ�Ҿ ������ <strong><?=$num;?></strong> ���&nbsp;&nbsp;�Դ�������� <strong><? $percen=$num*100/$total; echo number_format($percen,2); ?></strong> ����</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">3.1 </td>
    <td width="93%" valign="middle">���ѧ�ŷ�������ص���� 35 �բ���&nbsp;&nbsp;�ӹǹ <strong><?=$total35; ?></strong> ���&nbsp;&nbsp;�Դ�������� <strong><? $percen35=$total35*100/$num; echo number_format($percen35,2); ?></strong></td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">3.2 </td>
    <td valign="middle">���ѧ�ŷ�������ع��¡��� 35 ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ӹǹ <strong><?=$total34; ?></strong> ���&nbsp;&nbsp;�Դ�������� <strong><? $percen34=$total34*100/$num; echo number_format($percen34,2); ?></strong></td>
  </tr>
  <tr>
    <td align="right" valign="middle">4. </td>
    <td colspan="2" align="left" valign="middle">��ҴѪ����š��</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">4.1 </td>
    <td valign="middle">���ѧ�ŷ�������ص���� 35 �բ���&nbsp;&nbsp;���� �ӹǹ <strong>
      315
      </strong> ���&nbsp;&nbsp;���¡��һ��� �ӹǹ<strong>
      6
      </strong>���&nbsp;&nbsp;���˹ѡ�Թ �ӹǹ <strong>
      390
      </strong> ���&nbsp;&nbsp;��ǹ �ӹǹ<strong>
      37
    </strong>���</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">4.2 </td>
    <td valign="middle">���ѧ�ŷ�������ع��¡��� 35 ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���� �ӹǹ <strong>
    171
    </strong> ���&nbsp;&nbsp;���¡��һ��� �ӹǹ<strong>
    7
    </strong>���&nbsp;&nbsp;���˹ѡ�Թ �ӹǹ <strong>
    131
    </strong> ���&nbsp;&nbsp;��ǹ �ӹǹ<strong>
    15
    </strong>���</td>
  </tr>
  
  <tr>
    <td align="right" valign="middle">5. </td>
    <td colspan="2" align="left" valign="middle">�š�õ�Ǩ�آ�Ҿ��Шӻ�</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">5.1 </td>
    <td valign="middle">���ѧ�ŷ���ռš�õ�Ǩ�آ�Ҿ���� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ӹǹ <strong>
      <?=$totalsummary35+$totalsummary34; ?>
    </strong>���</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">5.1.1 ���ѧ�ŷ�������ص���� 35 �բ���&nbsp;&nbsp;�ӹǹ <strong>
    <?=$totalsummary35; ?>
    </strong> ���</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">5.1.2 ���ѧ�ŷ�������ع��¡��� 35 ��&nbsp;&nbsp; &nbsp;&nbsp;�ӹǹ <strong>
    <?=$totalsummary34; ?>
    </strong> ���</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">5.2 </td>
    <td valign="middle">���ѧ�ŷ���ռš�õ�Ǩ�آ�Ҿ�Դ���� &nbsp;&nbsp;�ӹǹ <strong>
      <?=$totalsummaryesc35+$totalsummaryesc34; ?>
    </strong>���</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">5.2.1 ���ѧ�ŷ�������ص���� 35 �բ���&nbsp;&nbsp;�ӹǹ <strong>
      <?=$totalsummaryesc35; ?>
    </strong> ���</td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">5.2.2 ���ѧ�ŷ�������ع��¡��� 35 ��&nbsp;&nbsp; &nbsp;&nbsp;�ӹǹ <strong>
      <?=$totalsummaryesc34; ?>
    </strong> ���</td>
  </tr>
  
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="right" valign="middle">&nbsp;</td>
    <td valign="middle">&nbsp;</td>
  </tr>
</table>
