<?php
include 'bootstrap.php';

if( $_SESSION['smenucode'] != "ADM" ){
  echo "����Է��੾�� Admin ��ҹ��";
  exit;
}
?>
<form method="POST" action="reporteclame1_finance.php">
<p>�١˹����ѡ��Сѹ�آ�Ҿ ��Ш���͹</p>




<p><font face="Angsana New">�ѹ���
 <select size="1" name="date">
    <option selected>���͡</option>
    <option>01</option>
	    <option>02</option>
		    <option>03</option>
			    <option>04</option>
				    <option>05</option>
					    <option>06</option>
						    <option>07</option>
							    <option>08</option>
								    <option>09</option>
									    <option>10</option>
										   
    <option>11</option>
	    <option>12</option>
		    <option>13</option>
			    <option>14</option>
				    <option>15</option>
					    <option>16</option>
						    <option>17</option>
							    <option>18</option>
								    <option>19</option>
									    <option>20</option>
										    

	    <option>21</option>
		    <option>22</option>
			    <option>23</option>
				    <option>24</option>
					    <option>25</option>
						    <option>26</option>
							    <option>27</option>
								    <option>28</option>
									    <option>29</option>
										    <option>30</option>
												    <option>31</option>
  </select>


   <font face="Angsana New">&nbsp;&nbsp; &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;<select size="1" name="rptmo">
    <option selected>--&#3648;&#3621;&#3639;&#3629;&#3585;--</option>
    <option value="01">&#3617;&#3585;&#3619;&#3634;&#3588;&#3617;</option>
    <option value="02">&#3585;&#3640;&#3617;&#3616;&#3634;&#3614;&#3633;&#3609;&#3608;&#3660;</option>
    <option value="03">&#3617;&#3637;&#3609;&#3634;&#3588;&#3617;</option>
    <option value="04">&#3648;&#3617;&#3625;&#3634;&#3618;&#3609;</option>
    <option value="05">&#3614;&#3620;&#3625;&#3616;&#3634;&#3588;&#3617;</option>
    <option value="06">&#3617;&#3636;&#3606;&#3640;&#3609;&#3634;&#3618;&#3609;</option>
    <option value="07">&#3585;&#3619;&#3585;&#3598;&#3634;&#3588;&#3617;</option>
    <option value="08">&#3626;&#3636;&#3591;&#3627;&#3634;&#3588;&#3617;</option>
    <option value="09">&#3585;&#3633;&#3609;&#3618;&#3634;&#3618;&#3609;</option>
    <option value="10">&#3605;&#3640;&#3621;&#3634;&#3588;&#3617;</option>
    <option value="11">&#3614;&#3620;&#3625;&#3592;&#3636;&#3585;&#3634;&#3618;&#3609;</option>
    <option value="12">&#3608;&#3633;&#3609;&#3623;&#3634;&#3588;&#3617;</option>

  </select><select size="1" name="thiyr">
    <option selected>2552</option>
    <option>2553</option>
    <option>2554</option>
    <option>2555</option>
    <option>2556</option>
    <option>2557</option>
    <option>2558</option>
    <option>2559</option>
    <option>2560</option>
    <option>2561</option>
    <option>2562</option>
    
    
  </select>
  

<?php

  $sql = "SELECT * 
  FROM `ptright` 
  WHERE `status` != 'n' AND (
    `code` = 'R09' OR `code` = 'R10' OR `code` = 'R11' OR `code` = 'R12' 
    OR `code` = 'R13' OR `code` = 'R14' OR `code` = 'R17'
  ) ORDER BY `code` ASC ";
  $q = mysql_query($sql) or die( mysql_error() );
  ?>

  ���͡�Է��
  <select name="ptright" id="">
  <?php
  while ( $item = mysql_fetch_assoc($q) ) {
    ?><option value="<?=$item['code'];?>"><?=$item['code'].$item['name'];?></option><?php
  }
  ?>
  </select>
  
  
  
  </p>

    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;
    <input type="submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>
