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
<strong>���͡������ DBF ������ 06 (OOP)</strong></font></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< �����</a>

<span class="font1">
<font face="Angsana New">
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <table width="302" border="0">
    <tr>
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


//--------------------Start DataSet6-------------------------//
$dbname6 = "OOP".$yy.$mm.".dbf";
	$def6 = array(
	  array("HN","C",15),
	  array("DATEOPD","D"),
	  array("CLINIC","C", 4),	  
	  array("OPER","C",7),
	  array("DROPID","C",6),
	  array("PERSON_ID","C",13),	  
	  array("SEQ","C",15)
	);

	// creation
	if (!dbase_create($dbname6, $def6)) {
	  echo "Error, can't create the database6\n";
	}

		$sql6 ="select * from opicd9cm  where (svdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') order by row_id";
		$result6 = mysql_query($sql6) or die("Query failed6");
   		while($rows6 = mysql_fetch_array($result6)){
		$hn6=$rows6["hn"];   //  HN �����ù�����Ң�����
		$oper6=$rows6["icd9cm"];   //  OPER �����ù�����Ң�����
		
		//DATEOPD
		$dateopd6=$rows6["svdate"];
		$date6 = substr($dateopd6,0,10);
		$date =explode("-",$date6);
		$newdate=$date[0]-543;
		$newdateopd =$newdate.$date[1].$date[2];  //  DATEOPD �����ù�����Ң�����		
		
		
//---------------------������Ũҡ���ҧ opday---------------------//
		$sqlop ="select * from opday where hn ='".$hn6."' and  (thidate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59')  order by row_id";   //  Query ��Ң����Ũҡ���ҧ opday
		$resultop = mysql_query($sqlop) or die("Query opday failed");
   		$rowsop = mysql_fetch_array($resultop);
			$personid=$rowsop["idcard"];  //  PERSON_ID �����ù�����Ң�����
			
				// DROPID
				//---------------------��������Ъ������-------------------------//
				$doctor_name=$rowsop["doctor"]; 
				$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name%' ";   //  Query ��Ң����Ũҡ���ҧ doctor
				$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
				$numdoc = mysql_num_rows($resultdoc);
				$rowsdoc = mysql_fetch_array($resultdoc);
					if($numdoc > 0){
							$newdropid = $rowsdoc["doctorcode"];
					}else{			
						$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name%' ";   //  Query ��Ң����Ũҡ���ҧ inputm
						$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
						$rowsinp = mysql_fetch_array($resultinp);	
							$newdropid = $rowsinp["codedoctor"];
					}			

			//CLINIC
			$clinic3=$rowsop["clinic"];
			$clinic1=0;
			$clinic2=1;
			$clinic=substr($clinic3,0,2);
			if($clinic==''){$clinic="00";} ;
			$newclinic=$clinic1.$clinic.$clinic2;  //  CLINIC �����ù�����Ң�����				
		
			//SEQ
			$rowidop=$rowsop["row_id"];
			$newrowid = substr($rowidop,3,4);				
			
			$vn=$rowsop["vn"];
			$lenvn=strlen($vn);
			if($lenvn=="1"){
				$newvn="00".$vn;
			}else if($lenvn=="2"){
				$newvn="0".$vn;
			}else if($lenvn=="3"){
				$newvn=$vn;
			}
			$newseq=$newdateopd.$newvn.$newrowid;  //  SEQ �����ù�����Ң�����	
			
				
		$db6 = dbase_open($dbname6, 2);
		if ($db6) {
			  dbase_add_record($db6, array(
				  $hn6, 
				  $newdateopd, 
 				  $newclinic, 
				  $oper6,
				  $newdropid,
				  $personid, 
				  $newseq));     
					dbase_close($db6);
				}  //if db
		}  //while
//--------------------End DataSet6-------------------------//

}  // if check box �Դ�ش����
?>