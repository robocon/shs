<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triage Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .patient-info {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .header {
            background-color: #ffeb3b;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h3 {
            margin: 0;
        }

    </style>

    <style>
        .circle_type1 {
            display: inline-block;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background-color: red;
            color: white;
            text-align: center;
            line-height: 50px;
            font-size: 200px;
            padding-top: 110px;
        }
    </style>

    <style>
        @media print {
  body {
    visibility: hidden;
  }
  #card_type1 {
    visibility: visible;
    position: absolute;
    left: 0;
    top: 0;
  }
}
    </style>
</head>
<body>
<div id="main">
<h1 align="center">Triage Form</h1>
<div class="patient-info">

    <form>

        <!----------------------- start ข้อมูลผู้ป่วย -----------------------------------> 
        <div id="f1_data_pt">
        <div class="header">
            <h3><img src="triage_images/patient.png" width="40" height="40"> ข้อมูลผู้ป่วย</h3>
        </div>
        <br>
        <h3>
        <div class="form-group">
            <table width="100%">
                <tr>
                    <td width="120px"> <b>HN :</b> </td>
                    <td><input type="text" class="form-control" id="hn" placeholder="ระบุ HN" required></td>
                </tr>
            </table>
        </div>
        <div id="ajax_Result_PtData"></div>
        </h3>
        </div><!--./f1_data_pt  -->

       <!----------------------- end ข้อมูลผู้ป่วย -----------------------------------> 

       <!----------------------- start สังเกตุอาการ -----------------------------------> 
       <div id="f2_pt_basic" style="display: none;">
        
        <div class="header">
            <h3><img src="triage_images/patient.png" width="40" height="40"> สังเกตุอาการเบื้องต้น</h3>
        </div>
        <br>
        <h3>
        <div class="form-group">
             <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="opserv" id="F2_Alteration_of_conscious" value="Alteration_of_conscious" style="width: 30px;height: 30px;">
                <label class="form-check-label" for="Alteration_of_conscious">Alteration of conscious</label>
            </div>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="opserv" id="F2_Accessory_muscle_usage" value="Accessory muscle usage" style="width: 30px;height: 30px;">
                <label class="form-check-label" for="Accessory_muscle_usage">Accessory muscle usage</label>
            </div>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="opserv" id="F2_Anaphylaxis" value="Anaphylaxis" style="width: 30px;height: 30px;">
                <label class="form-check-label" for="Anaphylaxis">Anaphylaxis</label>
            </div>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="opserv" id="F2_Apnea" value="Apnea" style="width: 30px;height: 30px;">
                <label class="form-check-label" for="Apnea">Apnea (ไม่หายใจ)</label>
            </div>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="opserv" id="F2_Shock" value="Shock" style="width: 30px;height: 30px;">
                <label class="form-check-label" for="Shock">Shock (เหงื่อแตก ตัวเย็น)</label>
            </div>
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="opserv" id="F2_Status_epilepticus" value="Status epilepticus" style="width: 30px;height: 30px;">
                <label class="form-check-label" for="Status epilepticus">Status epilepticus</label>
            </div> 
            <br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="opserv" id="F2_nothing" value="nothing" 
                style="width: 30px;height: 30px;">
                <label class="form-check-label" for="nothing">ไม่มี</label>
            </div>
        </h3>
            
            <br>
            <button type="button" class="btn btn-primary btn-block" onclick="f2_progress();">ถัดไป</button>
            <br>
            <button type="button" class="btn btn-outline-primary btn-block" onclick="f2_back_f1();">ย้อนกลับ</button>
        </div>

        </div><!--./f2_pt_basic  -->
       <!----------------------- end สังเกตุอาการ -----------------------------------> 
    
        </form>
</div><!--./patient-info  -->


</div><!---- . / main ---->

<!----------------------- start card ผู้ป่วยประเภท 1 -----------------------------------> 

    <div id="card_type1" style="display:none" > 
    <h1 align="center">Triage Form</h1>
    <div class="patient-info">
        <div class="row justify-content-center">
            <div class="circle_type1">1</div>
        </div>
        <br>
        <div class="container">
            <h3>
            <table style="table-layout: fixed; width: 100%" border=0>
               <tr>
                  <td width="200px"><b>HN</b></td>
                  <td><font color="blue">string1</font></td>
               </tr>
               <tr>
                  <td width="200px"><b>ชื่อ-นามสกุล</b></td>
                  <td><font color="blue">string2</font></td>
               </tr>
               <tr>
                  <td width="200px"><b>อายุ</b></td>
                  <td><font color="blue">string2</font> ปี</td>
               </tr>
               <tr>
                  <td width="200px"><b>โรคประจำตัว</b></td>
                  <td><font color="blue">string2</font></td>
               </tr>
               <tr>
                  <td width="200px"><b>สิทธิการรักษา</b></td>
                  <td><font color="blue">string2</font></td>
               </tr>
               <tr>
                  <td width="200px"><b>วันที่</b></td>
                  <td><font color="blue">string2</font></td>
               </tr>
               <tr>
                  <td width="200px"><b>เวลา</b></td>
                  <td><font color="blue">string2</font> น.</td>
               </tr>
                <tr >
                  <td width="200px" ><b>มาด้วย</b></td>
                  <td >
                    <br> 
                    <div class="break-word0" style="width:600px">
                    <font color="blue">
                        string2 string2 string2 string2 string2 string2 string2 string2
                        string2 string2 string2 string2 string2 string2 string2 string2
                    </font> 
                    </div>
                  </td>
               </tr>
            </table>

            </h3>
            <br>
            <center><button onclick="window.print()">Print</button></center>
        </div>
    </div>
    </div><!--- card_type1 ---->
    <!----------------------- end card ผู้ป่วยประเภท 1 -----------------------------------> 



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("#hn").change(function() {  
            var hn = $("#hn").val();
            if (hn) {
                $.ajax({
                    type: "POST",
                    url: "Triage_ajax_data_pt.php",
                    data: { hn: hn },
                    success: function(response) { 
                        $('#ajax_Result_PtData').html(response);
                        /*
                        if(response != "" || response != null){
                            let inputString = response; 
                            let parts = inputString.split('|'); 
                            $("#name").val(parts[0]);
                            $("#age").val(parts[1]);
                            $("#disease").val(parts[2]);
                            $("#rights").val(parts[3]); 
                        }else{

                        }//end if
                        */
                    }
                });
            }
        });
    });
</script>

<script type="text/javascript">
    function f2_pt_basic_show(){
        document.getElementById('f1_data_pt').style.display = 'none'; // ซ่อน ข้อมูลผู้ป่วย
        document.getElementById('f2_pt_basic').style.display = 'block'; // แสดง สังเกตุอาการเบื้องต้น
    }//end func



    function f2_progress(){
         
        var Alteration_of_conscious = document.getElementById("F2_Alteration_of_conscious").checked;
        var Accessory_muscle_usage = document.getElementById("F2_Accessory_muscle_usage").checked;
        var Anaphylaxis = document.getElementById("F2_Anaphylaxis").checked;
        var Apnea = document.getElementById("F2_Apnea").checked;
        var Shock = document.getElementById("F2_Shock").checked;
        var Status_epilepticus = document.getElementById("F2_Status_epilepticus").checked;
        var nothing = document.getElementById("F2_nothing").checked;

        if(nothing == true){
            //alert("check nothing");
            //go to next form (f3)
            //
        }else{
             //alert("uncheck nothing");
             

             //hidden f2_pt_basic
             //
             document.getElementById('f2_pt_basic').style.display = 'none'; // ซ่อน สังเกตุอาการเบื้องต้น
             document.getElementById('main').style.display = 'none'; // ซ่อน สังเกตุอาการเบื้องต้น

             //show ผู้ป่วย ประเภท 1 
             //
             document.getElementById('card_type1').style.display = 'block'; // แสดง ผู้ป่วยประเภท 1

        }//end if nothing == true



        //document.getElementById('f2_pt_basic').style.display = 'block'; // แสดง สังเกตุอาการเบื้องต้น
    }//end func



    function f2_back_f1(){
        document.getElementById('f1_data_pt').style.display = 'block'; // แสดง ข้อมูลผู้ป่วย
        document.getElementById('f2_pt_basic').style.display = 'none'; // ซ่อน สังเกตุอาการเบื้องต้น
    }//end func
</script>
</body>
</html>
