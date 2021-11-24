<?php
// List prodi
function detail_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_detail'])) {
$id_detail = sanitize_key($_GET['id_detail']);
if (!preg_match("/^[0-9]*$/",$id_detail))
$msg = "error:ID Tempat hanya berupa angka";
else {
$wpdb->delete( 'detail', array( 'id_detail' => $id_detail ) );
$msg = "Data Tempat telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_detail,kode_ps,nama_ps,jenis_kemampuan,sangat_baik,baik,cukup,kurang,tindak_lanjut,tahun from detail",$msg)
);
?>

<div class="wrap">
<h2>Kepuasan Pengguna Lulusan</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=detail_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th rowspan="2">ID Detail</th>
<th rowspan="2">Kode Prodi</th>
<th rowspan="2">Prodi</th>
<th rowspan="2" colspan="2">Jenis Kemampuan</th>

<th colspan="4"><center>Tingkat Kepuasan Pengguna (%)</center></th>
<th rowspan="2" colspan="2">Rencana Tindak Lanjut oleh UPPS/PS</th>

<th rowspan="2">Tahun</th>
<th rowspan="2" colspan="2">&nbsp;</th>
</tr>

<tr style="background-color: lightskyblue;">
<th>Sangat Baik</th>
<th>Baik</th>
<th>Cukup</th>
<th>Kurang</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->id_detail ?></td>
<td><?php echo $row->kode_ps ?></td>
<td><?php echo $row->nama_ps ?></td>
<td colspan="2"><?php echo $row->jenis_kemampuan ?></td>
<td><?php echo $row->sangat_baik ?></td>
<td><?php echo $row->baik ?></td>
<td><?php echo $row->cukup ?></td>
<td><?php echo $row->kurang ?></td>
<td colspan="2"><?php echo $row->tindak_lanjut ?></td>
<td><?php echo $row->tahun ?></td>
<td colspan="2">
<a href="<?php echo admin_url("admin.php?page=detail_update&id_detail=".$row->id_detail); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=detail_list&delete&id_detail=".$row->id_detail); ?>"
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
