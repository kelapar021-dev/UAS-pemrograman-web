<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_futsal");

// Deteksi nama file sendiri supaya redirect tidak error
$halaman_ini = basename($_SERVER['PHP_SELF']);

// --- LOGIKA EDIT & SIMPAN ---
$id_e = ""; $nama_e = ""; $jenis_e = ""; $status_e = "";
if(isset($_GET['edit'])){
    $id_get = $_GET['edit'];
    $ambil = mysqli_query($koneksi, "SELECT * FROM lapangan WHERE id='$id_get'");
    $data_e = mysqli_fetch_array($ambil);
    $id_e     = $data_e['id'];
    $nama_e   = $data_e['nama_lapangan'];
    $jenis_e  = $data_e['jenis_lapangan'];
    $status_e = $data_e['status_lapangan'];
}

if(isset($_POST['simpan'])){
    $id_post = $_POST['id_lama'];
    $nama    = $_POST['nama_lapangan'];
    $jenis   = $_POST['jenis_lapangan'];
    $status  = $_POST['status_lapangan'];

    if($id_post != ""){
        mysqli_query($koneksi, "UPDATE lapangan SET nama_lapangan='$nama', jenis_lapangan='$jenis', status_lapangan='$status' WHERE id='$id_post'");
    } else {
        mysqli_query($koneksi, "INSERT INTO lapangan (nama_lapangan, jenis_lapangan, status_lapangan) VALUES ('$nama', '$jenis', '$status')");
    }
    header("location: $halaman_ini");
    exit();
}

if(isset($_GET['hapus'])){
    $id_h = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM lapangan WHERE id='$id_h'");
    header("location: $halaman_ini");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SUNSET SPORT - DATA LAPANGAN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #ff9800; margin: 0; padding: 20px; }
        .main-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.3); max-width: 1100px; margin: auto; }
        
        /* HEADER DENGAN TOMBOL KEMBALI */
        .header-nav { 
            padding: 20px 25px; 
            background: #fff; 
            border-bottom: 5px solid #1a237e; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        .btn-kembali { 
            background: #1a237e; 
            color: white; 
            text-decoration: none; 
            padding: 12px 20px; 
            border-radius: 10px; 
            font-weight: bold; 
            display: flex; 
            align-items: center; 
            gap: 10px;
            transition: 0.3s;
        }
        .btn-kembali:hover { background: #0d47a1; transform: translateX(-5px); }

        .form-section { padding: 25px; background: #fff; }
        .input-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr; gap: 10px; }
        input, select { padding: 12px; border: 1px solid #ffcc80; border-radius: 8px; outline: none; }
        .btn-simpan { background: #e65100; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; }
        
        .table-section { background: #1a237e; padding: 10px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
        th { background: #1565c0; color: white; padding: 15px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        .btn-aksi { padding: 6px 10px; border-radius: 5px; text-decoration: none; color: white; }
        .edit { background: #0277bd; }
        .hapus { background: #c62828; }
    </style>
</head>
<body>

<div class="main-card">
    <div class="header-nav">
        <h2 style="margin:0; color:#e65100;"><i class="fas fa-futbol"></i> MASTER DATA LAPANGAN</h2>
        <a href="../index.php" class="btn-kembali">
            <i class="fas fa-arrow-left"></i> KEMBALI KE DASHBOARD
        </a>
    </div>

    <div class="form-section">
        <form method="POST" action="">
            <input type="hidden" name="id_lama" value="<?php echo $id_e; ?>">
            <div class="input-grid">
                <input type="text" name="nama_lapangan" placeholder="Nama Lapangan..." value="<?php echo $nama_e; ?>" required>
                <select name="jenis_lapangan">
                    <option value="futsal" <?php if($jenis_e == "futsal") echo "selected"; ?>>Futsal</option>
                    <option value="minisoccer" <?php if($jenis_e == "minisoccer") echo "selected"; ?>>Minisoccer</option>
                </select>
                <select name="status_lapangan">
                    <option value="tersedia" <?php if($status_e == "tersedia") echo "selected"; ?>>Tersedia</option>
                    <option value="tidak tersedia" <?php if($status_e == "tidak tersedia") echo "selected"; ?>>Tidak Tersedia</option>
                </select>
                <button type="submit" name="simpan" class="btn-simpan">
                    <?php echo ($id_e != "") ? "UPDATE" : "TAMBAH"; ?>
                </button>
                <?php if($id_e != ""): ?>
                    <a href="<?php echo $halaman_ini; ?>" style="padding:12px; background:#eee; border-radius:8px; text-align:center; color:black; text-decoration:none;">X</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="table-section">
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>NAMA LAPANGAN</th><th>JENIS</th><th>STATUS</th><th style="text-align:center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM lapangan ORDER BY id ASC");
                while($row = mysqli_fetch_array($res)){
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><b><?php echo strtoupper($row['nama_lapangan']); ?></b></td>
                    <td><?php echo ucfirst($row['jenis_lapangan']); ?></td>
                    <td><?php echo strtoupper($row['status_lapangan']); ?></td>
                    <td align="center">
                        <a href="?edit=<?php echo $row['id']; ?>" class="btn-aksi edit"><i class="fas fa-edit"></i></a>
                        <a href="?hapus=<?php echo $row['id']; ?>" class="btn-aksi hapus" onclick="return confirm('Hapus?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>