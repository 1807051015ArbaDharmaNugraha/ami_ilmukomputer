<?php
// List prodi
function tanggapan_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_tanggapan'])) {
$id_tanggapan = sanitize_key($_GET['id_tanggapan']);
if (!preg_match("/^[0-9]*$/",$id_tanggapan))
$msg = "error:ID Tanggapan hanya berupa angka";
else {
$wpdb->delete( 'tanggapan', array( 'id_tanggapan' => $id_tanggapan ) );
$msg = "Data Tanggapan telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_tanggapan,kode_ps,tahun_lulus,jumlah_lulusan,jumlah_tanggapan,tahun from tanggapan",$msg)
);
?>

<div class="wrap">
<h2>Tanggapan Kepuasan Pengguna Lulusan</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=tanggapan_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th >ID Tanggapan</th>
<th >Kode Prodi</th>
<th >Tahun Lulus</th>
<th colspan="3">Jumlah Lulusan</th>
<th >Jumlah Tanggapan</th>
<th >Tahun</th>
<th >&nbsp;</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->id_tanggapan ?></td>
<td><?php echo $row->kode_ps ?></td>
<td><?php echo $row->tahun_lulus ?></td>
<td colspan="3"><?php echo $row->jumlah_lulusan ?></td>
<td><?php echo $row->jumlah_tanggapan ?></td>
<td><?php echo $row->tahun ?></td>
<td>
<a href="<?php echo admin_url("admin.php?page=tanggapan_update&id_tanggapan=".$row->id_tanggapan); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=tanggapan_list&delete&id_tanggapan
=".$row->id_tanggapan); ?>"
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