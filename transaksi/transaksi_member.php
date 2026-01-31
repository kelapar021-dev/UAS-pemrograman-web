<?php
$koneksi = mysqli_connect("localhost","root","","db_futsal");
$halaman_ini = basename($_SERVER['PHP_SELF']);

// === SIMPAN MEMBER BARU ===
if(isset($_POST['simpan'])){
    $nama_member  = $_POST['nama_member'];
    $nama_pemilik = $_POST['nama_pemilik'];
    $tier         = $_POST['tier'];
    $diskon       = $_POST['diskon'];
    $tgl_daftar   = $_POST['tgl_daftar'];

    mysqli_query($koneksi,
        "INSERT INTO member (nama_member,nama_pemilik,tier,diskon,tgl_daftar)
         VALUES ('$nama_member','$nama_pemilik','$tier','$diskon','$tgl_daftar')"
    );

    header("location:$halaman_ini"); exit();
}

// === EDIT MEMBER ===
if(isset($_POST['update'])){
    $id_up         = $_POST['id_edit'];
    $nama_up       = $_POST['nama_member_edit'];
    $pemilik_up    = $_POST['nama_pemilik_edit'];
    $tier_up       = $_POST['tier_edit'];
    $diskon_up     = $_POST['diskon_edit'];
    $tgl_up        = $_POST['tgl_daftar_edit'];

    mysqli_query($koneksi,
        "UPDATE member SET 
         nama_member='$nama_up',
         nama_pemilik='$pemilik_up',
         tier='$tier_up',
         diskon='$diskon_up',
         tgl_daftar='$tgl_up'
         WHERE id='$id_up'"
    );

    header("location:$halaman_ini"); exit();
}

// === HAPUS MEMBER ===
if(isset($_GET['hapus'])){
    $id_h = $_GET['hapus'];
    mysqli_query($koneksi,"DELETE FROM member WHERE id='$id_h'");
    header("location:$halaman_ini"); exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>DATA MEMBER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body{ font-family:Arial; background:#121212; color:#eee; padding:20px; }
        .card{ background:#1e1e1e; max-width:1100px; margin:auto; border-radius:10px; padding:20px; border:1px solid #333; }
        input,select{ padding:10px; margin:5px 0; width:100%; background:#333; color:#fff; border:1px solid #444; border-radius:5px; }
        .btn-simpan{ background:#4caf50; color:#fff; padding:10px 20px; cursor:pointer; border:none; }
        .btn-dash{ background:#333; color:#fff; padding:10px 15px; text-decoration:none; border-radius:5px; }
        table{ width:100%; border-collapse:collapse; margin-top:20px; }
        th,td{ padding:12px; border-bottom:1px solid #444; }
        th{ background:#2a2a2a; color:#f57c00;}
        .btn-edit{ color:#03a9f4; cursor:pointer; margin-right:10px; }
        .btn-del{ color:#ff5252; text-decoration:none; }
        .modal{ display:none; position:fixed; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.8); }
        .modal-content{ background:#252525; margin:10% auto; padding:20px; width:350px; border-radius:10px; border:1px solid #f57c00;}
    </style>
</head>
<body>

<div class="card">

    <a href="../index.php" class="btn-dash"><i class="fas fa-tachometer-alt"></i> DASHBOARD</a>
    <h2>FORM DAFTAR MEMBER BARU</h2>

    <form method="POST">
        <input type="text" name="nama_member" placeholder="Nama Member..." required>
        <input type="text" name="nama_pemilik" placeholder="Nama Pemilik..." required>

        <select name="tier" required>
            <option value="">-- Pilih Tier --</option>
            <option value="BRONZE">BRONZE (5%)</option>
            <option value="SILVER">SILVER (8%)</option>
            <option value="GOLD">GOLD (10%)</option>
            <option value="PLATINUM">PLATINUM (15%)</option>
            <option value="ELITE">ELITE (20%)</option>
        </select>

        <input type="number" name="diskon" placeholder="Diskon Angka (cth: 10)" required>
        <input type="date" name="tgl_daftar" required>

        <button type="submit" name="simpan" class="btn-simpan">🚀 DAFTARKAN</button>
    </form>

    <h2>DAFTAR MEMBER</h2>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA MEMBER</th>
                <th>NAMA PEMILIK</th>
                <th>TIER</th>
                <th>DISKON</th>
                <th>TGL DAFTAR</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
            $data = mysqli_query($koneksi,"SELECT * FROM member ORDER BY id DESC");
            while($d=mysqli_fetch_assoc($data)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_member']; ?></td>
                <td><?php echo $d['nama_pemilik']; ?></td>
                <td><?php echo $d['tier']; ?></td>
                <td><?php echo $d['diskon']."%"; ?></td>
                <td><?php echo $d['tgl_daftar']; ?></td>
                <td>
                    <i class="fas fa-edit btn-edit" onclick="openEditModal(
                        '<?php echo $d['id'];?>',
                        '<?php echo $d['nama_member'];?>',
                        '<?php echo $d['nama_pemilik'];?>',
                        '<?php echo $d['tier'];?>',
                        '<?php echo $d['diskon'];?>',
                        '<?php echo $d['tgl_daftar'];?>'
                    )"></i>
                    <a href="?hapus=<?php echo $d['id'];?>" class="btn-del" onclick="return confirm('Yakin hapus data?')">
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
        <h3>Edit Member</h3>
        <form method="POST">
            <input type="hidden" name="id_edit" id="id_edit">
            <input type="text" name="nama_member_edit" id="nama_member_edit" placeholder="Nama Member" required>
            <input type="text" name="nama_pemilik_edit" id="nama_pemilik_edit" placeholder="Nama Pemilik" required>

            <select name="tier_edit" id="tier_edit" required>
                <option value="BRONZE">BRONZE</option>
                <option value="SILVER">SILVER</option>
                <option value="GOLD">GOLD</option>
                <option value="PLATINUM">PLATINUM</option>
                <option value="ELITE">ELITE</option>
            </select>

            <input type="number" name="diskon_edit" id="diskon_edit" placeholder="Diskon (%)" required>
            <input type="date" name="tgl_daftar_edit" id="tgl_daftar_edit" required>

            <button type="submit" name="update" class="btn-simpan">UPDATE</button>
            <button type="button" class="btn-dash" onclick="document.getElementById('modalEdit').style.display='none'">BATAL</button>
        </form>
    </div>
</div>

<script>
function openEditModal(id,nm,np,ti,di,td){
    document.getElementById('modalEdit').style.display='block';
    document.getElementById('id_edit').value=id;
    document.getElementById('nama_member_edit').value=nm;
    document.getElementById('nama_pemilik_edit').value=np;
    document.getElementById('tier_edit').value=ti;
    document.getElementById('diskon_edit').value=di;
    document.getElementById('tgl_daftar_edit').value=td;
}
</script>

</body>
</html>
