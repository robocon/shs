<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/class_file/class_patdata2.php';
include_once dirname(__FILE__).'/class_file/class_opacc2.php';
include_once dirname(__FILE__).'/includes/JSON.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}

$p = new ClassPatdata();
$o = new ClassOpacc();
$j = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$departItems = array();
$opaccId = $_GET['opacc_id'];
parse_str($_GET['depart_id'], $departItems);

$resDepart = $resPatdata = $resOpacc = false;


$o->delOpaccFromId($opaccId);
exit;

$resAll = array();
if(!empty($opaccId)){
    $opaccStatus = false;
    $res = $o->findOpaccFromId($opaccId);
    if(!$res['error']){
        $del = $o->delOpaccFromId($opaccId);
        $opaccStatus = true;
    }else{
        $res = array('status'=>400,'resOpacc'=>$res['msg']);
    }
    $resAll['opacc'] = $res;


}

if(count($departItems)>0 && $opaccStatus!==false){

    foreach ($departItems as $departId) {
        $resDepart = $p->delDepartFromRowId($departId);
        if(!$resDepart['error']){
            $resPatdata = $p->delPatdataFromIdno($departId);
        }else{
            $resAll['depart'] = array('status'=>400, 'msg'=>$resDepart['error']);
        }
        
    }
    

}
echo $j->encode($resAll);
exit;