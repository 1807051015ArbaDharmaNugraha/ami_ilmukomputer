<?php
// List prodi
function tempat_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_tempat'])) {
$id_tempat = sanitize_key($_GET['id_tempat']);
if (!preg_match("/^[0-9]*$/",$id_tempat))
$msg = "error:ID Tempat hanya berupa angka";
else {
$wpdb->delete( 'tempat', array( 'id_tempat' => $id_tempat ) );
$msg = "Data Tempat telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_tempat,kode_ps,tahun_lulus,jumlah_lulusan,lulusan_terlacak,lokal,nasional,internasional,tahun from tempat",$msg)
);
?>

<div class="wrap">
<h2>Tempat Kerja Lulusan</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=tempat_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th rowspan="2">ID Tempat</th>
<th rowspan="2">Kode Prodi</th>
<th rowspan="2">Tahun Lulus</th>
<th rowspan="2">Jumlah Lulusan</th>
<th rowspan="2">Lulusan Terlacak</th>
<th colspan="6"><center>Jumlah Lulusan Terlacak yang Bekerja Berdasarkan Tingkat/Ukuran Tempat Kerja/Berwirausaha</center></th>

<th rowspan="2">Tahun</th>
<th rowspan="2" colspan="2">&nbsp;</th>
</tr>

<tr style="background-color: lightskyblue;">
<th colspan="2">lokal</th>
<th colspan="2">nasional</th>
<th colspan="2">internasional</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->id_tempat ?></td>
<td><?php echo $row->kode_ps ?></td>
<td><?php echo $row->tahun_lulus ?></td>
<td><?php echo $row->jumlah_lulusan ?></td>
<td><?php echo $row->lulusan_terlacak ?></td>
<td colspan="2"><?php echo $row->lokal ?></td>
<td colspan="2"><?php echo $row->nasional ?></td>
<td colspan="2"><?php echo $row->internasional ?></td>
<td><?php echo $row->tahun ?></td>
<td colspan="2">
<a href="<?php echo admin_url("admin.php?page=tempat_update&id_tempat=".$row->id_tempat); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=tempat_list&delete&id_tempat=".$row->id_tempat); ?>"
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
