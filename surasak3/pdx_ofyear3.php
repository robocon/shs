<?
include("connect.inc");
?>
<script>
	window.print();
</script>
<style type="text/css">
<!--
.pdx {	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.pdxhead {	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
</head>

<?
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

 $query="SELECT hn,company,program,idno FROM chkup_company WHERE company='$com'  and program = '$pro' ORDER by idno";
  $result = mysql_query($query)or die("Query failed");
    while (list ($hn,$company,$program,$idno) = mysql_fetch_row ($result)) {	
	
		$sql = "Select yot,name,surname,idcard,dbirth,address,tambol,ampur,changwat,phone  From opcard where hn = '$hn' ";
		list($yot,$name,$surname,$idcard,$dbirth,$address,$tambol,$ampur,$changwat,$phone)  = mysql_fetch_row(Mysql_Query($sql));
	
		$fullname=$yot.''.$name.'&nbsp;'.$surname;
		$birthday = substr($dbirth,8,2)."-".substr($dbirth,5,2)."-".substr($dbirth,0,4);
		$age = calcage($dbirth);
?>
<table width="100%">
  <tr>
    <td><table width="98%">
      <tr style='line-height:18px'>
        <td width="126" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td width="687" align="center" class="pdx"><strong><span class="pdxhead">Ẻ��õ�Ǩ�آ�Ҿ
          <?=$company?>
        </span></strong></td>
        <td width="13" rowspan="3" align="center" valign="top"></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
      </tr>
      <tr style='line-height:16px'>
        <td align="center" class="pdxhead">�ѹ���.................................����...................</td>
      </tr>
    </table>
      <span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
        <strong>1. �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ�</strong></span><br />
      <table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr>
          <td><table>
            <tr>
              <td class="pdxpro">HN : <strong>
                <?=$hn?>
                </strong> ����-ʡ�� : <strong>
                  <?=$fullname?>
                  </strong>
                ���� :<?=$age?></td>
            </tr>
            <tr>
              <td class="pdx">�Ţ�ѵû�� :
                <?=$idcard?>
                &nbsp;������� :
                <?=$address." ".$tambol." ".$ampur." ".$changwat?>
                &nbsp;���Ѿ�� :
                <?=$phone?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <?
	$ban = explode(" ",$program);

	$arrtype = array('��Ǩ x-ray �ʹ','��Ǩ��������ó�ͧ������ʹ(CBC)','��Ǩ�������(UA)','��ѹ(CHOL,TRI)','����ҹ(BS)','��Ǩ˹�ҷ��ͧ�Ѻ(SGOT,SGPT,ALK)','��Ǩ˹�ҷ��ͧ�(BUN,CR)','��ҷ�(URIC)');
	$arrprice = array('170.00','90.00','50.00','120.00','40.00','150.00','100.00','60.00');
	?>
      <table width="756">
        <tr>
          <td class="pdxpro" colspan="2"><strong>��¡�õ�Ǩ�آ�Ҿ
            <?=$program?>
          </strong></td>
        </tr>
        <? 
	  $sumpri=0;
	  	if($ban[1]=="1"){
			$q =1;
			for($r=0;$r<3;$r++){
				echo "<tr style='line-height:12px'><td class='pdx'>".$q.". ".$arrtype[$r]."</td><td class='pdx'>�Ҥ� ".$arrprice[$r]." �ҷ</td></tr>";
				$q++;
				$sumpri+=$arrprice[$r];
			}	
			$sumpri = number_format(($sumpri+50),2);
			echo "<tr style='line-height:12px'><td class='pdx'>4. ��Һ�ԡ��</td><td class='pdx'>�Ҥ� 50.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>���</B></td><td class='pdx'><B>�Ҥ� $sumpri �ҷ</B></td></tr>";
		}
		elseif($ban[1]=="2"){
			$q =1;
			for($r=0;$r<3;$r++){
				echo "<tr style='line-height:12px'><td class='pdx'>".$q.". ".$arrtype[$r]."</td><td class='pdx'>�Ҥ� ".$arrprice[$r]." �ҷ</td></tr>";
				$q++;
				$sumpri+=$arrprice[$r];
			}	
			$sumpri = number_format(($sumpri+300),2);
			echo "<tr style='line-height:12px'><td class='pdx'>4. ��Ǩ����移ҡ���١</td><td class='pdx'>�Ҥ� 50.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>5. ��ҵ�Ǩ����</td><td class='pdx'>�Ҥ� 100.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>6. ��ҵ�Ǩ����移ҡ���١</td><td class='pdx'>�Ҥ� 100.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>7. ��Һ�ԡ��</td><td class='pdx'>�Ҥ� 50.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>���</B></td><td class='pdx'><B>�Ҥ� $sumpri �ҷ</B></td>";
		}
		elseif($ban[1]=="3"){
			$q =1;
			for($r=0;$r<8;$r++){
				echo "<tr style='line-height:12px'><td class='pdx'>".$q.". ".$arrtype[$r]."</td><td class='pdx'>�Ҥ� ".$arrprice[$r]." �ҷ</td></tr>";
				$q++;
				$sumpri+=$arrprice[$r];
			}	
			$sumpri = number_format(($sumpri+50),2);
			echo "<tr style='line-height:12px'><td class='pdx'>9. ��Һ�ԡ��</td><td class='pdx'>�Ҥ� 50.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>���</B></td><td class='pdx'><B>�Ҥ� $sumpri �ҷ</B></td>";
		}
		elseif($ban[1]=="4"){
			$q =1;
			for($r=0;$r<8;$r++){
				echo "<tr style='line-height:12px'><td class='pdx'>".$q.". ".$arrtype[$r]."</td><td class='pdx'>�Ҥ� ".$arrprice[$r]." �ҷ</td></tr>";
				$q++;
				$sumpri+=$arrprice[$r];
			}	
			$sumpri = number_format(($sumpri+300),2);
			echo "<tr style='line-height:12px'><td class='pdx'>9. ��Ǩ����移ҡ���١</td><td class='pdx'>�Ҥ� 50.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>10. ��ҵ�Ǩ����</td><td class='pdx'>�Ҥ� 100.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>11. ��ҵ�Ǩ����移ҡ���١</td><td class='pdx'>�Ҥ� 100.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx'>12. ��Һ�ԡ��</td><td class='pdx'>�Ҥ� 50.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>���</B></td><td class='pdx'><B>�Ҥ� $sumpri �ҷ</B></td>";
		}
	  ?>
        <tr>
          <td class="pdx" colspan="2"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
        </tr>
        <tr>
          <td class="pdx" colspan="2"><? 
			echo "<table><tr style='line-height:16px'><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>ʶҹ� 1<br>����¹<br>ŧ����¹<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>ʶҹ� 2<br>�Ѵ�¡������<br>�ѡ����ѵ�<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>ʶҹ� 3<br>X-ray<br>X-ray<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>ʶҹ� 4<br>��ͧ��Ǩ 5<br>��ᾷ��<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>ʶҹ� 5<br>�ش�Ѵ���1<br>�Ѻ�š�õ�Ǩ<br>.............................</td></tr></table></td></tr></table>";
	  ?></td>
        </tr>
        <?
    if($ban[1]=="4"||$ban[1]=="2"){
	?>
        <tr>
          <td class="pdx" colspan="2">�����˵� *�óյ�Ǩ����移ҡ���١����ҵ�Ǩ����� 13.00 �. �.��ͧ��Ǩ�ä�������ٵ� ��֡�ͧ�ѧ�Ѻ���</td>
        </tr>
        <?
	}
	?>
        <tr>
          <td class="pdx">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<div style="page-break-after:always"></div>
<?
	}
?>
