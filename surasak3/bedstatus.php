<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
//    session_destroy();
    //wardpage.php
    session_unregister("cDepart");
    session_unregister("aDetail");
    session_unregister("cTitle");
    //ipdata.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister('cDate');
    session_unregister('cBedcode');
    session_unregister('cBed');
    session_unregister('cPtname');
    session_unregister('cAge');
    session_unregister('cPtright');
    session_unregister('cDoctor');
    session_unregister('cHn');
    session_unregister('cAn');
    session_unregister('cDiag');
    session_unregister('cBedpri');
    session_unregister('cChgdate');
    session_unregister('cBedname');
    session_unregister('cAccno');
    session_unregister("nRunno");
////

    $Bedcode=$cBedcode;
    session_register("Bedcode");

///////////
session_register('cBedcode');
echo "ʶҹ� $cstatus<br>";
?>
<form method="POST" action="bedstatusok.php">
   <p><font face="Angsana New">����¹ʶҹ��� :<select size="1" name="status">
    <option selected>B01:�Դ���ԡ��</option>
    <option>B02:�����ԡ��</option>
    <option>B03:��§�ͧ</option></select>
  &nbsp;&nbsp;���ͧ/�˵ؼ�&nbsp;&nbsp; <input type='text' name='status_detail' size='30' >
<p> <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  ź���  " name="B2"></p>
</form>
