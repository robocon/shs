<?php 
require_once 'mb_header.php';

$page = $_REQUEST['page'];
if ( empty($page) ) {
    ?>
    <div class="w3-container w3-text-theme">
        <h2>�к�����Ҽ������</h2>
    </div>
    <div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
    <p>���ѧ���Ƿҧ ����� ;)</p>
    </div>
    <form action="mb_order_drug.php" method="post">
        <section class="w3-container">
            <div>
                <label><b>AN</b></label>
                <input class="w3-input w3-border" type="text" id="an" name="an" placeholder="��͡������ AN �� 63/1">
            </div>
        </section>
        <section class="w3-container">
            <button class="w3-button w3-block w3-teal" type="submit">���͡</button>
            <input type="hidden" name="page" value="searchAn">
        </section>
    </form>
    <?php
}elseif ($page==='searchAn') { 

    $an = input_post('an');
    if (empty($an)) {
        redirect('mb_order_drug.php','�����żԴ��Ҵ');
    }
    $db = Mysql::load();

    $sql = "SELECT * 
    FROM `ipcard` 
    WHERE `an` = '$an' 
    AND `dcdate` = '0000-00-00 00:00:00' ";
    $db->select($sql);
    
    if( $db->get_rows() > 0 ){
        $item = $db->get_item();

        ?>
        <section class="w3-container">
            <p><b>AN : </b><?=$item['an'];?> <b>����-ʡ�� : </b><?=$item['ptname'];?> <b><?=$item['my_ward'];?></b></p>
        </section>
        <section class="w3-container">
            <div>
                <label><b>Drug Name</b></label>
                <input class="w3-input w3-border" type="text" id="drugName" name="drugName">
            </div>
            <div id="drugContent"></div>
            <div>
                <label><b>�Ը���</b></label>
                <input class="w3-input w3-border" type="text" id="an" name="an" placeholder="">
            </div>
            <div>
                <button>�ѹ�֡</button>
            </div>
        </section>
        

        <script> 
        function addEventListener(el, eventName, handler) {
        if (el.addEventListener) {
            el.addEventListener(eventName, handler);
        } else {
            el.attachEvent('on' + eventName, function(){
            handler.call(el);
            });
        }
        }

        addEventListener(document.getElementById('drugName'), 'keyup', function(){

            var drugName = this.value;

            var newSm = new SmHttp();
            newSm.ajax(
                'mb_ajax.php',
                { 'action': 'drugSearch', 'drug_name': drugName },
                function(res){
                    document.getElementById('drugContent').innerHTML = res;
                    document.getElementById('drugContent').style.display = '';
                    // addEventListener(document.getElementByClassName('drugSearchItem'), 'click', function(){
                    //     console.log(this.getAttribute('data-drug'));
                    // });

                    var el = document.getElementsByClassName('drugSearchItem');
                    for (var i=0; i < el.length; i++) {
                        // Here we have the same onclick
                        el.item(i).onclick = function(){
                            console.log(this.getAttribute('data-drug'));
                            // document.getElementById('VACCINETYPE').value = this.getAttribute('data');
                            // document.getElementById('epi198').innerHTML = '';

                            document.getElementById('drugName').value = this.getAttribute('data-drug');
                            document.getElementById('drugContent').style.display = 'none';
                        };
                    }

                }
            );

        });
        </script>
        <?php

    }else{
        redirect('mb_order_drug.php','������ D/C ���º�������Ǩ�� ��سһ���ҹ��ͧ��������Ẻ���');
    }

    
}


require_once 'mb_footer.php';
?>