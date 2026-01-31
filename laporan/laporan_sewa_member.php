<?php include '../header.php'; ?>

<div style="padding: 30px;">
    <h2 style="color: #1e3c72; border-bottom: 3px solid #ff9800; padding-bottom: 10px; display: inline-block; margin-bottom: 20px;">
        📈 LAPORAN SEWA PERALATAN & MEMBER
    </h2>
    <p style="color: #666; margin-bottom: 30px;">Laporan transaksi sewa peralatan dengan detail member</p>

    <!-- Filter Form -->
    <div style="background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <form method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; align-items: end;">
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 5px; color: #333;">Tanggal Mulai:</label>
                <input type="date" name="tgl_mulai" value="<?= $_GET['tgl_mulai'] ?? '' ?>" 
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 5px; color: #333;">Tanggal Akhir:</label>
                <input type="date" name="tgl_akhir" value="<?= $_GET['tgl_akhir'] ?? '' ?>" 
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 5px; color: #333;">Jenis Alat:</label>
                <select name="jenis_alat" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    <option value="">-- Semua Jenis --</option>
                    <?php
                    // Get unique peralatan
                    $alat_query = mysqli_query($conn, "SELECT DISTINCT nama_peralatan FROM sewa_alat ORDER BY nama_peralatan");
                    while($alat = mysqli_fetch_assoc($alat_query)) {
                        $selected = (isset($_GET['jenis_alat']) && $_GET['jenis_alat'] == $alat['nama_peralatan']) ? 'selected' : '';
                        echo "<option value='{$alat['nama_peralatan']}' {$selected}>{$alat['nama_peralatan']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: 600;">
                    🔍 Filter
                </button>
                <a href="laporan_sewa_member.php" style="background: #999; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px; display: inline-block; font-weight: 600;">
                    🔄 Reset
                </a>
            </div>
        </form>
    </div>

    <?php
    // Query data sewa alat dengan filter
    $where = "WHERE 1=1";
    
    if(isset($_GET['tgl_mulai']) && $_GET['tgl_mulai'] != '') {
        $where .= " AND tanggal >= '".$_GET['tgl_mulai']."'";
    }
    if(isset($_GET['tgl_akhir']) && $_GET['tgl_akhir'] != '') {
        $where .= " AND tanggal <= '".$_GET['tgl_akhir']."'";
    }
    if(isset($_GET['jenis_alat']) && $_GET['jenis_alat'] != '') {
        $where .= " AND nama_peralatan = '".$_GET['jenis_alat']."'";
    }

    $query = "SELECT * FROM sewa_alat $where ORDER BY tanggal DESC, jam DESC";

    $result = mysqli_query($conn, $query);
    $total_pendapatan = 0;
    $total_transaksi = 0;
    $total_qty = 0;
    ?>

    <!-- Tabel Laporan -->
    <div style="overflow-x: auto; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white;">
                <tr>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">No</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Tanggal</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Jam</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Nama Penyewa</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Nama Peralatan</th>
                    <th style="padding: 15px; text-align: center; font-size: 13px;">Jumlah</th>
                    <th style="padding: 15px; text-align: left; font-size: 13px;">Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $total_pendapatan += $row['total_bayar'];
                        $total_transaksi++;
                        $total_qty += $row['jumlah'];
                ?>
                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 12px 15px; font-size: 13px;"><?= $no++ ?></td>
                    <td style="padding: 12px 15px; font-size: 13px;"><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td style="padding: 12px 15px; font-size: 13px;"><?= date('H:i', strtotime($row['jam'])) ?></td>
                    <td style="padding: 12px 15px; font-size: 13px;"><strong><?= $row['nama_penyewa'] ?></strong></td>
                    <td style="padding: 12px 15px; font-size: 13px;">
                        <span style="background:#e3f2fd; padding:5px 12px; border-radius:5px; font-size:12px; color:#1976d2;">
                            <?= $row['nama_peralatan'] ?>
                        </span>
                    </td>
                    <td style="padding: 12px 15px; font-size: 13px; text-align: center;">
                        <strong style="background:#fff3e0; padding:5px 12px; border-radius:5px; color:#f57c00;">
                            <?= $row['jumlah'] ?> pcs
                        </strong>
                    </td>
                    <td style="padding: 12px 15px; font-size: 13px;">
                        <strong style="color:#2e7d32;">Rp <?= number_format($row['total_bayar']) ?></strong>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center; padding:50px; color:#999; font-size:16px;'>
                            📭 Tidak ada data sewa peralatan ditemukan
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
            <div style="font-size: 11px; opacity: 0.8;">Dari semua transaksi sewa</div>
        </div>
        <div style="background: linear-gradient(135deg, #1976d2, #42a5f5); padding: 25px; border-radius: 12px; color: white; box-shadow: 0 4px 15px rgba(25,118,210,0.3);">
            <div style="font-size: 13px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Total Transaksi</div>
            <div style="font-size: 32px; font-weight: bold; margin: 10px 0;"><?= $total_transaksi ?></div>
            <div style="font-size: 11px; opacity: 0.8;">Transaksi sewa peralatan</div>
        </div>
        <div style="background: linear-gradient(135deg, #f57c00, #ff9800); padding: 25px; border-radius: 12px; color: white; box-shadow: 0 4px 15px rgba(245,124,0,0.3);">
            <div style="font-size: 13px; opacity: 0.9; text-transform: uppercase; letter-spacing: 1px;">Total Qty Disewa</div>
            <div style="font-size: 32px; font-weight: bold; margin: 10px 0;"><?= $total_qty ?> pcs</div>
            <div style="font-size: 11px; opacity: 0.8;">Total unit peralatan</div>
        </div>
    </div>

    <!-- Top Peralatan Terlaris -->
    <?php
    $top_query = "SELECT 
                    nama_peralatan, 
                    SUM(jumlah) as total_qty,
                    COUNT(*) as jumlah_transaksi,
                    SUM(total_bayar) as total_pendapatan
                  FROM sewa_alat 
                  $where
                  GROUP BY nama_peralatan 
                  ORDER BY total_qty DESC 
                  LIMIT 5";
    $top_result = mysqli_query($conn, $top_query);
    ?>

    <div style="background: white; padding: 25px; border-radius: 10px; margin-top: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <h3 style="color: #1e3c72; margin-bottom: 20px;">🏆 Top 5 Peralatan Terlaris</h3>
        <div style="display: grid; gap: 15px;">
            <?php 
            $rank = 1;
            while($top = mysqli_fetch_assoc($top_result)) { 
                $color = ['#FFD700', '#C0C0C0', '#CD7F32', '#4CAF50', '#2196F3'];
            ?>
            <div style="display: flex; align-items: center; background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid <?= $color[$rank-1] ?>;">
                <div style="font-size: 24px; font-weight: bold; color: <?= $color[$rank-1] ?>; width: 50px;">#<?= $rank++ ?></div>
                <div style="flex: 1;">
                    <div style="font-weight: bold; color: #1e3c72; font-size: 15px;"><?= $top['nama_peralatan'] ?></div>
                    <div style="color: #666; font-size: 12px; margin-top: 5px;">
                        <?= $top['total_qty'] ?> pcs disewa • <?= $top['jumlah_transaksi'] ?> transaksi • 
                        <span style="color: #2e7d32; font-weight: bold;">Rp <?= number_format($top['total_pendapatan']) ?></span>
                    </div>
                </div>
            </div>
            <?php } ?>
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
            <strong>Laporan ini menampilkan data dari tabel sewa_alat:</strong>
        </p>
        <ul style="color: #666; line-height: 2;">
            <li><strong>sewa_alat</strong> - Data transaksi sewa peralatan dengan informasi penyewa, jenis peralatan, jumlah, dan pembayaran</li>
        </ul>
        <p style="color: #666; line-height: 1.8; margin-top: 15px;">
            <em>Laporan menampilkan detail transaksi sewa peralatan dengan filter berdasarkan tanggal dan jenis alat, serta menampilkan top 5 peralatan terlaris.</em>
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