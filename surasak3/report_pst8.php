<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
?>

<body>
<div align="center">
  <p><strong>��§ҹ�ӹǹ������Ѻ��ԡ�âͧ þ.��.(��Ǫ���Ѵ) (ç.�ʵ.8)<br>
  ˹��§ҹ  �ç��Һ�Ť�������ѡ��������  <br>
 ��Ш���͹  <?=$mon;?>&nbsp;�� <?=$thyear;?></strong></p>
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" rowspan="2" align="center"><strong>�������ؤ��</strong></td>
      <td width="23%" rowspan="2" align="center"><strong>�����¹͡<br>
      (����)</strong></td>
      <td width="22%" align="center"><strong>����ǹ�</strong></td>
    </tr>
    <tr>
      <td align="center"><strong>(�Ѻ����)</strong></td>
    </tr>
    <tr>
      <td width="6%" align="center"><strong>������ �.</strong></td>
      <td width="49%" align="left"><p>��·��û�Шӡ�� , ����Ժ��Шӡ�� , ����Ժ��Шӡ��</p>
      <p>����Ҫ��á����������͹ , �١��ҧ��Ш� , �١��ҧ���Ǥ���</p></td>
      
       <?
	  $sql1="select * from opday where an is null  and thidate  between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 // echo $sql1;
	  $query1=mysql_query($sql1);
	  $aball=0;
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows1=mysql_fetch_array($query1)){
		 //  $aball++;
	  $group=substr($rows1["goup"],0,2);
	 // echo "--->".$group."<br>";
	  	if($group=="G1"){
			$ab1++;
		}
		if($group=="G2"){
			$ab2++;		
		}
		if($group=="G3" || $group=="G4"){
			$ab3++;	
		}
	  }
	  $aball=$ab1+$ab2+$ab3;
	  
	  $sql2="select * from ipcard where date between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //  $sql2="select * from opday where an is not null  and thidate  between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	// echo $sql2;
	  $query2=mysql_query($sql2);
	  $aballin=0;
	  $ab1in=0;
	  $ab2in=0;
	  $ab3in=0;
	  while($rows2=mysql_fetch_array($query2)){
		   //$aballin++;
	  $group=substr($rows2["goup"],0,2);
	 // echo "--->".$group."<br>";
	  	if($group=="G1"){
			$ab1in++;
		}
		if($group=="G2"){
			$ab2in++;		
		}
		if($group=="G3" || $group=="G4"){
			$ab3in++;	
		}
	  }
	
	  $aballin=$ab1in+$ab2in+$ab3in;
	  ?>
      
      
      
      <td><center><?=$ab1;?></td>
      <td><center><?=$ab1in;?></td>
    </tr>
    <tr>
      <td align="center"><strong>������ �.</strong></td>
      <td align="left"><p>�ŷ��áͧ��Шӡ�� , �ѡ���¹���� ,</p>
      <p>������Ѥ÷��þ�ҹ , �ѡ�ɷ��� , ��о�ѡ�ҹ�Ҫ���</p></td>
      <td><center><?=$ab2;?></td>
      <td><center><?=$ab2in;?></td>
    </tr>
    <tr>
      <td align="center"><strong>������ �.</strong></td>
      <td align="left"><p>��ͺ���Ƿ��� , ���ù͡��Шӡ�� , �ѡ�֡���Ԫҷ��� (ô.)</p>
      <p>���Ѳ������ͧ , �����͹��ѵû�Сѹ�ѧ��</p>
      <p>�����͹��ѵû�Сѹ�آ�Ҿ , ����Ҫ��þ����͹ (�ԡ���ѧ�Ѵ)</p>
      <p>�����͹ (����ԡ���ѧ�Ѵ) , �����͹ ����</p>
      </td>
      <td><center><?=$ab3;?></td>
      <td><center><?=$ab3in;?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><strong>���������</strong></td>
      <td> <center><?=$aball;?></td>
      <td><center><?=$aballin;?></td>
    </tr>
  </table>
  <p><strong>��Ǩ�١��ͧ</strong></p>
</div>
</body>
</html>
