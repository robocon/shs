
<div>
    <a target=_top  href='../nindex.htm'>&lt;&lt; �����</a> | <a href="rphos2m_2.php">��§ҹ�ʹ��������ǧ����</a>
</div>


<form method="POST" action="rphos2m.php">
<p><b>��ش����ѹ����������Ǫ�ѳ��(�.�.2)  �����͹</b></p>
    <div>
        <p>
            <font face="Angsana New">&nbsp;&nbsp; &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;<? $m=date('m'); ?>
            <select size="1" name="rptmo">
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
            </select>&nbsp;&nbsp; &#3614;.&#3624;
            <?php 
            $Y=date("Y")+543;
            $date=date("Y")+543+5;
            $dates=range(2547,$date);

            echo "<select name='thiyr'>";
            foreach($dates as $i){
                ?>
                <option value='<?=$i-543?>' <? if($Y==$i){ echo "selected"; }?>><?=$i-543;?></option>
                <?php
            }
            echo "<select>";
            ?>
        </p>
    </div>
    <div>
        <p>
            <font face="Angsana New">&nbsp;&nbsp; �֧��͹ &nbsp;<?php $m=date('m'); ?>
            <select size="1" name="rptmo_end">
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
            </select>&nbsp;&nbsp; &#3614;.&#3624;
            <?php 
            $Y=date("Y")+543;
            $date=date("Y")+543+5;
            $dates=range(2547,$date);

            echo "<select name='thiyr_end'>";
            foreach($dates as $i){
                ?>
                <option value='<?=$i-543?>' <? if($Y==$i){ echo "selected"; }?>><?=$i-543;?></option>
                <?php
            }
            echo "<select>";
            ?>
        </p>
    </div>

  <p>
  ������ : <INPUT TYPE="text" NAME="drugcode">
  </p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1">
    </p>
</form>

