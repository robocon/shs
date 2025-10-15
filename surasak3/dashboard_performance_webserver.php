<!DOCTYPE html>
<html>
<head>
    <title>Server Status Dashboard (Legacy)</title>
    <style>
        /* กำหนดโทนสีเขียว-ฟ้า */
        :root {
            --color-primary: #1e90ff; /* ฟ้าสดใส */
            --color-secondary: #3cb371; /* เขียวอมฟ้า */
            --color-background: #f4f7f6;
            --color-card-bg: #ffffff;
            --color-text: #333;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--color-background);
            padding: 20px;
            color: var(--color-text);
        }

        .dashboard-header {
            color: var(--color-primary);
            margin-bottom: 30px;
            border-bottom: 2px solid var(--color-secondary);
            padding-bottom: 10px;
        }

        .dashboard-grid {
            display: flex; /* ใช้ Flexbox เพื่อจัดวาง */
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background-color: var(--color-card-bg);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1 1 300px; /* ทำให้ Card ยืดหยุ่นและมีขนาดขั้นต่ำ 300px */
            min-width: 250px;
        }

        .card-title {
            font-size: 1.2em;
            margin-top: 0;
            color: var(--color-secondary);
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .metric-value {
            font-size: 2em;
            font-weight: bold;
            color: var(--color-primary);
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .progress-bar-container {
            background-color: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-bar {
            height: 20px;
            background-color: var(--color-secondary);
            text-align: center;
            line-height: 20px;
            color: white;
            transition: width 0.5s;
        }		
    </style>
</head>
<body>
<?php
// Function สำหรับดึงข้อมูล MySQL Version (สมมติใช้ extension mysql เก่า)
function get_mysql_version_legacy($host, $user, $pass) {
    // *** กรุณาแก้ไขข้อมูลการเชื่อมต่อฐานข้อมูลตามจริง ***
    $link = @mysql_connect($host, $user, $pass);
    if ($link) {
        $version = mysql_get_server_info($link);
        mysql_close($link);
        return $version;
    }
    return "N/A (DB not connected)";
}

// Function สำหรับจัดรูปแบบหน่วยข้อมูล
function format_bytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, $precision) . ' ' . $units[$pow];
}

// -------------------------------------------------------------------
// ส่วนดึงข้อมูลพื้นฐาน (จากโค้ดเดิม)
$php_ver = phpversion();
$os_info = php_uname('s') . " " . php_uname('r');
$server_soft = $_SERVER['SERVER_SOFTWARE'];
$mysql_ver = get_mysql_version_legacy('192.168.131.240', 'sm3db_user', 'sm3dbPassword'); // แก้ไขตามข้อมูลของคุณ

$disk_free = @disk_free_space("/");
$disk_total = @disk_total_space("/");
$disk_usage_percent = ($disk_total > 0) ? round((($disk_total - $disk_free) / $disk_total) * 100, 2) : "N/A";
$disk_total_formatted = format_bytes($disk_total);
$disk_free_formatted = format_bytes($disk_free);
// -------------------------------------------------------------------

// 1. ดึงเวอร์ชั่น CentOS (ต้องใช้คำสั่ง Shell)
$centos_version = "N/A (Shell Disabled)";
if (function_exists('shell_exec')) {
    // คำสั่งที่ใช้ได้กับ CentOS/RHEL ส่วนใหญ่
    $ver_output = shell_exec('cat /etc/redhat-release');
    if ($ver_output) {
        $centos_version = trim($ver_output);
    }
}

// 2. ดึงข้อมูล RAM (ต้องใช้คำสั่ง Shell: Linux)
$ram_total = "N/A";
$ram_free = "N/A";
$ram_percent = "N/A";

if (function_exists('shell_exec')) {
    // อ่านไฟล์ /proc/meminfo เพื่อดึง Total Memory และ Free Memory
    $mem_info = shell_exec('cat /proc/meminfo');
    if ($mem_info) {
        // ใช้ regular expression เพื่อหาค่า MemTotal และ MemFree (เป็น KB)
        if (preg_match('/MemTotal:\s+(\d+)\s+kB/', $mem_info, $matches_total)) {
            $mem_total_kb = $matches_total[1];
        }
        if (preg_match('/MemFree:\s+(\d+)\s+kB/', $mem_info, $matches_free)) {
            $mem_free_kb = $matches_free[1];
        }

        if (isset($mem_total_kb) && isset($mem_free_kb)) {
            $ram_total = format_bytes($mem_total_kb * 1024);
            $ram_free = format_bytes($mem_free_kb * 1024);
            $ram_used_kb = $mem_total_kb - $mem_free_kb;
            $ram_percent = round(($ram_used_kb / $mem_total_kb) * 100, 2);
        }
    }
}

// -------------------------------------------------------------------
// ดึงค่า CPU Load Average (ใช้สำหรับ Linux)
// -------------------------------------------------------------------
$cpu_load_avg = "N/A (Shell Disabled)";
$cpu_load_percent = "N/A"; // เราจะใช้ค่าเฉลี่ย 1 นาที มาแปลงเป็นเปอร์เซ็นต์แบบหยาบ

if (function_exists('shell_exec') && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    // 1. ดึงค่า Load Average (ค่าเฉลี่ย 1, 5, 15 นาที)
    $load_output = @shell_exec('cat /proc/loadavg 2>/dev/null');
    
    // 2. ดึงจำนวน Core CPU เพื่อแปลงค่า Load Average เป็นเปอร์เซ็นต์
    $cpu_cores = 1;
    $cpuinfo_output = @shell_exec('grep -P \'^processor\' /proc/cpuinfo | wc -l 2>/dev/null');
    if ($cpuinfo_output && intval(trim($cpuinfo_output)) > 0) {
        $cpu_cores = intval(trim($cpuinfo_output));
    }
    
    if ($load_output) {
        $loads = explode(' ', $load_output);
        $load_1min = floatval($loads[0]);
        $cpu_load_avg = $load_1min . ", " . floatval($loads[1]) . ", " . floatval($loads[2]);
        
        // 3. คำนวณเปอร์เซ็นต์ CPU Load (Load 1 นาที / จำนวน Core) * 100
        $load_percent_raw = ($load_1min / $cpu_cores) * 100;
        $cpu_load_percent = round(min($load_percent_raw, 100), 2); // จำกัดไม่ให้เกิน 100%
    }
}


// -------------------------------------------------------------------
// D A T A   R E T R I E V A L   (P E R F O R M A N C E)
// -------------------------------------------------------------------

// 1. Swap Memory Usage (ต้องใช้ Shell)
$swap_usage_percent = "N/A";
$swap_total_formatted = "N/A";

if (function_exists('shell_exec') && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    $free_output = @shell_exec('free -k 2>/dev/null'); // ดึงข้อมูลหน่วยเป็น KB
    
    if ($free_output) {
        $lines = explode("\n", $free_output);
        // หาบรรทัด 'Swap:'
        foreach ($lines as $line) {
            if (strpos(trim($line), 'Swap:') === 0) {
                // ตัวอย่างบรรทัด: Swap:  8388604  453372  7935232
                $parts = preg_split('/\s+/', trim($line));
                if (count($parts) >= 4) {
                    $swap_total_kb = $parts[1]; // Total Swap
                    $swap_used_kb = $parts[2];  // Used Swap
                    
                    if ($swap_total_kb > 0) {
                        $swap_total_formatted = format_bytes($swap_total_kb * 1024);
                        $swap_used_formatted = format_bytes($swap_used_kb * 1024);
                        $swap_usage_percent = round(($swap_used_kb / $swap_total_kb) * 100, 2);
                    } else {
                        $swap_total_formatted = "0 MB";
                        $swap_usage_percent = 0;
                    }
                }
                break;
            }
        }
    }
}

// 2. MySQL Performance Status (ต้องใช้ DB Connection เดิม)
$mysql_uptime = "N/A";
$mysql_connections = "N/A";

// *** ต้องใช้การเชื่อมต่อฐานข้อมูลจริงของคุณ
$host = '192.168.131.240';
$user = 'sm3db_user'; // แก้ไข
$pass = 'sm3dbPassword'; // แก้ไข

if (function_exists('mysql_connect')) {
    $link = @mysql_connect($host, $user, $pass);
    if ($link) {
        // ดึง Uptime (เป็นวินาที)
        $result_uptime = @mysql_query("SHOW GLOBAL STATUS LIKE 'Uptime'", $link);
        if ($result_uptime) {
            $row_uptime = mysql_fetch_assoc($result_uptime);
            if ($row_uptime && isset($row_uptime['Value'])) {
                $seconds = intval($row_uptime['Value']);
                // แปลงวินาทีเป็นรูปแบบ Dd Hh:Mm:Ss
                $days = floor($seconds / 86400);
                $hours = floor(($seconds % 86400) / 3600);
                $minutes = floor(($seconds % 3600) / 60);
                $mysql_uptime = $days . 'd ' . str_pad($hours, 2, '0', STR_PAD_LEFT) . 'h:' . str_pad($minutes, 2, '0', STR_PAD_LEFT) . 'm';
            }
        }
        
        // ดึงจำนวน Connection ที่กำลังเชื่อมต่อ
        $result_conn = @mysql_query("SHOW STATUS LIKE 'Threads_connected'", $link);
        if ($result_conn) {
            $row_conn = mysql_fetch_assoc($result_conn);
            if ($row_conn && isset($row_conn['Value'])) {
                $mysql_connections = $row_conn['Value'];
            }
        }
        
        mysql_close($link);
    }
}


// -------------------------------------------------------------------
// S E R V I C E   S T A T U S   C H E C K (ต้องใช้ Shell)
// -------------------------------------------------------------------

$apache_status = "N/A (Shell Disabled)";
$mysql_service_status = "N/A (Shell Disabled)";

if (function_exists('shell_exec') && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    // 1. ตรวจสอบ Web Server (สมมติใช้ Apache/HTTPD)
    // ใช้ 'pgrep' เพื่อหา Process ID (PID) ของ Apache
    $apache_pid = @shell_exec('pgrep httpd'); 
    if ($apache_pid !== null && $apache_pid !== '') {
        //$apache_status = "Running (PID: " . trim($apache_pid) . ")";
		$apache_status = "Running";
    } else {
        $apache_status = "Stopped / Failed";
    }

    // 2. ตรวจสอบ MySQL Service
    // ใช้ 'pgrep' เพื่อหา Process ID (PID) ของ MySQL/MariaDB
    $mysql_pid = @shell_exec('pgrep mysqld'); 
    if ($mysql_pid !== null && $mysql_pid !== '') {
		//$mysql_service_status = "Running (PID: " . trim($mysql_pid) . ")";
		$mysql_service_status = "Running";
    } else {
        $mysql_service_status = "Stopped / Failed";
    }
}
?>
<h1 class="dashboard-header">Server Health Dashboard</h1>

<div class="dashboard-grid">

    <div class="card">
        <h2 class="card-title">PHP Version</h2>
        <div class="metric-value"><?php echo $php_ver; ?></div>
        <p>Current scripting engine version.</p>
    </div>

    <div class="card">
        <h2 class="card-title">Operating System</h2>
        <div class="metric-value">OS</div>
        <div class="detail-item">Name: **<?php echo $os_info; ?>**</div>
        <div class="detail-item">Server: **<?php echo $server_soft; ?>**</div>
    </div>

    <div class="card">
        <h2 class="card-title">Database Version</h2>
        <div class="metric-value">MySQL</div>
        <div class="detail-item">Version: **<?php echo $mysql_ver; ?>**</div>
        <p>Based on legacy `mysql_connect` extension check.</p>
    </div>
	
	<div class="card">
		<h2 class="card-title">OS Distribution</h2>
		<div class="metric-value">CentOS/Linux</div>
		<div class="detail-item">Version: **<?php echo $centos_version; ?>**</div>
		<div class="detail-item">Kernel: **<?php echo php_uname('r'); ?>**</div>
	</div>
	
    <div class="card">
        <h2 class="card-title">Disk Usage (Root)</h2>
        <div class="metric-value"><?php echo $disk_usage_percent; ?>%</div>
        <div class="detail-item">Total: <?php echo $disk_total_formatted; ?></div>
        <div class="detail-item">Free: <?php echo $disk_free_formatted; ?></div>

        <div class="progress-bar-container">
            <div class="progress-bar" style="width: <?php echo $disk_usage_percent; ?>%;">
                <?php echo $disk_usage_percent; ?>%
            </div>
        </div>
    </div>
	
	<div class="card">
        <h2 class="card-title">CPU Load (1 Min Avg)</h2>
        <div class="metric-value"><?php echo ($cpu_load_percent !== "N/A") ? $cpu_load_percent . "%" : $cpu_load_percent; ?></div>
        
        <div class="detail-item">Load Averages (1, 5, 15 min): **<?php echo $cpu_load_avg; ?>**</div>
        <div class="detail-item">CPU Cores: **<?php echo $cpu_cores; ?>**</div>

        <div class="progress-bar-container">
            <div class="progress-bar" style="width: <?php echo $cpu_load_percent; ?>%; background-color: <?php echo ($cpu_load_percent > 80) ? '#ff4d4d' : 'var(--color-secondary)'; ?>;">
                <?php echo ($cpu_load_percent !== "N/A") ? $cpu_load_percent . "%" : ""; ?>
            </div>
        </div>
    </div>

	<div class="card">
        <h2 class="card-title">Swap Memory Usage</h2>
        <div class="metric-value"><?php echo ($swap_usage_percent !== "N/A") ? $swap_usage_percent . "%" : $swap_usage_percent; ?></div>
        
        <div class="detail-item">Total Swap: **<?php echo $swap_total_formatted; ?>**</div>
        <div class="detail-item">Used Swap: **<?php echo $swap_used_formatted; ?>**</div>

        <div class="progress-bar-container">
            <div class="progress-bar" style="width: <?php echo $swap_usage_percent; ?>%; background-color: <?php echo ($swap_usage_percent > 30) ? '#ff4d4d' : '#FFBF00'; ?>;"> 
                <?php echo ($swap_usage_percent !== "N/A") ? $swap_usage_percent . "%" : ""; ?>
            </div>
        </div>
        <p class="detail-item" style="font-size: 0.8em; color: #777; margin-top: 10px;">*Swap Usage สูง แสดงว่า RAM ไม่พอ</p>
    </div>

    <div class="card">
        <h2 class="card-title">MySQL Runtime Status</h2>
        <div class="metric-value"><?php echo $mysql_connections; ?></div>
        
        <div class="detail-item">Active Connections</div>
        <div class="detail-item">Uptime: **<?php echo $mysql_uptime; ?>**</div>
        <p class="detail-item" style="font-size: 0.8em; color: #777; margin-top: 10px;">Connections/Uptime</p>
    </div>


    <div class="card">
        <h2 class="card-title">Core Service Status</h2>
        <div class="metric-value">Service Health</div>
        
        <div class="detail-item" style="font-weight: bold; color: #1E90FF;">
            Web Server (Apache/HTTPD): 
            <span style="color: <?php echo (strpos($apache_status, 'Running') !== false) ? 'var(--color-secondary)' : '#ff4d4d'; ?>;">
                <?php echo $apache_status; ?>
            </span>
        </div>
        
        <div class="detail-item" style="font-weight: bold; color: #1E90FF;">
            Database (MySQL/MariaDB): 
            <span style="color: <?php echo (strpos($mysql_service_status, 'Running') !== false) ? 'var(--color-secondary)' : '#ff4d4d'; ?>;">
                <?php echo $mysql_service_status; ?>
            </span>
        </div>
        <p class="detail-item" style="font-size: 0.8em; color: #777; margin-top: 10px;">*หากสถานะเป็น Stopped บ่งชี้ว่าเกิด Downtime ทันที</p>
    </div>	
</div>
</body>
</html>