<?php 
session_start();

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";

}

$types = array(
    1 => array(
        'title' => '�ä���ͤ����Դ���Ԣͧ��',
        'items' => array(
            '�' => '�Ң�ҧ㴢�ҧ˹�觺Դ ���������ѡ���������µҴ�����蹵����ǡ���ͧ����ѧ������дѺ��ӡ��� 3/60 �����ҹ��µ��������᤺���� 10 ͧ��',
            '�' => '��µ���軡�� ���������ѡ���������µҴ���������� ����ͧ����ѧ������дѺ 6/24 ���͵�ӡ��ҷ���ͧ��ҧ',
            '�' => '��µ�����ҡ���� 8 ��ͻ���� ������µ�����ҡ���� 5 ��ͻ���� ����ͧ��ҧ',
            '�' => '�����ǵҷ���ͧ��ҧ (Bilateral Cataract)',
            '�' => '����Թ (Glaucoma)',
            '�' => '�ä���ǻ���ҷ����������� 2 ��ҧ (Optic Atrophy)',
            '�' => '���ǻ���ҷ���ѡ�ʺ������ѧ���͢�蹷���ͧ��ҧ',
            '�' => '����ҷ�������͹����١�����ӧҹ�٭�������ҧ���� (Cranial never 3 , 4 , 6)'
        )
    ),2 => array(
        'title' => '�ä���ͤ����Դ���Ԣͧ��',
        'items' => array(
            '�' => '��˹ǡ����ͧ��ҧ ��͵�ͧ�����§㹪�ǧ���蹤������ 500-2,000 �ͺ����Թҷ������Թ���� 55 ഫ��� �֧�����Թ����ͧ��ҧ',
            '�' => '�٪�鹡�ҧ�ѡ�ʺ������ѧ����ͧ��ҧ',
            '�' => '���������ٷ��ط���ͧ��ҧ'
        )
    ),3 => array(
        'title' => '�ä�ͧ���������ʹ���ʹ',
        'items' => array(
            '�' => '����������ʹ���ʹ�ԡ�����ҧ���� ���Ҩ�Դ�ѹ���������ç',
            '�' => '������㨾ԡ��',
            '�' => '����鹢ͧ���㨼Դ�������ҧ���� ���Ҩ�Դ�ѹ���������ç',
            '�' => '�ä�ͧ������������㨹Դ����������ö�ѡ�������¢Ҵ������Ҩ���ѹ����',
            '�' => '��ʹ���ʹᴧ�˭��觾ͧ',
            '�' => '��ʹ���ʹ���㹡����š������觾ͧ���ͼԴ���Ԫ�Դ����Ҩ���ѹ����'
        )
    ),4 => array(
        'title' => '�ä���ʹ������������ҧ���ʹ',
        'items' => array(
            '�' => '�ä���ʹ�������������ҧ���ʹ�Դ�������ҧ�ع�ç����Ҩ���ѹ���¶֧���Ե',
            '�' => '��������� (Hypersplenism) ����ѡ������������Ҩ���ѹ����'
        )
    ),5 => array(
        'title' => '�ä�ͧ�к�����',
        'items' => array(
            '�' => '�ä�״ (Asthma) ������Ѻ����ԹԨ��µ��ࡳ�����ԹԨ���',
            '�' => '�ä�ҧ�ʹ������ҡ���� �ͺ�˹���� ����ա���٭���¡�÷ӧҹ�ͧ�к��ҧ�Թ���� �µ�Ǩ���ö�Ҿ�ʹ���� forced Expiratoy Volume in One Second ���,���� Forced Vital Capacity ��ӡ��������� 60 �ͧ����ҵðҹ���ࡳ��',
            '�' => '�ä�����ѹ���ʹ㹻ʹ�٧ (Pulmonary Hypertension) ����ԹԨ����¡�õ�Ǩ���㨴��¤������§��������٧ (Echocardiogram) �����¡����������¤����ѹ���ʹ㹻ʹ',
            '�' => '�ä�ا���㹻ʹ (Lung Cyst) ����Ǩ�ԹԨ������¡�ö����ѧ�շ�ǧ͡ ���� ��硫��������������ʹ',
            '�' => '�ä��ش������㨢�й͹��Ѻ (Obstructive Sleep Apnea) ����ԹԨ��´��¡�õ�Ǩ��ù͹��Ѻ (Polysomnography)'
        )
    ),6 => array(
        'title' => '�ä�ͧ�к��������',
        'items' => array(
            '�' => '��ѡ�ʺ������ѧ',
            '�' => '������ҡ��䵾ԡ�� (Nephrotic Syndrome)',
            '�' => '����������ѧ',
            '�' => '䵾ͧ�繶ا�������Դ (Polycystic Kidney)'
        )
    ),7 => array(
        'title' => '�ä���ͤ����Դ���Ԣͧ��д١ ��� ��С��������',
        'items' => array(
            '�' => array(
                'name' => '�ä������ͤ����Դ���Ԣͧ��� �ѧ���仹��',
                'attributes' => array(
                    1 => '����ѡ�ʺ������ѧ (Chronic Arthritis)',
                    2 => '���������������ѧ (Chronic Osteoarthritis)',
                    3 => '�ä�����С�д١�ѹ��ѧ�ѡ�ʺ������ѧ (Spondyloarthropathy)'
                )
            ),
            '�' => array(
                'name' => 'ᢹ �� ��� ��� ���� ���ҧ����ҧ˹�觼Դ���� �ѧ���仹��',
                'attributes' => array(
                    1 => 'ᢹ �� ��� ������� ��ǹ���;ԡ�� �֧�����Ҩ��ѡ�Ҵ����Ը��������ش���ǡ��ѧ���������',
                    2 => '������������ʹ�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    3 => '���Ǫ��ͧ��ʹ�ǹ������ͻ��¹���',
                    4 => '����������͢�ҧ���ǡѹ������ͧ���Ǣ��仴�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    5 => '������������Ҵ�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    6 => '������Ң�ҧ���ǡѹ������ͧ���Ǣ��仴�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    7 => '��������������Т�ҧ�����˹�觹��Ǣ��仴�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    8 => '����������Ң�ҧ㴢�ҧ˹�觵����˹�觹��Ǣ��仴�ǹ���֧���⤹�������;ԡ�ö֧������������'
                )
            ),
            '�' => '�����§�����秷��ͪ�Դ����',
            '�' => '��д١�ѹ˹ѧ�����ͤ�������蹨������Ѵ �����秷��ͪ�Դ����',
            '�' => '����������������պ����˴��� (Atrophy or Contracture) ���繼������������ǹ˹���������������'
        )
    ),8 => array(
        'title' => '�ä�ͧ���������������мԴ���Ԣͧ���к������',
        'items' => array(
            '�' => '���е��������´�ӧҹ��������ҧ����',
            '�' => '���е������Ҹ����´�ӧҹ��������ҧ����',
            '�' => '���е�������ͧ�Դ�������ҧ����',
            '�' => '����ҹ',
            '�' => '������ǹ (Obesity) ����մѪ�դ������¢ͧ��ҧ��� (BodyMass Index) ����� 35 ���š��������ҧ���â���',
            '�' => '�ä���ͤ����Դ��������ǡѺ���к�������ͧ���ҵ� ������ô����ù�����������·� ��Сô��ҧ ��ʹ�����к���������� ��Դ���� ����Ҩ���ѹ����',
            '�' => '���е��������´�ӧҹ�ҡ�Դ���� (Hyperthyroidism)'
        )
    ),9 => array(
        'title' => '�ä�Դ����',
        'items' => array(
            '�' => '�ä����͹',
            '�' => '�ä��Ҫ�ҧ',
            '�' => '�ä�Դ����������ѧ�����ʴ��ҡ���ع�ç ����������ö�ѡ�������¢Ҵ��'
        )
    ),10 => array(
        'title' => '�ä�ҧ����ҷ�Է��',
        'items' => array(
            '�' => '�Ե��ԭ��Ҫ�� (Mental retardation) ������дѺ����ѭ�� 69 ���� ��ӡ��ҹ��',
            '�' => '�� (Mutism) ���;ٴ������������Ϳѧ��������������ͧ (Aphasia) ��Դ����',
            '�' => '���ѡ (Epilepsy) �����ä����������ҡ�êѡ (Seizures) ���ҧ����',
            '�' => '����ҵ (Paralysis) �ͧᢹ �� ��� ���� ��Ҫ�Դ����',
            '�' => '��ͧ������ (Dementia)',
            '�' => '�ä���ͤ����Դ���Ԣͧ��ͧ������ѹ��ѧ��������Դ�����Դ�������ҧ�ҡ㹡������͹��Ǣͧᢹ���͢����ҧ����',
            '�' => '���������������ѧ���ҧ˹ѡ (Myasthenia Gravis)'
        )
    ),11 => array(
        'title' => '�ä�ҧ�Ե�Ǫ',
        'items' => array(
            '�' => array(
                'name' => '�ä�Ե������ҡ���ع�ç ����������ѧ',
                'attributes' => array(
                    1 => '�ä�Ե��� (Schizophrenia)',
                    2 => '�ä�Ե������ŧ�Դ (Resistant delusional disorder, Induced delusional disorder)',
                    3 => '�äʤԫ��Ϳ�礷ջ (Schizoaffective disorder)',
                    4 => '�ä�Ե����Դ�ҡ�ä�ҧ��� (Other Mental disorder due to brain Damage and Dysfunction)',
                    5 => '�ä�Ե���� (Unspecified nonorganic psychosis)'
                )
            ),
            '�' => array(
                'name' => '�ä�������û�ǹ������ҡ���ع�ç ����������ѧ',
                'attributes' => array(
                    1 => '�ä�������û�ǹ (Manic Episode, Bipolar Affective Disorder)',
                    2 => '�ä�������û�ǹ����Դ�ҡ�ä�ҧ��� (Other Mental Disorder due to brain Damage and Dysfunction to Physical disorder)',
                    3 => '�ä�������û�ǹ���� (Other Mood (Affective)Disorder, Unspecified Mood Disorder)',
                    4 => '�ä�������� (Depressive Depressive Disorder, Recurent Depressive Disorder)'
                )
            ),
            '�' => array(
                'name' => '�ä�Ѳ�ҡ�÷ҧ�Ե�Ǫ',
                'attributes' => array(
                    1 => '�Ե��ԭ��Ҫ�ҷ�����дѺ����ѭ�� 70 ���͵�ӡ��ҹ�� (Mental Retardation)',
                    2 => '�ä���ͤ����Դ����㹡�þѲ�ҡ�âͧ�ѡ�зҧ�ѧ��������� (Pervasive Development)'
                )
            )
        )
    ),12 => array(
        'title' => '�ä����',
        'items' => array(
            '�' => '����� (Hermaphrodism)',
            '�' => '����� (Malignant Neoplasm)',
            '�' => '�Ѻ�ѡ�ʺ������ѧ (Chronic Hepatitis)',
            '�' => '�Ѻ�� (Chrrhosis of Liver)',
            '�' => '����͡ (Albion)',
            '�' => '�ä�ٻ�����Ը���⵫�ʷ�����ҧ��� (Systemic Lupus Eyethematosus)',
            '�' => '����秷�����ҧ��� (Systemic Sclerosis)',
            '�' => array(
                'name' => '�ٻ�Ի�Ե��ҧ� ����',
                'attributes' => array(
                    1 => '��١����',
                    2 => 'ྴҹ���������٧�����������鹾ٴ���Ѵ'
                )
            ),
            '�' => '�ä���˹ѧ�͡��ش��ǼԴ��������Դ��Դ�硴ѡ�� (Lamella Ichthyosis & Congenital Ichthyosiform Erytkroderma)'
        )
    )
);

$set_types = array();
foreach ($types as $main_number => $item_type) {

    if( count($item_type['items']) > 0 ){
        foreach( $item_type['items'] AS $item_number => $item ){

            $item_name = $item;
            $sub_item = false;
            if( is_array($item) === true ){
                $item_name = $item['name'];
                $sub_item = $item['attributes'];
            }
            
            if( $sub_item === false ){
                $sub_item_key = "$main_number.$item_number";
                $set_types[$sub_item_key] = $item_name;
            }

            $json_sub_item = array();
            if( $sub_item !== false ){
                foreach ($sub_item as $last_key => $value) {
                    $last_item_key = "$main_number.$item_number.$last_key";
                    $set_types[$last_item_key] = $value;
                }
            }

        }
    }
}
// dump($set_types);


/**
 * @todo
 * [] ���Ҩҡ��ä���
 * [/] ����ö������ҡ���� �� 7.�.5
 * [] ����ö��������ͤ���� 2 3 ����������ͤ��á���͡����˹
 * [] ����ö���͡��ҡ��¡�÷���ʴ�������
 */

$action = $_POST['action'];
if( $action === "search_val" ){

    $regular = trim($_POST['content_txt']);

    // if ( preg_match('/[�-�]/', $regular) > 0 ) {
        $regular = iconv('UTF-8', 'TIS-620', $regular);
    // }

    foreach ($set_types as $key => $value) {

        $test_match_val = preg_match('/'.addslashes($regular).'/', $value);
        $test_match_key = preg_match('/'.str_replace('.','\.',$regular).'/', $key);
        
        if ( $test_match_val > 0 OR $test_match_key > 0 ) {

            dump($key.':'.$value);
        }

    }

    exit;
}









include "connect.inc";
include "checklogin.php";

?>
<style type="text/css">
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}
.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.font3 {
	font-size: 18px;
}
p{
    margin: 0;
    padding: 0;
}
</style>

<?php
include "dt_menu.php";
include "dt_patient.php";
?>

<div>
    <form action="dt_soldier.php" method="post">
        <div>
            <span>����з�ǧ: </span><input type="text" name="regular" id="regular" style="width: 80%">
        </div>
        <div>
            <button type="submit">�ѹ�֡������</button>
        </div>
    </form>
</div>
<div class="show_list"></div>

<button class="show_detail">�٢����ŷ�����</button>
<div class="full_detail" style="display: none;">
    <?php

    foreach ($types as $main_number => $item_type) {

        $header =  '<p>('.$main_number.') '.$item_type['title'].'</p>';
        echo $header;

        if( count($item_type['items']) > 0 ){
            foreach( $item_type['items'] AS $item_number => $item ){

                $item_name = $item;
                $sub_item = false;
                if( is_array($item) === true ){
                    $item_name = $item['name'];
                    $sub_item = $item['attributes'];
                }
                

                $txt = '<p class="from_full_detail">('.$main_number.') ('.$item_number.') '.$item_name.'</p>';
                if( $sub_item === false ){
                    echo '<a href="javascript:void(0)">'.$txt.'</a>';
                }else if( $sub_item !== false ){
                    echo $txt;
                }

                $json_sub_item = array();
                if( $sub_item !== false ){
                    foreach ($sub_item as $last_key => $value) {
                        echo '<a href="javascript:void(0)"><p class="from_full_detail">('.$main_number.') ('.$item_number.') ('.$last_key.') '.$value.'</p></a>';
                    }
                }

            }
        }
    }
    ?>
</div>

<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
(function( $ ) {
  $(function() {
    $(document).on("click", ".show_detail", function(){
        $(".full_detail").slideToggle("fast");
    });

    $(document).on("keyup", "#regular", function(){

        var txt = $(this).val();
        if( txt.length >= 3 ){
            $.ajax({
                data: {"content_txt": txt,"action":"search_val"},
                // datatype: "json",
                method : "post",
                url: "dt_soldier.php",
                success: function(msg){
                    // console.log(msg);
                    $(".show_list").html(msg);
                }
            });
        }
        
    });

    $(document).on("click", ".from_full_detail", function(){
        var full_detail = $(this).html();
        $("#regular").val(full_detail);
    });

  });
})(jQuery);

</script>