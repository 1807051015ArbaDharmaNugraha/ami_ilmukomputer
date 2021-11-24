<?php
// List prodi
function prodi_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['kode_ps'])) {
$kode_ps = sanitize_key($_GET['kode_ps']);
if (!preg_match("/^[0-9]*$/",$kode_ps))
$msg = "error:Kode Prodi hanya berupa angka";
else {
$wpdb->delete( 'prodi', array( 'kode_ps' => $kode_ps ) );
$msg = "Data Prodi telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT kode_ps,nama_ps,kaprodi,fakultas,no_telpon from prodi",$msg)
);
?>

<div class="wrap">
<h2>Program Studi</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=prodi_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th>Kode Prodi</th>
<th>Nama Prodi</th>
<th>Kepala Prodi</th>
<th>Fakultas</th>
<th>No. Telepon</th>
<th>&nbsp;</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->kode_ps ?></td>
<td><?php echo $row->nama_ps ?></td>
<td><?php echo $row->kaprodi ?></td>
<td><?php echo $row->fakultas ?></td>
<td><?php echo $row->no_telpon ?></td>
<td>
<a href="<?php echo admin_url("admin.php?page=prodi_update&kode_ps=".$row->kode_ps); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=prodi_list&delete&kode_ps=".$row->kode_ps); ?>"
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
?>
//users di ganti mutu