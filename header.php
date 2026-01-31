<?php 
// Include config from parent directory
include '../config.php'; 
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SUNSET SPORT - LAPORAN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="sidebar">
    <h2>☀️ SUNSET SPORT</h2>
    <a href="../index.php" class="<?= ($current_page == 'index.php')?'active':''; ?>">📊 Dashboard</a>
    
    <p style="font-size:10px; color:#ffa726; margin:15px 0 10px 15px; font-weight:bold; text-transform:uppercase;">DATA MASTER</p>
    <a href="../master/lapangan.php" class="<?= ($current_page == 'lapangan.php')?'active':''; ?>">⚙️ Lapangan</a>
    <a href="../master/member.php" class="<?= ($current_page == 'member.php')?'active':''; ?>">💳 Member</a>
    <a href="../master/paket.php" class="<?= ($current_page == 'paket.php')?'active':''; ?>">💼 Paket Sewa</a>
    <a href="../master/pegawai.php" class="<?= ($current_page == 'pegawai.php')?'active':''; ?>">👤 Pegawai</a>
    <a href="../master/peralatan.php" class="<?= ($current_page == 'peralatan.php')?'active':''; ?>">🔧 Peralatan</a>
    <a href="../master/jadwal.php" class="<?= ($current_page == 'jadwal.php')?'active':''; ?>">📅 Jadwal</a>
    <a href="../master/pelanggan.php" class="<?= ($current_page == 'pelanggan.php')?'active':''; ?>">👥 Pelanggan</a>
    <a href="../master/tarif.php" class="<?= ($current_page == 'tarif.php')?'active':''; ?>">🏷️ Tarif</a>
    
    <p style="font-size:10px; color:#ffa726; margin:15px 0 10px 15px; font-weight:bold; text-transform:uppercase;">TRANSAKSI</p>
    <a href="../transaksi/gaji_pegawai.php" class="<?= ($current_page == 'gaji_pegawai.php')?'active':''; ?>">💰 Gaji Pegawai</a>
    <a href="../transaksi/booking.php" class="<?= ($current_page == 'booking.php')?'active':''; ?>">📝 Booking Lapangan</a>
    <a href="../transaksi/transaksi_member.php" class="<?= ($current_page == 'transaksi_member.php')?'active':''; ?>">🆔 Transaksi Member</a>
    <a href="../transaksi/transaksi_pembayaran.php" class="<?= ($current_page == 'transaksi_pembayaran.php')?'active':''; ?>">💳 Pembayaran</a>
    <a href="../transaksi/transaksi_sewa_peralatan.php" class="<?= ($current_page == 'transaksi_sewa_peralatan.php')?'active':''; ?>">⚽ Sewa Peralatan</a>
    
    <p style="font-size:10px; color:#ffa726; margin:15px 0 10px 15px; font-weight:bold; text-transform:uppercase;">LAPORAN</p>
    <a href="laporan_booking_pembayaran.php" class="<?= ($current_page == 'laporan_booking_pembayaran.php')?'active':''; ?>">📊 Laporan Booking & Pembayaran</a>
    <a href="laporan_sewa_member.php" class="<?= ($current_page == 'laporan_sewa_member.php')?'active':''; ?>">📈 Laporan Sewa & Member</a>
</div>

<div class="main-content">
    <div class="top-nav">
        <div style="font-weight:bold; color:#1e3c72; font-size:16px;">📊 SISTEM FUTSAL v1.0</div>
        <div style="text-align:right;">
            <div style="font-weight:bold; color:#1e3c72;">Administrator</div>
            <div style="font-size:11px; color:#666;"><?= date('l, d F Y'); ?></div>
        </div>
    </div>
    
    <div class="content-box">