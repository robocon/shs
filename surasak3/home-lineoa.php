<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>หน้าอินเทอร์เฟซหลัก</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      padding-bottom: 80px;
      font-family: 'Sarabun', sans-serif;
      background-color: #efebe9;
    }	
	.header {
	  background-color: #2e7d32; /* เขียวทหาร */
	  color: white;
	  padding: 20px 10px;
	  text-align: center;
	  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
	  border-bottom: 4px solid #c0ca33; /* เส้นล่างสีทองอ่อน */
	}

	.header h1 {
	  font-size: 20px;
	  margin: 0;
	  letter-spacing: 1px;
	}

	.header h2 {
	  font-size: 26px;
	  margin: 5px 0 0;
	  font-weight: bold;
	  color: #fffde7; /* ขาวอมทอง */
	  letter-spacing: 1.5px;
	}

    .content {
      padding: 20px;
      text-align: center;
    }

    .menu-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      margin-top: 20px;
    }

    .menu-button {
      background-color: #e8f5e9;
      border: 2px solid #2e7d32;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      transition: 0.2s;
      color: #2e7d32;
      font-size: 14px;
    }

    .menu-button:hover {
      background-color: #c8e6c9;
      cursor: pointer;
    }

    .menu-button i {
      font-size: 28px;
      margin-bottom: 8px;
      display: block;
      color: #388e3c;
    }

    .bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #2e7d32;
      border-top: 2px solid #c0ca33;
      display: flex;
      justify-content: space-around;
      padding: 10px 0;
      z-index: 1000;
    }

    .nav-item {
      text-align: center;
      color: #FFFFFF;
      font-size: 14px;
      text-decoration: none;
      flex: 1;
    }

    .nav-item i {
      font-size: 20px;
      display: block;
      margin-bottom: 5px;
      color: #FFFFFF;
    }

    .nav-item.active {
      color: #5d4037;
      background-color: #fff8e1;
      border-radius: 10px;
      font-weight: bold;
      margin: 0 5px;
    }

    .nav-item.active i {
      color: #5d4037;
    }

    .nav-item:hover {
      background-color: #c8e6c9;
      border-radius: 10px;
    }
  </style>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="content">
	<header class="header">
	  <div class="header-content">
		<h1>ระบบบริการสุขภาพ</h1>
		<h2>Surasak Healthcare</h2>
	  </div>
	</header>

    <div class="menu-grid">
      <div class="menu-button">
        <i class="fas fa-notes-medical"></i>
        ผลตรวจสุขภาพประจำปีกองทัพบก
      </div>
      <div class="menu-button">
        <i class="fas fa-tooth"></i>
        ผลตรวจสุขภาพสภาวะช่องปาก
      </div>
      <div class="menu-button">
        <i class="fas fa-user-md"></i>
        ผลตรวจสุขภาพทั่วไป
      </div>
      <div class="menu-button">
        <i class="fas fa-vial"></i>
        ผลตรวจทางห้องปฏิบัติการ
      </div>
      <div class="menu-button">
        <i class="fas fa-folder-plus"></i>
        จองคิวตรวจสุขภาพ
      </div>
      <div class="menu-button">
        <i class="fas fa-clipboard-list"></i>
        จองคิว/นัดหมายออนไลน์
      </div>
      <div class="menu-button">
        <i class="fas fa-calendar-check"></i>
        ข้อมูลการนัดหมาย
      </div>
      <div class="menu-button">
        <i class="fas fa-bell"></i>
        รับการแจ้งเตือนส่วนบุคคล
      </div>
    </div>
  </div>

  <!-- แถบเมนูด้านล่าง -->
  <div class="bottom-nav">
    <a href="#" class="nav-item active">
      <i class="fas fa-clinic-medical"></i>
      บริการ<br>สุขภาพ
    </a>
    <a href="#" class="nav-item">
      <i class="fas fa-child"></i>
      ประวัติ<br>การรักษา
    </a>
    <a href="#" class="nav-item">
      <i class="fas fa-pills"></i>
     ประวัติ<br> การใช้ยา
    </a>
    <a href="#" class="nav-item">
      <i class="fas fa-desktop"></i>
      ติดตาม<br>คิวออนไลน์
    </a>
  </div>

  <script>
    // สลับ active tab
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        navItems.forEach(i => i.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>

</body>
</html>
