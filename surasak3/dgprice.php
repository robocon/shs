<?php
    $Thaidate=date("d/m/").(date("Y")+543);
    print  "�Ҥ���/�Ǫ�ѳ����������� ����ػ�ó���ᾷ�� $Thaidate<br> ";
?>
<a target=_BLANK href="dgprigp.php">���Ǫ�ѳ�� ����ػ�ó���ᾷ�������</a>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">������ ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="drugcode" size="10"></font>
	&nbsp;&nbsp;���ͤ���&nbsp;&nbsp;
    <select name="part" class="txt">
      <option value="">�ҷ�����</option>
      <option value="e">�� ED</option>
      <option value="n">�� NED</option>
    </select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ��ŧ     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>
</form>
<?
if($part=="e"){
	$showised="�� ED";
}else if($part=="n"){
	$showised="�� NED";
}else{
	$showised="�ҷ�����";
}
?>
<div align="center" style="margin-top: 20px;"><strong>�������� ������<?=$showised;?></strong></div>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>    
  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
 </tr>

<?php
    include("connect.inc");
    //runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RX1D'";
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

    $dStartday=$row->startday;
	
	if(empty($drugcode)){
		if($part=="e"){
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE part = 'DDL' AND drug_active='y'";
		}else if($part=="n"){
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE (part = 'DDY' || part='DDN')  AND drug_active='y'";
		}else{
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE part LIKE 'DD%' AND drug_active='y'";
		}
	}else{
		if($part=="e"){
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE drugcode LIKE '$drugcode%' AND part = 'DDL' AND drug_active='y'";
		}else if($part=="n"){
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst WHERE drugcode LIKE '$drugcode%' AND (part = 'DDY' || part='DDN') AND drug_active='y'";
		}else{
			$query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE part LIKE 'DD%' AND drugcode LIKE '$drugcode%' AND drug_active='y'";
		}
	}
		  
	 //echo $query;
     $result = mysql_query($query)or die("Query failed");
//    print "�������Ǫ�ѳ������ػ�ó�<br> ";
    print "<font face='Angsana New'>DDL =   ��㹺ѭ������ѡ��觪ҵ� �ԡ��<br> ";
    print "<font face='Angsana New'>DDY =   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��<br> ";
    print "<font face='Angsana New'>DDN =   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����<br> ";

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
?>

</table>

 