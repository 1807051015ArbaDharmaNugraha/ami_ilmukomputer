<?php
// List prodi
function luaran_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_luaran'])) {
$id_luaran = sanitize_key($_GET['id_luaran']);
if (!preg_match("/^[0-9]*$/",$id_luaran))
$msg = "error:ID Luaran hanya berupa angka";
else {
$wpdb->delete( 'luaran', array( 'id_luaran' => $id_luaran ) );
$msg = "Data Luaran Penelitian telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_luaran,kode_ps,jenis,keterangan,link,tahun from luaran",$msg)
);
?>

<div class="wrap">
<h2>Luaran Penelitian/PkM yang Dihasilkan Mahasiswa</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=luaran_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th>ID Luaran</th>
<th>Kode Prodi</th>
<th colspan="2">Luaran Penelitian dan PkM</th>
<th>Keterangan</th>
<th>Link</th>
<th>Tahun</th>
<th>&nbsp;</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->id_luaran ?></td>
<td><?php echo $row->kode_ps ?></td>
<td colspan="2"><?php echo $row->jenis ?></td>
<td><?php echo $row->keterangan ?></td>
<td><?php echo $row->link ?></td>
<td><?php echo $row->tahun ?></td>
<td>
<a href="<?php echo admin_url("admin.php?page=luaran_update&id_luaran=".$row->id_luaran); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=luaran_list&delete&id_luaran=".$row->id_luaran); ?>"
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