<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_futsal");

// Ambil statistik dari database Bos
$q_lapangan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM lapangan")); //
$q_member   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM member")); //
$q_pegawai  = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pegawai")); //
$q_gaji     = mysqli_query($koneksi, "SELECT SUM(gaji) as total FROM gaji_pegawai"); //
$row_gaji   = mysqli_fetch_array($q_gaji);
$total_gaji = $row_gaji['total'] ?? 0; //
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>SUNSET SPORT - DASHBOARD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; margin: 0; display: flex; }
        
        /* SIDEBAR (Warna & Menu sesuai image_f79b37.png) */
        .sidebar { width: 280px; background: #1a237e; height: 100vh; color: white; padding: 25px; position: fixed; overflow-y: auto; }
        .sidebar h1 { font-size: 24px; color: #ff9800; margin-bottom: 30px; display: flex; align-items: center; gap: 10px; }
        .nav-link { display: flex; align-items: center; color: white; text-decoration: none; padding: 12px; margin: 5px 0; border-radius: 8px; transition: 0.3s; font-size: 14px; }
        .nav-link:hover, .active { background: #ff9800; color: #1a237e; font-weight: bold; }
        .nav-link i { width: 30px; text-align: center; }
        .section-title { font-size: 11px; color: #ff9800; margin: 20px 0 10px 10px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }

        .main { margin-left: 310px; padding: 40px; width: 100%; }
        .banner { background: linear-gradient(90deg, #ff9800, #fb8c00); padding: 40px; border-radius: 20px; color: white; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(255,152,0,0.3); }
        
        /* Statistik Cards (Sesuai image_f79ed7.png) */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; }
        .card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #1a237e; }
        .card h3 { color: #888; font-size: 13px; margin: 0; text-transform: uppercase; }
        .card .val { font-size: 32px; font-weight: bold; color: #1a237e; margin: 10px 0; }
    </style>
</head>
<body>

<div class="sidebar">
    <h1><i class="fas fa-sun"></i> SUNSET SPORT</h1>
    
    <a href="index.php" class="nav-link active"><i class="fas fa-th-large"></i> Dashboard</a>
    
    <div class="section-title">DATA MASTER</div>
    <a href="master/lapangan.php" class="nav-link"><i class="fas fa-cog"></i> Lapangan</a>
    <a href="master/member.php" class="nav-link"><i class="fas fa-address-card"></i> Member</a>
    <a href="master/paket.php" class="nav-link"><i class="fas fa-briefcase"></i> Paket Sewa</a>
    <a href="master/pegawai.php" class="nav-link"><i class="fas fa-user"></i> Pegawai</a>
    <a href="master/peralatan.php" class="nav-link"><i class="fas fa-tools"></i> Peralatan</a>
    <a href="master/jadwal.php" class="nav-link"><i class="fas fa-calendar-alt"></i> Jadwal</a>
    <a href="master/pelanggan.php" class="nav-link"><i class="fas fa-users"></i> Pelanggan</a>
    <a href="master/tarif.php" class="nav-link"><i class="fas fa-tags"></i> Tarif</a>
    
    <div class="section-title">TRANSAKSI</div>
    <a href="transaksi/gaji_pegawai.php" class="nav-link"><i class="fas fa-money-check-alt"></i> Gaji Pegawai</a>
    <a href="transaksi/booking.php" class="nav-link"><i class="fas fa-file-invoice"></i> Booking Lapangan</a>
    <a href="transaksi/transaksi_member.php" class="nav-link"><i class="fas fa-id-badge"></i> Transaksi Member</a>
    <a href="transaksi/transaksi_pembayaran.php" class="nav-link"><i class="fas fa-credit-card"></i> Pembayaran</a>
    <a href="transaksi/transaksi_sewa_peralatan.php" class="nav-link"><i class="fas fa-volleyball-ball"></i> Sewa Peralatan</a>
    
    <div class="section-title">LAPORAN</div>
    <a href="laporan/laporan_booking_pembayaran.php" class="nav-link"><i class="fas fa-chart-bar"></i> Laporan Booking & Pembayaran</a>
    <a href="laporan/laporan_sewa_member.php" class="nav-link"><i class="fas fa-chart-line"></i> Laporan Sewa & Member</a>
</div>

<div class="main">
    <div class="banner">
        <h1 style="margin:0;">Selamat Datang, Administrator!</h1>
        <p style="opacity:0.9;">Panel Kendali Operasional Sunset Sport Futsal & Minisoccer.</p>
    </div>

    <div class="stats-grid">
        <div class="card">
            <h3>Total Lapangan</h3>
            <div class="val"><?php echo $q_lapangan; ?></div>
            <p style="font-size:12px; color:#999;">Unit Lapangan Aktif</p>
        </div>
        <div class="card" style="border-left-color: #ff9800;">
            <h3>Total Member</h3>
            <div class="val"><?php echo $q_member; ?></div>
            <p style="font-size:12px; color:#999;">Pelanggan Loyal</p>
        </div>
        <div class="card" style="border-left-color: #2e7d32;">
            <h3>Pegawai</h3>
            <div class="val"><?php echo $q_pegawai; ?></div>
            <p style="font-size:12px; color:#999;">Staf Operasional</p>
        </div>
        <div class="card" style="border-left-color: #d32f2f;">
            <h3>Total Gaji</h3>
            <div class="val">Rp <?php echo number_format($total_gaji); ?></div>
            <p style="font-size:12px; color:#999;">Pengeluaran Bulan Ini</p>
        </div>
    </div>
</div>

</body>
</html>