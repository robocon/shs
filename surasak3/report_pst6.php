<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
?>

<body>
<div align="center">
  <p><strong>( 6 ) �ѭ���ʹ���ѧ�ū��ʹѺʹع��ԡ��ᾷ�� (ç.�ʵ.6)<br>
 ˹��§ҹ �ç��Һ�Ť�������ѡ�������� <br>
��Ш���͹ <?=$mon;?>&nbsp;�� <?=$thyear;?></strong></p>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td width="28" rowspan="2" align="center"><strong>�ӴѺ</strong></td>
      <td width="157" rowspan="2" align="center"><strong>˹����Ѻ���ʹѺʹع</strong></td>
      <td width="101" align="center"><strong>�.1</strong></td>
      <td width="97" align="center"><strong>�.2</strong></td>
      <td width="79" align="center"><strong>�.3</strong></td>
      <td width="65" align="center"><strong>�.4</strong></td>
      <td width="79" align="center"><strong>�.5</strong></td>
      <td width="150" align="center"><strong>�.1</strong></td>
      <td width="77" align="center"><strong>�.2</strong></td>
      <td width="109" align="center"><strong>�.3</strong></td>
      <td width="74" align="center"><strong>�.4</strong></td>
      <td width="75" align="center"><strong>�.1</strong></td>
      <td width="94" align="center"><strong>�.3</strong></td>
      <td width="95" align="center"><strong>�.4</strong></td>
      <td width="55" rowspan="2" align="center"><strong>���</strong></td>
    </tr>
    <tr>
      <td width="101" align="center" valign="top"><strong>��·��û�Шӡ��</strong></td>
      <td width="97" align="center" valign="top"><strong>����Ժ �ŷ��û�Шӡ��</strong></td>
      <td width="79" align="center" valign="top"><strong>����Ҫ���<br />
        �����������͹</strong></td>
      <td width="65" align="center" valign="top"><strong>�١��ҧ��Ш�</strong></td>
      <td width="79" align="center" valign="top"><strong>�١��ҧ���Ǥ���</strong></td>
      <td width="150" align="center" valign="top"><strong>����Ժ�ŷ��áͧ��Шӡ��</strong></td>
      <td width="77" align="center" valign="top"><strong>�ѡ���¹����</strong></td>
      <td width="109" align="center" valign="top"><strong>������Ѥ÷��þ�ҹ</strong></td>
      <td width="74" align="center" valign="top"><strong>�ѡ�ɷ���</strong></td>
      <td width="75" align="center" valign="top"><strong>��ͺ���Ƿ���</strong></td>
      <td width="94" align="center" valign="top"><strong>�ѡ�֡���Ԫҷ��� (ô.)</strong></td>
      <td width="95" align="center" valign="top"><strong>���Ѳ������ͧ</strong></td>
    </tr>
    <?
	$sql="select * from camp where reportpst='Y'";
	$query=mysql_query($sql);
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	?>
    <tr>
      <td align="center"><?=$i;?></td>
      <td align="left"><?=$rows["name"];?></td>
   <?
	$sql1="select * from opday where thidate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59' and camp ='$rows[name]'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$newg11=0;
	$newg12=0;
	$newg13=0;
	$newg14=0;
	$newg15=0;
	$newg21=0;
	$newg22=0;
	$newg23=0;
	$newg24=0;
	$newg31=0;
	$newg32=0;
	$newg33=0;
	$newg34=0;
	$newg35=0;
	$newg36=0;
	$newg37=0;
	$newg38=0;
	$newg39=0;
	$newg40=0;	
	$newg41=0;	
	  while($rows1=mysql_fetch_array($query1)){
		$goup=substr($rows1["goup"],0,3);
		//echo $goup."<br>";
		if($goup=="G11"){
			$newg11++;
		}
		if($goup=="G12"){
			$newg12++;
		}
		if($goup=="G13"){
			$newg13++;
		}
		if($goup=="G14"){
			$newg14++;
		}
		if($goup=="G15"){
			$newg15++;
		}
		if($goup=="G21"){
			$newg21++;
		}
		if($goup=="G22"){
			$newg22++;
		}
		if($goup=="G23"){
			$newg23++;
		}
		if($goup=="G24"){
			$newg24++;
		}
		if($goup=="G31"){
			$newg31++;
		}	
		if($goup=="G32"){
			$newg32++;
		}
		if($goup=="G33"){
			$newg33++;
		}
		if($goup=="G34"){
			$newg34++;
		}
		if($goup=="G35"){
			$newg35++;
		}	
		if($goup=="G36"){
			$newg36++;
		}
		if($goup=="G37"){
			$newg37++;
		}
		if($goup=="G38"){
			$newg38++;
		}
		if($goup=="G39"){
			$newg39++;
		}
		if($goup=="G40"){
			$newg40++;
		}
		if($goup=="G41"){
			$newg41++;
		}																					
	}
	$sumnewg=$newg11+$newg12+$newg13+$newg14+$newg15+$newg21+$newg22+$newg23+$newg24+$newg31+$newg33+$newg34;
	?>      
      <td align="center"><?=$newg11;?></td>
      <td align="center"><?=$newg12;?></td>
      <td align="center"><?=$newg13;?></td>
      <td align="center"><?=$newg14;?></td>
      <td align="center"><?=$newg15;?></td>
      <td align="center"><?=$newg21;?></td>
      <td align="center"><?=$newg22;?></td>
      <td align="center"><?=$newg23;?></td>
      <td align="center"><?=$newg24;?></td>
      <td align="center"><?=$newg31;?></td>
      <td align="center"><?=$newg33;?></td>
      <td align="center"><?=$newg34;?></td>
      <td align="center"><?=$sumnewg;?></td>
    </tr>
    <?
	}  //close while
	?>
  </table>
  <p><strong>��Ǩ�١��ͧ</strong></p>
</div>
</body>
</html>
