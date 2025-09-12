<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <!-- Total Surat -->
  <div class="relative bg-blue-500 text-white rounded-xl shadow-lg p-6 overflow-hidden">
    <div>
      <h2 class="text-sm font-medium">Total Surat</h2>
      <p class="text-3xl font-bold mt-2">
        <?= count($arsip) ?>
      </p>
    </div>
    <!-- Icon -->
    <div class="absolute top-4 right-4 opacity-20 text-6xl">
      📄
    </div>
  </div>

  <!-- Surat Masuk -->
  <div class="relative bg-green-500 text-white rounded-xl shadow-lg p-6 overflow-hidden">
    <div>
      <h2 class="text-sm font-medium">Surat Masuk</h2>
      <p class="text-3xl font-bold mt-2">
        <?= rand(5, 15) ?> <!-- contoh data dummy -->
      </p>
    </div>
    <!-- Icon -->
    <div class="absolute top-4 right-4 opacity-20 text-6xl">
      📥
    </div>
  </div>

  <!-- Surat Keluar -->
  <div class="relative bg-red-500 text-white rounded-xl shadow-lg p-6 overflow-hidden">
    <div>
      <h2 class="text-sm font-medium">Surat Keluar</h2>
      <p class="text-3xl font-bold mt-2">
        <?= rand(3, 10) ?> <!-- contoh data dummy -->
      </p>
    </div>
    <!-- Icon -->
    <div class="absolute top-4 right-4 opacity-20 text-6xl">
      📤
    </div>
  </div>
</div>