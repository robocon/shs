

<?php
session_start();

include("connect.inc");



$today=date("d-m-").(date("Y")+543);	
$today1=(date("Y")+543).date("-m-d");	
    $month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";




$refresh = "<meta http-equiv=\"refresh\" content=\"1;URL=".$_SERVER['PHP_SELF']."\">";
 if(isset($_POST["cTdatehn"])){

	 $cTdatehn = $today.$_POST["cTdatehn"];
    $cTdatehn1 =$_POST["cTdatehn"];

$sql = "Select pharin,kewphar,item,ptname,hn,tvn,pharout From dphardep WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%' limit 1 ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 0){
		list($pharin,$kewphar,$item,$ptname,$hn,$tvn,$pharout) = Mysql_fetch_row($result);


    if(empty($pharout)){

		$query ="update dphardep SET pharout ='".date("H:i:s")."' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
		$result = mysql_query($query) or die("Query failed,update thaywin");

	

$today=date("d-m-").(date("Y")+543);	
$todaytime=date("H:i:s");	

$starttime = $pharin;
	$lasttime = $todaytime;
	if($lasttime!="" and $starttime!="" ){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}




//	echo "<body Onload='window.print();'>";
			echo "<font face='Angsana New' size='5'><center>������ <br></FONT>";
	      // echo "<font face='Angsana New' size='5'>�ç��Һ�Ť�������ѡ�������� �ӻҧ<br>";
	   	   echo " <font face='Angsana New' size='5'>$today&nbsp;&nbsp;$todaytime<br>"; 
	       echo "<font face='Angsana New' size='20'><b>���� &nbsp;$ptname <br> <font face='Angsana New' size='4'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
	   	   echo " <font face='Angsana New' size='20'>$kewphar<BR>";
		   echo " <font face='Angsana New' size='15'>**���������Ѻ��**";
		      echo " <font face='Angsana New' size='15'>$time3</center>";
			

$query11 = "INSERT INTO soundpha(kew,status,hn)VALUES('$kewphar','n','$hn');";
$result = mysql_query($query11) or die("Query failed,cannot insert into soundpha");


 

	   }else{


	$query ="update dphardep SET pharout1 ='".date("H:i:s")."' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
		$result = mysql_query($query) or die("Query failed,update thaywin");
  echo "<font face='Angsana New' size='6'><center><b>���� &nbsp;$ptname <br> <font face='Angsana New' size='5'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
		echo "<font face='Angsana New' size='15'><center>���Ѻ������º����<br>"; 
        echo "���� $pharout</center>"; 
		
		$query11 = "INSERT INTO soundpha(kew,status,hn)VALUES('$kewphar','n','$hn');";
$result = mysql_query($query11) or die("Query failed,cannot insert into soundpha");



}

	}else{
		echo "<font face='Angsana New' size='15'><center>����������Ţ�Ѻ�ҹ��</center>"; 
		echo "<embed src=''soundkewpha/001.wma' width='0' height='0' ></embed>";	

	}

	echo $refresh;
	exit();

}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>���ͺ</title>
    <script type="text/javascript" >
        function date_time(id) {
            date = new Date;
            year = date.getFullYear();
            month = date.getMonth();
            months = new Array('���Ҥ�', '����Ҿѹ��', '�չҤ�', '����¹', '����Ҥ�', '�Զع�¹', '�á�Ҥ�', '�ԧ�Ҥ�', '�ѹ��¹', '���Ҥ�', '��Ȩԡ�¹', '�ѹ�Ҥ�');
            d = date.getDate();
            day = date.getDay();
            days = new Array('�ҷԵ��', '�ѹ���', '�ѧ���', '�ظ', '����ʴ�', '�ء��', '�����');
            h = date.getHours();
            if (h < 10) {
                h = "0" + h;
            }
            m = date.getMinutes();
            if (m < 10) {
                m = "0" + m;
            }
            s = date.getSeconds();
            if (s < 10) {
                s = "0" + s;
            }
            result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + m + ':' + s;
            document.getElementById(id).innerHTML = result;
            setTimeout('date_time("' + id + '");', '1000');
            return true;
        }
      
    </script>
</head>
<body>   
           <span id="date_time" style="color: #000000; font-size: x-medium;"></span>
         <script type="text/javascript"> window.onload = date_time('date_time');</script>
  
 
</body>
</html>
<html>
<head>
<title>ŧ�����Ѻ�Ҵ���  HN ������</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="30;URL=<?php echo $_SERVER['PHP_SELF'];?>">
</head>
<body onLoad="document.getElementById('cTdatehn').focus();" onclick="document.getElementById('cTdatehn').focus();">
<?php

   // echo "�ѹ��� ".date("d")." ".$month[date("m")]." ".(date("Y")+543)." ";
//	echo " $today1";
    echo "<font size='3' color='#ff0000'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ŧ���Ҩ����Ҽ����´���  HN ������</font>&nbsp;&nbsp; <a target=bank  href='phas.php'>�Դ���§�ٴ</a> <a target=_self  href='../nindex.htm'>&lt;&lt;�����............</a> ";
    
$today=(date("Y")+543).date("-m-d");
$N='N';
$todaytime=date("H:i:s");	
?>

<FORM METHOD=POST ACTION="<?php echo $_SERVER['PHP_SELF'];?>">
	<TABLE>
		<TR>
			<TD>HN&nbsp;:&nbsp;</TD>
			<TD><INPUT ID="cTdatehn" TYPE="text" NAME="cTdatehn"></TD>
		</TR>
	</TABLE>
</FORM>
<?php
/*
function strtime($time){

		$subtime = explode(":",$time);
		$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));

	return  $rt;
}
*/




$tk='��';

    $query = "SELECT chktranx,date,ptname,hn,an,price,tvn,ptright,kew,pharout,doctor,pharin,pharout1,kewphar FROM dphardep WHERE date LIKE '$today1%' and pharout <> ''  and kewphar <> '' and stkcutdate <> '' and kewphar like '$tk%'  and dr_cancle 	is null order by pharout DESC  limit 3 ";

    $result = mysql_query($query) or die("Query failed1111");
	if(Mysql_num_rows($result) > 0){
		
		
		
?>
<table  align="center" style="font-family: Angsana New; font-size: 25px;">
 <tr>
	<th bgcolor="ffffff" colspan="9"  ><font size='8' color='#ff0000'><B><?php echo "��ª��ͷ����ѧ�����Ң�й��  ";?> </B></th>
  </tr>
 <tr>
 <th bgcolor="6495ED"><font size='4' >��Ƿ���/��ͺ����</th>	<th bgcolor="6495ED"><font size='4' >��Ƿ����</th>	
 
  </tr>
 
 
 
 
 

<?php

     $j=0;
	$countavg = 0;
    while (list ($chktranx,$date,$ptname,$hn,$an,$price,$tvn,$ptright,$kew,$pharout,$doctor,$pharin,$pharout1,$kewphar) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);

/*	if($pharout != ""){

$subtime = explode(":",$pharin);
$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));
$stringtime = strtime($pharout) - $rt;
if($stringtime > 600){
	$pharout = date("H:i:s",mktime($subtime[0],$subtime[1]+5,$subtime[2]+rand(1,60),date("m"),date("d"),date("Y")));
}
					$stringtime1 = strtime($pharin);
					$stringtime2 = strtime($pharout);
					$stringtime3 = $stringtime2-$stringtime1;
					$time3 = date("i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));
					$countavg = $countavg+$stringtime3;
					$j++;
				}else{
					$time3 = "";
				}
*/

$starttime = $pharin;
	$lasttime = $pharout;
	if($lasttime!=""and $starttime!=""){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}

        print (
					" <tr>\n".
					
		
			"  <td BGCOLOR=ffffff><font face='Angsana New' size ='20'><b>$kewphar</b></td>\n".
		"  <td BGCOLOR=fffffff><font face='Angsana New'  size ='20'><b>$kewphar</b></td>\n".	
			
										" </tr>\n");
       }
	
?>


</table>


<?php
	}



	
    include("unconnect.inc");
?>


</body>

</html>