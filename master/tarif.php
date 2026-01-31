<?php
// Konfigurasi Database
$host = "localhost";
$username = "root";
$password = "";
$database = "db_futsal";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

// Proses HAPUS
if (isset($_GET['hapus'])) {
    $id_tarif = $_GET['hapus'];
    $query = "DELETE FROM tarif WHERE id_tarif = '$id_tarif'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Tarif berhasil dihapus!'); window.location.href='tarif.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Proses TAMBAH
if (isset($_POST['tambah'])) {
    $nama_tarif = mysqli_real_escape_string($conn, $_POST['nama_tarif']);
    $jenis_hari = mysqli_real_escape_string($conn, $_POST['jenis_hari']);
    $harga_per_jam = mysqli_real_escape_string($conn, $_POST['harga_per_jam']);
    
    $query = "INSERT INTO tarif (nama_tarif, jenis_hari, harga_per_jam) 
              VALUES ('$nama_tarif', '$jenis_hari', '$harga_per_jam')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Tarif berhasil ditambahkan!'); window.location.href='tarif.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Proses UPDATE
if (isset($_POST['update'])) {
    $id_tarif = $_POST['id_tarif'];
    $nama_tarif = mysqli_real_escape_string($conn, $_POST['nama_tarif']);
    $jenis_hari = mysqli_real_escape_string($conn, $_POST['jenis_hari']);
    $harga_per_jam = mysqli_real_escape_string($conn, $_POST['harga_per_jam']);
    
    $query = "UPDATE tarif SET 
              nama_tarif = '$nama_tarif',
              jenis_hari = '$jenis_hari',
              harga_per_jam = '$harga_per_jam'
              WHERE id_tarif = '$id_tarif'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Tarif berhasil diupdate!'); window.location.href='tarif.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Ambil data untuk edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $query_edit = "SELECT * FROM tarif WHERE id_tarif = '$id_edit'";
    $result_edit = mysqli_query($conn, $query_edit);
    $edit_data = mysqli_fetch_assoc($result_edit);
}

// Query untuk menampilkan data
$query = "SELECT * FROM tarif ORDER BY id_tarif ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Tarif</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #ff6b35;
        }
        
        .header h2 {
            color: #ff6b35;
            font-size: 28px;
        }
        
        .btn-back {
            background: #1e3a8a;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        
        .btn-back:hover {
            background: #1e40af;
        }
        
        .form-container {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 2px solid #e0e0e0;
        }
        
        .form-container h3 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #ff6b35;
        }
        
        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .btn-submit {
            background: #10b981;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-submit:hover {
            background: #059669;
        }
        
        .btn-reset {
            background: #6b7280;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-reset:hover {
            background: #4b5563;
        }
        
        .btn-cancel {
            background: #ef4444;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-cancel:hover {
            background: #dc2626;
        }
        
        .search-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .search-container input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .btn-add {
            background: #ff6b35;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            white-space: nowrap;
        }
        
        .btn-add:hover {
            background: #e55a2b;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table thead {
            background: #1e3a8a;
            color: white;
        }
        
        table th {
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        
        table tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }
        
        table tbody tr:hover {
            background: #f8f9fa;
        }
        
        table td {
            padding: 12px 15px;
            color: #333;
        }
        
        .btn-edit {
            background: #3b82f6;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
            font-weight: bold;
        }
        
        .btn-edit:hover {
            background: #2563eb;
        }
        
        .btn-delete {
            background: #ef4444;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-delete:hover {
            background: #dc2626;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🏷️ MASTER DATA TARIF</h2>
            <button class="btn-back" onclick="history.back()">
                ← KEMBALI
            </button>
        </div>

        <!-- Form Tambah/Edit -->
        <div class="form-container">
            <h3><?php echo $edit_data ? '✏️ EDIT TARIF' : '➕ TAMBAH TARIF BARU'; ?></h3>
            <form method="POST" action="">
                <?php if ($edit_data): ?>
                    <input type="hidden" name="id_tarif" value="<?php echo $edit_data['id_tarif']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label>Nama Tarif:</label>
                    <input type="text" name="nama_tarif" 
                           value="<?php echo $edit_data ? $edit_data['nama_tarif'] : ''; ?>" 
                           required placeholder="Contoh: futsal siang">
                </div>

                <div class="form-group">
                    <label>Jenis Hari:</label>
                    <select name="jenis_hari" required>
                        <option value="">-- Pilih Jenis Hari --</option>
                        <option value="siang" <?php echo ($edit_data && $edit_data['jenis_hari'] == 'siang') ? 'selected' : ''; ?>>Siang</option>
                        <option value="sore" <?php echo ($edit_data && $edit_data['jenis_hari'] == 'sore') ? 'selected' : ''; ?>>Sore</option>
                        <option value="malam" <?php echo ($edit_data && $edit_data['jenis_hari'] == 'malam') ? 'selected' : ''; ?>>Malam</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga Per Jam:</label>
                    <input type="number" name="harga_per_jam" 
                           value="<?php echo $edit_data ? $edit_data['harga_per_jam'] : ''; ?>" 
                           required placeholder="Contoh: 150000">
                </div>

                <div class="form-buttons">
                    <?php if ($edit_data): ?>
                        <button type="submit" name="update" class="btn-submit">UPDATE</button>
                        <button type="button" class="btn-cancel" onclick="window.location.href='tarif.php'">BATAL</button>
                    <?php else: ?>
                        <button type="submit" name="tambah" class="btn-submit">SIMPAN</button>
                        <button type="reset" class="btn-reset">RESET</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Search -->
        <div class="search-container">
            <input type="text" id="searchNama" placeholder="🔍 Cari Nama Tarif..." onkeyup="filterTable()">
            <input type="text" id="searchJenis" placeholder="🔍 Cari Jenis Hari..." onkeyup="filterTable()">
            <input type="text" id="searchHarga" placeholder="🔍 Cari Harga..." onkeyup="filterTable()">
        </div>

        <!-- Tabel Data -->
        <table id="tarifTable">
            <thead>
                <tr>
                    <th>ID TARIF</th>
                    <th>NAMA TARIF</th>
                    <th>JENIS HARI</th>
                    <th>HARGA PER JAM</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_tarif'] . "</td>";
                        echo "<td>" . $row['nama_tarif'] . "</td>";
                        echo "<td>" . ucfirst($row['jenis_hari']) . "</td>";
                        echo "<td>Rp " . number_format($row['harga_per_jam'], 0, ',', '.') . "</td>";
                        echo "<td>
                                <button class='btn-edit' onclick=\"window.location.href='tarif.php?edit=" . $row['id_tarif'] . "'\">EDIT</button>
                                <button class='btn-delete' onclick=\"confirmDelete(" . $row['id_tarif'] . ")\">HAPUS</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='no-data'>📭 Tidak ada data tarif</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Fungsi untuk filter tabel
        function filterTable() {
            var inputNama = document.getElementById("searchNama").value.toLowerCase();
            var inputJenis = document.getElementById("searchJenis").value.toLowerCase();
            var inputHarga = document.getElementById("searchHarga").value.toLowerCase();
            var table = document.getElementById("tarifTable");
            var tr = table.getElementsByTagName("tr");

            for (var i = 1; i < tr.length; i++) {
                var tdNama = tr[i].getElementsByTagName("td")[1];
                var tdJenis = tr[i].getElementsByTagName("td")[2];
                var tdHarga = tr[i].getElementsByTagName("td")[3];
                
                if (tdNama && tdJenis && tdHarga) {
                    var txtNama = tdNama.textContent || tdNama.innerText;
                    var txtJenis = tdJenis.textContent || tdJenis.innerText;
                    var txtHarga = tdHarga.textContent || tdHarga.innerText;
                    
                    if (txtNama.toLowerCase().indexOf(inputNama) > -1 &&
                        txtJenis.toLowerCase().indexOf(inputJenis) > -1 &&
                        txtHarga.toLowerCase().indexOf(inputHarga) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        // Fungsi konfirmasi hapus
        function confirmDelete(id) {
            if (confirm("⚠️ Apakah Anda yakin ingin menghapus tarif ini?")) {
                window.location.href = "tarif.php?hapus=" + id;
            }
        }

        // Auto scroll ke form saat edit
        <?php if ($edit_data): ?>
            window.scrollTo({ top: 0, behavior: 'smooth' });
        <?php endif; ?>
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>