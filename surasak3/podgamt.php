<?php
    session_start();
include("connect.inc");
$sql="select edpri,unitpri from druglst where drugcode='$Dgcode'";
//echo $sql;
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);

if($rows["edpri"] > 0){
	if($rows["edpri"] < $rows["unitpri"]){  //�Ҥҡ�ҧ���¡����Ҥҷع/˹���
	$edpri=$rows["edpri"];  //�Ҥҡ�ҧ
	$unitpri=$rows["unitpri"];  //�Ҥҷع/˹���
		echo "<script>alert('�� $Dgcode �ա�á�˹��Ҥҷع/˹����ҡ�����Ҥҡ�ҧ��Ѻ');</script>";  //���������� 7/4/60
		echo "<strong style='color:red;font-size:20px;'>��سҾԨ�óҡ����觫����� $Dgcode  ���ͧ�ҡ�Ҥҷع/˹����٧�����Ҥҡ�ҧ����˹�<br></strong>";
		echo "<strong style='color:blue;font-size:20px;'>�Ҥҡ�ҧ ��� $edpri �ҷ<br>�Ҥҷع/˹��� ��� $unitpri �ҷ</strong>";
		
	}
}

    print"<form method='POST' action='podginfo.php' target='top'>";
	print"<font face='Angsana New'><p>��¡����觫��ͷ�� $x <span lang='en-us'>&nbsp; </span>����ѷ ($cComcode) $cComname</p>";
      	print"> ����<span lang='en-us'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	   print"</span>&nbsp;<input type='text' name='drugcode' size='15' value='$Dgcode'><span lang='en-us'>&nbsp;&nbsp;";
	print"</span>���͡�ä��<span lang='en-us'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	print"</span><input type='text' name='tradname' size='20' value='$Trade'><br>";
	print"˹��¹Ѻ <span lang='en-us'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	print"</span> <input type='text' name='cPacking' size='15' value='$Packing'><span lang='en-us'>&nbsp;&nbsp;";
	      print"</span>��Ҵ��è�<span lang='en-us'>&nbsp;&nbsp;&nbsp;&nbsp; </span><input type='text' name='cPack' size='18' value='$Pack'><br>";
	print"�ӹǹ�ҧ�дѺ <input type='text' name='nMinimum' size='10' value='$Minimum'><span lang='en-us'>&nbsp;&nbsp;";
	print"</span>�ӹǹ����ѧ";
	print"<input type='text' name='nTotalstk' size='15' value='$Totalstk'><br>";
	print"</span>SPEC";
	print"<input type='text' name='nSpec' size='15' value='$Spec'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print"</span>SNSPEC";
	print"<input type='text' name='nSnspec' size='20' value='$Snspec'><br>";

	print"�Ҥ�(+VAT)<span lang='en-us'>&nbsp;&nbsp;&nbsp; </span>";
	print"<input type='text' name='nPackpri_vat' size='10' value='$Packpri_vat'> �ҷ &nbsp;&nbsp;&nbsp; �Ҥ�(������vat)<input type='text' name='nPackpri' size='10' value='$Packpri'> �ҷ<<<<<</p>";

	print"<p>********** �ӹǹ��觫��� <span lang='en-us'>&nbsp;&nbsp;&nbsp; </span> ";
	print"<input type='text' name='amount' size='15'><span lang='en-us'>&nbsp;&nbsp;";
	print"</span>˹���";
    print"&nbsp;</p>";
	?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       ��ŧ       ' name='B1' onclick='window.open("","_self");self.setTimeout("window.close()",0);'></p>";
    <?
    print"</form>";
/*window.open('','_self');
self.setTimeout("window.close()",2000);*/
 ?>