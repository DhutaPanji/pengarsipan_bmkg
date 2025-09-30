<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileSurat'])) {
    $totalFiles   = count($_FILES['fileSurat']['name']);
    $successCount = 0;
    $errorCount   = 0;

    // Buat folder uploads jika belum ada
    $targetDir = __DIR__ . "/uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    for ($i = 0; $i < $totalFiles; $i++) {
        if ($_FILES['fileSurat']['error'][$i] === 0) {
            $fileTmp  = $_FILES['fileSurat']['tmp_name'][$i];
            $fileName = $_FILES['fileSurat']['name'][$i];

            // Validasi hanya file PDF
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if ($ext !== 'pdf') {
                $errorCount++;
                continue;
            }

            // Pindahkan file
            $targetFile = $targetDir . basename($fileName);
            if (move_uploaded_file($fileTmp, $targetFile)) {
                // Ambil data dari nama file
                $namaTanpaExt = pathinfo($fileName, PATHINFO_FILENAME);
                $parts = explode("_", $namaTanpaExt, 4);

                if (count($parts) >= 4) {
                    $tanggal = date("Y-m-d", strtotime($parts[0]));
                    $nomor   = $parts[1];
                    $kode    = $parts[2];
                    $perihal = $parts[3];

                    // Simpan ke database
                    $sql  = "INSERT INTO surat (tanggal, nomor_surat, perihal, file_pdf) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "ssss", $tanggal, $nomor, $perihal, $fileName);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    }
                }
                $successCount++;
            } else {
                $errorCount++;
            }
        } else {
            $errorCount++;
        }
    }

    // Buat flash message
    if ($successCount > 0 && $errorCount === 0) {
        $_SESSION['flash'] = ['msg' => "$successCount file berhasil diunggah.", 'type' => 'success'];
    } elseif ($successCount > 0 && $errorCount > 0) {
        $_SESSION['flash'] = ['msg' => "$successCount file berhasil, $errorCount gagal.", 'type' => 'warning'];
    } else {
        $_SESSION['flash'] = ['msg' => 'Semua file gagal diunggah.', 'type' => 'error'];
    }

    // Redirect kembali ke halaman upload di dalam layout (supaya sidebar & navbar tetap ada)
    header("Location: sidebar/layout.php?page=tambah");
    exit;
} else {
    // Jika akses langsung tanpa POST
    header("Location: sidebar/layout.php?page=tambah");
    exit;
}