<?
@ob_start();
@session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>˹���á</title>
<!--<link rel="stylesheet" href="../reset.css" />--> 

<!--[if IE]> 
	<link rel="stylesheet" href="ie-hack-style.css" />
<![endif]-->

<Style>
ul {
	padding: 10px;
	margin: 10px;
	border: thin solid black;
	width: 250px;
	height: autopx;
	overflow-x: scroll;
	overflow-y: auto;


}
#apDiv1 {
	position:absolute;
	left:298px;
	top:25px;
	width:1022px;
	height:486px;
	z-index:1;
}
</style>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
-->
</style>
</head>
<body>
		
<div id="apDiv1">
<link type="text/css" href="datepicker/css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="datepicker/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
		<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() +543);//


		    // �óյ�ͧ�����軯ԷԹŧ��ҡ���� 1 �ѹ���˹�� ����������� Code ����÷Ѵ��ҹ��ҧ���¤�Ѻ (1 �ش = 1 ��ԷԹ)
  $("#datepicker-th-1").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay,dayNames: ['�ҷԵ��','�ѹ���','�ѧ���','�ظ','����ʺ��','�ء��','�����'],
              dayNamesMin: ['��.','�.','�.','�.','��.','�.','�.'],
              monthNames: ['���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'],
              monthNamesShort: ['�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.']});



		    $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay,dayNames: ['�ҷԵ��','�ѹ���','�ѧ���','�ظ','����ʺ��','�ء��','�����'],
              dayNamesMin: ['��.','�.','�.','�.','��.','�.','�.'],
              monthNames: ['���Ҥ�','����Ҿѹ��','�չҤ�','����¹','����Ҥ�','�Զع�¹','�á�Ҥ�','�ԧ�Ҥ�','�ѹ��¹','���Ҥ�','��Ȩԡ�¹','�ѹ�Ҥ�'],
              monthNamesShort: ['�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.']});

     		    $("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});

		    $("#inline").datepicker({ dateFormat: 'dd/mm/yy', inline: true });


			});
		</script>
<?

include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

?>
<script language=Javascript>
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //�Ѻ��ҡ�Ѻ��
               } 
          }
     };
     req.open("GET", "locale.php?data="+src+"&val="+val); //���ҧ connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=tis-620"); // set Header
     req.send(null); //�觤��
}

window.onLoad=dochange('vaccine', -1);     

function ch_null(){
	if(document.form1.hn.value==""){
		alert("��سҡ�͡ HN ���¤�Ѻ");
		return false;
	}
}

function fncSubmit()
{
	if(document.sel.vaccine.selectedIndex==0)
	{
		alert('��س����͡�Ѥ�չ���¤�Ѻ');
		document.sel.vaccine.focus();
		return false;
	}
	if(document.sel.vaccine_detail.selectedIndex==0) {
		alert("��س��к�������մ���¤�Ѻ") ;
		document.sel.vaccine_detail.focus() ;
		return false ;
	}		

	if(document.sel.doctor.selectedIndex==0)
	{
		alert('��س����͡ᾷ����¤�Ѻ');
		document.sel.doctor.focus();		
		return false;
	}	
	
	document.sel.submit();
}

</script>

<form action="" method="post" name="form1" id="form1" onsubmit="JavaScript:return ch_null();">
  <table width="200" border="1" align="left" bordercolor="#0099FF">
    <tr>
      <td><table width="285" border="0" align="center" >
        <tr>
          <td colspan="3" class="forntsarabun"><h2 align="center">�Ѻ��ԡ���Ѥ�չ</h2></td>
          </tr>
        <tr>
          <td width="96" align="right" class="forntsarabun">HN :</td>
          <td width="173" colspan="2" align="left"><label>
            <input name="hn" type="text" class="forntsarabun" id="hn" />
            </label></td>
          </tr>
        <tr>
          <td colspan="3" align="center"><label>
            <input type="submit" name="button" id="button" value="��ŧ" />
            </label></td>
          </tr>
        </table></td>
      </tr>
    </table>

</form>
<p>&nbsp;  </p>
<p>&nbsp;</p>
<p>
  <?

 $hn=$_REQUEST['hn'];

  if($_POST['button']=='��ŧ' || $hn!=''){

	/*$sql="select * from opcard  Where  hn='$hn' ";
	$query=mysql_query($sql);
	$numrows=mysql_num_rows($query);

	$dbarr1=mysql_fetch_array($query);*/

	$yy=date("Y")+543;
	$mm=date("m");
	$dd=date("d");
	$dateN=$dd.'/'.$mm.'/'.$yy;
	
	
	
		
	$sql1 = "select *  from opcard Where  hn = '$hn' ";
	$result1 = mysql_query($sql1);
	$numrows=mysql_num_rows($result1);
	$fetch= mysql_fetch_array($result1);

	
	if($numrows>0){
	$dbirth=$fetch[dbirth];
	$age = calcage($dbirth);
	
	?>
</p>

<p><br />
</p>
<p>&nbsp; </p>
<form action="service_action.php?do=add" method="post" name="sel" id="sel"  onsubmit="JavaScript:return fncSubmit();">
  <table width="408" border="1" align="left" bordercolor="#0099FF" class="forntsarabun">
    <tr>
      <td ><table width="100%" border="0" align="left" cellpadding="2" cellspacing="2"  id="mytbl">
        <tr>
          <td colspan="2"><table width="100%"  border="0" align="left">
            <tr>
              <td colspan="4" align="center" bgcolor="#E7E7E7">�����ż�����</td>
            </tr>
            <tr>
              <td width="109"  align="right" bgcolor="#E7E7E7">HN :</td>
              <td width="55" ><?=$fetch['hn'];?></td>
              <td width="54" bgcolor="#E7E7E7" >�Է��</td>
              <td width="154" ><?=$fetch['ptright'];?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#E7E7E7">���� - ʡ�� :</td>
              <td colspan="3"><?=$fetch['yot'].$fetch['name'].' '.$fetch['surname'];?></td>
              </tr>
            <tr>
              <td align="right" bgcolor="#E7E7E7">����:</td>
              <td colspan="3"><?=$age;?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#E4E3E3">��سҡ�͡������</td>
        </tr>
        <tr>
          <td align="right">�ѹ����Ѻ��ԡ��:</td>
          <td> <input name="date1" type="text" class="forntsarabun" id="datepicker-th-1"  value="<?=$dateN;?>" size="15"/></td>
          </tr>
        <tr>
          <td align="right">�Ѥ�չ���մ :</td>
          <td><font id="vaccine"  class="forntsarabun"><select class="forntsarabun" ><option value="0">=========================</option></select></font></td>
          </tr>
        <tr>
          <td align="right">������ :</td>
          <td><font id="vaccine_detail"  class="forntsarabun"><select class="forntsarabun" ><option value='0'>=========================</option></select></font></td>
          </tr>
        <tr>
          <td align="right">LotNo:</td>
          <td><input name="lotno" type="text" id="lotno" size="15" maxlength="10" class="forntsarabun" /></td>
          </tr>
        <tr>
          <td align="right">�ѹ�������</td>
          <td> <input type="text" size="15"  name="date2"  class="forntsarabun"/></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#99FF99">LotNo2:</td>
          <td bgcolor="#99FF99"><input name="lotno2" type="text" id="lotno3" size="15" maxlength="10" class="forntsarabun" />
          * OPV</td>
        </tr>
        <tr>
          <td align="right" bgcolor="#99FF99">�ѹ�������</td>
          <td bgcolor="#99FF99"><input type="text" size="15"  name="date3"  class="forntsarabun"/>
            * OPV</td>
        </tr>
        <tr>
          <td width="34%" align="right">ᾷ��</td>
          <td width="66%"><select name="doctor" id="doctor" class="forntsarabun">
            <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){

		if($dbarr2['name']=="MD041  ���Է�� ǧ�����"){
			
		echo "<option value='".$dbarr2['name']."' selected>".$dbarr2['name']."</option>";	
		}
		else
		{
		echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
		}
		}
		?>
            </select></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><label>
            <input name="unit" type="hidden" id="unit" value="1" />
            <input type="hidden" name="hn" value="<?=$fetch['hn'];?>" />
            <input type="submit" name="button2" id="button2" value="�ѹ�֡������" />
            </label></td>
          </tr>
        </table>
      
        </td>
      </tr>
    </table>
</form>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;  </p>
<p>&nbsp;</p>
<p align="left">
  <?
  }else{
	  echo "<br/>";
	    echo "<br/>";
	 echo "<h1 align='left'>��辺 HN </h1>";
  }
  }

  ?>
  
</p>
<p><br/>
  </p>
<p>&nbsp;</p>
<p><br/>
  <br/>
</p>
</div>
<ul class="forntsarabun"> <div align="center">   
���١���Ѻ��ԡ���Ѥ�չ </div>
<li><a href="../../nindex.htm"  title="��Ѻ˹���á">˹���á</a> </li> 
<li><a href="service.php" title="����Ѻ��ԡ���Ѥ�չ">����Ѻ��ԡ���Ѥ�չ</a></li>
<li><a href="Report_vac.php" title="��§ҹ����Ѻ��ԡ��">��§ҹ����Ѻ��ԡ�õ���Ѥ�չ</a></li>  
<li><a href="Report_m.php" title="��§ҹ����Ѻ��ԡ��">��§ҹ����Ѻ��ԡ�û�Ш���͹</a></li>
<li><a href="Report_all.php" title="��§ҹ����Ѻ��ԡ��">��§ҹ����Ѻ��ԡ�÷�����</a>  </li>
<li><a href="show_edit.php" title="�����¡�ú�ԡ���Ѥ�չ">�����¡�ú�ԡ���Ѥ�չ</a>  </li>
<li><a href="add_vac.php" title="�Ѵ��â������Ѥ�չ">�Ѵ��â������Ѥ�չ (����/���/ź)</a>  </li>
</ul>
</body>
</html>
<!--show_edit.php-->