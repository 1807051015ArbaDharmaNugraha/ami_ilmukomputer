<?php
// Membuat prodi
function publikasi_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_publikasi = sanitize_key($_POST['id_publikasi']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$jenis_publikasi = sanitize_text_field($_POST['jenis_publikasi']);
$ts_2 = sanitize_text_field($_POST['ts_2']);
$ts_1 = sanitize_text_field($_POST['ts_1']);
$ts = sanitize_text_field($_POST['ts']);
$jumlah = floatval($_POST['ts_2']) + floatval($_POST['ts_1']) + floatval($_POST['ts']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$id_publikasi) || empty($id_publikasi)) {
$msg = "error:ID Publikasi hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka atau Belum diisi";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$jenis_publikasi) or empty($jenis_publikasi)) {
$msg = "error:Jenis Publikasi berupa huruf atau belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$ts_2)) {
$msg = "error:Jumlah Judul TS-2 hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$ts_1)) {
$msg = "error:Jumlah Judul TS-1 hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$ts)) {
$msg = "error:Jumlah Judul TS hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$jumlah)) {
$msg = "error:Jumlah hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$publikasi_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM publikasi WHERE id_publikasi = %d", $id_publikasi )
);
if ($publikasi_check == 0) {
$wpdb->insert(
'publikasi', // table</strong></span>
array('id_publikasi' => $id_publikasi, 'kode_ps' => $kode_ps, 'jenis_publikasi' => $jenis_publikasi, 'ts' => $ts, 'ts_1' => $ts_1, 'ts_2' => $ts_2, 'jumlah' => $jumlah,  'tahun' => $tahun), 
array('%d', '%d', '%s', '%d', '%d', '%d', '%d', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_publikasi = "";
$kode_ps = "";
$jenis_publikasi = "";
$ts_2 = "";
$ts_1 = "";
$ts = "";
$jumlah = "";
$tahun = "";
$msg = "updated:Data Publikasi Karya Ilmiah telah disimpan";
} else {
$msg = "error:Duplikasi ID Publikasi, Silahkan coba lagi";
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
<a href="<?php echo admin_url('admin.php?page=publikasi_list')?>">

&laquo; Kembali ke Daftar Publikasi Karya</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Publikasi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_publikasi" value="<?php echo $id_publikasi;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Kode Prodi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="kode_ps" value="<?php echo $kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Jenis Publikasi<em style="color: red;">*</em></th>
<td><input type="text" name="jenis_publikasi" value="<?php echo $jenis_publikasi;?>"/></td>
</tr>
<tr>
<th>Jumlah Judul TS-2</th>
<td><input type="text" name="ts_2" value="<?php echo $ts_2;?>"/>
<em>(berupa angka)</em></tr></td>
</tr>
<tr>
<th>Jumlah Judul TS-1</th>
<td><input type="text" name="ts_1" value="<?php echo $ts_1;?>"/>
<em>(berupa angka)</em></tr></td>
</tr>
<tr>
<th>Jumlah Judul TS</th>
<td><input type="text" name="ts" value="<?php echo $ts;?>"/>
<em>(berupa angka)</em></tr></td>
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
/*<tr>
<th>Jumlah</th>
<td><input type="text" name="jumlah" value="<?php echo $jumlah;?>"/>
<em>(berupa angka)</em></tr></td>
</tr>*/