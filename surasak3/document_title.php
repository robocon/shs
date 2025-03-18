<style>
	body {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
</style>
<h2 class="mt-2" align="center">ระบบจัดเก็บองค์ความรู้</h2>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="../nindex.htm">🏠 เมนูหลัก</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="document_list.php">🏬 เอกสารตามแผนก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="document_add.php">➕ เพิ่มเอกสารใหม่</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="document_Search2.php">
                <input type="text" class="form-control" id="basic-url" name="txtKeyword" id="txtKeyword" value="<?= $_GET["txtKeyword"]; ?>">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
            </form>
        </div>
    </div>
</nav>