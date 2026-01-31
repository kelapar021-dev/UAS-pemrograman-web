<?php
$conn = mysqli_connect("localhost", "root", "", "db_futsal");

// Cek koneksi
if (!$conn) {
    die("❌ Koneksi gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
$uri = basename($_SERVER['PHP_SELF']);

// FITUR TAMBAH
if(isset($_POST['tambah'])){
    $id_booking = mysqli_real_escape_string($conn, $_POST['id_booking']);
    $tgl_bayar = mysqli_real_escape_string($conn, $_POST['tgl_bayar']);
    $metode_bayar = mysqli_real_escape_string($conn, $_POST['metode_bayar']);
    $nama_kasir = mysqli_real_escape_string($conn, $_POST['nama_kasir']);
    
    $query = "INSERT INTO pembayaran (id_booking, tgl_bayar, metode_bayar, nama_kasir) 
              VALUES ('$id_booking', '$tgl_bayar', '$metode_bayar', '$nama_kasir')";
    
    if(mysqli_query($conn, $query)){
        header("Location: $uri"); 
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// FITUR EDIT
if(isset($_POST['edit'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $id_booking = mysqli_real_escape_string($conn, $_POST['id_booking']);
    $tgl_bayar = mysqli_real_escape_string($conn, $_POST['tgl_bayar']);
    $metode_bayar = mysqli_real_escape_string($conn, $_POST['metode_bayar']);
    $nama_kasir = mysqli_real_escape_string($conn, $_POST['nama_kasir']);
    
    $query = "UPDATE pembayaran SET id_booking='$id_booking', tgl_bayar='$tgl_bayar', metode_bayar='$metode_bayar', nama_kasir='$nama_kasir' WHERE id_pembayaran='$id'";
    
    if(mysqli_query($conn, $query)){
        header("Location: $uri"); 
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// FITUR HAPUS
if(isset($_GET['hapus'])){
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    
    $query = "DELETE FROM pembayaran WHERE id_pembayaran='$id'";
    
    if(mysqli_query($conn, $query)){
        header("Location: $uri"); 
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSAKSI PEMBAYARAN - FUTSAL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            background: #121212; 
            color: #e0e0e0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            padding: 20px; 
        }
        .error-alert {
            background: #ff5252;
            color: white;
            padding: 15px;
            margin: 20px auto;
            max-width: 1300px;
            border-radius: 8px;
            font-weight: bold;
        }
        .box { 
            max-width: 1300px; 
            margin: auto; 
            background: #1a1a1a; 
            border: 1px solid #333; 
            border-radius: 8px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }
        .header { 
            background: linear-gradient(135deg, #222 0%, #1a1a1a 100%);
            padding: 20px; 
            border-bottom: 3px solid #f57c00; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-radius: 8px 8px 0 0;
            flex-wrap: wrap;
            gap: 10px;
        }
        .header h2 {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
        }
        .form-area { 
            padding: 20px; 
            background: #151515; 
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            border-bottom: 1px solid #252525;
        }
        input, select { 
            background: #252525; 
            color: #fff; 
            border: 1px solid #444; 
            padding: 12px; 
            border-radius: 4px; 
            outline: none;
            transition: border-color 0.3s;
            font-size: 14px;
        }
        input:focus, select:focus {
            border-color: #f57c00;
            background: #2a2a2a;
        }
        input::placeholder {
            color: #666;
        }
        .btn-simpan { 
            background: #f57c00; 
            color: #fff; 
            border: none; 
            padding: 12px 25px; 
            border-radius: 4px; 
            font-weight: bold; 
            cursor: pointer;
            grid-column: 1 / -1;
            transition: all 0.3s;
            font-size: 14px;
        }
        .btn-simpan:hover {
            background: #e65100;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(245, 124, 0, 0.3);
        }
        .btn-dash { 
            background: #333; 
            color: #fff; 
            text-decoration: none; 
            padding: 10px 20px; 
            border-radius: 4px; 
            font-size: 13px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-dash:hover {
            background: #444;
            transform: translateY(-2px);
        }
        .table-wrapper {
            overflow-x: auto;
        }
        table { 
            width: 100%; 
            border-collapse: collapse;
            min-width: 900px;
        }
        th { 
            background: #222; 
            color: #f57c00; 
            padding: 15px 10px; 
            text-align: left; 
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #333;
        }
        td { 
            padding: 15px 10px; 
            border-bottom: 1px solid #252525; 
            font-size: 13px; 
        }
        tbody tr:hover {
            background: #1e1e1e;
        }
        .badge-metode { 
            padding: 5px 12px; 
            border-radius: 20px; 
            font-weight: bold; 
            font-size: 11px; 
            text-transform: uppercase;
            display: inline-block;
            letter-spacing: 0.5px;
        }
        .badge-cash { 
            background: rgba(76,175,80,0.2); 
            color: #81c784; 
            border: 1px solid rgba(76,175,80,0.4);
        }
        .badge-transfer { 
            background: rgba(33,150,243,0.2); 
            color: #64b5f6; 
            border: 1px solid rgba(33,150,243,0.4);
        }
        .badge-qris { 
            background: rgba(156,39,176,0.2); 
            color: #ba68c8; 
            border: 1px solid rgba(156,39,176,0.4);
        }
        .action-icon {
            cursor: pointer;
            margin-right: 12px;
            font-size: 16px;
            transition: all 0.2s;
        }
        .action-icon:hover {
            transform: scale(1.2);
        }
        .footer-info {
            padding: 15px 20px;
            background: #141414;
            border-top: 1px solid #252525;
            color: #666;
            text-align: center;
            font-size: 13px;
            border-radius: 0 0 8px 8px;
        }
        .footer-info b {
            color: #f57c00;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }
    </style>
</head>
<body>

<?php if(isset($error)): ?>
    <div class="error-alert">
        <i class="fa fa-exclamation-triangle"></i> <?= $error ?>
    </div>
<?php endif; ?>

<div class="box">
    <div class="header">
        <h2>
            <i class="fa fa-money-bill-wave" style="color:#f57c00;"></i> 
            TRANSAKSI PEMBAYARAN BOOKING
        </h2>
        <a href="../index.php" class="btn-dash">
            <i class="fa fa-home"></i> DASHBOARD
        </a>
    </div>

    <form method="POST" class="form-area">
        <input type="number" name="id_booking" placeholder="ID Booking" required min="1">
        <input type="datetime-local" name="tgl_bayar" placeholder="Tanggal Bayar" required>
        <select name="metode_bayar" required>
            <option value="">-- Pilih Metode Pembayaran --</option>
            <option value="Cash">💵 Cash</option>
            <option value="Transfer">🏦 Transfer</option>
            <option value="QRIS">📱 QRIS</option>
        </select>
        <input type="text" name="nama_kasir" placeholder="Nama Kasir (contoh: Admin_Siti)" required>
        <button type="submit" name="tambah" class="btn-simpan">
            <i class="fa fa-save"></i> SIMPAN TRANSAKSI
        </button>
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th style="width:80px;">ID BAYAR</th>
                    <th style="width:100px;">ID BOOKING</th>
                    <th>TANGGAL BAYAR</th>
                    <th style="width:130px;">METODE BAYAR</th>
                    <th>NAMA KASIR</th>
                    <th style="text-align:center; width:120px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM pembayaran ORDER BY id_pembayaran DESC");
                
                if (!$q) {
                    echo "<tr><td colspan='6' style='text-align:center; color:#ff5252; padding:30px;'>";
                    echo "<i class='fa fa-exclamation-circle' style='font-size:48px; margin-bottom:15px; display:block;'></i>";
                    echo "<strong>ERROR QUERY:</strong><br>" . mysqli_error($conn);
                    echo "</td></tr>";
                } elseif (mysqli_num_rows($q) == 0) {
                    echo "<tr><td colspan='6' class='empty-state'>";
                    echo "<i class='fa fa-inbox'></i>";
                    echo "<h3 style='color:#999; margin-bottom:10px;'>Belum Ada Transaksi</h3>";
                    echo "<p style='color:#666;'>Silakan tambahkan transaksi pembayaran baru menggunakan form di atas.</p>";
                    echo "</td></tr>";
                } else {
                    while($row = mysqli_fetch_assoc($q)){
                        // Tentukan class badge berdasarkan metode pembayaran
                        $badge_class = 'badge-cash';
                        if(strtolower($row['metode_bayar']) == 'transfer'){
                            $badge_class = 'badge-transfer';
                        } elseif(strtolower($row['metode_bayar']) == 'qris'){
                            $badge_class = 'badge-qris';
                        }
                        
                        // Format tanggal
                        $tgl = date('d/m/Y H:i', strtotime($row['tgl_bayar']));
                ?>
                <tr>
                    <td><strong style="color:#f57c00;">#<?= $row['id_pembayaran'] ?></strong></td>
                    <td><strong style="color:#64b5f6;">#<?= $row['id_booking'] ?></strong></td>
                    <td>
                        <i class="fa fa-calendar" style="color:#666; margin-right:5px;"></i>
                        <?= $tgl ?>
                    </td>
                    <td>
                        <span class="badge-metode <?= $badge_class ?>">
                            <?= htmlspecialchars($row['metode_bayar']) ?>
                        </span>
                    </td>
                    <td>
                        <i class="fa fa-user" style="color:#666; margin-right:5px;"></i>
                        <?= htmlspecialchars($row['nama_kasir']) ?>
                    </td>
                    <td align="center" style="white-space:nowrap;">
                        <i class="fa fa-edit action-icon" 
                           style="color:#03a9f4;" 
                           onclick="bukaEdit('<?= $row['id_pembayaran'] ?>','<?= $row['id_booking'] ?>','<?= date('Y-m-d\TH:i', strtotime($row['tgl_bayar'])) ?>','<?= $row['metode_bayar'] ?>','<?= htmlspecialchars($row['nama_kasir']) ?>')"
                           title="Edit Transaksi"></i>
                        <a href="?hapus=<?= $row['id_pembayaran'] ?>" 
                           style="color:#ff5252; text-decoration:none;" 
                           onclick="return confirm('⚠️ Yakin ingin menghapus transaksi pembayaran ID #<?= $row['id_pembayaran'] ?>?\n\nData yang dihapus tidak dapat dikembalikan!')">
                            <i class="fa fa-trash action-icon" title="Hapus Transaksi"></i>
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

    <div class="footer-info">
        <i class="fa fa-database"></i> 
        Total Transaksi: <b><?= mysqli_num_rows($q) ?></b> pembayaran
        <?php
        // Hitung total per metode
        $total_cash = 0;
        $total_transfer = 0;
        $total_qris = 0;
        
        mysqli_data_seek($q, 0); // Reset pointer
        while($row = mysqli_fetch_assoc($q)){
            $metode = strtolower($row['metode_bayar']);
            if($metode == 'cash'){
                $total_cash++;
            } elseif($metode == 'transfer'){
                $total_transfer++;
            } elseif($metode == 'qris'){
                $total_qris++;
            }
        }
        ?>
        | <span style="color:#81c784;">Cash: <?= $total_cash ?>x</span>
        | <span style="color:#64b5f6;">Transfer: <?= $total_transfer ?>x</span>
        | <span style="color:#ba68c8;">QRIS: <?= $total_qris ?>x</span>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="mEdit" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.95); z-index:1000; align-items:center; justify-content:center;">
    <div style="background:#1a1a1a; width:90%; max-width:500px; padding:35px; border:2px solid #f57c00; border-radius:12px; box-shadow:0 8px 30px rgba(0,0,0,0.8);">
        <h3 style="color:#f57c00; margin:0 0 25px 0; font-size:20px;">
            <i class="fa fa-edit"></i> Update Transaksi Pembayaran
        </h3>
        <form method="POST">
            <input type="hidden" name="id" id="eid">
            
            <label style="display:block; margin-bottom:8px; color:#aaa; font-size:13px; font-weight:600;">
                <i class="fa fa-hashtag"></i> ID Booking
            </label>
            <input type="number" 
                   name="id_booking" 
                   id="eid_booking" 
                   style="width:100%; margin-bottom:15px;" 
                   required 
                   min="1"
                   placeholder="Masukkan ID Booking">
            
            <label style="display:block; margin-bottom:8px; color:#aaa; font-size:13px; font-weight:600;">
                <i class="fa fa-calendar"></i> Tanggal Bayar
            </label>
            <input type="datetime-local" 
                   name="tgl_bayar" 
                   id="etgl_bayar" 
                   style="width:100%; margin-bottom:15px;" 
                   required>
            
            <label style="display:block; margin-bottom:8px; color:#aaa; font-size:13px; font-weight:600;">
                <i class="fa fa-credit-card"></i> Metode Pembayaran
            </label>
            <select name="metode_bayar" id="emetode" style="width:100%; margin-bottom:15px;" required>
                <option value="Cash">💵 Cash</option>
                <option value="Transfer">🏦 Transfer</option>
                <option value="QRIS">📱 QRIS</option>
            </select>
            
            <label style="display:block; margin-bottom:8px; color:#aaa; font-size:13px; font-weight:600;">
                <i class="fa fa-user"></i> Nama Kasir
            </label>
            <input type="text" 
                   name="nama_kasir" 
                   id="ekasir" 
                   style="width:100%; margin-bottom:25px;" 
                   required
                   placeholder="Masukkan nama kasir">
            
            <button type="submit" name="edit" class="btn-simpan" style="width:100%; margin-bottom:10px;">
                <i class="fa fa-save"></i> SIMPAN PERUBAHAN
            </button>
            <button type="button" 
                    onclick="tutupModal()" 
                    style="width:100%; background:#444; border:none; color:#fff; padding:12px; border-radius:4px; cursor:pointer; font-weight:bold; transition:background 0.3s; font-size:14px;">
                <i class="fa fa-times"></i> BATAL
            </button>
        </form>
    </div>
</div>

<script>
function bukaEdit(id, id_booking, tgl_bayar, metode_bayar, nama_kasir) {
    document.getElementById('mEdit').style.display = 'flex';
    document.getElementById('eid').value = id;
    document.getElementById('eid_booking').value = id_booking;
    document.getElementById('etgl_bayar').value = tgl_bayar;
    document.getElementById('emetode').value = metode_bayar;
    document.getElementById('ekasir').value = nama_kasir;
}

function tutupModal() {
    document.getElementById('mEdit').style.display = 'none';
}

// Tutup modal dengan klik di luar
document.getElementById('mEdit').addEventListener('click', function(e) {
    if (e.target === this) {
        tutupModal();
    }
});

// Tutup modal dengan tombol ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        tutupModal();
    }
});

// Set default tanggal ke sekarang jika kosong
document.querySelector('input[name="tgl_bayar"]').value = new Date().toISOString().slice(0, 16);
</script>

</body>
</html>
<?php
mysqli_close($conn);
?>