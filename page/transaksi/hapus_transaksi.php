<?php 
$id_transaksi = $_GET['id_transaksi'];

$conn->query("DELETE FROM transaksi WHERE id_transaksi = $id_transaksi") or die(mysqli_error($conn));
echo "<script>alert('Data Berhasil Dihapus.');window.location='?p=buku';</script>";

?>