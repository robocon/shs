<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surasak Healthcare Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
  <div class="p-6">
    <!-- Header -->
    <header class="mb-6 text-center">
      <h1 class="text-3xl font-bold text-green-700">ระบบบริการสุขภาพ</h1>
      <h2 class="text-xl text-green-500">Surasak Healthcare</h2>
    </header>

    <!-- Dashboard Section -->
    <section class="bg-white rounded-xl shadow p-6 mb-8">
      <h3 class="text-2xl font-semibold mb-4">ยอดผู้ใช้บริการในแต่ละเดือน</h3>
      <div class="overflow-x-auto">
        <table class="table-auto w-full text-left border border-gray-200">
          <thead>
            <tr class="bg-green-100">
              <th class="px-4 py-2">เดือน</th>
              <th class="px-4 py-2">จำนวนผู้ใช้บริการ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border px-4 py-2">มกราคม</td>
              <td class="border px-4 py-2">120</td>
            </tr>
            <tr>
              <td class="border px-4 py-2">กุมภาพันธ์</td>
              <td class="border px-4 py-2">150</td>
            </tr>
            <tr>
              <td class="border px-4 py-2">มีนาคม</td>
              <td class="border px-4 py-2">180</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Chart Section -->
    <section class="bg-white rounded-xl shadow p-6">
      <h3 class="text-2xl font-semibold mb-4">สัดส่วนการใช้บริการจองคิวออนไลน์แยกตามแผนก</h3>
      <canvas id="deptChart"></canvas>
    </section>
  </div>

  <script>
    const ctx = document.getElementById('deptChart').getContext('2d');
    const deptChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['อายุรกรรม', 'ทันตกรรม', 'กุมารเวช', 'ศัลยกรรม'],
        datasets: [{
          label: 'จำนวนการจอง',
          data: [120, 80, 60, 40],
          backgroundColor: ['#34d399', '#60a5fa', '#fbbf24', '#f87171'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          },
          title: {
            display: false
          }
        }
      }
    });
  </script>
</body>

</html>