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

async function checkMRA(drugcode){ // 1FINE
	
	const htmlTxt = `<div>
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA1" name="inputMRA[inputMRA1]" value="CKD w DM(ชะลอไตเสื่อมผู้ป่วย DM)"><label for="inputMRA1">CKD w DM(ชะลอไตเสื่อมผู้ป่วย DM)</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA2" name="inputMRA[inputMRA2]" value="มีระดับ k+ ไม่เกิน 5 mEq/L"><label for="inputMRA2">มีระดับ k<sup>+</sup> ไม่เกิน 5 mEq/L</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA3" name="inputMRA[inputMRA3]" value="ไม่มีภาวะ adrenal insufficiency"><label for="inputMRA3">ไม่มีภาวะ adrenal insufficiency</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA4" name="inputMRA[inputMRA4]" value="ระดับ eGFR > 25 ml/min/1.73m3"><label for="inputMRA4">ระดับ eGFR > 25 ml/min/1.73m<sup>3</sup></label></p>
		<p>
			<button type="button" onclick="confirmMRA('${drugcode}')" class="button">ยืนยันการสั่งใช้</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
			<input type="hidden" name="criteria" id="criteria" value="Mineralocorticoid receptor antagonist (MRA)">
		</p>
	</div>`;
	
	document.getElementById("pregHeader").innerHTML = '[RDU] Mineralocorticoid receptor antagonist (MRA)';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	
	document.getElementById("pregCloseBtn").style.display = "none";// ซ่อนปุ่มเอาไว้ก่อน
	document.getElementById("pregBackground").style.display = "";
	document.getElementById("pregContainer").style.display = "";

}

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
		formData.append("drugcode", drugcode);
		formData.append("hn", hn);
		formData.append("doctor", doctor);
		formData.append("detail[]", 'CKD w DM(ชะลอไตเสื่อมผู้ป่วย DM)');
		formData.append("detail[]", 'มีระดับ k+ ไม่เกิน 5 mEq/L');
		formData.append("detail[]", 'ไม่มีภาวะ adrenal insufficiency');
		formData.append("detail[]", 'ระดับ eGFR > 25 ml/min/1.73m3');

		const postData = new URLSearchParams(formData).toString();
		
		sendForm('doctor_medical.php',postData).then((res)=>{
			if(res.status === 200){
				Swal.fire({
					title: 'สำเร็จ',
					text: res.message,
					icon: 'success',
					allowOutsideClick: false
				});

                setCookie(mraCookieName, '1'); // บันทึก cookie 

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
	
	const htmlTxt = `<div>
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<p><input type="checkbox" class="inputLipid" id="inputLipid1" name="inputLipid[inputLipid1]" value="เกิด DI หรือไม่สามารถใช้ยา fibrates ได้เมื่อ TG > 500 mg/dl"><label for="inputLipid1">เกิด DI หรือไม่สามารถใช้ยา fibrates ได้เมื่อ TG > 500 mg/dl</label></p>
		<p><input type="checkbox" class="inputLipid" id="inputLipid2" name="inputLipid[inputLipid2]" value="ผู้ป่วย DM 40ปีขึ้นไปที่คุม LDL-Cได้ แต่ยังมีTriglycerides = 150-499 mg/dl"><label for="inputLipid2">ผู้ป่วย DM 40ปีขึ้นไปที่คุม LDL-Cได้ แต่ยังมีTriglycerides = 150-499 mg/dl</label></p>
		<p><input type="checkbox" class="inputLipid" id="inputLipid3" name="inputLipid[inputLipid3]" value="ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70-100 mg/dl"><label for="inputLipid3">ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70-100 mg/dl</label></p>
		<p>
			<button type="button" onclick="confirmLipidDrug('${drugcode}')" class="button">ยืนยันการสั่งใช้</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
			<input type="hidden" name="criteria" id="criteria" value="Other lipid-regulating drug">
		</p>
	</div>`;
	
	document.getElementById("pregHeader").innerHTML = '[RDU] Other lipid-regulating drug';
	document.getElementById("pregContent").innerHTML = htmlTxt;
	
	document.getElementById("pregCloseBtn").style.display = "none";// ซ่อนปุ่มเอาไว้ก่อน
	document.getElementById("pregBackground").style.display = "";
	document.getElementById("pregContainer").style.display = "";
}

async function confirmLipidDrug(drugcode){
	const lipidItem = document.querySelectorAll('.inputLipid');
	let formData = new FormData();
	let lipidCount = 0;
	for (let i = 0; i < lipidItem.length; i++) {
		if (lipidItem[i].checked===true) {
			formData.append("detail[]", lipidItem[i].value);
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

            setCookie(lipicCookieName, '1'); // บันทึก cookie 

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
    const htmlTxt = `<div>
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<p><input type="checkbox" class="inputAdeno" id="inputAdeno1" name="inputAdeno[inputAdeno1]" value="เป็น COPD ความรุนแรงระดับ E"><label for="inputAdeno1">เป็น COPD ความรุนแรงระดับ E</label></p>
		<p><input type="checkbox" class="inputAdeno" id="inputAdeno2" name="inputAdeno[inputAdeno2]" value="มีระดับ eosinophil > 300 cell/µl"><label for="inputAdeno2">มีระดับ eosinophil > 300 cell/µl</label></p>
		<p>
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
    const adrenoITem = document.querySelectorAll('.inputAdeno');
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
    formData.append("drugcode", drugcode);
    formData.append("hn", hn);
    formData.append("doctor", doctor);
    formData.append("detail[]", 'เป็น COPD ความรุนแรงระดับ E');
    formData.append("detail[]", 'มีระดับ eosinophil > 300 cell/µl');

    const postData = new URLSearchParams(formData).toString();
	sendForm('doctor_medical.php',postData).then((res)=>{
		if(res.status === 200){
			Swal.fire({
				title: 'สำเร็จ',
				text: res.message,
				icon: 'success',
				allowOutsideClick: false
			});
            setCookie(adrenoCookieName, '1'); // บันทึก cookie 

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

async function checkDiabetes(drugcode){ // 2SEMA  2DULA  2EVO
    const htmlTxt = `<div>
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<p><input type="checkbox" class="inputDiabettes" id="inputDiabettes1" name="inputDiabettes[inputDiabettes1]" value="คนไข้ DM มี BMI &gt; 30"><label for="inputDiabettes1">คนไข้ DM มี BMI &gt; 30</label></p>
		<p><input type="checkbox" class="inputDiabettes" id="inputDiabettes2" name="inputDiabettes[inputDiabettes2]" value="คนไข้ DM ที่มีภาวะ/ความเสี่ยงสูงที่จะเป็น MI, Stroke, ASCVD"><label for="inputDiabettes2">คนไข้ DM ที่มีภาวะ/ความเสี่ยงสูงที่จะเป็น MI, Stroke, ASCVD</label></p>
		<p><input type="checkbox" class="inputDiabettes" id="inputDiabettes3" name="inputDiabettes[inputDiabettes3]" value="คนไข้ DM มีภาวะ CKD eGFR &lt; 60 ml/min/7.13m2 หรือ ACR ≥ 30 mg/g"><label for="inputDiabettes3">คนไข้ DM มีภาวะ CKD eGFR &lt; 60 ml/min/7.13m2 หรือ ACR ≥ 30 mg/g</label></p>
		<p><input type="checkbox" class="inputDiabettes" id="inputDiabettes4" name="inputDiabettes[inputDiabettes4]" value="คนไข้ DM หรือ obesity ที่มีความเสี่ยงสูงในภาวะ MASLD"><label for="inputDiabettes4">คนไข้ DM หรือ obesity ที่มีความเสี่ยงสูงในภาวะ MASLD</label></p>
		<p>
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

    const diabetesItem = document.querySelectorAll('.inputDiabettes');
	let formData = new FormData();
	let diabetesCount = 0;
	for (let i = 0; i < diabetesItem.length; i++) {
		if (diabetesItem[i].checked===true) {
			formData.append("detail[]", diabetesItem[i].value);
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

            setCookie(diabetesCookieName, '1'); // บันทึก cookie
            
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