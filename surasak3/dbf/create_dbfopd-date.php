<?php
    include("../connect.inc");
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: AngsanaUPC;
	font-size:14px;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>���͡������ DBF</strong></font></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< �����</a>

<span class="font1">
<font face="Angsana New">
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <table width="563" border="0">
    <tr>
      <td width="33"><font face="Angsana New">�ѹ��� :</font></td>
      <td width="81"><label>
        <select name="day" id="day">
          <option value="00" selected="selected">--���͡--</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
      </label></td>
      <td width="26">��͹ :</td>
      <td width="94"> 
     <select name="mon">
           <option value="01" selected="selected">���Ҥ�</option>
           <option value="02">����Ҿѹ��</option>
           <option value="03">�չҤ�</option>
           <option value="04">����¹</option>
           <option value="05">����Ҥ�</option>
           <option value="06">�Զع�¹</option>
           <option value="07">�á�Ҥ�</option>
           <option value="08">�ԧ�Ҥ�</option>
           <option value="09">�ѹ��¹</option>
           <option value="10">���Ҥ�</option>
           <option value="11">��Ȩԡ�¹</option>
           <option value="12">�ѹ�Ҥ�</option>
       </select></td>
      <td width="118">�.�. : &nbsp;&nbsp;
		<?
        $Y=date("Y")+543;
        $date=date("Y")+543+5;
                      
        $dates=range(2547,$date);
        echo "<select name='year' class='forntsarabun'>";
        foreach($dates as $i){
        ?>
<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>>
            <?=$i;?>
            </option>
        <?
        }
        echo "<select>";
        ?>      </td>
      <td width="32" align="right"><font face="Angsana New">�Է�� :</font></td>
      <td width="99"><select name="credit" id="credit">
        <option value="OFC" selected="selected">���µç</option>
        <option value="SSS">��Сѹ�ѧ��</option>
        <option value="LGO">ͻ�</option>
      </select>      </td>
      <td width="46"><input name="BOK" value="��ŧ" type="submit" /></td>
    </tr>
  </table>
</form>
</font>
</span>
<?
if(isset($_POST['BOK'])){

$year = $_POST['year'];
$newyear = $year-543;
$yy = substr($newyear,2,2);
$mm =$_POST['mon'];
$day =$_POST['day'];

if($_POST['credit']=="OFC"){
	$newcredit = "���µç";
}else if($_POST['credit']=="SSS"){
	$newcredit = "��Сѹ�ѧ��";
}else if($_POST['credit']=="LGO"){
	$newcredit = "���µç ͻ�.";
}

//--------------------Start DataSet3-------------------------//
$dbname3 = "OPD".$yy.$mm.".dbf";
	$def3 = array(
	  array("HN","C",15),
	  array("CLINIC","C",4),
	  array("DATEOPD","D"),
	  array("TIMEOPD","C",4),
	  array("SEQ","C",15),
	  array("UUC","C",1)
	);

	// creation
	if (!dbase_create($dbname3, $def3)) {
	  echo "Error, can't create the database OPD\n";
	}
	if($day=="00"){
		$sqlop3 ="select hn, txdate from  opacc  where credit like '$newcredit%' and (date between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') group by substring(date,1,10), hn";
		//echo "test-->".$sqlop3."<br>";
	}else{
		$sqlop3 ="select hn, txdate from  opacc  where credit like '$newcredit%' and (date between '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-".$_POST['day']." 23:59:59') group by substring(date,1,10), hn";
		//echo "test-->".$sqlop3."<br>";
	}
   		$resultop3 = mysql_query($sqlop3) or die("Query failed3");
		while($rowsop3 = mysql_fetch_array($resultop3)){
			$hnop=$rowsop3["hn"];	
			
			$datetime=$rowsop3["txdate"];
			$dateopacc = substr($datetime,0,10);	
			
		
		
		$sql3 ="select * from opday where hn ='".$hnop."' and thidate like '$dateopacc%'";   //  Query ��Ң����Ũҡ���ҧ opday
		//echo "�ѹ��� $datetime ==>".$sql3."<br>";
		$result3 = mysql_query($sql3) or die("Query opday failed");
   		$rows3 = mysql_fetch_array($result3);
		$rowid=$rows3["row_id"];
		$newrowid = substr($rowid,3,4);
		
		$hn3=$rows3["hn"];  //  HN �����ù�����Ң�����
		$vn3=$rows3["vn"]; 
		
		//datetime
		$datetime3=$rows3["thidate"];
		$date3 = substr($datetime3,0,10);
		$date =explode("-",$date3);
		$newdate=$date[0]-543;
		$newdateopd =$newdate.$date[1].$date[2];  //  DATEOPD �����ù�����Ң�����
		
		$time3 = substr($datetime3,11,8);	
		$newtime =explode(":",$time3);
		$newtimeopd = $newtime[0].$newtime[1];  //  TIMEOPD �����ù�����Ң�����

		//clinic
		$clinic3=$rows3["clinic"];
		$clinic1=0;
		$clinic2=1;
   		$clinic=substr($clinic3,0,2);
		if($clinic==''){$clinic="00";} ;
		$newclinic=$clinic1.$clinic.$clinic2;  //  CLINIC �����ù�����Ң�����
		
		//SEQ
		$lenvn=strlen($vn3);
		if($lenvn=="1"){
			$newvn="00".$vn3;
		}else if($lenvn=="2"){
			$newvn="0".$vn3;
		}else if($lenvn=="3"){
			$newvn=$vn3;
		}
		$newseq=$newdateopd.$newvn.$newrowid;  //  SEQ �����ù�����Ң�����

		$ucc3="1";  //  UCC �����ù�����Ң�����

	$db3 = dbase_open($dbname3, 2);
		if ($db3) {
			  dbase_add_record($db3, array(
				  $hn3, 
				  $newclinic,		  
				  $newdateopd,
				  $newtimeopd, 		
				  $newseq, 				  		  
				  $ucc3));   
					dbase_close($db3);
				}  //if db
	}  //while
//--------------------End DataSet3-------------------------//

}  // if check box �Դ�ش����
?>