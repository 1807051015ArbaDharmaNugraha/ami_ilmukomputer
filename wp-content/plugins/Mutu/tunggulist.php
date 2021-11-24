<?php
// List prodi
function tunggu_list () {
global $wpdb;
$msg = "";
if(isset($_GET['delete']) && isset($_GET['id_tunggu'])) {
$id_tunggu = sanitize_key($_GET['id_tunggu']);
if (!preg_match("/^[0-9]*$/",$id_tunggu))
$msg = "error:ID Tunggu hanya berupa angka";
else {
$wpdb->delete( 'tunggu', array( 'id_tunggu' => $id_tunggu ) );
$msg = "Data Tunggu telah dihapus!";
}
}

// List prodi
$rows = $wpdb->get_results(
$wpdb->prepare("SELECT id_tunggu,kode_ps,tahun_lulus,jumlah_lulusan,lulusan_terlacak,lulusan_dipesan,tiga_bulan,tigaenam_bulan,enam_bulan,enam_bln,enamlapan_bln,lapan_bln,tahun from tunggu",$msg)
);
?>

<div class="wrap">
<h2>Tunggu</h2><br><br>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<a href="<?php echo admin_url('admin.php?page=tunggu_create'); ?>">Tambah Data</a>
<table class='wp-list-table widefat fixed'>
<tr style="background-color: lightskyblue;">
<th rowspan="2" colspan="2">ID Tunggu</th>
<th rowspan="2" colspan="2">Kode Prodi</th>
<th rowspan="2" colspan="2">Tahun Lulus</th>
<th rowspan="2" colspan="2">Jumlah Lulusan</th>
<th rowspan="2" colspan="2">Lulusan Terlacak</th>
<th rowspan="2" colspan="2">Lulusan Dipesan (D3)</th>
<th colspan="14"><center>Jumlah Lulusan Terlacak dengan Waktu Tunggu Mendapatkan Pekerjaan (Bulan)</center></th>

<th rowspan="2" colspan="2">Tahun</th>
<th rowspan="2" colspan="2">&nbsp;</th>
</tr>

<tr style="background-color: lightskyblue;">
<th colspan="2">WT< 3 (D3/D4)</th>
<th colspan="3">3 ≤ WT ≤ 6 (D3/D4)</th>
<th colspan="2">WT > 6 (D3/D4)</th>
<th colspan="2">WT < 6 (S1)</th>
<th colspan="3">6 ≤ WT ≤ 18 (S1)</th>
<th colspan="2">WT>18 (S1)</th>
</tr>
<?php
foreach ($rows as $row ){
?>
<tr>
<td colspan="2"><?php echo $row->id_tunggu ?></td>
<td colspan="2"><?php echo $row->kode_ps ?></td>
<td colspan="2"><?php echo $row->tahun_lulus ?></td>
<td colspan="2"><?php echo $row->jumlah_lulusan ?></td>
<td colspan="2"><?php echo $row->lulusan_terlacak ?></td>
<td colspan="2"><?php echo $row->lulusan_dipesan ?></td>
<td colspan="2"><?php echo $row->tiga_bulan ?></td>
<td colspan="3"><?php echo $row->tigaenam_bulan ?></td>
<td colspan="2"><?php echo $row->enam_bulan ?></td>
<td colspan="2"><?php echo $row->enam_bln ?></td>
<td colspan="3"><?php echo $row->enamlapan_bln ?></td>
<td colspan="2"><?php echo $row->lapan_bln ?></td>
<td colspan="2"><?php echo $row->tahun ?></td>
<td colspan="2">
<a href="<?php echo admin_url("admin.php?page=tunggu_update&id_tunggu=".$row->id_tunggu); ?>">Edit</a> |
<a href="<?php echo admin_url("admin.php?page=tunggu_list&delete&id_tunggu=".$row->id_tunggu); ?>"
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
