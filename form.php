<?php
include "koneksi.php";
include "tampilkan_data.php";
include "edit_data.php";

// Mengambil data untuk edit
$data_edit = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id = '$id'");
    $data_edit = mysqli_fetch_assoc($result);
}

// Menangani pencarian
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $names = explode(' ', $search_query);
    $last_name = array_pop($names);
    $search_sql = "SELECT * FROM mahasiswa WHERE nama_mahasiswa LIKE '%$search_query%' OR prodi LIKE '%$search_query%' OR npm LIKE '%$search_query%'";
    $proses = mysqli_query($koneksi, $search_sql);
} else {
    $proses = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Prodi Mahasiswa</title>
    <link href="library/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="library/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="library/assets/styles.css" rel="stylesheet" media="screen">
    <script src="library/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body>
<div class="span9" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Input Prodi Mahasiswa</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <form action="<?php echo isset($data_edit['id']) ? "edit_data.php?id={$data_edit['id']}&proses=1" : "proses.php"; ?>" method="POST">
                        <fieldset>
                            <legend>Input Prodi Mahasiswa</legend>
                            <div class="control-group">
                                <label class="control-label" for="nama_mahasiswa">Nama Mahasiswa:</label>
                                <div class="controls">
                                    <input type="hidden" class="input-xlarge focused" id="id_mahasiswa" name="id_mahasiswa" 
                                           value="<?php echo isset($data_edit['nama_mahasiswa']) ? $data_edit['id'] : ''; ?>">
                                    <input type="text" class="input-xlarge focused" id="nama_mahasiswa" name="'nama_mahasiswa" 
                                           value="<?php echo isset($data_edit['nama_mahasiswa']) ? $data_edit['nama_mahasiswa'] : ''; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="prodi">Prodi Mahasiswa:</label>
                                <select name="prodi" id="prodi">
                                <option value="pilih prodi">Pilih Prodi</option>
                                <option value="informatika">Informatika</option>
                                <option value="sistem informasi">Sistem Informasi</option>
                                <option value="kedokteran">Kedokteran</option>
                                </select>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="npm">NPM:</label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge focused" id="npm" name="npm" 
                                           value="<?php echo isset($data_edit['npm']) ? $data_edit['npm'] : ''; ?>">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Proses</button>
                                <button type="reset" class="btn">Cancel</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Data Mahasiswa</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Mahasiswa</th>
                                <th>Prodi Mahasiswa</th>
                                <th>NPM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($data = mysqli_fetch_assoc($proses)) {
                                ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['nama_mahasiswa']; ?></td>
                                    <td><?php echo $data['prodi']; ?></td>
                                    <td><?php echo $data['npm']; ?></td>
                                    <td>
                                        <a href="form.php?id=<?php echo $data['id']; ?>">Edit</a> |
                                        <a href="hapus_data.php?id=<?php echo $data['id']; ?>">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>