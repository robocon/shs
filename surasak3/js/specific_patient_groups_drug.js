async function sendForm(url, dataPost){
	let response = await fetch(url, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
		},
		body: dataPost
	});
	const body = await response.json();
	return body;
}

function cancelBtnForm(){
	resetLeftForm();
	closePreg();
}

/**
 * แบบฟอร์ม MRA
 * @param {*} drugcode 
 */
async function checkMRA(drugcode){ // 1FINE
	
	const htmlTxt = `<div style="width: 600px; height: 400px;">
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA1" name="detail[]" value="MRA1"><label for="inputMRA1">1.) CKD w DM(ชะลอไตเสื่อมผู้ป่วย DM)</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA2" name="detail[]" value="MRA2"><label for="inputMRA2">2.) มีระดับ k<sup>+</sup> ไม่เกิน 5 mEq/L</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA3" name="detail[]" value="MRA3"><label for="inputMRA3">3.) ไม่มีภาวะ adrenal insufficiency</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA4" name="detail[]" value="MRA4"><label for="inputMRA4">4.) ระดับ eGFR > 25 ml/min/1.73m<sup>3</sup></label></p>
		<p style="text-align: center;">
			<button type="button" onclick="confirmMRA('${drugcode}')" class="button">ยืนยันการสั่งใช้</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
			<input type="hidden" name="criteria" id="criteria" value="Mineralocorticoid receptor antagonist (MRA)">
		</p>
	</div>`;
	
	document.getElementById("pregHeader").innerHTML = '[RDU] Mineralocorticoid receptor antagonist (MRA)';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	
	document.getElementById("pregCloseBtn").style.display = "none";// ซ่อนปุ่มเอาไว้ก่อน
	document.getElementById("pregBackground").style.display = "";
	document.getElementById("pregContainer").style.display = "";

	// document.getElementById("pregContainer").style.height = "350px";

}

/**
 * 
 * @param {*} drugcode 
 * @returns 
 */
async function confirmMRA(drugcode){
	const mraItems = document.querySelectorAll('.inputMRA');
	let mraCount = 0;
	for (let i = 0; i < mraItems.length; i++) {
		if (mraItems[i].checked===true) {
			mraCount++;
		}
	}

	if(mraCount !== 4) {
		Swal.fire({
			title: 'แจ้งเตือน',
			text: 'กรุณาเลือกเหตุผลการสั่งใช้ยาให้ครบ 4 ข้อ',
			icon: 'warning',
			allowOutsideClick: false
		});
		return false;
	}else{

		let formData = new FormData();
		formData.append("action", 'save');
		formData.append("criteria", 'Mineralocorticoid receptor antagonist (MRA)');
		formData.append("criteriaCode", 'MRA');
		formData.append("drugcode", drugcode);
		formData.append("hn", hn);
		formData.append("doctor", doctor);
		formData.append("title[]", 'MRA');
		formData.append("MRA[]", 'MRA1');
		formData.append("MRA[]", 'MRA2');
		formData.append("MRA[]", 'MRA3');
		formData.append("MRA[]", 'MRA4');

		const postData = new URLSearchParams(formData).toString();
		
		sendForm('doctor_medical.php',postData).then((res)=>{
			if(res.status === 200){
				Swal.fire({
					title: 'สำเร็จ',
					text: res.message,
					icon: 'success',
					allowOutsideClick: false
				});
                setCookie(res.cookieName, res.cookieData); // บันทึก cookie 

			}else{
				Swal.fire({
					title: 'แจ้งเตือน',
					text: res.message,
					icon: 'warning',
					allowOutsideClick: false
				});
			}
		});
		
		closePreg();
	}
}

async function checkLipidDrug(drugcode){ // 1EPAD  1SEMA
	
	const htmlTxt = `<div style="width: 600px; height: 400px;">
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<p><input type="checkbox" class="inputLipid" id="inputLipid1" name="detail[]" value="LIPID1"><label for="inputLipid1">1.) เกิด DI หรือไม่สามารถใช้ยา fibrates ได้เมื่อ TG > 500 mg/dl</label></p>
		<p><input type="checkbox" class="inputLipid" id="inputLipid2" name="detail[]" value="LIPID2"><label for="inputLipid2">2.) ผู้ป่วย DM 40ปีขึ้นไปที่คุม LDL-Cได้ แต่ยังมีTriglycerides = 150-499 mg/dl</label></p>
		<p><input type="checkbox" class="inputLipid" id="inputLipid3" name="detail[]" value="LIPID3"><label for="inputLipid3">3.) ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl</label></p>
		<p style="text-align: center;">
			<button type="button" onclick="confirmLipidDrug('${drugcode}')" class="button">ยืนยันการสั่งใช้</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
			<input type="hidden" name="criteria" id="criteria" value="Other lipid-regulating drug">
		</p>
	</div>`;
	
	document.getElementById("pregHeader").innerHTML = '[RDU] Other lipid-regulating drug';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	
	document.getElementById("pregCloseBtn").style.display = "none";// ซ่อนปุ่มเอาไว้ก่อน
	document.getElementById("pregBackground").style.display = "";
	document.getElementById("pregContainer").style.display = "";

	// document.getElementById("pregContainer").style.height = "300px";
}

async function confirmLipidDrug(drugcode){
	const lipidItem = document.querySelectorAll('.inputLipid');
	let formData = new FormData();
	let lipidCount = 0;
	for (let i = 0; i < lipidItem.length; i++) {
		if (lipidItem[i].checked===true) {
			formData.append("LIPID[]", lipidItem[i].value);
			lipidCount++;
		}
	}

	if(lipidCount < 1){
		Swal.fire({
			title: 'แจ้งเตือน',
			text: 'กรุณาเลือกเหตุผลการสั่งใช้ยาอย่างน้อย 1 ข้อ',
			icon: 'warning',
			allowOutsideClick: false
		});
		return false;
	}

	formData.append("action", 'save');
	formData.append("criteria", 'Other lipid-regulating drug');
	formData.append("criteriaCode", 'LIPID');
	formData.append("title[]", 'LIPID');
	formData.append("drugcode", drugcode);
	formData.append("hn", hn);
	formData.append("doctor", doctor);
	
	const postData = new URLSearchParams(formData).toString();
	sendForm('doctor_medical.php',postData).then((res)=>{
		if(res.status === 200){
			Swal.fire({
				title: 'สำเร็จ',
				text: res.message,
				icon: 'success',
				allowOutsideClick: false
			});

            setCookie(res.cookieName, res.cookieData); // บันทึก cookie 

		}else{
			Swal.fire({
				title: 'แจ้งเตือน',
				text: res.message,
				icon: 'warning',
				allowOutsideClick: false
			});
		}
	});

	closePreg();
}

async function checkAdreno(drugcode){ // 7BREZ
    const htmlTxt = `<div style="width: 600px; height: 400px;">
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<p><input type="checkbox" class="inputAdreno" id="inputAdreno1" name="detail[]" value="ADRENO1"><label for="inputAdreno1">1.) เป็น COPD ความรุนแรงระดับ E</label></p>
		<p><input type="checkbox" class="inputAdreno" id="inputAdreno2" name="detail[]" value="ADRENO2"><label for="inputAdreno2">2.) มีระดับ eosinophil > 300 cell/µl</label></p>
		<p style="text-align: center;">
			<button type="button" onclick="confirmAdreno('${drugcode}')" class="button">ยืนยันการสั่งใช้</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
			<input type="hidden" name="criteria" id="criteria" value="Adrenoceptor agonists">
		</p>
	</div>`;
	
	document.getElementById("pregHeader").innerHTML = '[RDU] Adrenoceptor agonists';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	
	document.getElementById("pregCloseBtn").style.display = "none";// ซ่อนปุ่มเอาไว้ก่อน
	document.getElementById("pregBackground").style.display = "";
	document.getElementById("pregContainer").style.display = "";
}

function confirmAdreno(drugcode){
    const adrenoITem = document.querySelectorAll('.inputAdreno');
	let adenoCount = 0;
	for (let i = 0; i < adrenoITem.length; i++) {
		if (adrenoITem[i].checked===true) {
			adenoCount++;
		}
	}

	if(adenoCount < 2){
		Swal.fire({
			title: 'แจ้งเตือน',
			text: 'กรุณาเลือกเหตุผลการสั่งใช้ยาให้ครบ 2 ข้อ',
			icon: 'warning',
			allowOutsideClick: false
		});
		return false;
	}

    let formData = new FormData();
    formData.append("action", 'save');
    formData.append("criteria", 'Adrenoceptor agonists');
	formData.append("criteriaCode", 'ADRENO');
    formData.append("drugcode", drugcode);
    formData.append("hn", hn);
    formData.append("doctor", doctor);
	formData.append("title[]", 'ADRENO');
    formData.append("detail[]", 'ADRENO1');
    formData.append("detail[]", 'ADRENO2');

    const postData = new URLSearchParams(formData).toString();
	sendForm('doctor_medical.php',postData).then((res)=>{

		let resIcon, resText, tiresTitletle = '';

		if(res.status === 200){
			resText = res.message;
			resTitle = 'สำเร็จ';
			resIcon = 'success';
			
		}else{
			resText = res.message;
			resTitle = 'แจ้งเตือน';
			resIcon = 'warning';

		}

		Swal.fire({
			title: resTitle,
			text: resText,
			icon: resIcon,
			allowOutsideClick: false
		});

	});
	
	closePreg();
}

async function checkDiabetes(drugcode){ // 2SEMA  2DULA  2EVO
    const htmlTxt = `<div style="width: 600px; height: 400px;">
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<p><input type="checkbox" class="inputDiabetes" id="inputDiabetes1" name="detail[]" value="DIABETES1"><label for="inputDiabetes1">1.) คนไข้ DM มี BMI &gt; 30</label></p>
		<p><input type="checkbox" class="inputDiabetes" id="inputDiabetes2" name="detail[]" value="DIABETES2"><label for="inputDiabetes2">2.) คนไข้ DM ที่มีภาวะ/ความเสี่ยงสูงที่จะเป็น MI, Stroke, ASCVD</label></p>
		<p><input type="checkbox" class="inputDiabetes" id="inputDiabetes3" name="detail[]" value="DIABETES3"><label for="inputDiabetes3">3.) คนไข้ DM มีภาวะ CKD eGFR &lt; 60 ml/min/7.13m2 หรือ ACR ≥ 30 mg/g</label></p>
		<p><input type="checkbox" class="inputDiabetes" id="inputDiabetes4" name="detail[]" value="DIABETES4"><label for="inputDiabetes4">4.) คนไข้ DM หรือ obesity ที่มีความเสี่ยงสูงในภาวะ MASLD</label></p>
		<p style="text-align: center;">
			<button type="button" onclick="confirmDiabetes('${drugcode}')" class="button">ยืนยันการสั่งใช้</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
			<input type="hidden" name="criteria" id="criteria" value="Drug use in diabetes">
		</p>
	</div>`;
	
	document.getElementById("pregHeader").innerHTML = '[RDU] Drug use in diabetes';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	
	document.getElementById("pregCloseBtn").style.display = "none";// ซ่อนปุ่มเอาไว้ก่อน
	document.getElementById("pregBackground").style.display = "";
	document.getElementById("pregContainer").style.display = "";
}

async function confirmDiabetes(drugcode){

    const diabetesItem = document.querySelectorAll('.inputDiabetes');
	let formData = new FormData();
	let diabetesCount = 0;
	for (let i = 0; i < diabetesItem.length; i++) {
		if (diabetesItem[i].checked===true) {
			formData.append("DIABETES[]", diabetesItem[i].value);
			diabetesCount++;
		}
	}

	if(diabetesCount < 1){
		Swal.fire({
			title: 'แจ้งเตือน',
			text: 'กรุณาเลือกเหตุผลการสั่งใช้ยาอย่างน้อย 1 ข้อ',
			icon: 'warning',
			allowOutsideClick: false
		});
		return false;
	}

    formData.append("action", 'save');
	formData.append("criteria", 'Drug use in diabetes');
	formData.append("criteriaCode", 'DIABETES');
	formData.append("title[]", 'DIABETES');
	formData.append("drugcode", drugcode);
	formData.append("hn", hn);
	formData.append("doctor", doctor);

    const postData = new URLSearchParams(formData).toString();
	sendForm('doctor_medical.php',postData).then((res)=>{
		if(res.status === 200){
			Swal.fire({
				title: 'สำเร็จ',
				text: res.message,
				icon: 'success',
				allowOutsideClick: false
			});

            setCookie(res.cookieName, res.cookieData); // บันทึก cookie
            
		}else{
			Swal.fire({
				title: 'แจ้งเตือน',
				text: res.message,
				icon: 'warning',
				allowOutsideClick: false
			});
		}
	});
	
	closePreg();
}

/**
 * ดึงแบบฟอร์มมาให้หมอกรอกข้อมูล
 * @param {*} drugcode 
 * @param {*} criteriaCode 
 * @param {*} criteria 
 */
async function checkInclisiran(hn, drugcode, criteriaCode, criteria){

	const response = await fetch('inclisiran_form.php');
	let body = await response.text();

	body = body.replace('{{drugcode}}',drugcode);
	body = body.replace('{{criteriaCode}}',criteriaCode);
	body = body.replace('{{criteria}}',criteria);

	document.getElementById("pregHeader").innerHTML = '[RDU] Inclisiran และ Evolocumab';
	document.getElementById("pregContent").innerHTML = body;
	
	document.getElementById("pregCloseBtn").style.display = "none";// ซ่อนปุ่มเอาไว้ก่อน
	document.getElementById("pregBackground").style.display = "";
	document.getElementById("pregContainer").style.display = "";

}

async function checkInclisiran_old(drugcode){ // 2INC
    const htmlTxt = `<div>
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<div>
			<input type="checkbox" onclick="clickInclisiran()" class="inputInclisiran" id="inputInclisiran1" name="detail[]" value="INCIL1"><label for="inputInclisiran1">1.) ผู้ป่วย DM ที่มีความเสี่ยงสูง (ประเมิณโรคเบาหวานที่มีความเสี่ยงสูง) ที่มี LDL-C สูงและไม่มีโรคหัวใจ ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl</label>
			<div style="display:none;" id="subIncli1">
				<ul>
					<li><input type="checkbox" class="subDetail1" id="sub_detail1" name="sub_detail[]" value="INCIL1_1"><label for="sub_detail1">1.1) Target organ damage</label></li>
					<li><input type="checkbox" class="subDetail1" id="sub_detail2" name="sub_detail[]" value="INCIL1_2"><label for="sub_detail2">1.2) เป็นมานาน ≥10ปี</label></li>
					<li>
						<input type="checkbox" class="subDetail1" id="sub_detail3" name="sub_detail[]" value="INCIL1_3"><label for="sub_detail3">1.3) มีความเสี่ยงอื่นๆ เพิ่มเติม ได้แก่</label>
						<ul>
							<li>- มี subclinical atherosclerosis เช่น Coronary calcium score ≥1,000</li>
							<li>- ประวัติครอบครัวมี premature atherosclerosis ผู้หญิงอายุ &lt;55 ปี ผู้ชายอายุ &lt;45 ปี</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div>
			<input type="checkbox" onclick="clickInclisiran2()" class="inputInclisiran" id="inputInclisiran2" name="detail[]" value="INCIL2"><label for="inputInclisiran2">2.) ผู้ป่วยโรคคอเลสเตอรอลสูงทางพันธุกรรม (ประเมิณตาม Dutch Lipid Clinic Network Criteria ≥ 6) (familial hypercholesterolemia) ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl</label>
			<div style="display:none;" id="subIncli2">
				<table style="width:80%; margin: 0 auto;">
					<tr>
						<td colspan="3" style="text-align:center; font-weight:bold;">เกณฑ์การวินิจฉัยโรคคอเลสเตอรอลสูงทางพันธุกรรมหรือ Familial Hypercholesterolemia (FH)<br>ใช้ตาม Dutch Lipid Clinic Network Criteria โดยมีคะแนนมากกว่าหรือเท่ากับ 6</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bold;">Dutch Lipid Clinic Network Criteria</td>
						<td>Points</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group1: Family history</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="1" id="incil2_1" name="sub_detail[]" value="INCIL2_1"></td>
						<td><label for="incil2_1">First-degree relative with known premature (<55 years, men; &lt;60 years, women) coronary heart disease (CHD) OR First-degree relative with known LDL cholesterol &gt;95th percentile by age and gender for country</label></td>
						<td align="center">1</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="2" id="incil2_2" name="sub_detail[]" value="INCIL2_2"></td>
						<td><label for="incil2_2">First-degree relative with tendon xanthoma and/or corneal arcus OR Child(ren) &lt;18 years with LDL cholesterol &gt; 95th percentile by age and gender for country</label></td>
						<td align="center">2</td>
					</tr>
					<tr valign="top">
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group2: Clinical history</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="2" id="incil2_3" name="sub_detail[]" value="INCIL2_3"></td>
						<td><label for="incil2_3">Subject has premature  (&lt;55 years, men; &lt;60 years, women) CHD</label></td>
						<td align="center">2</td>
					</tr>
					<tr>
						<td><input type="checkbox" class="subDetail2" data-score="1" id="incil2_4" name="sub_detail[]" value="INCIL2_4"></td>
						<td><label for="incil2_4">Subject has premature (&lt;55 years, men; &lt;60 years, women) cerebral or peripheral vascular disease</label></td>
						<td align="center">1</td>
					</tr>
					<tr valign="top">
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group 3: Physical examination</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="6" id="incil2_5" name="sub_detail[]" value="INCIL2_5"></td>
						<td><label for="incil2_5">Tendon xanthoma</label></td>
						<td align="center">6</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="4" id="incil2_6" name="sub_detail[]" value="INCIL2_6"></td>
						<td><label for="incil2_6">Corneal arcus in a person &lt;45 years</label></td>
						<td align="center">4</td>
					</tr>
					<tr valign="top">
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group 4: Biochemical results (LDL cholesterol)</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="8" id="incil2_7" name="sub_detail[]" value="INCIL2_7"></td>
						<td><label for="incil2_7">&gt; 8.5 mmol/L (&gt;325 mg/dL)</label></td>
						<td align="center">8</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="5" id="incil2_8" name="sub_detail[]" value="INCIL2_8"></td>
						<td><label for="incil2_8">6.5 – 8.4 mmol/L (251-325 mg/dL)</label></td>
						<td align="center">5</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="3" id="incil2_9" name="sub_detail[]" value="INCIL2_9"></td>
						<td><label for="incil2_9">5.0 – 6.4 mmol/L (191-250 mg/dL)</label></td>
						<td align="center">3</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="1" id="incil2_10" name="sub_detail[]" value="INCIL2_10"></td>
						<td><label for="incil2_10">4.0 – 4.9 mmol/L (155-190 mg/dL)</label></td>
						<td align="center">1</td>
					</tr>
					<tr valign="top">
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group 5: Molecular genetic testing (DNA analysis)</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="8" id="incil2_11" name="sub_detail[]" value="INCIL2_11"></td>
						<td><label for="incil2_11">Causative mutation shown in the LDLR, APOB, or PCSK9 genes</label></td>
						<td align="center">8</td>
					</tr>
				</table>
			</div>
		</div>
		<p><input type="checkbox" class="inputInclisiran" id="inputInclisiran3" name="detail[]" value="INCIL3"><label for="inputInclisiran3">3.) เกิดผลข้างเคียงจากยากลุ่ม statin ไม่สามารถทนต่อผลข้างเคียงได้</label></p>
		<p style="text-align: center;">
			<button type="button" onclick="confirmInclisiran('${drugcode}')" class="button">ยืนยันการสั่งใช้</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
			<input type="hidden" name="criteria" id="criteria" value="Inclisiran">
		</p>
	</div>`;
	
	document.getElementById("pregHeader").innerHTML = '[RDU] Inclisiran (Sybrava 284 mg)';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	
	document.getElementById("pregCloseBtn").style.display = "none";// ซ่อนปุ่มเอาไว้ก่อน
	document.getElementById("pregBackground").style.display = "";
	document.getElementById("pregContainer").style.display = "";
}

function clickINC1(){
	if(document.getElementById('inputInclisiran1').checked===true){
		document.getElementById('subIncli1').style.display='';
	}else{
		document.getElementById('subIncli1').style.display='none';
	}
}

function clickINC2(){
	if(document.getElementById('inputInclisiran2').checked===true){
		document.getElementById('subIncli2').style.display='';
	}else{
		document.getElementById('subIncli2').style.display='none';
	}
}

function clickINC3(){
	if(document.getElementById('inputInclisiran3').checked===true){
		document.getElementById('subIncli3').style.display='';
	}else{
		document.getElementById('subIncli3').style.display='none';
	}
}

function clickINC4(){
	if(document.getElementById('inputInclisiran4').checked===true){
		document.getElementById('subIncli4').style.display='';
	}else{
		document.getElementById('subIncli4').style.display='none';
	}
}

function confirmInclisiran(drugcode, criteriaCode, criteria){

	const incliItem = document.querySelectorAll('.inputInclisiran');
	let formData = new FormData();
	let incliCount = 0;
	for (let i = 0; i < incliItem.length; i++) {
		const el = incliItem[i];
		if (el.checked===true) { 
			formData.append(el.getAttribute('name'), el.value);
			incliCount++;
		}
	}

	if(incliCount===0){
		Swal.fire({
			title: "กรุณาเลือกเกณฑ์ประเมินอย่างน้อย 1ข้อ",
			icon: 'warning',
			allowOutsideClick: false
		});
		return false;
	}

	if(document.getElementById('inputInclisiran1').checked===true){
		let detail1 = document.querySelectorAll('.detail1');
		let detail1Checked = false;
		let score = 0;
		for (let index = 0; index < detail1.length; index++) {
			const el = detail1[index];

			let itemScore = el.getAttribute("data-score");
			if(el.checked === true){
				score += parseInt(itemScore);
				detail1Checked = true;
			}
		}
		
		if(detail1Checked===false){
			Swal.fire({title:"กรุณาเลือกเกณฑ์การประเมินในข้อที่1", icon: "warning"});
			return false;
		}else{
			if(score<=6){
				Swal.fire({title:"คะแนนรวมในเกณฑ์ข้อที่1 ต้องมากกว่า 6", icon: "warning"});
				return false;
			}
		}
		formData.append("title[]", "INCIL1");
	}

	if(document.getElementById('inputInclisiran2').checked===true){
		let detail2 = document.querySelectorAll('.detail2');
		let detail2Checked = false;
		for (let index = 0; index < detail2.length; index++) {
			const el = detail2[index];
			if(el.checked === true){
				detail2Checked = true;
			}
		}
		if(detail2Checked===false){
			Swal.fire({title:"กรุณาเลือกเกณฑ์การประเมินในข้อที่2", icon: "warning"});
			return false;
		}

		formData.append("title[]", "INCIL2");
	}

	if(document.getElementById('inputInclisiran3').checked===true){
		let detail3 = document.querySelectorAll('.detail3');
		let detail3Checked = false;
		for (let index = 0; index < detail3.length; index++) {
			const el = detail3[index];
			if(el.checked === true){
				detail3Checked = true;
			}
		}
		if(detail3Checked===false){
			Swal.fire({title:"กรุณาเลือกเกณฑ์การประเมินในข้อที่3", icon: "warning"});
			return false;
		}else{
			if(document.getElementById('inputInclisiran4').checked===false){
				Swal.fire({title:"เกณฑ์การประเมินต้องทำควบคู่กับข้อ4", icon: "warning"});
				return false;
			}
		}

		formData.append("title[]", "INCIL3");
	}

	if(document.getElementById('inputInclisiran4').checked===true){
		let detail4 = document.querySelectorAll('.detail4');
		let detail4Checked = false;
		for (let index = 0; index < detail4.length; index++) {
			const el = detail4[index];
			if(el.checked === true){
				detail4Checked = true;
			}
		}

		if(detail4Checked===false){
			Swal.fire({title:"กรุณาเลือกเกณฑ์การประเมินในข้อที่4", icon: "warning"});
			return false;
		}

		formData.append("title[]", "INCIL4");
	}

	formData.append("action", 'save');
	formData.append("criteria", criteria);
	formData.append("criteriaCode", criteriaCode);
	formData.append("drugcode", drugcode);
	// hn กับ doctor ถูกประกาศไว้แล้วใน dt_drug.php
	formData.append("hn", hn);
	formData.append("doctor", doctor);

	const postData = new URLSearchParams(formData).toString();
	sendForm('doctor_medical.php',postData).then((res)=>{
		if(res.status === 200){
			Swal.fire({
				title: 'สำเร็จ',
				text: res.message,
				icon: 'success',
				allowOutsideClick: false
			});

            setCookie(res.cookieName, res.cookieData); // บันทึก cookie
            
		}else{
			Swal.fire({
				title: 'แจ้งเตือน',
				text: res.message+':'+res.error,
				icon: 'warning',
				allowOutsideClick: false
			});
		}
	});
	
	closePreg();
}