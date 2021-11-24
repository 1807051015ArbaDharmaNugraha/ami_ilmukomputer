<?php
// Membuat prodi
function tempat_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_tempat = sanitize_key($_POST['id_tempat']);
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

// Validations
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
global $wpdb;

// Check if the ID exists</span></strong>
$tempat_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM tempat WHERE id_tempat = %d", $id_tempat )
);
if ($tempat_check == 0) {
$wpdb->insert(
'tempat', // table</strong></span>
array('id_tempat' => $id_tempat, 'kode_ps' => $kode_ps, 'tahun_lulus' => $tahun_lulus, 'jumlah_lulusan' => $jumlah_lulusan, 'lulusan_terlacak' => $lulusan_terlacak, 'lokal' => $lokal, 'nasional' => $nasional, 'internasional' => $internasional, 'tahun' => $tahun), 
array('%d', '%d', '%s', '%d', '%d', '%d', '%d', '%d', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_tempat = "";
$kode_ps = "";
$tahun_lulus = "";
$jumlah_lulusan = "";
$lulusan_terlacak = "";
$lokal = "";
$nasional = "";
$internasional = "";
$tahun = "";
$msg = "updated:Data Tempat telah disimpan";
} else {
$msg = "error:Duplikasi ID Tempat, Silahkan coba lagi";
}
}
}
?>

<div class="wrap">
<h2>Tambah Data</h2>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<p>
<a href="<?php echo admin_url('admin.php?page=tempat_list')?>">

&laquo; Kembali ke Daftar tempat </a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Tempat<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_tempat" value="<?php echo $id_tempat;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Kode Prodi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="kode_ps" value="<?php echo $kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tahun Lulus<em style="color: red;">*</em></th>
<td><input type="text" name="tahun_lulus" value="<?php echo $tahun_lulus;?>"/></td>
</tr>
<tr>
<th>Jumlah Lulusan</th>
<td><input type="text" name="jumlah_lulusan" value="<?php echo $jumlah_lulusan;?>"/>
</td>
<tr>
<th>Lulusan Terlacak</th>
<td><input type="text" name="lulusan_terlacak" value="<?php echo $lulusan_terlacak;?>"/>
</td>
</tr>
</tr>
<tr>
<th>
Jumlah Lulusan Terlacak yang Bekerja Berdasarkan Tingkat/Ukuran Tempat Kerja/Berwirausaha		
</th>
</tr>
<tr>
<th>Lokal</th>
<td><input type="text" name="lokal" value="<?php echo $lokal;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Nasional</th>
<td><input type="text" name="nasional" value="<?php echo $nasional;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Internasional</th>
<td><input type="text" name="internasional" value="<?php echo $internasional;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tahun<em style="color: red;">*</em></th>
<td><input type="text" name="tahun" value="<?php echo $tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
<br>
</table>
<input type="submit" name="insert" value="Save" class="button">
</form>
</div>
<?php
}

//'users' di ganti 'mutu' sesuai databases
