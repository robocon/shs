<?php
session_start();

 include("connect.inc");
?>
<style>
fieldset{ border:1px solid red; }

legend{
  padding: 0.2em 0.5em;

  color:black;
  font-size:100%;
  text-align:right;
  font-family:Th Niramit AS;
  font-size:18px;
  }
</style>
<?
 	$query = "SELECT row_id,my_food FROM ipcard where an = '".$_POST["an"]."' ";
	 $result = mysql_query($query);
	 $rows = Mysql_num_rows($result);
	
	$result2 = mysql_fetch_array($result);
	if($rows == 0){
		
		echo "����������Ţ AN ����ҹ�к� ��س��ͧ�����ա���� <BR><BR><input type=button onclick='history.back()' value='&lt;&lt; ��Ѻ�'>";
			
	exit();
	}elseif($result2['my_food']==""){
		echo "�ѧ������к��Է�Ԣͧ������ �������¼�ҹ��ǹ���Թ������͹<BR><BR><input type=button onclick='history.back()' value='&lt;&lt; ��Ѻ�'><br>";
		exit();
	}

    $cAdmitd="";
    $cHn="";
    $cAn=$an;
    $cYot="";
    $cName="";
    $cSurname="";
    $cPtright="";  
    $cGoup="";
    $cCamp="";
    
    $cIdcard="";
    $cAge="";
    $cAddress="";
    $cMuang=""; 

    session_register("cAdmitd");  
    session_register("cHn");  
    session_register("cAn");  
    session_register("cYot");
    session_register("cName");
    session_register("cSurname");
    session_register("cPtright");
    session_register("cGoup");
    session_register("cCamp");
    session_register("cIdcard");  
    session_register("cAge");  
    session_register("cAddress");
    session_register("cMuang");

//
Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
	  //$bY=substr($birth,0,4);
      $bM=substr($birth,5,2);
      $ageY=$nY-$bY;
      $ageM=$nM-$bM;
       if ($ageM<0) {
           $ageY=$ageY-1;
           $ageM=12+$ageM;
                    }
      if ($ageM==0){
           $pAge="$ageY ��";
             }
      else{
            $pAge="$ageY �� $ageM ��͹";
                        }
      return $pAge;
          }
//
  

///////
    $query = "SELECT ptname,an FROM bed WHERE an = '$an'";
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

          if(mysql_num_rows($result)){
                die("AN: $an  ���� $row->ptname <br>
	        ���ѧ�͹����������ç��Һ��  �������ö�Ѻ�����������§�����<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value='<< ��Ѻ�'>");
                         }  
//////
   $query = "SELECT date,an,hn,dcdate,status_log FROM ipcard WHERE an = '$an'";
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
   IF ($result){
       $cHn=$row->hn;
       $cAdmitd=$row->date;
	   $cDcmitd=$row->dcdate;
	   $status_log=$row->status_log;
		   if($cDcmitd == '0000-00-00 00:00:00'){}else{ echo "<FONT SIZE='3' COLOR='#FF0000'>����͹ ��������ӡ�è�˹������º��������<BR> ��سҵ�Ǩ�ͺ AN ��͹��� ADMIT </FONT><br>";};
     //
	    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
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
 	       $cHn=$row->hn;
  	       $cYot = $row->yot;
                       $cName = $row->name;
   	       $cSurname = $row->surname;
   	       $cPtright = $row->ptright;
    	       $cGoup= $row->goup;
	       $cCamp= $row->camp;
                       $cIdcard=$row->idcard;
                       $cAge=$row->dbirth;
                       $cAddress=$row->address;
                       $cMuang="�. $row->tambol  �. $row->ampur  �. $row->changwat" ; 
                       $cAge=calcage($cAge);
                       echo "��Ǩ�ͺ���ͼ�����  ���ͤ����١��ͧ��͹�Ѻ����<br>";
   	       echo "<FONT SIZE='4' COLOR='#FF0000'>HN : $cHn, <B>AN:$an</B></FONT> <BR><FONT SIZE='4' COLOR=''> ����: $cYot   $cName  $cSurname,  �Է�ԡ���ѡ�� : $cPtright </FONT><br>";
   	       }  
 	  else {
  	       echo "��辺 HN : $hn ";
  	         }    
    	       }  
ELSE {
      echo "��辺 AN  in ipcard table : $an ";
      }  
	  
	  
	  
	  /////////////
	  
if($status_log=="��˹���"){
print "<script>alert('������ an: $an ���˹����͡�ҡ�ç��Һ������ ������ѹ��� $cDcmitd    �ҡ��ͧ�������¹�ŧ�������¡�سҵԴ�����ǹ���Թ�����')</script>";
print "<a target=_self  href='../nindex.htm'><-----�����</a>";


}else{
	  
?>


<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		var ff = document.f1;
		var txt = "";
		var stat = true;

		if(ff.diag.value == "�к��ä���ͧ��" || ff.diag.value == "" ){
			stat = false;
			txt += "��سҡ�͡�����ä�ͧ������";
		}
		else if(ff.price.value == ""){
			stat = false;
			txt += " ��س����͡�ҤҤ����ͧ";
		}
		
		if(stat == false){
			alert(txt);
		}
		
		return stat;
	}

function chkother(){
	if(document.getElementById('rep').value=="other"){
		document.getElementById('hosother').style.display='';
	}else{
		document.getElementById('hosother').style.display='none';
	}
}
</SCRIPT>
<?
$query11 = "SELECT * FROM ipcard WHERE an = '$an'";
$result11 = mysql_query($query11);
$rows11=mysql_num_rows($result11);
$arr=mysql_fetch_array($result11);


if($arr['diag']==''){ $diag="�к��ä���ͧ��";}else{ $diag=$arr['diag'];}

 if($cDcmitd == '0000-00-00 00:00:00'){
	$action="ipregis.php?do=first"; 
 }else{
	$action="ipregis.php?do=second"; 
 }

?>

<form name="f1" method="POST" action="<?=$action;?>" onsubmit="return checkForm();">
   <p><b>�ôŧ�����ŵ��仹��</b></p>
   �Ѻ�����¨ҡ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select name="rep" id="rep" onchange="chkother()">
   <option value="er">ER</option>
   <option value="opd">OPD</option>
   <option value="other">�ç��Һ�����</option>
   <option value="��ͧ��ҵѴ">��ͧ��ҵѴ</option>
   <option value="��ͧ��ʹ">��ͧ��ʹ</option>
   
   </select>
   &nbsp;<input name="hosother" type="text" id="hosother" size="40" style="display:none">
   &nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;
  <p>
   �ԹԨ����ä&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input type="text" name="diag" size="50" value="<?=$diag;?>">
   &nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;
  <p>
   �ä��Шӵ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input type="text" name="diag1" size="50" value="�����">
   &nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;
   <p> �����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <select size="1" name="food">
     <option value="����û���" selected="selected">����û���</option>
     <option value="�������͹">�������͹</option>
     <option value="���������">���������</option>
     <option value="NPO (�������, ���)">NPO (�������, ���)</option>
  </select>&nbsp;&nbsp;&nbsp;</p>
   <p>������������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="addfood" size="50">
   &nbsp;&nbsp;</p>
   <p>ᾷ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <?php
   include("connect.inc");
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>" <? if($arr['doctor']==$objResult["name"]){ echo "selected"; }?>><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>

	  <?php }else{?>
	  <? 
	 $strSQL = "SELECT name FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>" <? if($arr['doctor']==$objResult["name"]){ echo "selected"; }?>><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>

	  <?php
	  
	   if($cDcmitd == '0000-00-00 00:00:00'){}else{ echo "&nbsp;<BR><BR><FONT SIZE='3' COLOR='#FF0000'>����͹ ��������ӡ�è�˹������º��������<BR> ��سҵ�Ǩ�ͺ AN ��͹��� ADMIT  <B>AN:$an</B> </FONT><br>";};
	  
	  }?>
  
  </p>
  <?
  if($_SESSION['cBedcode']=="42R5"||$_SESSION['cBedcode']=="42R8"){
  ?>
  <fieldset><legend>�����ͧ</legend>
   <p>&nbsp;&nbsp;����кؤ����ͧ�ͧ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <select name="price" id="price">
       <option value="">-���͡�ҤҤ����ͧ-</option>
       <option value="300">300</option>
       <option value="600">600</option>
     </select>&nbsp;&nbsp;�ҷ </p>
     <br /></fieldset>
   <?
  }
   ?>
 <p>�ô��Ǩ�ͺ&nbsp; AN&nbsp;��͹����Ѻ���� �ء����

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="  &#3605;&#3585;&#3621;&#3591;  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  &#3649;&#3585;&#3657;&#3652;&#3586;  " name="B2"></p>
</form>
<? } ?>