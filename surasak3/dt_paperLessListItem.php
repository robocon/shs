<?php 
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$hn = sprintf("%s", $_GET['hn']);

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, 'http://192.168.131.240:8081/api/getopcard?opcard_id='.$hn);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec( $ch );
$items = $json->decode($result);

?>
<style>
		body{
			margin: 0;
		}
		.thumbImg{
			max-height: 200px;
            max-width: 150px;
			box-shadow: 5px 5px 5px #b8b8b8;
		}
		.thumbImg:hover{
			cursor: pointer;
			box-shadow: 5px 5px 5px #666666;
		}
		#thumbList{
			padding-top: 5em;
		}
		#thumbList > .column{
			margin-bottom: 8px;
		}
		.thumbContain{
			border-bottom:1px solid #b8b8b8;
            text-align: center;
		}
        .thumbContain a{
            text-decoration: none;
            color: blue;
        }
	</style>
<div style="position: fixed;width: 100%;background-color: #ffffff;box-shadow: 0px 4px 4px #b8b8b8; text-align: center;"><h3 style="margin:8px;">ข้อมูลการมาโรงพยาบาล</h3></div>
<div class="row" id="thumbList">
<?php
if ($items->totalCount > 0) { 
    $items_reverse = array_reverse($items->list);
    foreach ($items_reverse as $key => $item) {
        list($dateEp, $timeEp) = explode(' ', $item->date);
        list($y, $m, $d) = explode('-', $dateEp);
        ?>
        <div class="column thumbContain">
            <a href="dt_paperLessFullPage.php?path=<?=rawurlencode($item->original);?>" target="right">
                <img src="<?=$item->thumbnail;?>" alt="Lights" class="thumbImg" onclick="myFunction('<?=$item->original;?>');">
                <p><b><?=$d.' '.$def_fullm_th[$m].' '.($y+543);?></b></p>
            </a>
        </div>
        <?php
    }
}else{
    ?><p style="text-align:center;">ยังไม่มีประวัติ e-OPD</p><?php
}
?>
</div>