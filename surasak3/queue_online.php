<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function loadQueueStatus() {
    $.ajax({
      url: 'status-queue_lineoa.php', // ไฟล์ PHP ที่ใช้ดึงข้อมูลสถานะคิว
      type: 'GET',
      success: function (data) {
        $('#queue-status').html(data);
      }
    });
  }

  // โหลดครั้งแรก
  loadQueueStatus();

  // โหลดซ้ำทุก 3 นาที
  setInterval(loadQueueStatus, 180000);
</script>
