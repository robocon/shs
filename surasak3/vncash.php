<?php
    session_start();

	include("connect.inc");
    if (isset($sIdname)){} else {die;} //for security

    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  



	///////////////////

	
	?>
    
<script>
function check(){
	if(document.getElementById('aLink').value=="")
	{ 
		alert("��س���� vn ���¤��"); 
		document.getElementById('aLink').focus();
		return false;
	}
	else if(document.getElementById('chkop').checked==true){
		var cvn = document.getElementById('aLink').value;
		return confirm("�׹�ѹ��äԴ�����Ѻ�ͧᾷ�� \nvn: "+cvn);
	}
	else{ 
		return true;
	}
}
</script>
<form method='POST' action='opcashvn.php' onsubmit='return check();'>
<?
    print "<p><font face='Angsana New'>��ͧ��ô���¡�õ�Ǩ���� VN (�����¹͡) ���� AN (�������) ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>�ѹ���&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='2' value=$d>&nbsp;&nbsp;";
    print "��͹&nbsp; <input type='text' name='m' size='2' value=$m>&nbsp;&nbsp;&nbsp;";
    print "�.�. <input type='text' name='yr' size='8' value=$yr></font></p>";
   // print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  print "<p><font face='Angsana New' >VN ���� AN&nbsp;&nbsp; ";
    print "<input type='text' name='vn' size='10'  id='aLink' ><script type='text/javascript'>";
   print "document.getElementById('aLink').focus();";
  print "</script>&nbsp;&nbsp;";
  print "<font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='radio' value='1' name='op' id='chkop1'> �Դ�����Ѻ�ͧᾷ�� 20 �ҷ &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
	print "<input type='radio' value='2' name='op' id='chkop2'> �Դ�����Ѻ�ͧᾷ�� 50 �ҷ &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<br>";
	print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	print "�ӹǹ <input type='radio' value='1' name='ncal' id='ncal1' checked> 1 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
	print "<input type='radio' value='2' name='ncal' id='ncal2'> 2 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
	print "<input type='radio' value='3' name='ncal' id='ncal3'> 3 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
	print "<input type='radio' value='4' name='ncal' id='ncal4'> 4 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
	print "<input type='radio' value='5' name='ncal' id='ncal5'> 5 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
  print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='          ��ŧ          ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ź���' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
    print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<a target=_self  href='../nindex.htm'><<�����</a>";
	print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<a href='../surasak3/check_cash.php' target='_blank'><<��¡�ä�ҧ������͹��ѧ</a>"; print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<a href='../surasak3/rprecipthn.php' target='_blank' ><<����������͹��ѧ</a>"; print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<a href='report_approvecode.php' target='_blank' >������ Approve Code �Է���ԡ���µç</a>";
    print "</form>";
?>
<?

//////	 ����͹�������¡�üԴ��Ҵ ///

$start_date=(date("Y")+543).date("-m-d");

$sql="Select * from opacc Where date like '$start_date%' and credit =''  ";
	$query= mysql_query($sql) or die (mysql_error());
	

	$numrow=mysql_num_rows($query);
	
	if($numrow){
		print "����¡�÷��Դ��Ҵ�ҡ���ŧ������";
		
		echo "<script>alert('�Դ�����Դ��Ҵ㹡�����Թ�����¹͡  \\n ��س�仵�Ǩ�ͺ�����Դ��Ҵ�������  �Դ�ѭ�ռ����¹͡')</script>";
		while($arr=mysql_fetch_array($query)){	
		
		$sqln="Select ptname  from opday Where hn = '$arr[hn]' and ptname !='' limit 1 ";
		$queryn= mysql_query($sqln) or die (mysql_error());
		$arrn=mysql_fetch_array($queryn)	;
		
		 print (" <div style=background-color:#C33><tr>\n".
		   "  <td bgcolor='#FF0000'><font face='Angsana New'>$i</td>\n&nbsp;".
		   "  <td bgcolor='#FF0000'><font face='Angsana New'>$arr[hn]</td>\n&nbsp;".
           "  <td bgcolor='#FF0000'><font face='Angsana New'>$arrn[ptname]</td>\n&nbsp;".
           "  <td bgcolor='#FF0000'><font face='Angsana New'>$arr[detail]</td>\n&nbsp;".
		   "  <td bgcolor='#FF0000'><font face='Angsana New'>$arr[price]</td>\n&nbsp;".
		   "  <td bgcolor='#FF0000'><font face='Angsana New'>$arr[credit]</td>\n&nbsp;".
           "  <td bgcolor='#FF0000'><font face='Angsana New'>$arr[ptright]</td>&nbsp;</tr> </div>");
		}
		
	//	print "<hr>";
	}
	
///////////////////////////

$query="CREATE TEMPORARY TABLE opacc1 SELECT * FROM opacc WHERE date  LIKE '$start_date%' and credit  not in ('¡��ԡ','�Թʴ','����','�͹�ç��Һ��')" ;
//echo $query."<br>";
    $result = mysql_query($query) or die("Query failed,opday1");
	
	$chksql="Select * from opacc1";
	$chkquery= mysql_query($chksql) or die (mysql_error());
	$numrow11=mysql_num_rows($chkquery);
	$i=1;
	
	
	print "�բ����� ������ admit ���١�͹�������� ��Һѭ�ռ������  <BR>";
		while($arr=mysql_fetch_array($chkquery)){
			
			$sql2="Select * from  ipcard  Where   hn ='".$arr['hn']."' and date like '$start_date%'";
			//echo $sql2;
			$query2= mysql_query($sql2) or die (mysql_error());
			$numrow2=mysql_num_rows($query2);
			
			
			if($numrow2){
		//	print "�բ����� ������ admit ���١�͹�������� ��Һѭ�ռ������  <BR>";	
				?>
    <!-- <script>
		alert('�բ����� ������ admit ���١�͹���������ѹ���');
	</script>-->
                <?
				
				while($arr2=mysql_fetch_array($query2)){
					
   			print (" <div style=background-color:#C33><tr>\n".
		  "  <td><font face='Angsana New'>$arr2[an]</td>\n&nbsp;".
		   "  <td><font face='Angsana New'>$arr2[hn]</td>\n&nbsp;".
           "  <td><font face='Angsana New'>$arr[ptname]</td>\n&nbsp;".
		   "  <td><font face='Angsana New'>$arr[detail]</td>\n&nbsp;".
		    "  <td><font face='Angsana New'>$arr[depart]</td>\n&nbsp;".
			"  <td><font face='Angsana New'>$arr[price]</td>\n&nbsp;".
			"  <td><font face='Angsana New'>$arr[ptright]</td>\n&nbsp;".
			"  <td><font face='Angsana New'>( $arr[credit] )</td>\n&nbsp;".
           "  <td><font face='Angsana New'>(vn : $arr[vn] )</td>&nbsp;</tr></div>");
  
				$i++;
				}
					//print "<hr>";	
	}
	
}		 
?>
��ª��� �����·���ѧ���������Թ�����͹�������������к�<BR>

<TABLE width='100%' border="1" cellpadding="0" cellspacing="0" bordercolor="#CC3333">
<TR align="center" bgcolor=6495ED>
	<TD colspan='11' bgcolor="#FFCC99"><B>�Ǫ�ѳ�� PT</B></TD>
</TR>
<TR align="center" bgcolor=6495ED>
	<TD bgcolor="#FFCC99">VN</TD>
	<TD bgcolor="#FFCC99">����</TD>
	<TD bgcolor="#FFCC99">HN</TD>
    <TD bgcolor="#FFCC99">AN</TD>
	<TD bgcolor="#FFCC99">����-ʡ��</TD>
	<TD bgcolor="#FFCC99">�Է���</TD>
	<TD bgcolor="#FFCC99"><font size='1'>�ӹǹ�Թ</font></TD>
	<TD bgcolor="#FFCC99">��ǹ�Թ</TD>
	<TD bgcolor="#FFCC99"><font size='2'>���˹�ҷ��</font></TD>
	<TD bgcolor="#FFCC99"><font size='2'>�͡OPCARD��</font></TD>
    <TD bgcolor="#FFCC99"><font size='2'>�Ѵ������</font></TD>
</TR>
<?php 
$null='NULL';
$mon = array('','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');

	$sql = "Select tvn, hn, ptname, ptright, price,an,date,idname,nessdn,dpn,dsn From dphardep_pt where date like '$yr-$m-$d%' AND  (cashok = '' OR cashok is Null ) AND (an is Null OR an = '') AND `borrow` is NULL AND price > 0  ORDER BY ptright,date ";
	$nows = date("H.i");
	$result  = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		
		$dapp = "select * from appoint where hn='".$arr["hn"]."' and appdate = '".$d." ".$mon[$m+0]." ".$yr."' ";
		$result2  = Mysql_Query($dapp);
		$arr2 = Mysql_fetch_assoc($result2);
		
		
		$datearr = explode(" ",$arr["date"]);
		$datearr2 = explode(":",$datearr[1]);
		$times = $datearr2[0].".".$datearr2[1];
		$more =((24-$times)+$nows+(1-2)*24);
		if($arr["price"]<='0'){$color="#FF6699";}
		else{$color="66CDAA";};
		if($more>=2){$color="#FF7979";}
		
		$sqlf = "select toborow,an from opday where hn='".$arr['hn']."' and thidate like '$yr-$m-$d%' ";
		list($toborow,$Tan) = mysql_fetch_array(mysql_query($sqlf));
		
		
		$nprice=$arr['nessdn']+$arr['dpn']+$arr['dsn'];
?>
<TR BGCOLOR=66CDAA>
	<TD BGCOLOR="<?php echo $color ?>"><a href="opcashvn.php?a=<?=$d?>&b=<?=$m?>&c=<?=$yr?>&vn=<?=$arr["tvn"]?>" ><?php echo $arr["tvn"];?></a></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php $date1=substr($arr["date"],10,10);echo $date1;?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["hn"];?></TD>
    <TD BGCOLOR="<?php echo $color ?>"><?=$Tan?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptright"];?></TD>
	<TD align="right" BGCOLOR="<?php echo $color ?>" ><?php echo number_format($arr["price"],2);?></TD>
	<TD align="right" <? if($nprice){ echo "BGCOLOR='#CC0033'"; }else{ echo "BGCOLOR='$color'";}?>><?php echo number_format($nprice,2) ;?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><font size='1'><?php echo $arr["idname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><font size='1'><?php echo $toborow?></TD>
    <TD BGCOLOR="<?php echo $color ?>"  ><font size='1'><?=$arr2['detail']?></TD>
</TR>
<?php }?>
</TABLE>

<TABLE width='100%'>
<TR align="center" bgcolor=6495ED>
	<TD colspan='11'><B>�Ǫ�ѳ��</B></TD>
</TR>
<TR align="center" bgcolor=6495ED>
	<TD bgcolor="6495ED">VN</TD>
	<TD bgcolor="6495ED">����</TD>
	<TD bgcolor="6495ED">HN</TD>
    <TD bgcolor="6495ED">AN</TD>
	<TD bgcolor="6495ED">����-ʡ��</TD>
	<TD bgcolor="6495ED">�Է���</TD>
	<TD bgcolor="6495ED"><font size='1'>�ӹǹ�Թ</font></TD>
	<TD>��ǹ�Թ</TD>
	<TD bgcolor="6495ED"><font size='2'>���˹�ҷ��</font></TD>
	<TD bgcolor="6495ED"><font size='2'>�͡OPCARD��</font></TD>
    <TD bgcolor="6495ED"><font size='2'>�Ѵ������</font></TD>
</TR>
<?php 
$null='NULL';
$mon = array('','���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�');

	$sql = "Select tvn, hn, ptname, ptright, price,an,date,idname,nessdn,dpn,dsn From phardep where date like '$yr-$m-$d%' AND  (cashok = '' OR cashok is Null ) AND (an is Null OR an = '') AND `borrow` is NULL AND price > 0  ORDER BY ptright,date ";
	$nows = date("H.i");
	$result  = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		
		$dapp = "select * from appoint where hn='".$arr["hn"]."' and appdate = '".$d." ".$mon[$m+0]." ".$yr."' ";
		$result2  = Mysql_Query($dapp);
		$arr2 = Mysql_fetch_assoc($result2);
		
		
		$datearr = explode(" ",$arr["date"]);
		$datearr2 = explode(":",$datearr[1]);
		$times = $datearr2[0].".".$datearr2[1];
		$more =((24-$times)+$nows+(1-2)*24);
		if($arr["price"]<='0'){$color="#FF6699";}
		else{$color="66CDAA";};
		if($more>=2){$color="#FF7979";}
		
		$sqlf = "select toborow,an from opday where hn='".$arr['hn']."' and thidate like '$yr-$m-$d%' ";
		list($toborow,$Tan) = mysql_fetch_array(mysql_query($sqlf));
		
		
		$nprice=$arr['nessdn']+$arr['dpn']+$arr['dsn'];
?>
<TR BGCOLOR=66CDAA>
	<TD BGCOLOR="<?php echo $color ?>"><a href="opcashvn.php?a=<?=$d?>&b=<?=$m?>&c=<?=$yr?>&vn=<?=$arr["tvn"]?>" ><?php echo $arr["tvn"];?></a></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php $date1=substr($arr["date"],10,10);echo $date1;?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["hn"];?></TD>
    <TD BGCOLOR="<?php echo $color ?>"><?=$Tan?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptright"];?></TD>
	<TD align="right" BGCOLOR="<?php echo $color ?>" ><?php echo number_format($arr["price"],2);?></TD>
	<TD align="right" <? if($nprice){ echo "BGCOLOR='#CC0033'"; }else{ echo "BGCOLOR='$color'";}?>><?php echo number_format($nprice,2) ;?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><font size='1'><?php echo $arr["idname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><font size='1'><?php echo $toborow?></TD>
    <TD BGCOLOR="<?php echo $color ?>"  ><font size='1'><?=$arr2['detail']?></TD>
</TR>
<?php }?>
</TABLE>


<TABLE  width='100%'>
<TR align="center" bgcolor=6495ED>
	<TD colspan='12'><B>�ѵ����</B></TD>
</TR>
<TR align="center" bgcolor=6495ED>
	<TD bgcolor="6495ED">VN</TD>
	<TD bgcolor="6495ED">����</TD>
	<TD bgcolor="6495ED">HN</TD>
    <TD bgcolor="6495ED">AN</TD>
	<TD bgcolor="6495ED">����-ʡ��</TD>
	<TD bgcolor="6495ED">�Է���</TD>
	<TD bgcolor="6495ED"><font size='1'>�ӹǹ�Թ</font></TD>
	<TD>��ǹ�Թ</TD>
	<TD bgcolor="6495ED">Ἱ�</TD>
	<TD bgcolor="6495ED">���˹�ҷ��</TD>
	<TD bgcolor="6495ED"><font size='1'>�͡ OPCARD</font></TD>
    <TD bgcolor="6495ED"><font size='2'>�Ѵ������</font></TD>
</TR>
<?php 
	$sql = "Select tvn, hn, ptname, ptright, price,an,date,depart,idname,sumnprice From depart  where date like '$yr-$m-$d%' AND    (cashok = '' OR cashok is Null ) AND (an = '' OR an is Null) AND `status` = 'Y' AND price > 0 ORDER BY ptright,date ";
	//echo $sql;
	$result  = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		
		$dapp = "select * from appoint where hn='".$arr["hn"]."' and appdate = '".$d." ".$mon[$m+0]." ".$yr."' ";
		$result2  = Mysql_Query($dapp);
		$arr2 = Mysql_fetch_assoc($result2);
		
		
		$datearr = explode(" ",$arr["date"]);
		$datearr2 = explode(":",$datearr[1]);
		$times = $datearr2[0].".".$datearr2[1];
		$more =((24-$times)+$nows+(1-2)*24);
		if($arr["price"]<='0'){$color="#CC3366";}
		else{$color="66CDAA";};
		if($more>=2){
			if($arr["depart"]=="HEMO"){
				$color="#FFFF66";
			}else{
				$color="#FFCACA";
				}
		}
		$sqlf = "select toborow,an from opday where hn='".$arr['hn']."' and thidate like '$yr-$m-$d%' ";
		list($toborow,$Tan) = mysql_fetch_array(mysql_query($sqlf));
$toborow=substr($toborow,0,20);
?>
<TR BGCOLOR=66CDAA >
	<TD BGCOLOR="<?php echo $color ?>"><font size='3'><a href="opcashvn.php?a=<?=$d?>&b=<?=$m?>&c=<?=$yr?>&vn=<?=$arr["tvn"]?>" ><?php echo $arr["tvn"];?></a></TD>
		<TD BGCOLOR="<?php echo $color ?>"><font size='3'><?php $date1=substr($arr["date"],10,10);echo $date1;?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><font size='3'><?php echo $arr["hn"];?></TD>
    <TD BGCOLOR="<?php echo $color ?>"><font size='2'><?=$Tan?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><font size='3'><?php echo $arr["ptname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><font size='3'><?php echo $arr["ptright"];?></TD>
	<TD  align="right" BGCOLOR="<?php echo $color ?>"><?php echo number_format($arr["price"],2);?></TD>
	<TD  align="right" <? if($arr['sumnprice']!='0.00'){ echo "BGCOLOR='#CC0033'"; }else{ echo "BGCOLOR='$color'";}?>><?=number_format($arr['sumnprice'],2);?></TD>
		<TD BGCOLOR="<?php echo $color ?>"><font size='2'><?php echo $arr["depart"];?></TD>
			<TD BGCOLOR="<?php echo $color ?>"><font size='1'><?php  echo $arr["idname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"  ><font size='1'><?=$toborow?></TD>
    <TD BGCOLOR="<?php echo $color ?>"  ><font size='1'><?=$arr2['detail']?></TD>
</TR>
<?php }?>
</TABLE>
</TABLE>
