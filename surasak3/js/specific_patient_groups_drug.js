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
		<p><input type="checkbox" class="inputMRA" id="inputMRA1" name="detail[]" value="MRA1"><label for="inputMRA1">1.) CKD w DM(ชะลอไตเสื่อมผู้ป่วย DM)</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA2" name="detail[]" value="MRA2"><label for="inputMRA2">2.) มีระดับ k<sup>+</sup> ไม่เกิน 5 mEq/L</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA3" name="detail[]" value="MRA3"><label for="inputMRA3">3.) ไม่มีภาวะ adrenal insufficiency</label></p>
		<p><input type="checkbox" class="inputMRA" id="inputMRA4" name="detail[]" value="MRA4"><label for="inputMRA4">4.) ระดับ eGFR > 25 ml/min/1.73m<sup>3</sup></label></p>
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
		formData.append("criteriaCode", 'MRA');
		formData.append("drugcode", drugcode);
		formData.append("hn", hn);
		formData.append("doctor", doctor);
		formData.append("detail[]", 'MRA1');
		formData.append("detail[]", 'MRA2');
		formData.append("detail[]", 'MRA3');
		formData.append("detail[]", 'MRA4');

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
		<p><input type="checkbox" class="inputLipid" id="inputLipid1" name="detail[]" value="LIPID1"><label for="inputLipid1">1.) เกิด DI หรือไม่สามารถใช้ยา fibrates ได้เมื่อ TG > 500 mg/dl</label></p>
		<p><input type="checkbox" class="inputLipid" id="inputLipid2" name="detail[]" value="LIPID2"><label for="inputLipid2">2.) ผู้ป่วย DM 40ปีขึ้นไปที่คุม LDL-Cได้ แต่ยังมีTriglycerides = 150-499 mg/dl</label></p>
		<p><input type="checkbox" class="inputLipid" id="inputLipid3" name="detail[]" value="LIPID3"><label for="inputLipid3">3.) ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl</label></p>
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
	formData.append("criteriaCode", 'LIPID');
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
		<p><input type="checkbox" class="inputAdreno" id="inputAdreno1" name="detail[]" value="ADENO1"><label for="inputAdreno1">1.) เป็น COPD ความรุนแรงระดับ E</label></p>
		<p><input type="checkbox" class="inputAdreno" id="inputAdreno2" name="detail[]" value="ADENO2"><label for="inputAdreno2">2.) มีระดับ eosinophil > 300 cell/µl</label></p>
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
    formData.append("detail[]", 'ADENO1');
    formData.append("detail[]", 'ADENO2');

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
		<p><input type="checkbox" class="inputDiabetes" id="inputDiabetes1" name="detail[]" value="DIABETES1"><label for="inputDiabetes1">1.) คนไข้ DM มี BMI &gt; 30</label></p>
		<p><input type="checkbox" class="inputDiabetes" id="inputDiabetes2" name="detail[]" value="DIABETES2"><label for="inputDiabetes2">2.) คนไข้ DM ที่มีภาวะ/ความเสี่ยงสูงที่จะเป็น MI, Stroke, ASCVD</label></p>
		<p><input type="checkbox" class="inputDiabetes" id="inputDiabetes3" name="detail[]" value="DIABETES3"><label for="inputDiabetes3">3.) คนไข้ DM มีภาวะ CKD eGFR &lt; 60 ml/min/7.13m2 หรือ ACR ≥ 30 mg/g</label></p>
		<p><input type="checkbox" class="inputDiabetes" id="inputDiabetes4" name="detail[]" value="DIABETES4"><label for="inputDiabetes4">4.) คนไข้ DM หรือ obesity ที่มีความเสี่ยงสูงในภาวะ MASLD</label></p>
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

    const diabetesItem = document.querySelectorAll('.inputDiabetes');
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
	formData.append("criteriaCode", 'DIABETES');
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

async function checkInclisiran(drugcode){ // 2INC
    const htmlTxt = `<div>
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<div>
			<input type="checkbox" onclick="clickInclisiran()" class="inputInclisiran" id="inputInclisiran1" name="detail[]" value="INCIL1"><label for="inputInclisiran1">1.) ผู้ป่วย DM ที่มีความเสี่ยงสูง (ประเมิณโรคเบาหวานที่มีความเสี่ยงสูง) ที่มี LDL-C สูงและไม่มีโรคหัวใจ ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl</label>
			<div style="display:none;" id="subIncli1">
				<ul>
					<li><input type="checkbox" class="subDetail" id="sub_detail1" name="sub_detail[]" value="INCIL1_1"><label for="sub_detail1">1.1) Target organ damage</label></li>
					<li><input type="checkbox" class="subDetail" id="sub_detail2" name="sub_detail[]" value="INCIL1_2"><label for="sub_detail2">1.2) เป็นมานาน ≥10ปี</label></li>
					<li>
						<input type="checkbox" class="subDetail" id="sub_detail3" name="sub_detail[]" value="INCIL1_3"><label for="sub_detail3">1.3) มีความเสี่ยงอื่นๆ เพิ่มเติม ได้แก่</label>
						<ul>
							<li>- มี subclinical atherosclerosis เช่น Coronary calcium score ≥1,000</li>
							<li>- ประวัติครอบครัวมี premature atherosclerosis ผู้หญิงอายุ &lt;55 ปี ผู้ชายอายุ &lt;45 ปี</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<p><input type="checkbox" class="inputInclisiran" id="inputInclisiran2" name="detail[]" value="INCIL2"><label for="inputInclisiran2">2.) ผู้ป่วยโรคคอเลสเตอรอลสูงทางพันธุกรรม (ประเมิณตาม Dutch Lipid Clinic Network Criteria ≥ 6) (familial hypercholesterolemia) ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl</label></p>
		<p><input type="checkbox" class="inputInclisiran" id="inputInclisiran3" name="detail[]" value="INCIL3"><label for="inputInclisiran3">3.) เกิดผลข้างเคียงจากยากลุ่ม statin ไม่สามารถทนต่อผลข้างเคียงได้</label></p>
		<p>
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

function clickInclisiran(){
	if(document.getElementById('inputInclisiran1').checked===true){
		document.getElementById('subIncli1').style.display='';
	}else{
		document.getElementById('subIncli1').style.display='none';
	}
}

function confirmInclisiran(drugcode){

	const incliItem = document.querySelectorAll('.inputInclisiran');
	let formData = new FormData();
	let incliCount = 0;
	let checkIncli1 = false;
	for (let i = 0; i < incliItem.length; i++) {

		if (incliItem[i].checked===true) { 

			// ถ้าเป็นข้อ 1 ให้แปะสถานะเอาไว้
			if(incliItem[i].value==='INCIL1'){
				checkIncli1 = true;
			}
			
			formData.append("detail[]", incliItem[i].value);
			incliCount++;
		}
	}

	const subIncliItem = document.querySelectorAll('.subDetail');
	let subCount = 0;
	for (let i = 0; i < subIncliItem.length; i++) {
		if (subIncliItem[i].checked===true) {
			formData.append("sub_detail[]", subIncliItem[i].value);
			subCount++;
		}
	}

	if(incliCount===0){
		Swal.fire({
			title: "กรุณาเลือกรายละเอียดอย่างน้อย 1ข้อ",
			icon: 'warning',
			allowOutsideClick: false
		});
	}else if(checkIncli1===true && subCount===0){ // ข้อ 1 ถูกติ๊กเอาไว้ แต่ไม่ได้เลือกตัวย่่อย
		Swal.fire({
			title: "กรุณาเลือกรายละเอียดในข้อที่1 อย่างน้อย 1ข้อ",
			icon: 'warning',
			allowOutsideClick: false
		});
		return false;
	}

	formData.append("action", 'save');
	formData.append("criteria", 'Inclisiran (Sybrava 284 mg)');
	formData.append("criteriaCode", 'INCLISIRAN');
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

            setCookie(inclisiranCookieName, '1'); // บันทึก cookie
            
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