<?php
    $x=0;
    $aDgcode = array("����");
    $aTrade  = array("��¡��");
    $aPrice  = array("�Ҥ� ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aMoney= array("       ����Թ   ");
	$aFilmsize= array("       ��Ҵ   ");
    $Netprice="";   
   
    $cHn="";
    $cPtname="";
    $cPtright="";    
//    $cDepart="";
    $cPart="";
    $cDiag="";
    $cDoctor="";
    $cAn=$an;
    $cAccno="";

    $nRunno="";
  
    session_register("nRunno");

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");

    session_register("cHn");  
    session_register("cPtname");
    session_register("cPtright");
//    session_register("cDepart");
    session_register("cPart");
    session_register("cDiag");
    session_register("cAn"); 
    session_register("cDoctor"); 
    session_register("cAccno"); 
	session_register("aFilmsize");

    $aYprice = array("�Ҥ� ");
    $aNprice = array("�Ҥ� ");
    $aSumYprice = array("�Ҥ� ");
    $aSumNprice = array("�Ҥ� ");
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");

    include("connect.inc");
//seek $an in bed
    $query = "SELECT * FROM opday WHERE an = '$an'";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed");
	$rows_an = mysql_num_rows($result);
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   If ($result){
      $cPtname= $row->ptname;
      $cPtright = $row->ptright;
      //$cDoctor= $row->doctor;      
      $cHn=$row->hn;
   //   $cDiag= $row->diagnos;
    //  $cAccno=$row->accno;
   }

   $sqlIP = "SELECT `row_id` FROM `ipcard` WHERE `an` = '$an' AND `status_log` = '��˹���' ";
   $qIP = mysql_query($sqlIP);
   if(mysql_num_rows($qIP) > 0){
       echo "��������ӡ�� Discharge ��سһ���ҹ ��ǹ���Թ��������ͻŴ��ͤ ��йӼ����¡�Ѻ�����§";
       exit;
   }

  $query = "SELECT * FROM bed WHERE an = '$an'";
    $result = mysql_query($query)
        or die("Query failed1");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   If ($result){
      //$cPtname= $row->ptname;
     // $cPtright = $row->ptright;
     $cDoctor= $row->doctor;      
     // $cHn=$row->hn;
      $cDiag= $row->diagnos;
      $cAccno=$row->accno;

//seek $an in ipcard �ѧ��������
/*
    $query = "SELECT * FROM bed WHERE an = '$an'";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   If ($result){
      $cPtname= $row->ptname;
      $cPtright = $row->ptright;
      $cDoctor= $row->doctor;      
      $cHn=$row->hn;
      $cDiag= $row->diagnos;
      $cAccno=$row->accno;
*/
//runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $nRunno=$row->runno;
    $nRunno++;

    $query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
	$sql = "Select bedcode , left(doctor,5), doctor From bed where an = '".$cAn."' limit 0,1 ";
	list($bedcode , $doctor_ipd, $doctor_ipd2) = mysql_fetch_row(mysql_query($sql));

      //
      echo "<FONT SIZE='' COLOR='#FF0000'>�ô��Ǩ�ͺ�������ͤ����١��ͧ</FONT><br><br>";
      echo "HN : $cHn <BR> AN : $cAn <BR><FONT SIZE='' COLOR='#FF0066'> ����: <B>$cPtname</B></FONT><br> ";
      echo "�Է�� : $cPtright<br> ";
      echo "�ä: $cDiag <BR> ᾷ��: $cDoctor<br>";


       //
           }  
   else {
      echo "��辺 AN : $an 㹢����ż������ ���ͨ�˹��¼��������� ";
           }  
  
 include("unconnect.inc");  
  $tvn=$an;
session_register("tvn");
?>
<?php
if($rows_an > 0){

	if($_SESSION["until_login"] == "xray"){
	  
	?>

	<FORM METHOD=POST ACTION="labseek.php">
		<font face="Angsana New"><A HREF="xraylst_dr.php" target="right">��Ǩ(���)</A> : <BR>
	<div id="cXraydetail"></div>
		<INPUT TYPE="submit" value="����¡�õ���">
	</FORM>

  <?php }else{ 
  ?>
  <FORM METHOD=POST ACTION="labseek.php">
  <?
  	if($bedcode!=""){
		$codeb = substr($bedcode,0,2);//����ward
  ?>
	�ͼ����� :<select name="bcode">
      <option value="">��س����͡��</option>
      <option value="42" <? if($codeb=="42") echo "selected";?>>�ͼ�����˭ԧ</option>
      <option value="44" <? if($codeb=="44") echo "selected";?>>�ͼ����� ICU</option>
      <option value="43" <? if($codeb=="43") echo "selected";?>>�ͼ������ٵ�</option>
      <option value="45" <? if($codeb=="45") echo "selected";?>>�ͼ����¾����</option>
   </select>
  <?
	}else{
  ?>
      �ͼ����� :<select name="bcode">
      <option value="">-��س����͡�ͼ�����-</option>
      <option value="42">�ͼ�����˭ԧ</option>
      <option value="44">�ͼ����� ICU</option>
      <option value="43">�ͼ������ٵ�</option>
      <option value="45">�ͼ����¾����</option>
      </select>
  <?
	}
  ?><br /><br />
		<INPUT TYPE="submit" value="����¡�õ���">
	</FORM>
<!--<a href="labseek.php">����¡�õ���</a>-->
<?php }} ?>
