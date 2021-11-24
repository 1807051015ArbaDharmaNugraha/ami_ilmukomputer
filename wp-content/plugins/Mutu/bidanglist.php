<?php
// List prodi
function bidang_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_bidang'])) {
$id_bidang = sanitize_key($_GET['id_bidang']);
if (!preg_match("/^[0-9]*$/",$id_bidang))
$msg = "error:ID Bidang hanya berupa angka";
else {
$wpdb->delete( 'bidang', array( 'id_bidang' => $id_bidang ) );
$msg = "Data Bidang telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_bidang,kode_ps,nama_ps,tahun_lulus,jumlah_lulusan,lulusan_terlacak,rendah,sedang,tinggi,tahun from bidang",$msg)
);
?>

<div class="wrap">
<h2>Kesesuaian Bidang Kerja Lulusan</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=bidang_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th rowspan="2">ID Bidang</th>
<th rowspan="2">Kode Prodi</th>
<th rowspan="2">Prodi</th>
<th rowspan="2">Tahun Lulus</th>
<th rowspan="2">Jumlah Lulusan</th>
<th rowspan="2">Lulusan Terlacak</th>
<th colspan="3"><center>Jumlah lulusan Terlacak dengan Tingkat Keseuaian Bidang Kerja</center></th>

<th rowspan="2">Tahun</th>
<th rowspan="2">&nbsp;</th>
</tr>

<tr style="background-color: lightskyblue;">
<th>rendang</th>
<th>sedang</th>
<th>tinggi</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td><?php echo $row->id_bidang ?></td>
<td><?php echo $row->kode_ps ?></td>
<td><?php echo $row->nama_ps ?></td>
<td><?php echo $row->tahun_lulus ?></td>
<td><?php echo $row->jumlah_lulusan ?></td>
<td><?php echo $row->lulusan_terlacak ?></td>
<td><?php echo $row->rendah ?></td>
<td><?php echo $row->sedang ?></td>
<td><?php echo $row->tinggi ?></td>
<td><?php echo $row->tahun ?></td>
<td>
<a href="<?php echo admin_url("admin.php?page=bidang_update&id_bidang=".$row->id_bidang); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=bidang_list&delete&id_bidang=".$row->id_bidang); ?>"
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
