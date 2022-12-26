<?php 
require_once 'function.php';

#select all transaksi
$sql_transaksi = $conn->query("SELECT * FROM transaksi JOIN users
										ON transaksi.id_user = users.id_user
										order by id_transaksi asc") or die(mysqli_error($conn));

#select transaksi bulan ini
$sql_transaksi_bulanini = $conn->query("SELECT * FROM transaksi JOIN users
                                        ON transaksi.id_user = users.id_user
                                        WHERE MONTH(tanggal_transaksi) = MONTH(CURRENT_DATE())
                                        order by id_transaksi asc") or die(mysqli_error($conn));


if (isset ($_POST['cari'])) {
    $cari_transaksi_s = htmlspecialchars($_POST['cari_transaksi_s']);
    $cari_transaksi_e = htmlspecialchars($_POST['cari_transaksi_e']);
    
    if(empty($cari_transaksi_s && $cari_transaksi_e)) {
        echo "<script>alert('Pastikan anda sudah mengisi tanggal awal dan tanggal akhir.');window.location='?p=transaksi';</script>";
    }

    $sql_pemasukan = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi 
                                WHERE jenis_transaksi = 'pemasukan' AND tanggal_transaksi BETWEEN '$cari_transaksi_s' AND '$cari_transaksi_e'") or die(mysqli_error($conn));
    $sql_pengeluaran = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi 
                                WHERE jenis_transaksi = 'pengeluaran' AND tanggal_transaksi BETWEEN '$cari_transaksi_s' AND '$cari_transaksi_e'") or die(mysqli_error($conn));

    $sql_pemasukan_total = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pemasukan'") or die(mysqli_error($conn));
    $sql_pengeluaran_total = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pengeluaran'") or die(mysqli_error($conn));

} else if (isset ($_POST['tampilSemuaTransaksi'])) {
    $sql_pemasukan = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pemasukan'") or die(mysqli_error($conn));
    $sql_pengeluaran = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pengeluaran'") or die(mysqli_error($conn));

    $sql_pemasukan_total = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pemasukan'") or die(mysqli_error($conn));
    $sql_pengeluaran_total = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pengeluaran'") or die(mysqli_error($conn));

} else if (isset ($_POST['tampilTransaksiBulanIni'])) {
    $sql_pemasukan = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pemasukan' AND MONTH(tanggal_transaksi) = MONTH(CURRENT_DATE())") or die(mysqli_error($conn));

    $sql_pengeluaran = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pengeluaran' AND MONTH(tanggal_transaksi) = MONTH(CURRENT_DATE())") or die(mysqli_error($conn));


    $sql_pemasukan_total = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pemasukan'") or die(mysqli_error($conn));
    $sql_pengeluaran_total = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pengeluaran'") or die(mysqli_error($conn));
} else {
    $sql_pemasukan = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pemasukan' AND MONTH(tanggal_transaksi) = MONTH(CURRENT_DATE())") or die(mysqli_error($conn));

    $sql_pengeluaran = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pengeluaran' AND MONTH(tanggal_transaksi) = MONTH(CURRENT_DATE())") or die(mysqli_error($conn));

    $sql_pemasukan_total = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pemasukan'") or die(mysqli_error($conn));
    $sql_pengeluaran_total = $conn->query("SELECT SUM(jumlah_transaksi) as jumlah_transaksi FROM transaksi WHERE jenis_transaksi = 'pengeluaran'") or die(mysqli_error($conn));
}


// jumlah pemasukan
$data_pemasukan = $sql_pemasukan->fetch_assoc();
$data_pengeluaran = $sql_pengeluaran->fetch_assoc();
$jumlah_pemasukan = $data_pemasukan['jumlah_transaksi'];
$jumlah_pengeluaran = $data_pengeluaran['jumlah_transaksi'];

$data_pemasukan_total = $sql_pemasukan_total->fetch_assoc();
$data_pengeluaran_total = $sql_pengeluaran_total->fetch_assoc();
$jumlah_pemasukan_total = $data_pemasukan_total['jumlah_transaksi'];
$jumlah_pengeluaran_total = $data_pengeluaran_total['jumlah_transaksi'];

// saldo
$saldo = $jumlah_pemasukan_total - $jumlah_pengeluaran_total;

?>
<div class="row mt-4" >
<div class="col">
    <h1>Data Transaksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="dashboard.php?p=transaksi">Transaksi</a></a></li>
        <li class="breadcrumb-item active">data transaksi</li>
    </ol>
</div>
<div class="col">
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <div class="col mx-1">
                            <button class="btn btn-outline-ungu w-100" type="submit" name="tampilSemuaTransaksi">Semua Transaksi</button>
                        </div>
                        <div class="col mx-1">
                            <button class="btn btn-outline-ungu w-100" type="submit" name="tampilTransaksiBulanIni">Transaksi Bulan Ini</button>
                        </div>
                    </div>
                </div>
            </div>
           <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="cari_transaksi_s" id="cari_transaksi_s" placeholder="Tanggal Awal" onfocus="(this.type='date')" onblur="(this.type='text')">
                    <span class="rentang mx-1">-</span>
                    <input type="text" class="form-control" name="cari_transaksi_e" id="cari_transaksi_e" placeholder="Tanggal Akhir" onfocus="(this.type='date')" onblur="(this.type='text')">
                    <div class="input-group-append">
                        <button class="btn btn-ungu ms-3" type="submit" name="cari">Cari</button>
                    </div>
                </div>
            </div>
           </div>
        </form>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <!-- card -->
        <div class="card card-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h6 class="card-title">Dompet</h6>
                        <h3>Rp. <?=$saldo?></34>
                    </div>
                    <div class="col">
                        <img src="../../img/illustration/img1.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <!-- card -->
        <div class="card card-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h5 class="card-title">Pemasukan : <?=$jumlah_pemasukan?></h5>
                        <h5 class="card-title">Pengeluaran : <?=$jumlah_pengeluaran?></h5>
                    </div>
                    <div class="col">
                        <img src="../../img/illustration/img2.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
<div class="row">
    <div class="col">
        <a href="?p=transaksi&aksi=tambah" class="btn btn-ungu mb-3">Tambah Transaksi</a>
        <a target="_blank" href="?p=transaksi&aksi=laporan" class="btn btn-outline-ungu mb-3">Print Transaksi</a>
    </div> 
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Jenis Transaksi</th>
                        <th>Nama Transaksi</th>
                        <th>Jumlah Transaksi</th>
                        <th>Objek Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    if (isset ($_POST['cari'])) {
                        $cari_transaksi_s = htmlspecialchars($_POST['cari_transaksi_s']);
                        $cari_transaksi_e = htmlspecialchars($_POST['cari_transaksi_e']);


                        if(empty($cari_transaksi_s && $cari_transaksi_e)) {
                            echo "<script>alert('Pastikan anda sudah mengisi tanggal awal dan tanggal akhir.');window.location='?p=transaksi';</script>";
                        }

                        $PageQuery_transaksi_bulanIni = mysqli_query($conn, "SELECT * FROM transaksi JOIN users
                        ON transaksi.id_user = users.id_user
                        WHERE tanggal_transaksi BETWEEN '$cari_transaksi_s' AND '$cari_transaksi_e'
                        order by tanggal_transaksi desc  ") or die(mysqli_error($conn));

                        // tampilkan rentang pencarian
                        echo "<div class='alert' style='background-color:#810ca83b; color:#2D033B;'>Rentang pencarian: $cari_transaksi_s - $cari_transaksi_e</div>";
                    
                    } else if (isset($_POST['tampilSemuaTransaksi'])) {
                        $PageQuery_transaksi_bulanIni = mysqli_query($conn, "SELECT * FROM transaksi JOIN users
                        ON transaksi.id_user = users.id_user
                        order by tanggal_transaksi desc  ") or die(mysqli_error($conn));

                        echo "<div class='alert' style='background-color:#810ca83b; color:#2D033B;'>Jumlah keseluruhan transaksi</div>";
                    } else {
                        $PageQuery_transaksi_bulanIni = mysqli_query($conn, "SELECT * FROM transaksi JOIN users
                        ON transaksi.id_user = users.id_user
                        WHERE MONTH(tanggal_transaksi) = MONTH(CURRENT_DATE())
                        order by tanggal_transaksi desc  ") or die(mysqli_error($conn));

                        echo "<div class='alert m-0' style='background-color:#810ca83b; color:#2D033B;'>Transaksi bulan ini</div>";
                    }
                    
                    $no = 1;
                    while ($view_data = $PageQuery_transaksi_bulanIni->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $view_data['tanggal_transaksi']; ?></td>
                        <td><?= $view_data['jenis_transaksi']; ?></td>
                        <td><?= $view_data['nama_transaksi']; ?></td>
                        <td><?= $view_data['jumlah_transaksi']; ?></td>
                        <td><?= $view_data['objek_transaksi']; ?></td>
                        <td>
                            <a href="?p=transaksi&aksi=pengeluaran&id_transaksi=<?= $view_data['id_transaksi']; ?>&nama_user=<?= $view_data['nama_user']; ?>" class="btn btn-ungu btn-sm">Ubah</a>
                            <a href="?p=transaksi&aksi=hapus&id_transaksi=<?= $view_data['id_transaksi']; ?>" class="btn btn-merah btn-sm" onclick="return confirm('Yakin ?')">Hapus</a>
                        </td>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>