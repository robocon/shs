<? 
	session_start();
?>
<title>��Ǩ�ͺ�����š�èͧ</title>
<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}

</style>
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td colspan="2"  align="center" bgcolor="#CCCCCC" class="forntsarabun">��Ǩ�ͺ�����š�èͧ��§</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right" class="forntsarabun">�ѹ���</td>
    <td ><select name="d_start">
	<?
	$d=date("d");
	for($i=1;$i<=31;$i++){
		if($i<=9){
			$i="0".$i;		
		}else{
			$i=$i;
		}
		if($i==$d){
		echo "<option value='$i' selected='selected'>$i</option>";
		}else{
		echo "<option value='$i' >$i</option>";
		}
	}
	
	?>
	</select>
	<? $m=date('m'); ?>
      <select name="m_start" >
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
				echo "<select name='y_start' >";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;<a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>&nbsp;&nbsp;
      </td>
  </tr>
</table>
</form>
<br />

<?
if($_POST['submit']){

	include("../Connections/connect.inc.php"); 
	
	$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
	
	/////////////////////////
	$sessiondate=$_POST['d_start'].'/'.$_POST['m_start'].'/'.$_POST['y_start'];
	$_SESSION['sessiondate']=$sessiondate;
	////////////////
	switch($_POST['m_start']){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}
	if($_POST['d_start']==''){
		$day="��͹";
	 	$dateshow=$printmonth." ".$_POST['y_start'];
	}else{
	 	$day="�ѹ���";
	 	$dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
	}
	

	if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
		$where1 = "and ward='�ͼ��������' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
		$where1 = "and ward='�ͼ������ٵԹ��' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
		$where1 = "and ward='�ͼ�����˹ѡ(icu)' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
		$where1 = "and ward='�ͼ����¾����' ";
	}
	
	$sql="SELECT * FROM  booking  WHERE  date_in  like '".$date1."%' $where1";
    $query = mysql_query($sql)or die (mysql_error()); 
	$row=mysql_num_rows($query);
	//echo $sql;
	
	
	$i=1;
	if($row){
		echo "<div class=\"forntsarabun\">�����š�èͧ��§ $day : $dateshow      </div>";
		
		
		echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>�ӴѺ</td>
    <td>�/�/� ���ͧ</td>
    <td>����-ʡ��</td>
    <td>HN</td>
    <td>ᾷ��</td>
    <td>��§/��ͧ</td>
    <td>�ͼ�����</td>
    <td>�/�/� �Ѻ����</td>
	<td>ʶҹ�</td>
	<td>͹��ѵ�</td>
	<td>���͹��ѵ�</td>
  </tr>";
	  while($dbarr=mysql_fetch_array($query)){
		  if($dbarr['status']==""){
			  $status1= "�͡�õͺ�Ѻ";
			  $color="";
		  }else if($dbarr['status']=="�Ѻ��Һ"){
			  $status1=$dbarr['status'];
			  $color="#FFFF99";//����ͧ
		  }else if($dbarr['status']=="͹��ѵ�"){
			  $status1=$dbarr['status'];
			  $color="#84BC30";//����
		  }else if($dbarr['status']=="���͹��ѵ�"){
			  $status1=$dbarr['status'];
			  $color= "#FF9393";//ᴧ
		  }else{
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//ᴧ
		  }
		  	$date_regis = substr($dbarr['date_regis'],8,2)."-".substr($dbarr['date_regis'],5,2)."-".substr($dbarr['date_regis'],0,4);
	  		$date_in = substr($dbarr['date_in'],8,2)."-".substr($dbarr['date_in'],5,2)."-".substr($dbarr['date_in'],0,4);
		echo "<tr bgcolor='$color'>
			<td align='center'>$i</td>
			<td>$date_regis</td>
			<td>$dbarr[ptname]</td>
			<td>$dbarr[hn]</td>
			<td>$dbarr[doctor]</td>
			<td>$dbarr[bed]</td>
			<td>$dbarr[ward]</td>
			<td>$date_in</td>
			<td>$status1</td>";
			if($dbarr['status']=="�Ѻ��Һ"){
			?>
				<td><a href='booking_ok.php?row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
				<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
            <?
			}
			elseif($dbarr['status']==""){
			?>
				<td><a href='booking_ok.php?row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
				<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
            <?
			}elseif($dbarr['status']=="͹��ѵ�"){
				echo "<td colspan='2'>�����Ţ��§ :$dbarr[comment]</td>";
			}
		echo  "</tr>";
		$i++;
	  }// �Դ while
	echo "</table>";
	
	}else{
		echo "<font class='forntsarabun'>��辺��èͧ��§   $dateshow </font><br>";
		//echo "<a href='booking.php' class='forntsarabun'>�ͧ��§�������</a><hr />";	
	}
	echo "<hr>";
}// �Դ$_POST['submit']

mysql_close();
?>
<br />
<?	
/////////////////////////��èͧ��§�ѹ���///////////////////////////

include("../Connections/connect.inc.php"); 

	if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
		$where1 = "and ward='�ͼ��������' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
		$where1 = "and ward='�ͼ������ٵԹ��' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
		$where1 = "and ward='�ͼ�����˹ѡ(icu)' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
		$where1 = "and ward='�ͼ����¾����' ";
	}
$todayy1=date("Y")+543;
$todaym1=date("m");
$todayd1=date("d");


$today5=$todayy1.'-'.$todaym1.'-'.$todayd1;

	switch($todaym1){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}

	 $day="�ѹ���";
	 $dateshow5=$todayd1.' '.$printmonth." ".$todayy1;
	 

	$sql="SELECT * FROM  booking  WHERE  date_regis  like '".$today5."%' $where1";
    $query = mysql_query($sql); 
	$row=mysql_num_rows($query);
	
	
	$i=1;
	if($row){
		echo "<div class=\"forntsarabun\">�����š�èͧ��§ $day : $dateshow5      </div>";
		
		
		echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>�ӴѺ</td>
    <td>�/�/� ���ͧ</td>
    <td>����-ʡ��</td>
    <td>HN</td>
    <td>ᾷ��</td>
    <td>��§/��ͧ</td>
    <td>�ͼ�����</td>
    <td>�/�/� �Ѻ����</td>
	<td>ʶҹ�</td>
	<td>͹��ѵ�</td>
	<td>���͹��ѵ�</td>
  </tr>";
	  while($dbarr=mysql_fetch_array($query)){
		  if($dbarr['status']==""){
			  $status1= "�͡�õͺ�Ѻ";
			  $color="";
		  }else if($dbarr['status']=="�Ѻ��Һ"){
			  $status1=$dbarr['status'];
			  $color="#FFFF99";//����ͧ
		  }else if($dbarr['status']=="͹��ѵ�"){
			  $status1=$dbarr['status'];
			  $color="#84BC30";//����
		  }else if($dbarr['status']=="���͹��ѵ�"){
			  $status1=$dbarr['status'];
			  $color= "#FF9393";//ᴧ
		  }else{
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//ᴧ
		  }
		  	$date_regis = substr($dbarr['date_regis'],8,2)."-".substr($dbarr['date_regis'],5,2)."-".substr($dbarr['date_regis'],0,4);
	  		$date_in = substr($dbarr['date_in'],8,2)."-".substr($dbarr['date_in'],5,2)."-".substr($dbarr['date_in'],0,4);
		echo "<tr bgcolor='$color'>
			<td align='center'>$i</td>
			<td>$date_regis</td>
			<td>$dbarr[ptname]</td>
			<td>$dbarr[hn]</td>
			<td>$dbarr[doctor]</td>
			<td>$dbarr[bed]</td>
			<td>$dbarr[ward]</td>
			<td>$date_in</td>
			<td>$status1</td>";
			if($dbarr['status']=="�Ѻ��Һ"){
			?>
				<td><a href='booking_ok.php?row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
				<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
            <?
			}
			elseif($dbarr['status']==""){
			?>
				<td><a href='booking_ok.php?row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
				<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
            <?
			}elseif($dbarr['status']=="͹��ѵ�"){
				echo "<td colspan='2'>�����Ţ��§ :$dbarr[comment]</td>";
			}
		echo  "</tr>";
		$i++;
	  }// �Դ while
	echo "</table>";
	
	}else{
		echo "<font class='forntsarabun'>��辺��èͧ��§ : $dateshow5 </font><br>";
		//echo "<a href='booking.php' class='forntsarabun'>�ͧ��§�������</a><hr />";	
	}
echo "<hr>";
mysql_close();
//////////////////////////////////�ͧ��§�ѹ���/////////////////////////////////
?>
<br />
<?


include("../Connections/connect.inc.php"); 

//*******��§�ͧ�ѹ���**********//
$todayy=date("Y")+543;
$todayd=date("d");
$todaym=date("m");

$today=$todayy.'-'.$todaym.'-'.$todayd;


	switch($todaym){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}

	 $day="�ѹ���";
	 $show_today=$todayd.' '.$printmonth.' '.$todayy;
	 
	if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
		$where1 = "and ward='�ͼ��������' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
		$where1 = "and ward='�ͼ������ٵԹ��' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
		$where1 = "and ward='�ͼ�����˹ѡ(icu)' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
		$where1 = "and ward='�ͼ����¾����' ";
	}
	
	$sql1="SELECT * FROM  booking  WHERE  date_in  like '".$today."%' $where1";
    $query1 = mysql_query($sql1); 
	$row1=mysql_num_rows($query1);
	$i=1;
	
	if($row1){
		echo "<div class=\"forntsarabun\">��§�ͧ�ѹ��� : $show_today</div>";
		
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>�ӴѺ</td>
    <td>�/�/� ���ͧ</td>
    <td>����-ʡ��</td>
    <td>HN</td>
    <td>ᾷ��</td>
    <td>��§/��ͧ</td>
    <td>�ͼ�����</td>
    <td>�/�/� �Ѻ����</td>
	<td>ʶҹ�</td>
	<td>͹��ѵ�</td>
	<td>���͹��ѵ�</td>
  </tr>";
  while($dbarr1=mysql_fetch_array($query1)){
	  
	  if($dbarr1['status']==""){
		  $status2= "�͡�õͺ�Ѻ";
		  $color="";
	  }else if($dbarr1['status']=="�Ѻ��Һ"){
		  $status2=$dbarr1['status'];
		  $color="#FFFF99";//����ͧ
	  }else if($dbarr1['status']=="͹��ѵ�"){
		  $status2=$dbarr1['status'];
		  $color="#84BC30";//����
	  }else if($dbarr1['status']=="���͹��ѵ�"){
		  $status2=$dbarr1['status'];
		  $color= "#FF9393";//ᴧ
	  }else{
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//ᴧ
		  }
	  $date_regis1 = substr($dbarr1['date_regis'],8,2)."-".substr($dbarr1['date_regis'],5,2)."-".substr($dbarr1['date_regis'],0,4);
	  $date_in1 = substr($dbarr1['date_in'],8,2)."-".substr($dbarr1['date_in'],5,2)."-".substr($dbarr1['date_in'],0,4);
echo"  <tr bgcolor='$color'>
    <td align='center'>$i</td>
    <td>$date_regis1</td>
    <td>$dbarr1[ptname]</td>
    <td>$dbarr1[hn]</td>
    <td>$dbarr1[doctor]</td>
    <td>$dbarr1[bed]</td>
    <td>$dbarr1[ward]</td>
    <td>$date_in1</td>
	<td>$status2</td>";
	if($dbarr1['status']=="�Ѻ��Һ"){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
		<?
	}
	elseif($dbarr1['status']==""){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
		<?
        }elseif($dbarr1['status']=="���͹��ѵ�"){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
		<?
	}elseif($dbarr1['status']=="͹��ѵ�"){
		echo "<td>�����Ţ��§ :$dbarr1[comment]</td>";
		?>
	<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
		<?
	}
	echo  "</tr>";
  	$i++;
    }// �Դ while
echo "</table>";

  }else{
	echo "<font class='forntsarabun'>��辺��§�ͧ�ѹ��� : $show_today</font><br>";
	}
echo "<hr>";
echo "<br>";	
//*******�ͧ��§�ѹ���**********//

//*******�ͧ��§���觹��**********//

$todayy1=date("Y")+543;
$todaym1=date("m");
$todayd1=date("d")+1;

if($todayd1<=9){
	$todayd1="0".$todayd1;		
}else{
	$todayd1=$todayd1;
}

$today1=$todayy1.'-'.$todaym1.'-'.$todayd1;


	switch($todaym1){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}
	$show_today2=$todayd1.' '.$printmonth.' '.$todayy1;
	
	$sql2="SELECT * FROM  booking  WHERE  date_in  like '".$today1."%' $where1";
    $query2 = mysql_query($sql2); 
	$row2=mysql_num_rows($query2);
	$ii=1;
	
	
	
	if($row2){
	echo "<div class=\"forntsarabun\">��§�ͧ���觹�� : $show_today2</div>";
	
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>�ӴѺ</td>
    <td>�/�/� ���ͧ</td>
    <td>����-ʡ��</td>
    <td>HN</td>
    <td>ᾷ��</td>
    <td>��§/��ͧ</td>
    <td>�ͼ�����</td>
    <td>�/�/� �Ѻ����</td>
	<td>ʶҹ�</td>
	<td>͹��ѵ�</td>
	<td>���͹��ѵ�</td>
  </tr>";
  while($dbarr2=mysql_fetch_array($query2)){
	  
	  if($dbarr2['status']==""){
		  $status3= "�͡�õͺ�Ѻ";
		  $color="";
	  }else if($dbarr2['status']=="�Ѻ��Һ"){
		  $status3=$dbarr2['status'];
		  $color="#FFFF99";//����ͧ
	  }else if($dbarr2['status']=="͹��ѵ�"){
		  $status3=$dbarr2['status'];
		  $color="#84BC30";//����
	  }else if($dbarr2['status']=="���͹��ѵ�"){
		  $status3=$dbarr2['status'];
		  $color= "#FF9393";//ᴧ
	  }else{
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//ᴧ
		  }
	  $date_regis2 = substr($dbarr2['date_regis'],8,2)."-".substr($dbarr2['date_regis'],5,2)."-".substr($dbarr2['date_regis'],0,4);
	  $date_in2 = substr($dbarr2['date_in'],8,2)."-".substr($dbarr2['date_in'],5,2)."-".substr($dbarr2['date_in'],0,4);
echo"  <tr bgcolor='$color'>
    <td align='center'>$ii</td>
    <td>$date_regis2</td>
    <td>$dbarr2[ptname]</td>
    <td>$dbarr2[hn]</td>
    <td>$dbarr2[doctor]</td>
    <td>$dbarr2[bed]</td>
    <td>$dbarr2[ward]</td>
    <td>$date_in2</td>
	<td>$status3</td>";
	if($dbarr2['status']=="�Ѻ��Һ"){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
		<?
	}elseif($dbarr2['status']==""){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
		<?
	}elseif($dbarr2['status']=="���͹��ѵ�"){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>'>͹��ѵ�</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
		<?
	}elseif($dbarr2['status']=="͹��ѵ�"){
		echo "<td >�����Ţ��§ :$dbarr2[comment]</td>";
		?>
	<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("���͹��ѵԡ�èͧ��§?")'>���͹��ѵ�</a></td>
		<?
	}
	echo  "</tr>";
  	$ii++;
    }// �Դ while
echo "</table>
";

  }else{
	echo "<font class='forntsarabun'>��辺��§�ͧ���觹�� : $show_today2</font><br>";
	}
echo "<hr>";
echo "<br>";	
//*******�ͧ��§���觹��**********//

if(isset($_GET['confirm'])){
	if($_GET['confirm']=="0"){
		$sql = "update booking set status='���͹��ѵ�' ,officer_con='".$_SESSION['sOfficer']."' where row_id= '".$_GET['row_id']."'  ";
		mysql_query($sql);
		?>
		<script>
        	window.location.href="booking_confirm.php?code=<?=$_GET['code']?>";
        </script>
		<?
	}
}

mysql_close();
?>