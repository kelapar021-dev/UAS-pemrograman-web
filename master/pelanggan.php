<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_futsal");
$halaman_ini = basename($_SERVER['PHP_SELF']);

// 1. Deteksi Kolom ID Otomatis
$cek = mysqli_query($koneksi, "SELECT * FROM pelanggan LIMIT 1");
$info = mysqli_fetch_field($cek);
$pk = $info->name; 

// 2. Hitung Total Pelanggan Otomatis
$hitung = mysqli_query($koneksi, "SELECT * FROM pelanggan");
$total_pelanggan = mysqli_num_rows($hitung);

// 3. Logika AMBIL DATA UNTUK EDIT (Jika masih butuh koreksi data)
$data_e = null; $id_e = "";
if(isset($_GET['edit'])){
    $id_e = $_GET['edit'];
    $ambil_e = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE $pk = '$id_e'");
    $data_e = mysqli_fetch_assoc($ambil_e);
}

// 4. Logika UPDATE (Hanya Edit, Tambah dihapus karena Otomatis dari Booking)
if(isset($_POST['update_data'])){
    $id_post = $_POST['id_lama'];
    $update_sql = [];
    $fields = mysqli_fetch_fields($cek);

    foreach($fields as $f){
        $nama_kolom = $f->name;
        if($nama_kolom != $pk){
            $nilai = mysqli_real_escape_string($koneksi, $_POST[$nama_kolom]);
            $update_sql[] = "$nama_kolom = '$nilai'";
        }
    }
    mysqli_query($koneksi, "UPDATE pelanggan SET " . implode(", ", $update_sql) . " WHERE $pk = '$id_post'");
    header("location: $halaman_ini"); exit();
}

// 5. Logika HAPUS
if(isset($_GET['hapus'])){
    $id_h = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE $pk = '$id_h'");
    header("location: $halaman_ini"); exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SUNSET SPORT - DATABASE PELANGGAN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #ff9800; margin: 0; padding: 20px; }
        .card { background: white; border-radius: 15px; overflow: hidden; max-width: 1200px; margin: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .header { padding: 20px; background: #fff; border-bottom: 5px solid #1a237e; display: flex; justify-content: space-between; align-items: center; }
        .btn-back { background: #1a237e; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; display: flex; align-items: center; gap: 8px; }
        .stats-bar { background: #e3f2fd; padding: 15px 25px; border-bottom: 1px solid #ddd; display: flex; align-items: center; gap: 15px; color: #0d47a1; }
        .counter { background: #1a237e; color: white; padding: 5px 15px; border-radius: 20px; font-size: 14px; }
        .form-edit-area { padding: 20px; background: #fff9c4; border-bottom: 2px solid #fbc02d; }
        .input-grid { display: flex; flex-wrap: wrap; gap: 10px; }
        input { padding: 10px; border: 1px solid #ccc; border-radius: 5px; flex: 1; }
        .table-area { background: #1a237e; padding: 15px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
        th { background: #1565c0; color: white; padding: 15px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #eee; font-size: 14px; }
        .btn-aksi { padding: 6px 12px; border-radius: 5px; text-decoration: none; color: white; font-size: 11px; font-weight: bold; }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        <h2 style="margin:0; color:#e65100;"><i class="fas fa-database"></i> DATABASE PELANGGAN TETAP</h2>
        <a href="../index.php" class="btn-back"><i class="fas fa-arrow-left"></i> KEMBALI KE DASHBOARD</a>
    </div>

    <div class="stats-bar">
        <i class="fas fa-users-cog fa-lg"></i> 
        <span>SISTEM LOG PELANGGAN</span>
        <span class="counter">Total Terdaftar: <?php echo $total_pelanggan; ?></span>
        <small style="color: #666;">*Data bertambah otomatis saat proses Booking dilakukan.</small>
    </div>

    <?php if($data_e): ?>
    <div class="form-edit-area">
        <p style="margin: 0 0 10px 0; font-weight: bold; color: #f57f17;">MODE EDIT DATA PELANGGAN:</p>
        <form method="POST">
            <input type="hidden" name="id_lama" value="<?php echo $id_e; ?>">
            <div class="input-grid">
                <?php
                foreach($fields as $f){
                    if($f->name != $pk){ 
                        $val = $data_e[$f->name];
                        echo "<input type='text' name='$f->name' value='$val' required>";
                    }
                }
                ?>
                <button type="submit" name="update_data" class="btn-aksi" style="background:#f57f17; border:none; cursor:pointer; padding: 0 20px;">UPDATE</button>
                <a href="<?php echo $halaman_ini; ?>" style="padding:10px; color:#666; text-decoration:none;">BATAL</a>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <div class="table-area">
        <table>
            <thead>
                <tr>
                    <?php 
                    $fields = mysqli_fetch_fields($cek);
                    foreach($fields as $f) { echo "<th>".strtoupper($f->name)."</th>"; } 
                    ?>
                    <th style="text-align:center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                while($row = mysqli_fetch_assoc($res)){
                    echo "<tr>";
                    foreach($fields as $f) { echo "<td>".$row[$f->name]."</td>"; }
                    ?>
                    <td align="center">
                        <a href="?edit=<?php echo $row[$pk]; ?>" class="btn-aksi" style="background:#0277bd;">EDIT</a>
                        <a href="?hapus=<?php echo $row[$pk]; ?>" class="btn-aksi" style="background:#c62828;" onclick="return confirm('Hapus data pelanggan?')">HAPUS</a>
                    </td>
                    <?php echo "</tr>";
                } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>