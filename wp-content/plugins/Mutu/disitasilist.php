<?php
// List prodi
function disitasi_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_disitasi'])) {
$id_disitasi = sanitize_key($_GET['id_disitasi']);
if (!preg_match("/^[0-9]*$/",$id_disitasi))
$msg = "error:ID Disitasi hanya berupa angka";
else {
$wpdb->delete( 'disitasi', array( 'id_disitasi' => $id_disitasi ) );
$msg = "Data Disitasi telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_disitasi,kode_ps,nama_ps,nama_mhs,judul,jumlah,tahun from disitasi",$msg)
);
?>

<div class="wrap">
<h2>Karya Ilmiah Mahasiswa yang Disitasi</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=disitasi_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th >ID Disitasi</th>
<th >Kode Prodi</th>
<th >Nama Mahasiswa</th>
<th >Prodi</th>
<th colspan="3">Judul Artikel yang Disitasi (Jurnal, Volume, Tahun, Nomor, Halaman)</th>
<th >Jumlah Sitasi</th>
<th >Tahun</th>
<th >&nbsp;</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->id_disitasi ?></td>
<td><?php echo $row->kode_ps ?></td>
<td><?php echo $row->nama_ps ?></td>
<td><?php echo $row->nama_mhs ?></td>
<td colspan="3"><?php echo $row->judul ?></td>
<td><?php echo $row->jumlah ?></td>
<td><?php echo $row->tahun ?></td>
<td>
<a href="<?php echo admin_url("admin.php?page=disitasi_update&id_disitasi=".$row->id_disitasi); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=disitasi_list&delete&id_disitasi
=".$row->id_disitasi); ?>"
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