<?php
    $yym=$_GET['yym'];
    print "<center><font face='TH Sarabun New' size='+2'><b>��ش����ѹ����</b></center>";
	$year=substr($yym,0,4);
	$showyear=$year+543;
	
function showmonth($mm){
	$month_name=array("01"=>"�.�.", "02"=>"�.�.", "03"=>"��.�.", "04"=>"��.�.", "05"=>"�.�.", "06"=>"��.�.", "07"=>"�.�.", "08"=>"�.�.", "09"=>"�.�.", "10"=>"�.�.", "11"=>"�.�.", "12"=>"�.�.");
	$month=$month_name[$mm];
	return $month;
}
?>
<div align="right" style="font-size:12px;">�.�.2</div>
<table width="100%" border="1"  style="border-collapse:collapse;" cellpadding="0" cellspacing="0" bordercolor="#000000">
 <tr>
  <td width="6%" rowspan="2" align="center" >�ӴѺ</td>
  <td colspan="3" align="center"><font face='TH Sarabun New'>�.�. <?=$showyear;?></td>
  <td width="14%" rowspan="2" align="center"><font face='TH Sarabun New'>�Ţ�����觢ͧ</td>
  <td width="11%" rowspan="2" align="center"><font face='TH Sarabun New'>����ѷ</td>
  <td width="16%" rowspan="2" align="center" ><font face='TH Sarabun New'>�ѭ���������˹��</td>
  <td colspan="2" rowspan="2" align="center" ><font face='TH Sarabun New'>�ӹǹ</td>
  <td width="12%" rowspan="2" align="center" ><font face='TH Sarabun New'>�Ҥ�/pack</td>
  <td width="9%" rowspan="2" align="center"><font face='TH Sarabun New'>�Թ���</td>
  </tr>
 <tr>
   <td width="7%" align="center" ><font face='TH Sarabun New'>��͹</td>
   <td width="6%" align="center" >�ѹ���</td>
   <td width="11%" align="center" ><font face='TH Sarabun New'>�Ţ������觫���</td>
  </tr>
<?php
if(!empty($yym)){
    include("connect.inc");
	 
    $query = "SELECT stkno,docno,getdate,date,billno,comname FROM combill WHERE (date LIKE '$yym%') group by docno ORDER BY getdate,date";  // Query ��Ң������������ʴ� ��ШѴ���§������Ẻ�˹
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    $netprice=0;
    while (list ($stkno,$docno,$getdate,$billdate,$billno,$comname) = mysql_fetch_row ($result)) {
	$num++;
	    $netprice = $netprice+$price;
		$query2 = "SELECT stkno,docno,getdate,date,billno,comname,drugcode,tradname,lotno,packamt,packing,packpri,price,stkbak,packamt FROM combill WHERE docno='$docno' and date LIKE '$yym%' ";
		$result2 = mysql_query($query2) or die("Query failed");
		$nrow = mysql_num_rows($result2);
		
		$subdoc = substr($docno,0,2);
		$subdoc1 = substr($docno,2);
		//echo $subdoc1."<br>";
		if($subdoc!="DD"){
			$subdoc1 =$docno;
		}	
		
		$query3 = "SELECT pono, right(pono,3) as numpono FROM pocompany WHERE prepono='$subdoc1'";  
		//echo $query3."<br>";
		$result3 = mysql_query($query3) or die("Query failed");
		list($pono,$numpono) = mysql_fetch_row ($result3);
		
		$dbilldate = substr($billdate,8,2);
		$mbilldate = substr($billdate,5,2);
		$newmonth=showmonth($mbilldate);
		$ybilldate = substr($billdate,0,4);
		
		if($pono !="" || $pono != 0){
        print (" <tr>\n".		
           "  <td rowspan='$nrow' valign='top' align='center'><font face='TH Sarabun New'>$num</td>\n".
		   "  <td rowspan='$nrow' valign='top'  align='center'><font face='TH Sarabun New' >$newmonth</td>\n".
           "  <td rowspan='$nrow' valign='top' align='center'><font face='TH Sarabun New'>$dbilldate</td>\n".
 "  <td rowspan='$nrow' valign='top'  align='center'><font face='TH Sarabun New' >$pono</td>\n".		   
           "  <td rowspan='$nrow' valign='top'><font face='TH Sarabun New'>$billno</td>\n".
		   "  <td rowspan='$nrow' valign='top'><font face='TH Sarabun New'>$comname</td>\n");		   
		}else{
        print (" <tr>\n".		
           "  <td rowspan='$nrow' valign='top' align='center'><font face='TH Sarabun New'>$num</td>\n".
		   "  <td rowspan='$nrow' valign='top'  align='center'><font face='TH Sarabun New' >$newmonth</td>\n".
           "  <td rowspan='$nrow' valign='top' align='center'><font face='TH Sarabun New'>$dbilldate</td>\n".
		   "  <td rowspan='$nrow' valign='top'  align='center'><font face='TH Sarabun New' >-</td>\n".		   
           "  <td rowspan='$nrow' valign='top'><font face='TH Sarabun New'>$billno</td>\n".
		   "  <td rowspan='$nrow' valign='top'><font face='TH Sarabun New'>$comname</td>\n");			
		}
		
		$d=0;
		while (list ($stkno,$docno,$getdate,$billdate,$billno,$comname,$drugcode,$tradname,$lotno,$packamt,$packing,$packpri,$price,$stkbak,$packamt) = mysql_fetch_row ($result2)) {
    	$d++;
        print (
           "  <td valign='top'><font face='TH Sarabun New'>$tradname</td>\n".
           "  <td align='right' valign='top'><font face='TH Sarabun New'>$packamt</td>\n".
           "  <td valign='top'><font face='TH Sarabun New'>$packing</td>\n".
           "  <td align='right' valign='top'><font face='TH Sarabun New'>$packpri</td>\n".
           "  <td align='right' valign='top'><font face='TH Sarabun New'>$price</td>\n".
           " </tr>\n");	
	/*	if(mysql_num_rows($result2)>1&&$d<mysql_num_rows($result2)){
			print (" <tr>\n".
           "  <td ><font face='TH Sarabun New'></td>\n");
		}*/
        }
	}
   include("unconnect.inc");
}
?>
</table>
