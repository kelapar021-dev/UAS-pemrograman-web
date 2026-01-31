<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_futsal");
$halaman_ini = basename($_SERVER['PHP_SELF']);

// 1. Auto-detect Primary Key
$cek = mysqli_query($koneksi, "SELECT * FROM peralatan LIMIT 1");
$info = mysqli_fetch_field($cek);
$pk = $info->name; 

// 2. Logika AMBIL DATA UNTUK EDIT
$data_e = null;
$id_e = "";
if(isset($_GET['edit'])){
    $id_e = $_GET['edit'];
    $ambil_e = mysqli_query($koneksi, "SELECT * FROM peralatan WHERE $pk = '$id_e'");
    $data_e = mysqli_fetch_assoc($ambil_e);
}

// 3. Logika SIMPAN (TAMBAH & EDIT)
if(isset($_POST['simpan'])){
    $id_post = $_POST['id_lama'];
    $kolom_sql = []; $nilai_sql = []; $update_sql = [];
    $fields = mysqli_fetch_fields($cek);

    foreach($fields as $f){
        $nama_kolom = $f->name;
        if($nama_kolom != $pk){
            $nilai = mysqli_real_escape_string($koneksi, $_POST[$nama_kolom]);
            $kolom_sql[] = $nama_kolom;
            $nilai_sql[] = "'$nilai'";
            $update_sql[] = "$nama_kolom = '$nilai'";
        }
    }

    if($id_post != ""){
        mysqli_query($koneksi, "UPDATE peralatan SET " . implode(", ", $update_sql) . " WHERE $pk = '$id_post'");
    } else {
        mysqli_query($koneksi, "INSERT INTO peralatan (" . implode(", ", $kolom_sql) . ") VALUES (" . implode(", ", $nilai_sql) . ")");
    }
    header("location: $halaman_ini");
    exit();
}

// 4. Logika HAPUS
if(isset($_GET['hapus'])){
    $id_h = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM peralatan WHERE $pk = '$id_h'");
    header("location: $halaman_ini");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SUNSET SPORT - DATA PERALATAN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #ff9800; margin: 0; padding: 20px; }
        .card { background: white; border-radius: 15px; overflow: hidden; max-width: 1200px; margin: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .header { padding: 20px; background: #fff; border-bottom: 5px solid #1a237e; display: flex; justify-content: space-between; align-items: center; }
        .btn-back { background: #1a237e; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; display: flex; align-items: center; gap: 8px; }
        .form-area { padding: 20px; background: #f4f4f4; border-bottom: 1px solid #ddd; }
        .input-grid { display: flex; flex-wrap: wrap; gap: 10px; }
        input, select { padding: 12px; border: 1px solid #ccc; border-radius: 8px; flex: 1; min-width: 150px; }
        .btn-simpan { background: #e65100; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .table-area { background: #1a237e; padding: 15px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
        th { background: #1565c0; color: white; padding: 15px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #eee; font-size: 14px; }
        .btn-aksi { padding: 6px 12px; border-radius: 5px; text-decoration: none; color: white; font-size: 11px; font-weight: bold; }
        .badge-kondisi { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; color: white; }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        <h2 style="margin:0; color:#e65100;"><i class="fas fa-tools"></i> MASTER DATA PERALATAN</h2>
        <a href="../index.php" class="btn-back"><i class="fas fa-arrow-left"></i> KEMBALI KE DASHBOARD</a>
    </div>

    <div class="form-area">
        <form method="POST">
            <input type="hidden" name="id_lama" value="<?php echo $id_e; ?>">
            <div class="input-grid">
                <?php
                $fields = mysqli_fetch_fields($cek);
                foreach($fields as $f){
                    if($f->name != $pk){ 
                        $val = $data_e ? $data_e[$f->name] : "";
                        if(strpos($f->name, 'kondisi') !== false){
                            // Dropdown Otomatis untuk Kondisi
                            echo "<select name='$f->name' required>";
                            $opt = ['BARU', 'BAIK', 'LAYAK', 'RUSAK'];
                            foreach($opt as $o){
                                $sel = ($val == $o) ? "selected" : "";
                                echo "<option value='$o' $sel>$o</option>";
                            }
                            echo "</select>";
                        } else {
                            echo "<input type='text' name='$f->name' placeholder='Masukkan ".ucwords(str_replace('_',' ',$f->name))."...' value='$val' required>";
                        }
                    }
                }
                ?>
                <button type="submit" name="simpan" class="btn-simpan">
                    <i class="fas fa-save"></i> <?php echo $data_e ? "UPDATE ALAT" : "TAMBAH ALAT"; ?>
                </button>
            </div>
        </form>
    </div>

    <div class="table-area">
        <table>
            <thead>
                <tr>
                    <?php foreach($fields as $f) { echo "<th>".strtoupper($f->name)."</th>"; } ?>
                    <th style="text-align:center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM peralatan");
                while($row = mysqli_fetch_assoc($res)){
                    echo "<tr>";
                    foreach($fields as $f) { 
                        $isi = $row[$f->name];
                        if(strpos($f->name, 'kondisi') !== false){
                            $color = ($isi == 'RUSAK') ? '#c62828' : (($isi == 'BARU') ? '#2e7d32' : '#1565c0');
                            echo "<td><span class='badge-kondisi' style='background:$color'>$isi</span></td>";
                        } else {
                            echo "<td>".$isi."</td>"; 
                        }
                    }
                    ?>
                    <td align="center">
                        <a href="?edit=<?php echo $row[$pk]; ?>" class="btn-aksi" style="background:#0277bd;">EDIT</a>
                        <a href="?hapus=<?php echo $row[$pk]; ?>" class="btn-aksi" style="background:#c62828;" onclick="return confirm('Hapus peralatan ini?')">HAPUS</a>
                    </td>
                    <?php echo "</tr>";
                } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>