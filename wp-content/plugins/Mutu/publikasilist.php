<?php
// List prodi
function publikasi_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_publikasi'])) {
$id_publikasi = sanitize_key($_GET['id_publikasi']);
if (!preg_match("/^[0-9]*$/",$id_publikasi))
$msg = "error:ID Publikasi hanya berupa angka";
else {
$wpdb->delete( 'publikasi', array( 'id_publikasi' => $id_publikasi ) );
$msg = "Data Publikasi telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_publikasi,kode_ps,jenis_publikasi,ts_2,ts_1,ts,jumlah,tahun from publikasi",$msg)
);
?>

<div class="wrap">
<h2>Pagelaran/Pameran/Presentasi/Publikasi Ilmiah</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=publikasi_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th rowspan="2">ID Publikasi</th>
<th rowspan="2">Kode Prodi</th>
<th rowspan="2">Jenis Publikasi</th>
<th colspan="3"><center>Jumlah Judul</center></th>
<th rowspan="2">Jumlah</th>
<th rowspan="2">Tahun</th>
<th rowspan="2">&nbsp;</th>
</tr>

<tr style="background-color: lightskyblue;">
<th>TS-2</th>
<th>TS-1</th>
<th>TS</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->id_publikasi ?></td>
<td><?php echo $row->kode_ps ?></td>
<td><?php echo $row->jenis_publikasi ?></td>
<td><?php echo $row->ts_2 ?></td>
<td><?php echo $row->ts_1 ?></td>
<td><?php echo $row->ts ?></td>
<td><?php echo $row->jumlah ?></td>
<td><?php echo $row->tahun ?></td>
<td>
<a href="<?php echo admin_url("admin.php?page=publikasi_update&id_publikasi=".$row->id_publikasi); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=publikasi_list&delete&id_publikasi=".$row->id_publikasi); ?>"
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