<?php
// Membuat prodi
function bidang_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_bidang = sanitize_key($_POST['id_bidang']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$nama_ps = sanitize_text_field($_POST['nama_ps']);
$tahun_lulus = sanitize_text_field($_POST['tahun_lulus']);
$jumlah_lulusan = sanitize_text_field($_POST['jumlah_lulusan']);
$lulusan_terlacak = sanitize_text_field($_POST['lulusan_terlacak']);
$rendah = sanitize_text_field($_POST['rendah']);
$sedang = sanitize_text_field($_POST['sedang']);
$tinggi = sanitize_text_field($_POST['tinggi']);
$msg = "";
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$id_bidang) || empty($id_bidang)) {
$msg = "error:ID Bidang hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka atau Belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$rendah)) {
$msg = "error:Rendah hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$sedang)) {
$msg = "error:Sedang hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$tinggi)) {
$msg = "error:Tinggi hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$bidang_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM bidang WHERE id_bidang = %d", $id_bidang )
);
if ($bidang_check == 0) {
$wpdb->insert(
'bidang', // table</strong></span>
array('id_bidang' => $id_bidang, 'kode_ps' => $kode_ps,'nama_ps' => $nama_ps, 'tahun_lulus' => $tahun_lulus, 'jumlah_lulusan' => $jumlah_lulusan, 'lulusan_terlacak' => $lulusan_terlacak, 'rendah' => $rendah, 'sedang' => $sedang, 'tinggi' => $tinggi, 'tahun' => $tahun), 
array('%d', '%d', '%s','%s', '%d', '%d', '%d', '%d', '%d', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_bidang = "";
$kode_ps = "";
$nama_ps = "";
$tahun_lulus = "";
$jumlah_lulusan = "";
$lulusan_terlacak = "";
$rendah = "";
$sedang = "";
$tinggi = "";
$tahun = "";
$msg = "updated:Data Bidang telah disimpan";
} else {
$msg = "error:Duplikasi ID Bidang, Silahkan coba lagi";
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
<a href="<?php echo admin_url('admin.php?page=bidang_list')?>">

&laquo; Kembali ke Daftar Bidang </a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Bidang<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_bidang" value="<?php echo $id_bidang;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Kode Prodi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="kode_ps" value="<?php echo $kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Prodi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="nama_ps" value="<?php echo $nama_ps;?>"/>
</td>
</tr>
<tr>
<th>Tahun Lulus<em style="color: red;">*</em></th>
<td><input type="text" name="tahun_lulus" value="<?php echo $tahun_lulus;?>"/></td>
</tr>
<tr>
<th>Jumlah Lulusan</th>
<td><input type="text" name="jumlah_lulusan" value="<?php echo $jumlah_lulusan;?>"/>
</td>
</tr>
<tr>
<th>Lulusan Terlacak</th>
<td><input type="text" name="lulusan_terlacak" value="<?php echo $lulusan_terlacak;?>"/>
</td>
</tr>
<tr><th>
	Jumlah lulusan Terlacak dengan Tingkat Keseuaian Bidang Kerja
</th></tr>
<tr>
<th>Rendah</th>
<td><input type="text" name="rendah" value="<?php echo $rendah;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Sedang</th>
<td><input type="text" name="sedang" value="<?php echo $sedang;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tinggi</th>
<td><input type="text" name="tinggi" value="<?php echo $tinggi;?>"/>
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
