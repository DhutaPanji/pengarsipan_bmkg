<!-- Konten -->
<main class="flex-1 flex items-start justify-center p-6 mt-10">
  <!-- Card Upload -->
  <div class="bg-white p-10 rounded-xl shadow-md w-full max-w-2xl">
    <h2 class="text-2xl font-semibold text-center mb-6">Unggah File Surat</h2>
    
    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
      <label class="block text-sm font-medium text-gray-700">
        PILIH FILE SURAT (PDF)
      </label>

      <input 
        type="file" 
        name="fileSurat" 
        accept=".pdf" 
        class="block w-full text-sm text-gray-500
               file:mr-4 file:py-2 file:px-4
               file:rounded-l-md file:border-0
               file:text-sm file:font-semibold
               file:bg-gray-100 file:text-gray-700
               hover:file:bg-gray-200"
        required
      >

      <p class="text-xs text-gray-500">
        Nama file: <span class="font-mono">YYYYMMDD_NomorSurat_KodeSurat_Perihal Surat.pdf</span>
      </p>

      <button type="submit" 
        class="w-full bg-indigo-500 hover:bg-indigo-600 
               text-white font-medium py-3 rounded-lg 
               shadow-md transition">
        Upload Surat
      </button>

      <p class="text-xs text-red-500 mt-2">
        Contoh nama file: <span class="font-mono">20190805_ME.104-224-KMP-VII-2019_ME_Perihal Surat.pdf</span>
      </p>
    </form>
  </div>
</main>
