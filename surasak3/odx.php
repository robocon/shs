
<?
include("connect.inc");
echo "<table><tr><td>HN</td><td>�ѹ����ԹԨ����ä</td><td>���ʤ�չԡ</td><td>���� ICD10</td><td>��Դ�ͧ�ä</td><td>ᾷ�����ѡ��</td><td>�Ţ���ѵû�ЪҪ�</td><td>���ʡ�ú�ԡ�÷���˹��������</td></tr>";
		$sql5 ="select * from diag  where svdate like '2557-10%'";
		$result5 = mysql_query($sql5) or die("Query failed5");
   		while($rows5 = mysql_fetch_array($result5)){
		$doctor_name=$rows5["office"];
		$hn5=$rows5["hn"];   //  HN �����ù�����Ң�����
		
		
		//DATEDX
		$datedx5=$rows5["svdate"];
		$date5 = substr($datedx5,0,10);
		$date =explode("-",$date5);
		$newdate=$date[0]-543;
		$newdatedx =$newdate.$date[1].$date[2];  //  DATEDX �����ù�����Ң�����
				
		$diag5=$rows5["icd10"];  //  DIAG �����ù�����Ң�����
		
		//------------------��˹�����âͧ ��Դ�ͧ�ä
		$dxtype5=$rows5["type"];
		if($dxtype5=="PRINCIPLE"){		
			$dxtype ="1";
		}else if(dxtype5=="CO-MORBIDITY"){
			$dxtype ="2";
		}else if(dxtype5=="COMPLICATION"){
			$dxtype ="3";
		}else if(dxtype5=="OTHER"){
			$dxtype ="4";
		}else if(dxtype5=="EXTERNAL CAUSE"){
			$dxtype ="5";
		}else{
			$dxtype ="2";
		}


//---------------------������Ũҡ���ҧ opday---------------------//
		$sqlop ="select * from opday where hn ='".$hn5."' and thidate like '$date5%'";   //  Query ��Ң����Ũҡ���ҧ opday
		$resultop = mysql_query($sqlop) or die("Query opday failed");
   		$rowsop = mysql_fetch_array($resultop);
			$hn=$rowsop["hn"]; 
			$personid=$rowsop["idcard"];  //  PERSON_ID �����ù�����Ң�����
			
				
				//---------------------��������Ъ������-------------------------//
				$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name%' ";   //  Query ��Ң����Ũҡ���ҧ doctor
				$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
				$numdoc = mysql_num_rows($resultdoc);
				$rowsdoc = mysql_fetch_array($resultdoc);
					if($numdoc > 0){
							$newdrdx = $rowsdoc["doctorcode"];
					}else{			
					$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name%' ";   //  Query ��Ң����Ũҡ���ҧ inputm
					$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
					$rowsinp = mysql_fetch_array($resultinp);	
						$newdrdx = $rowsinp["codedoctor"];
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
			$newseq=$newdatedx.$newvn.$newrowid;  //  SEQ �����ù�����Ң�����

	echo  "<tr><td>$hn5</td>
				  <td>$newdatedx</td>
				  <td>$newclinic</td>			  
				  <td>$diag5</td> 		
				  <td>$dxtype</td>	
				  <td>$newdrdx</td>		
				  <td>$personid</td>					  			  		  
				 <td> $newseq</td></tr>";			
}		
echo "</table>";	
?>            