<?php
// koneksi
$koneksi = mysqli_connect("localhost","root","","db_futsal");
$halaman_ini = basename($_SERVER['PHP_SELF']);

// === SIMPAN DATA ===
if(isset($_POST['simpan'])){
    $penyewa  = $_POST['nama_penyewa'];
    $alat      = $_POST['nama_peralatan'];
    $jumlah    = $_POST['jumlah'];
    $tanggal   = $_POST['tanggal'];
    $jam       = $_POST['jam'];
    $total     = $_POST['total_bayar'];

    mysqli_query($koneksi,
        "INSERT INTO sewa_alat (nama_penyewa,nama_peralatan,jumlah,tanggal,jam,total_bayar)
         VALUES ('$penyewa','$alat','$jumlah','$tanggal','$jam','$total')"
    );
    header("location: $halaman_ini"); exit();
}

// === EDIT DATA ===
if(isset($_POST['update'])){
    $id_up      = $_POST['id_edit'];
    $penyewa    = $_POST['nama_penyewa_edit'];
    $alat       = $_POST['nama_peralatan_edit'];
    $jumlah     = $_POST['jumlah_edit'];
    $tanggal    = $_POST['tanggal_edit'];
    $jam        = $_POST['jam_edit'];
    $total      = $_POST['total_bayar_edit'];

    mysqli_query($koneksi,
        "UPDATE sewa_alat SET
         nama_penyewa='$penyewa',
         nama_peralatan='$alat',
         jumlah='$jumlah',
         tanggal='$tanggal',
         jam='$jam',
         total_bayar='$total'
         WHERE id='$id_up'"
    );
    header("location: $halaman_ini"); exit();
}

// === HAPUS DATA ===
if(isset($_GET['hapus'])){
    $id_h = $_GET['hapus'];
    mysqli_query($koneksi,"DELETE FROM sewa_alat WHERE id='$id_h'");
    header("location: $halaman_ini"); exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>TRANSAKSI SEWA PERALATAN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    body { font-family:Arial; background:#121212; color:#eee; padding:20px; }
    .card { background:#1e1e1e; padding:20px; border-radius:10px; max-width:1100px; margin:auto; border:1px solid #333; }
    input, select { padding:10px; margin:5px 0; width:100%; background:#333; color:#fff; border:1px solid #444; border-radius:5px; }
    .btn-simpan { background:#4caf50; color:#fff; border:none; padding:10px 20px; cursor:pointer; }
    .btn-dash { background:#333; color:#fff; padding:10px 15px; text-decoration:none; border-radius:5px; }
    table { width:100%; border-collapse:collapse; margin-top:20px; }
    th,td { padding:12px; border-bottom:1px solid #444; }
    th { background:#2a2a2a; color:#f57c00; }
    .btn-edit { color:#03a9f4; cursor:pointer; }
    .btn-del { color:#ff5252; text-decoration:none; }
    .modal { display:none; position:fixed; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.8); }
    .modal-content { background:#252525; margin:10% auto; padding:20px; width:350px; border-radius:10px; border:1px solid #f57c00; }
    </style>
</head>
<body>

<div class="card">
    <a href="../index.php" class="btn-dash"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <h2>🛡️ TAMBAH SEWA ALAT</h2>

    <form method="POST">
        <input type="text" name="nama_penyewa" placeholder="Nama Penyewa" required>
        <input type="text" name="nama_peralatan" placeholder="Alat" required>
        <input type="number" name="jumlah" placeholder="Qty" min="1" required>

        <input type="date" name="tanggal" required>
        <input type="time" name="jam" required>

        <input type="number" name="total_bayar" placeholder="Total (Rp)" required>

        <button type="submit" name="simpan" class="btn-simpan">🚀 SIMPAN</button>
    </form>

    <h2>🛡️ LAPORAN PENYEWAAN ALAT</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyewa</th>
                <th>Peralatan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Total Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
            $data = mysqli_query($koneksi,"SELECT * FROM sewa_alat ORDER BY id DESC");
            while($d=mysqli_fetch_assoc($data)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_penyewa']; ?></td>
                <td><?php echo $d['nama_peralatan']; ?></td>
                <td><?php echo $d['jumlah']; ?></td>
                <td><?php echo $d['tanggal']; ?></td>
                <td><?php echo $d['jam']; ?></td>
                <td><?php echo "Rp ".number_format($d['total_bayar'],0,',','.'); ?></td>
                <td>
                    <i class="fas fa-edit btn-edit" onclick="openEditModal(
                        '<?php echo $d['id'];?>',
                        '<?php echo $d['nama_penyewa'];?>',
                        '<?php echo $d['nama_peralatan'];?>',
                        '<?php echo $d['jumlah'];?>',
                        '<?php echo $d['tanggal'];?>',
                        '<?php echo $d['jam'];?>',
                        '<?php echo $d['total_bayar'];?>'
                    )"></i>
                    <a href="?hapus=<?php echo $d['id'];?>" class="btn-del"
                       onclick="return confirm('Yakin hapus data ini?')">
                       <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<!-- MODAL EDIT -->
<div id="modalEdit" class="modal">
    <div class="modal-content">
        <h3>Edit Sewa Alat</h3>
        <form method="POST">

            <input type="hidden" name="id_edit" id="id_edit">
            <input type="text" name="nama_penyewa_edit" id="nama_penyewa_edit" placeholder="Nama Penyewa" required>
            <input type="text" name="nama_peralatan_edit" id="nama_peralatan_edit" placeholder="Alat" required>
            <input type="number" name="jumlah_edit" id="jumlah_edit" placeholder="Qty" min="1" required>

            <input type="date" name="tanggal_edit" id="tanggal_edit" required>
            <input type="time" name="jam_edit" id="jam_edit" required>

            <input type="number" name="total_bayar_edit" id="total_bayar_edit" placeholder="Total (Rp)" required>

            <button type="submit" name="update" class="btn-simpan">UPDATE</button>
            <button type="button" class="btn-dash"
                onclick="document.getElementById('modalEdit').style.display='none'">BATAL
            </button>

        </form>
    </div>
</div>

<script>
function openEditModal(id,np,na,jm,td,tj,tb){
    document.getElementById('modalEdit').style.display='block';
    document.getElementById('id_edit').value=id;
    document.getElementById('nama_penyewa_edit').value=np;
    document.getElementById('nama_peralatan_edit').value=na;
    document.getElementById('jumlah_edit').value=jm;
    document.getElementById('tanggal_edit').value=td;
    document.getElementById('jam_edit').value=tj;
    document.getElementById('total_bayar_edit').value=tb;
}
</script>

</body>
</html>
