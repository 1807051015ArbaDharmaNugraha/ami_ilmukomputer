<?php
// List prodi
function produk_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_produk'])) {
$id_produk = sanitize_key($_GET['id_produk']);
if (!preg_match("/^[0-9]*$/",$id_produk))
$msg = "error:ID Produk/Jasa hanya berupa angka";
else {
$wpdb->delete( 'produk', array( 'id_produk' => $id_produk ) );
$msg = "Data Produk/Jasa telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_produk,kode_ps,nama_mhs,nama_produk,deskripsi,bukti,link,tahun from produk",$msg)
);
?>

<div class="wrap">
<h2>Produk/Jasa DTPS yang Dihasilkan Mahasiswa yang Diadopsi oleh Industri/Masyarakat</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=produk_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th>ID Produk/Jasa</th>
<th>Kode Prodi</th>
<th colspan="2">Nama Mahasiswa</th>
<th colspan="2">Nama Produk/Jasa</th>
<th colspan="2">Deskripsi Produk/Jasa</th>
<th>Bukti</th>
<th colspan="2">Link</th>
<th>Tahun</th>
<th>&nbsp;</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->id_produk ?></td>
<td><?php echo $row->kode_ps ?></td>
<td colspan="2"><?php echo $row->nama_mhs ?></td>
<td colspan="2"><?php echo $row->nama_produk ?></td>
<td colspan="2"><?php echo $row->deskripsi ?></td>
<td><?php echo $row->bukti ?></td>
<td colspan="2"><?php echo $row->link ?></td>
<td><?php echo $row->tahun ?></td>
<td>
<a href="<?php echo admin_url("admin.php?page=produk_update&id_produk=".$row->id_produk); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=produk_list&delete&id_produk=".$row->id_produk); ?>"
onclick="return confirm('Apakah Anda Yakin?')">Hapus</a>
</td>
</tr>
<?php
}
?>
</table>
</div>
<?php
}

//users di ganti mutu