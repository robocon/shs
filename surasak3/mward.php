<?php
    session_start();
    if (isset($sIdname)){} else {die;}
?>
   �ͼ����ª�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='ipdcost.php'>����Թ�ء��§</a>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a target=_self  href="../nindex.htm">�����</a>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>��§</th>
 <th bgcolor=6495ED><font face='Angsana New'>ʶҹ�</th>
 <th bgcolor=6495ED><font face='Angsana New'>STICKER</th>
 <th bgcolor=6495ED><font face='Angsana New'>�ѹ�Ѻ����</th>
 <th bgcolor=6495ED><font face='Angsana New'>���ͼ�����</th>
  <th bgcolor=6495ED><font face='Angsana New'>AN</th>
<th bgcolor=6495ED><font face='Angsana New'>HN</th>
 <th bgcolor=6495ED><font face='Angsana New'>�ä</th>
 <th bgcolor=6495ED><font face='Angsana New'>�����</th>
 <th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>
 <th bgcolor=6495ED><font face='Angsana New'>�Է�ԡ���ѡ��</th>
 <th bgcolor=CD853F><font face='Angsana New'><b>����Թ</b></th>
 <th bgcolor=CD853F><font face='Angsana New'><b>����</b></th>
 <th bgcolor=CD853F><font face='Angsana New'><b>��ҧ����</b></th>
 <th bgcolor=CD853F><font face='Angsana New'><b>�ѹ���ӹǳ</b></th>
 <th bgcolor=6495ED><font face='Angsana New'>�����ͧ+�����</th>

 </tr>
<?php
    include("connect.inc");
 
    $query = "SELECT bed,date_format(date,'%d- %m- %Y'),ptname,an,hn,diagnos,food,
                    doctor,ptright,price,paid,debt,caldate,bedname,bedcode,hn,chgdate,status FROM bed WHERE bedcode LIKE '41%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$date,$ptname,$an,$hn,$diagnos,$food,$doctor,$ptright,$price,$paid,$debt,$caldate,$bedname,
                      $bedcode,$hn,$chgdate,$status) = mysql_fetch_row ($result)) {
		
	$status2 = substr($status,0,3);

		switch($status2){
			case "B01" : $color="#66CDAA"; break;
			case "B02" : $color="#FF9999"; break;
			case "B03" : $color="#FFFF99"; break;

		}

        print (" <tr>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a href=\"ipbed.php? cBed=$bed&cDate=$date&cPtname=$ptname
                     &cAn=$an&cDiagnos=$diagnos&cFood=$food&cDoctor=$doctor&cPtright=$ptright&cBedcode=$bedcode
                     &cHn=$hn&cChgdate=$chgdate & cbedname=�ͼ����ª�� \">$bed</a></td>\n".
  "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"bedstatus.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cstatus=$status\">$status</a></td>\n".

   "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipbed1.php? cAn=$an &cBed=$bed & cBedcode=$bedcode & cHn=$hn & cbedname=�ͼ����ª�� \">STICKER</a></td>\n".

           "  <td BGCOLOR=$color><font face='Angsana New'><font face='Angsana New'>$date</td>\n".
 
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipdata.php? cBedcode=$bedcode\">$ptname</a></td>\n".
            "  <td BGCOLOR=$color><font face='Angsana New'>$an</td>\n".
            "  <td BGCOLOR=$color><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipdiag.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDiag=$diagnos\">$diagnos</a></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipfood.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cFood=$food\">$food</a></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><a target=_blank  href=\"ipdr.php? cBedcode=$bedcode&cBed=$bed&cFulname=$ptname&cDoctor=$doctor\">$doctor</a></td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$ptright</td>\n".

		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$caldate</td>\n".

           "  <td BGCOLOR=$color><font face='Angsana New'>$bedname</td>\n".
		 
           " </tr>\n");
        }
		$bbbbcode= "41";
		include("calroom.php");
    	include("unconnect.inc");
?>
</table>

