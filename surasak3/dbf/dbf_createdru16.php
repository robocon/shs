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
.style1 {
font-family: AngsanaUPC;
font-size: 14px;
}
.style2 {
	font-family: AngsanaUPC;
	font-size: 14px;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>���͡������ DBF ������ 16 (DRU)</strong>
</font>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< �����</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<span class="font1">
<font face="Angsana New">
��͹ 
</font>
</span>
 <select name="mon">
   <option value="01">���Ҥ�</option>
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
 </select>
<span class="font1">
<font face="Angsana New">
</font>
</span>
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
?>
<input name="BOK" value="��ŧ" type="submit" />
  </span>
</form>
</div>

<?
if(isset($_POST['BOK'])){

$year = $_POST['year'];
$newyear = $year-543;
$yy = substr($newyear,2,2);
$mm =$_POST['mon'];

//---------------Start Dataset16---------------//
$dbname16 = "DRU".$yy.$mm.".dbf";
	$def16 = array(
	  array("HCODE","C",5),
	  array("HN","C",15),
	  array("AN","C",9),
	  array("CLINIC","C",4),
	  array("PERSON_ID","C",13),	  
	  array("DATE_SERV","D"),	  
	  array("DID","C",30), 
	  array("DIDNAME","C",255),	 
	  array("AMOUNT","C",12),
	  array("DRUGPRIC","C",14),
	  array("DRUGCOST","C",14),
	  array("DIDSTD","C",24), 
	  array("UNIT","C",20),	 
	  array("UNIT_PACK","C",20),
	  array("SEQ","C",15),
	  array("DRUGREMARK","C",2),	  
	  array("PA_NO","C",9)
	);
	
	// creation
	if (!dbase_create($dbname16, $def16)) {
	  echo "Error, can't create the database16\n";
	}
	
		$sql16 ="select * from  drugrx  where date between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59' and (an='' or an is null)";
		$result16 = mysql_query($sql16) or die("Query failed16");
		$num16= mysql_num_rows($result16);
   		while($rows16 = mysql_fetch_array($result16)){	
			$hcode16 ="11512";
			$hn16=$rows16["hn"];  //  HN �����ù�����Ң�����	
			$an16=$rows16["an"]; //  AN �����ù�����Ң�����
			$drugcode16=$rows16["drugcode"];  //  DID �����ù�����Ң�����
			$drugname16=$rows16["tradname"];  //  DIDNAME �����ù�����Ң�����
			$amount16=$rows16["amount"];  //  AMOUNT �����ù�����Ң�����
			
			$datetimedrg=$rows16["date"];
			$datedrg = substr($datetimedrg,0,10);
			$datedrug =explode("-",$datedrg);
			$newdatedrug=$datedrug[0]-543;
			$newdateserv =$newdatedrug.$datedrug[1].$datedrug[2];  		  //  DATE_SERV �����ù�����Ң�����						
			
			// �к������˵ؼ� EA, EB, EC, ED, EE, EF
			$reason16=$rows16["reason"]; 
			$reason=substr($reason16,0,1);
			$reasondefault ="00";
			

//---------------------��������Ҩҡ���ҧ druglst---------------------//					
			$sqldrx= "SELECT * FROM  druglst WHERE drugcode ='".$drugcode16."' ";
			$resultdrx = mysql_query($sqldrx) or die("Query druglst failed");
			$rowsdrx=mysql_fetch_array($resultdrx);
				$code24=$rowsdrx["code24"];    //  DIDSTD �����ù�����Ң�����
				$saleprice=$rowsdrx["salepri"];    //  DRUGPRICE(�ҤҢ��) �����ù�����Ң�����
				$unitprice=$rowsdrx["unitpri"];    //  DRUGCOST(�Ҥҷع) �����ù�����Ң�����
				$unit=$rowsdrx["unit"];    //  DIDSTD �����ù�����Ң�����
				$packing=$rowsdrx["packing"];    //  UNIT_PACK �����ù�����Ң�����
						
	
				// �� drugtype=2 �к������˵ؼ� EA, EB, EC, ED, EE, EF, PA
				

//---------------------������š���Ѻ��ԡ�èҡ���ҧ opday---------------------//					
		$sqlop ="select * from opday where hn ='".$hn16."' and thidate like '$datedrg%'";   //  Query ��Ң����Ũҡ���ҧ opday
		$resultop = mysql_query($sqlop) or die("Query opday failed");
   		$rowsop = mysql_fetch_array($resultop);	
			$personid=$rowsop["idcard"]; //  PERSON_ID �����ù�����Ң�����	
			
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
			$newseq=$newdateserv.$newvn.$newrowid;  //  SEQ �����ù�����Ң�����								
			
			if(($reason =="A" || $reason =="B" || $reason =="C" || $reason =="D" || $reason =="E" || $reason =="F") && $reason !=" "){
			$newreason ="E".$reason;
			$db16 = dbase_open($dbname16, 2);
				if ($db16) {
					dbase_add_record($db16, array(
						$hcode16, 
						$hn16, 
						$an16, 
						$newclinic,
						$personid, 
						$newdateserv,
						$drugcode16,  // drugcode
						$drugname16, 
						$amount16, 
						$saleprice,
						$unitprice, 
						$code24, 	
						$unit, 	
						$packing, 	
						$newseq, 	
						$newreason, 																																		  				  
						$pano));     
						dbase_close($db16);
					}  //if db		
				}else{
					$db16 = dbase_open($dbname16, 2);
						if ($db16) {
							dbase_add_record($db16, array(
								$hcode16, 
								$hn16, 
								$an16, 
								$newclinic,
								$personid, 
								$newdateserv,
								$drugcode16,  // drugcode
								$drugname16, 
								$amount16, 
								$saleprice,
								$unitprice, 
								$code24, 	
								$unit, 	
								$packing, 	
								$newseq, 	
								$reasondefault, 																																		  				  
								$pano));     
								dbase_close($db16);
							}  //if db						
				}  // if $reason
	}  // while
	//---------------End Dataset16---------------//

}  // if check box �Դ�ش����
?>