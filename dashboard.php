<?php
// koneksi ke database
$conn = new mysqli("localhost", "root", "", "arsip_bmkg");

// cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ambil data total, masuk, keluar
$total  = $conn->query("SELECT COUNT(*) as jml FROM surat")->fetch_assoc()['jml'];
$masuk  = $conn->query("SELECT COUNT(*) as jml FROM surat WHERE jenis='masuk'")->fetch_assoc()['jml'];
$keluar = $conn->query("SELECT COUNT(*) as jml FROM surat WHERE jenis='keluar'")->fetch_assoc()['jml'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

  <!-- Tampilkan kartu jumlah -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-blue-500 text-white p-6 rounded-2xl shadow-lg">
      <h3 class="text-lg font-semibold">Total Surat</h3>
      <p class="text-3xl font-bold"><?= $total ?></p>
    </div>
    <div class="bg-green-500 text-white p-6 rounded-2xl shadow-lg">
      <h3 class="text-lg font-semibold">Surat Masuk</h3>
      <p class="text-3xl font-bold"><?= $masuk ?></p>
    </div>
    <div class="bg-red-500 text-white p-6 rounded-2xl shadow-lg">
      <h3 class="text-lg font-semibold">Surat Keluar</h3>
      <p class="text-3xl font-bold"><?= $keluar ?></p>
    </div>
  </div>

  <!-- Grafik -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    <!-- Grafik Donat -->
    <div class="bg-white p-6 rounded-4x3 shadow-lg">
      <h3 class="text-lg font-semibold text-gray-700 text-center mb-4">Grafik Donat</h3>
      <canvas id="donutChart"></canvas>
    </div>

    <!-- Diagram Batang -->
    <div class="bg-white p-6 rounded-4x3 shadow-lg">
      <h3 class="text-lg font-semibold text-gray-700 text-center mb-4">Diagram Batang</h3>
      <canvas id="barChart"></canvas>
    </div>

    <!-- Grafik Garis -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">
      <h3 class="text-lg font-semibold text-gray-700 text-center mb-4">Grafik Garis</h3>
      <canvas id="lineChart"></canvas>
    </div>
  </div>

  <script>
    const dataSurat = {
      labels: ['Total Surat', 'Surat Masuk', 'Surat Keluar'],
      datasets: [{
        label: 'Jumlah Surat',
        data: [<?= $total ?>, <?= $masuk ?>, <?= $keluar ?>],
        backgroundColor: ['#3B82F6', '#22C55E', '#EF4444'],
        borderColor: ['#2563EB', '#16A34A', '#DC2626'],
        borderWidth: 1,
        fill: true,
        tension: 0.3
      }]
    };

    // Donat
    new Chart(document.getElementById('donutChart'), {
      type: 'doughnut',
      data: dataSurat,
      options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // Batang
    new Chart(document.getElementById('barChart'), {
      type: 'bar',
      data: dataSurat,
      options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Garis
    new Chart(document.getElementById('lineChart'), {
      type: 'line',
      data: dataSurat,
      options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
  </script>
</body>
</html>
