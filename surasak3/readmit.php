  <form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;<font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="4"><b>
    ���͡ ��͹-�� ����ͧ��õ٢�����</b></font></font></p>
  <font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<? $m=date('m'); ?>
      <select name="month">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
        </select>

     <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  </form>

<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����-ʡ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>AN</th>
  <th bgcolor=6495ED><font face='Angsana New'>admit</th>
  <th bgcolor=6495ED><font face='Angsana New'>discharge</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ�͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ԹԨ����ä</th>
  <th bgcolor=6495ED><font face='Angsana New'>ICD10�ä��ѡ</th>
  <th bgcolor=6495ED><font face='Angsana New'>COMPLICATION</th>
  <th bgcolor=6495ED><font face='Angsana New'>D/C TYPE</th>
  <th bgcolor=6495ED><font face='Angsana New'>��������</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ͼ�����</th>
  <th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>
 </tr>
<?php
	/*
CREATE TABLE `ipcard` (
  `row_id` int(11) NOT NULL auto_increment,
  `date` datetime default NULL,
  `an` varchar(12) NOT NULL default '',
  `hn` varchar(12) NOT NULL default '',
  `ptname` varchar(40) default NULL,
  `age` varchar(24) default NULL,
  `ptright` varchar(40) default NULL,
  `goup` varchar(40) default NULL,
  `camp` varchar(32) default NULL,
  `bedcode` varchar(8) default NULL,
  `dcdate` datetime default NULL,
  `days` int(4) default NULL,
  `dcstatus` varchar(4) default NULL,
  `diag` varchar(56) default NULL,
  `icd10` varchar(20) default NULL,
  `comorbid` varchar(16) default NULL,
  `complica` varchar(16) default NULL,
  `other` varchar(20) default NULL,
  `extcause` varchar(32) default NULL,
  `icd9cm` varchar(20) default NULL,
  `second` varchar(16) default NULL,
  `result` varchar(16) default NULL,
  `dctype` varchar(20) default NULL,
  `doctor` varchar(48) default NULL,
  `price` double(12,2) default NULL,
  `paid` double(12,2) default NULL,
  `calc` datetime default NULL,
  `accno` int(4) default NULL,
  PRIMARY KEY  (`row_id`),
  UNIQUE KEY `an` (`an`),
  KEY `admnum` (`an`),
  KEY `dcdate` (`dcdate`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;
*/
If (!empty($month)){
   $yrmn=$year."-".$month;
   print"������㹷������ͧ��͹ $month/$year , �����·��admit �ҡ����˹�觤������͹��� �ٴ�ҹ��ҧ ";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipmonth SELECT ptname,hn,an,date,dcdate,days,diag,icd10,complica,dctype,price,bedcode,doctor  FROM ipcard WHERE date LIKE '$yrmn%' ORDER BY hn";
    $result = mysql_query($query) or die("Query failed,warphar"); 

   $query="SELECT * FROM ipmonth";
   $result = mysql_query($query);
     $n=0;
 while (list ($ptname,$hn,$an,$date,$dcdate,$days,$diag,$icd10,$complica,$dctype,$price,$bedcode,$doctor 
	) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
	           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$days</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"dxicd9lst.php? 				cHn=$hn&cAn=$an\">$icd10</a></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$complica</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dctype</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
               " </tr>\n");
               }
//    print "</table>";
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>�����˵�: �����ͼ�����  41=���  42=˭ԧ  43=�ٵ�-���  44=ICU  45=�����3</font></th>";
    print "</table>";

   print"<br><b>�����·��admit �ҡ����˹�觤������͹���</b><br>";
   $query="SELECT  ptname,hn,an, COUNT(*) AS duplicate FROM ipmonth GROUP BY hn HAVING duplicate > 1";
   $result = mysql_query($query);
     $n=0;
 while (list ($ptname,$hn,$an,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n,</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>HN: $hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>AN: $an</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ���駷��admit = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
print "<b>�����š��admit  �ٵ��ҧ��</b>";
  }
?>

