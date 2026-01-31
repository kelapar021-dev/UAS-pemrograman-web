<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_futsal");
$halaman_ini = basename($_SERVER['PHP_SELF']);

// --- SIMPAN DATA ---
if(isset($_POST['simpan'])){
    $nama = $_POST['pegawai'];
    $jbt  = $_POST['jabatan'];
    $nom  = $_POST['nominal'];

    // Ambil tanggal manual
    $tanggal_input = $_POST['tanggal_input'];
    $bulan_input   = $_POST['bulan_input'];
    $tahun_input   = $_POST['tahun_input'];
    $tgl           = "$tahun_input-$bulan_input-$tanggal_input";

    $jam = $_POST['jam_input'];

    mysqli_query($koneksi,
        "INSERT INTO gaji (nama_pegawai, jabatan, tanggal, jam, gaji) 
         VALUES ('$nama','$jbt','$tgl','$jam','$nom')");
    header("location: $halaman_ini"); exit();
}

// --- UPDATE DATA ---
if(isset($_POST['update'])){
    $id_up  = $_POST['id_edit'];
    $nom_up = $_POST['nominal_edit'];
    mysqli_query($koneksi, "UPDATE gaji SET gaji='$nom_up' WHERE id='$id_up'");
    header("location: $halaman_ini"); exit();
}

// --- HAPUS DATA ---
if(isset($_GET['hapus'])){
    $id_h = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM gaji WHERE id='$id_h'");
    header("location: $halaman_ini"); exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SISTEM GAJI LENGKAP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background:#121212; color:#eee; font-family:Arial; padding:20px; }
        .card { background:#1f1f1f; padding:20px; border-radius:10px; margin:auto; max-width:1200px; }
        input, select { padding:10px; background:#333; color:#fff; border:1px solid #444; border-radius:5px; margin:5px 0; }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th,td{ padding:12px; border-bottom:1px solid #444; }
        th{ background:#2a2a2a; color:#f57c00; }
        .btn-simpan{ background:#f57c00; color:#fff; border:none; padding:12px 20px; cursor:pointer; }
        .btn-dash{ background:#333; color:#fff; padding:10px 15px; text-decoration:none; border-radius:5px;}
        .btn-edit{ color:#03a9f4; cursor:pointer; }
        .btn-del{ color:#ff5252; text-decoration:none; }
        .modal{ display:none; position:fixed; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.8); }
        .modal-content{ background:#252525; margin:10% auto; padding:20px; width:350px; border:1px solid #f57c00; border-radius:10px; }
    </style>
</head>
<body>

<div class="card">
    <a href="../index.php" class="btn-dash"><i class="fas fa-tachometer-alt"></i> DASHBOARD</a>
    <h2>Form Input Gaji</h2>

    <form method="POST">
        <select name="pegawai" id="pegawai" onchange="updateJabatan()" required>
            <option value="">-- Pilih Pegawai --</option>
            <?php
            $q_pegawai = mysqli_query($koneksi, "SELECT nama_pegawai,jabatan FROM pegawai");
            while($r = mysqli_fetch_assoc($q_pegawai)){
                echo "<option value='{$r['nama_pegawai']}' data-jabatan='{$r['jabatan']}'>{$r['nama_pegawai']}</option>";
            }
            ?>
        </select>

        <input type="text" name="jabatan" id="jabatan" placeholder="Jabatan otomatis" readonly>

        <input type="number" name="tanggal_input" placeholder="Tanggal (1-31)" min="1" max="31" required>
        <input type="number" name="bulan_input" placeholder="Bulan (1-12)" min="1" max="12" required>
        <input type="number" name="tahun_input" placeholder="Tahun (mis: 2025)" min="2022" required>
        <input type="time" name="jam_input" required>

        <input type="number" name="nominal" placeholder="Nominal Gaji (Rp)" required>

        <button type="submit" name="simpan" class="btn-simpan">SIMPAN</button>
    </form>

    <h2>Data Gaji Terakhir</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pegawai</th>
                <th>Jabatan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = mysqli_query($koneksi,"SELECT * FROM gaji ORDER BY id DESC LIMIT 15");
            while($d = mysqli_fetch_assoc($data)){
            ?>
            <tr>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo $d['nama_pegawai']; ?></td>
                <td><?php echo $d['jabatan']; ?></td>
                <td><?php echo $d['tanggal']; ?></td>
                <td><?php echo $d['jam']; ?></td>
                <td><?php echo "Rp ".number_format($d['gaji'],0,',','.'); ?></td>
                <td>
                    <i class="fas fa-edit btn-edit" onclick="openEditModal('<?php echo $d['id'];?>','<?php echo $d['gaji'];?>')"></i>
                    <a href="?hapus=<?php echo $d['id'];?>" class="btn-del" onclick="return confirm('Yakin hapus?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="modal">
    <div class="modal-content">
        <h3>Edit Gaji</h3>
        <form method="POST">
            <input type="hidden" name="id_edit" id="id_edit">
            <input type="number" name="nominal_edit" id="nominal_edit" placeholder="Nominal baru..." required>

            <button type="submit" name="update" class="btn-simpan">UPDATE</button>
            <button type="button" onclick="document.getElementById('modalEdit').style.display='none'" class="btn-dash">BATAL</button>
        </form>
    </div>
</div>

<script>
function updateJabatan(){
    var pegawai = document.getElementById('pegawai');
    var jabatan = document.getElementById('jabatan');
    var selected = pegawai.options[pegawai.selectedIndex];
    jabatan.value = selected.getAttribute('data-jabatan');
}

function openEditModal(id, gaji){
    document.getElementById('modalEdit').style.display='block';
    document.getElementById('id_edit').value=id;
    document.getElementById('nominal_edit').value=gaji;
}
</script>

</body>
</html>
