/*
�к����Է��͹�Ź��ҹ ucAuthen4.x ���� IE �ջѭ������ö����������价��
Internet Options > Security > Internet > Custom level... 
������� Miscellaneous 
1. Access data sources across domains �Դ Enable
2. Allow META REFRESH �Դ Enable
3. Allow scripting of Microsoft web browser control �Դ Enable
*/
function checkPtRight(link, ev, hn){

    // ���������Ǩ�١�͹��� include ��� templates/classic/main.js �������ѧ
    var newSm = new SmHttp();
    newSm.ajax(
        'http://192.168.1.43/index.php',
        { "hn": hn },
        function(res){
            var txt = JSON.parse(res);
            if (txt.ws_status === "NHSO-00003") {
                alertTxt = txt.ws_status_desc+"\n��س��Դ��ҹ����� nhsoauthen4.x ��͹�����ҹ��Ǩ�ͺ�Է���͹�Ź�";

            }else{
            
                var subInScl, hMain, hMainOp, hSub, mainInScl, alertTxt = '';
                var title = '';
                if (parseInt(txt.title)==1) {
                    title = '�.�.';
                }else if(parseInt(txt.title)==2){
                    title = '�.�.';
                }else if(parseInt(txt.title)==3){
                    title = '���';
                }else if(parseInt(txt.title)==4){
                    title = '�.�.';
                }else if(parseInt(txt.title)==5){
                    title = '�ҧ';
                }

                alertTxt += "## ��������ǹ�ؤ�� ����Է�Է�����ԡ ##"+"\n";
                alertTxt += "�Ţ�ѵû�ЪҪ� : "+txt.person_id+"\n";
                alertTxt += "����-ʡ�� : "+title+txt.fname+" "+txt.lname+"\n";
                alertTxt += "�.�.�.�Դ : "+txt.birthdate.substring(6, 8)+"/"+txt.birthdate.substring(4, 6)+"/"+txt.birthdate.substring(0, 4)+"    ";

                if(txt.sex==1){
                    alertTxt += "�� : ���\n";
                }else{
                    alertTxt += "�� : ˭ԧ\n";
                }

                if( txt.status !== undefined ){
                    
                    var ptstatus = '';
                    if (parseInt(txt.status)==1) {
                        ptstatus = '�ժ�������������¹��ҹ�ࢵ�Ѻ�Դ�ͺ��������ԧ';
                    }else if(parseInt(txt.status)==2){
                        ptstatus = '�ժ�������������¹��ҹ�ࢵ�Ѻ�Դ�ͺ������������ԧ';
                    }else if(parseInt(txt.status)==3){
                        ptstatus = '������������ࢵ�Ѻ�Դ�ͺ�����¹��ҹ����͡ࢵ�Ѻ�Դ�ͺ';
                    }else if(parseInt(txt.status)==4){
                        ptstatus = '������������͡ࢵ�Ѻ�Դ�ͺ���������Ѻ��ԡ��';
                    }else if(parseInt(txt.status)==5){
                        ptstatus = '��������ࢵ�Ѻ�Դ�ͺ�����������������¹��ҹ�ࢵ�Ѻ�Դ�ͺ �� �������͹ ����շ��ѡ����� �繵�';
                    }

                    alertTxt += "ʶҹ��Ҿ�ؤ�� : "+ptstatus+"\n";
                }

                alertTxt += "\n";

                if( txt.maininscl !== undefined ){
                    if( txt.maininscl_name !== undefined ){
                        alertTxt += "�Է����ѡ㹡���Ѻ��ԡ�� : "+txt.maininscl+" "+txt.maininscl_name+"\n";
                    }

                    if( txt.subinscl_name !== undefined){
                        alertTxt += "�������Է������ : "+txt.subinscl+" "+txt.subinscl_name+"\n";
                    }

                    if( txt.cardid !== undefined){
                        alertTxt += "���ʺѵ� : "+txt.cardid+"\n";
                    }

                    if( txt.startdate !== undefined){
                        alertTxt += "�ѹ�������� : "+txt.startdate.substring(6, 8)+"/"+txt.startdate.substring(4, 6)+"/"+txt.startdate.substring(0, 4)+"\n";
                    }

                    if( txt.expdate !== undefined){
                        alertTxt += "�ѹ�������Է�� : "+txt.expdate.substring(6, 8)+"/"+txt.expdate.substring(4, 6)+"/"+txt.expdate.substring(0, 4)+"\n";
                    }

                    if( txt.purchaseprovince_name !== undefined){
                        alertTxt += "�ѧ��Ѵ���ŧ����¹ : "+txt.purchaseprovince_name+"\n";
                    }

                    if( txt.hsub_name !== undefined){
                        alertTxt += "˹��º�ԡ�û������ : "+txt.hsub+" "+txt.hsub_name+"\n";
                    }

                    if( txt.hmain_name !== undefined){
                        alertTxt += "˹��º�ԡ�÷���Ѻ�� : "+txt.hmain+" "+txt.hmain_name+"\n";
                    } 

                    if( txt.hmain_op_name !== undefined){
                        alertTxt += "˹��º�ԡ�û�Ш� : "+txt.hmain_op+" "+txt.hmain_op_name+"\n";
                    } 
                    
                }else if( txt.new_maininscl !== undefined ){

                    if( txt.new_maininscl_name !== undefined ){
                        alertTxt += "�Է����ѡ㹡���Ѻ��ԡ�� : "+txt.new_maininscl+" "+txt.new_maininscl_name+"\n";
                    }

                    if( txt.new_subinscl_name !== undefined){
                        alertTxt += "�������Է������ : "+txt.new_subinscl+" "+txt.new_subinscl_name+"\n";
                    }

                    if( txt.new_type_register !== undefined){
                        alertTxt += "���������ŧ����¹���� : "+txt.new_type_register_desc+"\n";
                    }

                    if( txt.new_startdate !== undefined){
                        alertTxt += "�ѹ�������� : "+txt.new_startdate.substring(6, 8)+"/"+txt.new_startdate.substring(4, 6)+"/"+txt.new_startdate.substring(0, 4)+"\n";
                    }

                    if( txt.new_expdate !== undefined){
                        alertTxt += "�ѹ�������Է�� : "+txt.new_expdate.substring(6, 8)+"/"+txt.new_expdate.substring(4, 6)+"/"+txt.new_expdate.substring(0, 4)+"\n";
                    }

                    if( txt.new_purchaseprovince_name !== undefined){
                        alertTxt += "�ѧ��Ѵ���ŧ����¹ : "+txt.new_purchaseprovince_name+"\n";
                    }

                    if( txt.new_hsub_name !== undefined){
                        alertTxt += "˹��º�ԡ�û������ : "+txt.new_hsub+" "+txt.new_hsub_name+"\n";
                    } 

                    if( txt.new_hmain_name !== undefined){
                        alertTxt += "˹��º�ԡ�÷���Ѻ�� : "+txt.new_hmain+" "+txt.new_hmain_name+"\n";
                    } 

                    if( txt.new_hmain_op_name !== undefined){
                        alertTxt += "˹��º�ԡ�û�Ш� : "+txt.new_hmain_op+" "+txt.new_hmain_op_name+"\n";
                    } 
                }
                
            }
            
            alert(alertTxt);
        },
        false // true is Syncronous and false is Assyncronous (Default by true)
    );
}