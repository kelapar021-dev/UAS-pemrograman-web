<?php include '../header.php'; ?>

<div style="padding: 30px;">
    <h2 style="color: #1e3c72; border-bottom: 3px solid #ff9800; padding-bottom: 10px; display: inline-block; margin-bottom: 20px;">
        📊 LAPORAN BOOKING & PEMBAYARAN
    </h2>
    <p style="color: #666; margin-bottom: 30px;">Laporan transaksi booking lapangan dengan detail pembayaran</p>

    <!-- Filter Form -->
    <div style="background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <form method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; align-items: end;">
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 5px; color: #333;">Status Bayar:</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <option value="">-- Semua Status --</option>
                    <option value="lunas" <?= (isset($_GET['status']) && $_GET['status']=='lunas')?'selected':'' ?>>Lunas</option>
                    <option value="DP" <?= (isset($_GET['status']) && $_GET['status']=='DP')?'selected':'' ?>>DP</option>
                </select>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: 600;">
                    🔍 Filter
                </button>
                <a href="laporan_booking_pembayaran.php" style="background: #999; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block; font-weight: 600;">
                    🔄 Reset
                </a>
            </div>
        </form>
    </div>

    <?php
    // Query data booking
    $where = "WHERE 1=1";
    
    if(isset($_GET['status']) && $_GET['status'] != '') {
        $where .= " AND status_pembayaran = '".$_GET['status']."'";
    }

    $query = "SELECT * FROM booking $where ORDER BY no DESC";

    $result = mysqli_query($conn, $query);
    $total_pendapatan = 0;
    $total_lunas = 0;
    $total_dp = 0;
    ?>

    <!-- Tabel Laporan -->
    <div style="overflow-x: auto; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white;">
                <tr>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">No</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Nama Pelanggan</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Lapangan</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Paket</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Member</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Total Harga</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $status_badge = '';
                        if($row['status_pembayaran'] == 'lunas') {
                            $status_badge = '<span style="background:#4caf50; color:white; padding:5px 12px; border-radius:20px; font-size:11px; font-weight:bold;">✓ LUNAS</span>';
                            $total_lunas++;
                        } else {
                            $status_badge = '<span style="background:#ff9800; color:white; padding:5px 12px; border-radius:20px; font-size:11px; font-weight:bold;">⚠ DP</span>';
                            $total_dp++;
                        }
                        $total_pendapatan += $row['total_harga'];
                ?>
                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 12px 15px; font-size: 13px;"><?= $no++ ?></td>
                    <td style="padding: 12px 15px; font-size: 13px;"><strong><?= $row['nama_pelanggan'] ?></strong></td>
                    <td style="padding: 12px 15px; font-size: 13px;">
                        <strong style="color:#1e3c72;"><?= $row['nama_lapangan'] ?></strong>
                    </td>
                    <td style="padding: 12px 15px; font-size: 13px;"><?= $row['nama_paket'] ?></td>
                    <td style="padding: 12px 15px; font-size: 13px;">
                        <span style="background:#e3f2fd; padding:3px 10px; border-radius:5px; font-size:11px; color:#1976d2;">
                            <?= $row['nama_member'] ?>
                        </span>
                    </td>
                    <td style="padding: 12px 15px; font-size: 13px;"><strong style="color:#2e7d32;">Rp <?= number_format($row['total_harga']) ?></strong></td>
                    <td style="padding: 12px 15px; font-size: 13px;"><?= $status_badge ?></td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center; padding:50px; color:#999; font-size:16px;'>
                            📭 Tidak ada data booking ditemukan
                          </td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Summary Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 30px;">
        <div style="background: linear-gradient(135deg, #2e7d32, #4caf50); padding: 25px; border-radius: 12px; color: white; box-shadow: 0 4px 15px rgba(46,125,50,0.3);">
            <div style="font-size: 13px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Total Pendapatan</div>
            <div style="font-size: 32px; font-weight: bold; margin: 10px 0;">Rp <?= number_format($total_pendapatan) ?></div>
            <div style="font-size: 11px; opacity: 0.8;">Dari semua transaksi booking</div>
        </div>
        <div style="background: linear-gradient(135deg, #1976d2, #42a5f5); padding: 25px; border-radius: 12px; color: white; box-shadow: 0 4px 15px rgba(25,118,210,0.3);">
            <div style="font-size: 13px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Transaksi Lunas</div>
            <div style="font-size: 32px; font-weight: bold; margin: 10px 0;"><?= $total_lunas ?></div>
            <div style="font-size: 11px; opacity: 0.8;">Pembayaran selesai</div>
        </div>
        <div style="background: linear-gradient(135deg, #f57c00, #ff9800); padding: 25px; border-radius: 12px; color: white; box-shadow: 0 4px 15px rgba(245,124,0,0.3);">
            <div style="font-size: 13px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Pembayaran DP</div>
            <div style="font-size: 32px; font-weight: bold; margin: 10px 0;"><?= $total_dp ?></div>
            <div style="font-size: 11px; opacity: 0.8;">Perlu pelunasan</div>
        </div>
    </div>

    <!-- Tombol Cetak -->
    <div style="margin-top: 30px; text-align: center;">
        <button onclick="window.print()" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border: none; padding: 15px 40px; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 15px; box-shadow: 0 4px 15px rgba(30,60,114,0.3);">
            🖨️ CETAK LAPORAN
        </button>
    </div>

    <!-- Penjelasan Query -->
    <div style="background: #f8f9fa; padding: 25px; border-radius: 10px; margin-top: 40px; border-left: 4px solid #1e3c72;">
        <h3 style="color: #1e3c72; margin-bottom: 15px;">📝 Informasi Laporan</h3>
        <p style="color: #666; line-height: 1.8; margin-bottom: 10px;">
            <strong>Laporan ini menampilkan data dari tabel booking:</strong>
        </p>
        <ul style="color: #666; line-height: 2;">
            <li><strong>booking</strong> - Data booking lapangan dengan informasi pelanggan, lapangan, paket, member, dan status pembayaran</li>
        </ul>
        <p style="color: #666; line-height: 1.8; margin-top: 15px;">
            <em>Laporan menampilkan ringkasan transaksi booking dengan filter berdasarkan status pembayaran (Lunas/DP).</em>
        </p>
    </div>
</div>

<style>
@media print {
    .sidebar, .top-nav, button, form, a {
        display: none !important;
    }
    body {
        margin: 0 !important;
    }
}
</style>

<?php include '../footer.php'; ?>