<?php
function tempat_update () {
global $wpdb;
// Get Values
$id_tempat = sanitize_key($_GET['id_tempat']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$tahun_lulus = sanitize_text_field($_POST['tahun_lulus']);
$jumlah_lulusan = sanitize_text_field($_POST['jumlah_lulusan']);
$lulusan_terlacak = sanitize_text_field($_POST['lulusan_terlacak']);
$lokal = sanitize_text_field($_POST['lokal']);
$nasional = sanitize_text_field($_POST['nasional']);
$internasional = sanitize_text_field($_POST['internasional']);
$msg = "";
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

if(isset($_POST['update'])){
// Validations</strong></span>
if (!preg_match("/^[0-9]*$/",$id_tempat) || empty($id_tempat)) {
$msg = "error:ID Tempat hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka atau Belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$lokal)) {
$msg = "error:Jumlah Judul TS-1 hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$nasional)) {
$msg = "error:Jumlah Judul TS hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$internasional)) {
$msg = "error:Jumlah hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
$wpdb->update(
'tempat', //table
array('kode_ps' => $kode_ps, 'tahun_lulus' => $tahun_lulus, 'jumlah_lulusan' => $jumlah_lulusan, 'lulusan_terlacak' => $lulusan_terlacak, 'lokal' => $lokal, 'nasional' => $nasional, 'internasional' => $internasional, 'tahun' => $tahun), //data
array('id_tempat' => $id_tempat ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Tempat telah diperbaharui!";
}
}

$tempats = $wpdb->get_row(
$wpdb->prepare("SELECT id_tempat,kode_ps,tahun_lulus,jumlah_lulusan,lulusan_terlacak,lokal,nasional,internasional,tahun from tempat where id_tempat=%d",$id_tempat)
);
?>

<div class="wrap">
<h2>Edit Tempat</h2>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<p>
<a href="<?php echo admin_url('admin.php?page=tempat_list')?>">
&laquo; Kembali ke Daftar Tempat</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $tempats->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tahun Lulus</th>
<td><input type="text" name="tahun_lulus" value="<?php echo $tempats->tahun_lulus;?>"/></td>
</tr>
<tr>
<th>Jumlah Lulusan</th>
<td><input type="text" name="jumlah_lulusan" value="<?php echo $tempats->jumlah_lulusan;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Lulusan Terlacak</th>
<td><input type="text" name="lulusan_terlacak" value="<?php echo $tempats->lulusan_terlacak;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>
Jumlah Lulusan Terlacak yang Bekerja Berdasarkan Tingkat/Ukuran Tempat Kerja/Berwirausaha		
</th>
</tr>
<tr>
<th>Lokal</th>
<td><input type="text" name="lokal" value="<?php echo $tempats->lokal;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Nasional</th>
<td><input type="text" name="nasional" value="<?php echo $tempats->nasional;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Internasioanl</th>
<td><input type="text" name="internasional" value="<?php echo $tempats->internasional;?>"/>
(berupa angka)</td>
</tr>

<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $tempats->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu
