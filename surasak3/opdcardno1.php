<?php

    $today="$d-$m-$yr";

    print "�ѹ��� $today  ��ª��ͤ����ҧ�׹�ѵ����§����ӴѺ���ҡ�͹��ѧ";

    print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";

    $today="$yr-$m-$d";

?>

<table>

 <tr>

  <th bgcolor=6495ED>#</th>

  <th bgcolor=6495ED>�ѹ - ����</th>

  <th bgcolor=6495ED>HN</th>

  <th bgcolor=6495ED>����</th>

  <th bgcolor=6495ED>AN</th>

  <th bgcolor=6495ED>�ä</th>

  <th bgcolor=6495ED>ᾷ��</th>

  <th bgcolor=6495ED><font face='Angsana New'>�׹OPD</th>

 
 <th bgcolor=6495ED><font face='Angsana New'>�͡��</th>

 
 <th bgcolor=6495ED><font face='Angsana New'>���</th>

 

 </tr>



<?php

    $detail="�����";

    include("connect.inc");

  

    $query = "SELECT vn,thdatehn, date_format(thidate, '%d/%m/%Y %H:%i:%s'),hn,ptname,an,diag,doctor,okopd,toborow,borow FROM opday WHERE okopd='N'and thidate LIKE '$today%' ";

    $result = mysql_query($query)

        or die("Query failed");


$opd = 0;
    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$doctor,$okopd,$toborow,$borow) = mysql_fetch_row ($result)) {

        //$time=substr($thidate,11);
	$num++;
		
		if(substr($toborow,0,4) == "EX15"){
			$bg="FFCC99";
		}else if(substr($toborow,0,4) == "EX12"){
			$bg="FFCC99";
		}else if(substr($toborow,0,4) == "EX19"){
			$bg="FFCC99";
		}else if(substr($toborow,0,5) == "EX 91"){
			$bg="FFCC99";
		}else if($toborow == "�͡ VN �� LAB"){
			$bg="FFCC99";
		}else{
			$bg="66CDAA";
			$opd++;
		}



        print (" <tr>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$num</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$thidate</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$hn</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'><a target=_BLANK  href=\"chkopd.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&cVn=$vn\">$ptname</a></td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$an</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$diag</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$doctor</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$okopd</td>\n".

      
  "  <td BGCOLOR=$bg><font face='Angsana New'>$toborow</td>\n".

   
  "  <td BGCOLOR=$bg><font face='Angsana New'>$borow</td>\n".

   
     " </tr>\n");

       }

    include("unconnect.inc");

?>
<tr>
	<td colspan="10" align="right">
		�ӹǹ OPDCard �٭��� : <?php echo $opd;?>
	</td>
</tr>
</table>