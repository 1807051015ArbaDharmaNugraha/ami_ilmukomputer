<?php
// Membuat prodi
function detail_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_detail = sanitize_key($_POST['id_detail']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$nama_ps = sanitize_text_field($_POST['nama_ps']);
$jenis_kemampuan = sanitize_text_field($_POST['jenis_kemampuan']);
$sangat_baik = sanitize_text_field($_POST['sangat_baik']);
$baik = sanitize_text_field($_POST['baik']);
$cukup = sanitize_text_field($_POST['cukup']);
$kurang = sanitize_text_field($_POST['kurang']);
$tindak_lanjut = sanitize_text_field($_POST['tindak_lanjut']);
$msg = "";
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$id_detail) || empty($id_detail)) {
$msg = "error:ID Tempat hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka atau Belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$sangat_baik)) {
$msg = "error:Jumlah Judul TS-1 hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$baik)) {
$msg = "error:Jumlah Judul TS hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$cukup)) {
$msg = "error:Jumlah hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kurang)) {
$msg = "error:Jumlah hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$detail_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM detail WHERE id_detail = %d", $id_detail )
);
if ($detail_check == 0) {
$wpdb->insert(
'detail', // table</strong></span>
array('id_detail' => $id_detail, 'kode_ps' => $kode_ps,'nama_ps' => $nama_ps, 'jenis_kemampuan' => $jenis_kemampuan, 'sangat_baik' => $sangat_baik, 'baik' => $baik, 'cukup' => $cukup, 'kurang' => $kurang, 'tindak_lanjut' => $tindak_lanjut, 'tahun' => $tahun), 
array('%d', '%d', '%s','%s', '%d', '%d', '%d', '%d', '%s', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_detail = "";
$kode_ps = "";
$nama_ps = "";
$jenis_kemampuan = "";
$sangat_baik = "";
$baik = "";
$cukup = "";
$kurang = "";
$tindak_lanjut = "";
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
<a href="<?php echo admin_url('admin.php?page=detail_list')?>">

&laquo; Kembali ke Daftar Detail </a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Detail<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_detail" value="<?php echo $id_detail;?>"/>
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
<tr>
<th>Jenis Kemampuan<em style="color: red;">*</em></th>
<td><input type="text" name="jenis_kemampuan" value="<?php echo $jenis_kemampuan;?>"/></td>
</tr>
<tr>
<th>
Tingkat Kepuasan Pengguna (%)
</th>
</tr>
<tr>
<th>Sangat Baik</th>
<td><input type="text" name="sangat_baik" value="<?php echo $sangat_baik;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Baik</th>
<td><input type="text" name="baik" value="<?php echo $baik;?>"/>
<em>(berupa angka)</em></td>
</tr>

<tr>
<th>Cukup</th>
<td><input type="text" name="cukup" value="<?php echo $cukup;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Kurang</th>
<td><input type="text" name="kurang" value="<?php echo $kurang;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tindak Lanjut</th>
<td><input type="text" name="tindak_lanjut" value="<?php echo $tindak_lanjut;?>"/>
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
