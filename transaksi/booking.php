<?php
// KONFIGURASI DATABASE
$conn = mysqli_connect("localhost", "root", "", "db_futsal");

// CEK KONEKSI
if (!$conn) {
    die("❌ KONEKSI GAGAL: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$uri = basename($_SERVER['PHP_SELF']);

// TAMBAH DATA
if(isset($_POST['add'])){
    $n = mysqli_real_escape_string($conn, $_POST['n']);
    $l = mysqli_real_escape_string($conn, $_POST['l']);
    $p = mysqli_real_escape_string($conn, $_POST['p']);
    $m = mysqli_real_escape_string($conn, $_POST['m']);
    $h = mysqli_real_escape_string($conn, $_POST['h']);
    $s = mysqli_real_escape_string($conn, $_POST['s']);
    
    $query = "INSERT INTO booking (nama_pelanggan, nama_lapangan, nama_paket, nama_member, total_harga, status_pembayaran) 
              VALUES ('$n', '$l', '$p', '$m', '$h', '$s')";
    
    if(mysqli_query($conn, $query)){
        header("Location: $uri"); 
        exit();
    } else {
        $error_msg = "ERROR INSERT: " . mysqli_error($conn);
    }
}

// EDIT DATA - Mencari kolom ID yang tepat
if(isset($_POST['edit'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $h = mysqli_real_escape_string($conn, $_POST['h']);
    $s = mysqli_real_escape_string($conn, $_POST['s']);
    
    // Coba beberapa kemungkinan nama kolom ID
    $possible_id_columns = ['id', 'no', 'id_booking', 'booking_id'];
    $update_success = false;
    
    foreach($possible_id_columns as $id_col) {
        $query = "UPDATE booking SET total_harga='$h', status_pembayaran='$s' WHERE $id_col='$id'";
        if(@mysqli_query($conn, $query)){
            $update_success = true;
            header("Location: $uri"); 
            exit();
            break;
        }
    }
    
    if(!$update_success) {
        $error_msg = "ERROR UPDATE: " . mysqli_error($conn);
    }
}

// HAPUS DATA
if(isset($_GET['del'])){
    $id = mysqli_real_escape_string($conn, $_GET['del']);
    
    // Coba beberapa kemungkinan nama kolom ID
    $possible_id_columns = ['id', 'no', 'id_booking', 'booking_id'];
    $delete_success = false;
    
    foreach($possible_id_columns as $id_col) {
        $query = "DELETE FROM booking WHERE $id_col='$id'";
        if(@mysqli_query($conn, $query)){
            $delete_success = true;
            header("Location: $uri"); 
            exit();
            break;
        }
    }
    
    if(!$delete_success) {
        $error_msg = "ERROR DELETE: " . mysqli_error($conn);
    }
}

// DETEKSI NAMA KOLOM ID OTOMATIS
$id_column = 'no'; // default
$columns_result = mysqli_query($conn, "SHOW COLUMNS FROM booking");
while($col = mysqli_fetch_assoc($columns_result)) {
    if(in_array(strtolower($col['Field']), ['id', 'no', 'id_booking', 'booking_id'])) {
        if($col['Key'] == 'PRI' || stripos($col['Extra'], 'auto_increment') !== false) {
            $id_column = $col['Field'];
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA BOOKING - FUTSAL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #121212; color: #e0e0e0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; }
        .box { max-width: 1300px; margin: auto; background: #1a1a1a; border: 1px solid #333; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.3); }
        .header { background: #222; padding: 20px; border-bottom: 2px solid #f57c00; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
        .status-badge { background: rgba(76,175,80,0.2); color: #81c784; padding: 5px 10px; border-radius: 15px; font-size: 11px; margin-top: 5px; }
        .error-msg { background: #ff5252; color: #fff; padding: 15px; margin: 20px; border-radius: 4px; }
        .form-grid { padding: 20px; background: #141414; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; }
        input, select { background: #252525; color: #fff; border: 1px solid #444; padding: 12px; border-radius: 4px; outline: none; width: 100%; }
        input:focus, select:focus { border-color: #f57c00; }
        .btn-orange { background: #f57c00; color: #fff; border: none; padding: 12px; border-radius: 4px; font-weight: bold; cursor: pointer; grid-column: 1 / -1; transition: 0.3s; }
        .btn-orange:hover { background: #e65100; }
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        th { background: #202020; color: #f57c00; padding: 15px 10px; text-align: left; font-size: 12px; text-transform: uppercase; white-space: nowrap; }
        td { padding: 12px 10px; border-bottom: 1px solid #252525; font-size: 13px; }
        tr:hover { background: #1e1e1e; }
        .st { padding: 4px 8px; border-radius: 3px; font-weight: bold; font-size: 11px; display: inline-block; white-space: nowrap; }
        .lunas { background: rgba(76,175,80,0.2); color: #81c784; }
        .dp { background: rgba(255,152,0,0.2); color: #ffb74d; }
        .action-btn { color: #03a9f4; cursor: pointer; margin-right: 10px; transition: 0.3s; font-size: 16px; }
        .action-btn:hover { color: #0288d1; transform: scale(1.1); }
        .delete-btn { color: #ff5252; transition: 0.3s; font-size: 16px; }
        .delete-btn:hover { color: #d32f2f; transform: scale(1.1); }
    </style>
</head>
<body>

<?php if(isset($error_msg)): ?>
    <div class="error-msg">❌ <?= $error_msg ?></div>
<?php endif; ?>

<div class="box">
    <div class="header">
        <div>
            <h2 style="margin:0;">📊 DATA TRANSAKSI BOOKING FUTSAL</h2>
            <div class="status-badge">✓ Koneksi OK | ID Column: <b><?= $id_column ?></b></div>
        </div>
        <a href="../index.php" style="color:#fff; text-decoration:none; background:#333; padding:10px 20px; border-radius:4px; transition:0.3s; display:inline-block;">🏠 DASHBOARD</a>
    </div>

    <form method="POST" class="form-grid">
        <input type="text" name="n" placeholder="Nama Pelanggan" required>
        <input type="text" name="l" placeholder="Lapangan (contoh: Futsal A)" required>
        <input type="text" name="p" placeholder="Paket (contoh: Paket 2 Jam)" required>
        <input type="text" name="m" placeholder="Member (contoh: Gold Member)" required>
        <input type="number" name="h" placeholder="Total Harga (Rp)" required min="0">
        <select name="s" required>
            <option value="">-- Pilih Status --</option>
            <option value="lunas">💰 Lunas</option>
            <option value="DP">💳 DP (Down Payment)</option>
        </select>
        <button type="submit" name="add" class="btn-orange">💾 SIMPAN DATA BARU</button>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width:50px;"><?= strtoupper($id_column) ?></th>
                    <th>PELANGGAN</th>
                    <th>LAPANGAN</th>
                    <th>PAKET</th>
                    <th>MEMBER</th>
                    <th style="text-align:right;">HARGA</th>
                    <th style="text-align:center;">STATUS</th>
                    <th style="text-align:center; width:100px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query dengan kolom ID yang terdeteksi otomatis
                $query = "SELECT * FROM booking ORDER BY $id_column DESC";
                $res = mysqli_query($conn, $query);
                
                if (!$res) {
                    echo "<tr><td colspan='8' style='text-align:center; color:#ff5252; padding:30px;'>";
                    echo "❌ ERROR QUERY: " . mysqli_error($conn);
                    echo "</td></tr>";
                } elseif (mysqli_num_rows($res) == 0) {
                    echo "<tr><td colspan='8' style='text-align:center; padding:30px; color:#999;'>";
                    echo "📭 Belum ada data booking. Silakan tambahkan data baru di form atas.";
                    echo "</td></tr>";
                } else {
                    while($d = mysqli_fetch_assoc($res)){
                        $cls = (strtolower($d['status_pembayaran']) == 'lunas') ? 'lunas' : 'dp';
                        $id_value = $d[$id_column];
                ?>
                <tr>
                    <td><b>#<?= $id_value ?></b></td>
                    <td>
                        <b style="color:#fff;"><?= htmlspecialchars($d['nama_pelanggan']) ?></b>
                    </td>
                    <td><?= htmlspecialchars($d['nama_lapangan']) ?></td>
                    <td><?= htmlspecialchars($d['nama_paket']) ?></td>
                    <td><small style="color:#999;"><?= htmlspecialchars($d['nama_member']) ?></small></td>
                    <td style="color:#81c784; font-weight:bold; text-align:right;">Rp <?= number_format($d['total_harga'],0,',','.') ?></td>
                    <td style="text-align:center;"><span class="st <?= $cls ?>"><?= strtoupper($d['status_pembayaran']) ?></span></td>
                    <td align="center" style="white-space: nowrap;">
                        <i class="fa fa-pen-to-square action-btn" onclick="edit('<?= $id_value ?>','<?= $d['total_harga'] ?>','<?= $d['status_pembayaran'] ?>')" title="Edit"></i>
                        <a href="?del=<?= $id_value ?>" class="delete-btn" onclick="return confirm('⚠️ Yakin ingin menghapus booking atas nama <?= htmlspecialchars($d['nama_pelanggan']) ?>?')" style="text-decoration:none;">
                            <i class="fa fa-trash" title="Hapus"></i>
                        </a>
                    </td>
                </tr>
                <?php 
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div style="padding:15px; background:#141414; color:#666; text-align:center; font-size:12px; border-top:1px solid #252525;">
        📊 Total Data: <b style="color:#f57c00;"><?= mysqli_num_rows($res) ?></b> transaksi booking
    </div>
</div>

<!-- MODAL EDIT -->
<div id="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.95); z-index:1000; align-items:center; justify-content:center;">
    <div style="background:#1a1a1a; width:90%; max-width:400px; padding:30px; border:2px solid #f57c00; border-radius:10px; box-shadow:0 4px 20px rgba(0,0,0,0.5);">
        <h3 style="color:#f57c00; margin-top:0; margin-bottom:20px;">✏️ Update Data Booking</h3>
        <form method="POST">
            <input type="hidden" name="id" id="eid">
            
            <label style="display:block; margin-bottom:5px; color:#999; font-size:13px;">Total Harga (Rp)</label>
            <input type="number" name="h" id="eh" style="width:100%; margin-bottom:15px;" required min="0">
            
            <label style="display:block; margin-bottom:5px; color:#999; font-size:13px;">Status Pembayaran</label>
            <select name="s" id="es" style="width:100%; margin-bottom:20px;" required>
                <option value="lunas">💰 Lunas</option>
                <option value="DP">💳 DP (Down Payment)</option>
            </select>
            
            <button type="submit" name="edit" class="btn-orange" style="width:100%;">✓ SIMPAN PERUBAHAN</button>
            <button type="button" onclick="closeModal()" style="width:100%; margin-top:10px; background:#444; border:none; color:#fff; padding:12px; border-radius:4px; cursor:pointer; transition:0.3s; font-weight:bold;">✕ BATAL</button>
        </form>
    </div>
</div>

<script>
function edit(id, hrg, status) {
    document.getElementById('modal').style.display='flex';
    document.getElementById('eid').value = id;
    document.getElementById('eh').value = hrg;
    document.getElementById('es').value = status;
}

function closeModal() {
    document.getElementById('modal').style.display='none';
}

// Close modal saat klik di luar
document.getElementById('modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal dengan tombol ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>

</body>
</html>
<?php
mysqli_close($conn);
?>