<?php
// index.php
session_start();
include __DIR__ . "/config.php";

// Ambil semua data surat
$arsip = [];
$sql = "SELECT id, tanggal, nomor_surat, perihal FROM surat ORDER BY tanggal DESC";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $arsip[] = $row;
    }
}

// Routing
$page   = isset($_GET['page']) ? preg_replace('/[^a-z0-9_-]/i','', $_GET['page']) : 'dashboard';
$action = isset($_GET['action']) ? preg_replace('/[^a-z0-9_-]/i','', $_GET['action']) : null;
$id     = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Panggil layout utama
include __DIR__ . "/sidebar/layout.php";
include _DIR_ . "/sidebar/navbar.php";
