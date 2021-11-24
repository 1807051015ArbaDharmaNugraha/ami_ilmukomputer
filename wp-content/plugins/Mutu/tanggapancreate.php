<?php
// Membuat prodi
function tanggapan_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_tanggapan = sanitize_key($_POST['id_tanggapan']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$tahun_lulus = sanitize_text_field($_POST['tahun_lulus']);
$jumlah_lulusan = sanitize_text_field($_POST['jumlah_lulusan']);
$jumlah_tanggapan = sanitize_text_field($_POST['jumlah_tanggapan']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$id_tanggapan) || empty($id_tanggapan)) {
$msg = "error:ID tanggapan hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka atau Belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$jumlah_lulusan)) {
$msg = "error:Jumlah Lulusan hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$jumlah_tanggapan)) {
$msg = "error:Jumlah Tanggapan hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$tanggapan_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM tanggapan WHERE id_tanggapan = %d", $id_tanggapan )
);
if ($tanggapan_check == 0) {
$wpdb->insert(
'tanggapan', // table</strong></span>
array('id_tanggapan' => $id_tanggapan, 'kode_ps' => $kode_ps, 'tahun_lulus' => $tahun_lulus, 'jumlah_lulusan' => $jumlah_lulusan, 'jumlah_tanggapan' => $jumlah_tanggapan, 'tahun' => $tahun), 
array('%d', '%d', '%s', '%d', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_tanggapan = "";
$kode_ps = "";
$tahun_lulus = "";
$jumlah_lulusan = "";
$jumlah_tanggapan = "";
$tahun = "";
$msg = "updated:Data Tanggapan telah disimpan";
} else {
$msg = "error:Duplikasi ID Tanggapan, Silahkan coba lagi";
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
<a href="<?php echo admin_url('admin.php?page=tanggapan_list')?>">

&laquo; Kembali ke Daftar Tanggapan </a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Tanggapan<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_tanggapan" value="<?php echo $id_tanggapan;?>"/>
<em>(berupa angka)</em>
</td>
</tr>
<tr>
<th>Kode Prodi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="kode_ps" value="<?php echo $kode_ps;?>"/>
<em>(berupa angka)</em>
</td>
</tr>
<tr>
<th>Tahun Lulus<em style="color: red;">*</em></th>
<td><input type="text" name="tahun_lulus" value="<?php echo $tahun_lulus;?>"/>
</td>
</tr>
<tr>
<th>Jumlah Lulusan</th>
<td><input type="text" name="jumlah_lulusan" value="<?php echo $jumlah_lulusan;?>"/>
</td>
</tr>
<tr>
<th>Jumlah Tanggapan</th>
<td><input type="text" name="jumlah_tanggapan" value="<?php echo $jumlah_tanggapan;?>"/>
</td>
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


//'users' di ganti 'mutu' sesuai databases