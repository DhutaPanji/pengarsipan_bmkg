<?php
// index.php
session_start();

// -----------------------------
// Data dummy (ganti dengan DB nanti)
// -----------------------------
$arsip = [
  ['tanggal' => '05-08-2019', 'nomor' => 'ME.104-224-KMP-VII-2019', 'perihal' => 'Koreksi Sandi Pilot Balon'],
  ['tanggal' => '21-03-2019', 'nomor' => 'ME.305-089-III-TBK-2019', 'perihal' => 'Bulletin Analisa Klimatologi Bulanan'],
  ['tanggal' => '21-01-2019', 'nomor' => 'ME.305-036-I-TBK-2019', 'perihal' => 'Bulletin Analisa Klimatologi Bulanan'],
  ['tanggal' => '25-01-2016', 'nomor' => 'ME.401-003-HNM-I-2016', 'perihal' => 'Data Curah Hujan'],
];

// -----------------------------
// Helper
// -----------------------------
function esc($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function set_flash($msg, $type = 'info') { $_SESSION['flash'] = ['msg'=>$msg, 'type'=>$type]; }
function get_flash() { if (!empty($_SESSION['flash'])) { $f = $_SESSION['flash']; unset($_SESSION['flash']); return $f; } return null; }

// -----------------------------
// Routing
// -----------------------------
$page   = isset($_GET['page']) ? preg_replace('/[^a-z0-9_-]/i','', $_GET['page']) : 'dashboard';
$action = isset($_GET['action']) ? preg_replace('/[^a-z0-9_-]/i','', $_GET['action']) : null;
$id     = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Ambil flash jika ada
$flash = get_flash();

// -----------------------------
// Panggil layout utama
// -----------------------------
include __DIR__ . "/sidebar/layout.php";