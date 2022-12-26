<?php 
$username =  $_SESSION['login_user'];

$sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$data = mysqli_fetch_array($sql);
$id_user = $data['id_user'];

$tanggal_transaksi = date('Y-m-d');

    if(isset($_POST['tambah'])) {

        $user_id = htmlspecialchars($_POST['id_user']);
        
        $int_id_user = intval($user_id);
        $tanggal_transaksi = htmlspecialchars($_POST['tanggal_transaksi']);
        $nama_transaksi = htmlspecialchars($_POST['nama_transaksi']);
        $jenis_transaksi = htmlspecialchars($_POST['jenis_transaksi']);
        $jumlah_transaksi = htmlspecialchars($_POST['jumlah_transaksi']);
        $objek_transaksi = htmlspecialchars($_POST['objek_transaksi']);

       
        if(empty($nama_transaksi && $jenis_transaksi && $jumlah_transaksi && $objek_transaksi)) {
            echo "<script>alert('Pastikan anda sudah mengisi semua formulir.');window.location='?p=transaksi&aksi=tambah';</script>";
        }

        $sql_insert = $conn->query("INSERT INTO transaksi(id_user, tanggal_transaksi, jenis_transaksi, nama_transaksi, jumlah_transaksi, objek_transaksi) 
                            VALUES ('$int_id_user', '$tanggal_transaksi', '$jenis_transaksi', '$nama_transaksi', '$jumlah_transaksi', '$objek_transaksi')") or die(mysqli_error($conn));
            if($sql_insert) {
                echo "<script>alert('Data Berhasil Ditambahkan.');window.location='?p=transaksi';</script>";
            } else {
                echo "<script>alert('Data Gagal Ditambahkan.')</script>";
            }

    }

?>

<h1 class="mt-4">Tambah Transaksi</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="?p=transaksi">Transaksi</a></li>
    <li class="breadcrumb-item active">tambah transaksi</li>
</ol>
<div class="card-header mb-5">
	
	<form action="" method="post">
   
    <div class="form-group">
        <input type="text" name="id_user" id="id_user" class="form-control" readonly="" value="<?=$id_user ?>" style="display:none;">
    </div>

    <div class="form-group">
        <label class="small mb-1" for="tanggal_transaksi">Tanggal Transaksi</label>
        <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control"  value="<?= $tanggal_transaksi ?>">
    </div>
    <div class="form-group">
    	<label for="jenis_transaksi">Jenis Transaksi</label>
    	<select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
    		<option value="" style="color: gray;">Jenis Transaksi</option>
    		<option value="pemasukan" style="color: green;">Pemasukan</option>
    		<option value="pengeluaran" style="color: red;">Pengeluaran</option>
    	</select>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="nama_transaksi">Nama Transaksi</label>
        <input class="form-control" id="nama_transaksi" name="nama_transaksi" type="text" placeholder="Nama transaksi"/>
    </div>
    
    <div class="form-group">
        <label class="small mb-1" for="jumlah_transaksi">Jumlah Transaksi</label>
        <input class="form-control" id="jumlah_transaksi" name="jumlah_transaksi" type="numver" placeholder="Jumlah transaksi"/>
    </div>
   
    <div class="form-group">
        <label class="small mb-1" for="objek_transaksi">Objek Transaksi</label>
        <input class="form-control" id="objek_transaksi" name="objek_transaksi" type="text" placeholder="Objek transaksi"/>
    </div>
    <div class="form-group">
    	<button type="submit" class="btn btn-ungu mt-3" name="tambah">Tambah Data</button>
    </div>
	</form>
</div>