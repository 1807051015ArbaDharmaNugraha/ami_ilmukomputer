<?php
// Membuat prodi
function tunggu_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_tunggu = sanitize_key($_POST['id_tunggu']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$tahun_lulus = sanitize_text_field($_POST['tahun_lulus']);
$jumlah_lulusan = sanitize_text_field($_POST['jumlah_lulusan']);
$lulusan_terlacak = sanitize_text_field($_POST['lulusan_terlacak']);
$lulusan_dipesan = sanitize_text_field($_POST['lulusan_dipesan']);
$tiga_bulan = sanitize_text_field($_POST['tiga_bulan']);
$tigaenam_bulan = sanitize_text_field($_POST['tigaenam_bulan']);
$enam_bulan = sanitize_text_field($_POST['enam_bulan']);
$enam_bln = sanitize_text_field($_POST['enam_bln']);
$enamlapan_bln = sanitize_text_field($_POST['enamlapan_bln']);
$lapan_bln = sanitize_text_field($_POST['lapan_bln']);
$msg = "";
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$id_tunggu) || empty($id_tunggu)) {
$msg = "error:ID Tunggu hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka atau Belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$tiga_bulan)) {
$msg = "error:Rendah hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$tigaenam_bulan)) {
$msg = "error:Sedang hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$enam_bulan)) {
$msg = "error:Tinggi hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$enam_bln)) {
$msg = "error:Tinggi hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$enamlapan_bln)) {
$msg = "error:Tinggi hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$lapan_bln)) {
$msg = "error:Tinggi hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$tunggu_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM tunggu WHERE id_tunggu = %d", $id_tunggu )
);
if ($tunggu_check == 0) {
$wpdb->insert(
'tunggu', // table</strong></span>
array('id_tunggu' => $id_tunggu, 'kode_ps' => $kode_ps, 'tahun_lulus' => $tahun_lulus, 'jumlah_lulusan' => $jumlah_lulusan, 'lulusan_terlacak' => $lulusan_terlacak, 'lulusan_dipesan' => $lulusan_dipesan, 'tiga_bulan' => $tiga_bulan, 'tigaenam_bulan' => $tigaenam_bulan, 'enam_bulan' => $enam_bulan, 'enam_bln' => $enam_bln,'enamlapan_bln' => $enamlapan_bln,'lapan_bln' => $lapan_bln, 'tahun' => $tahun), 
array('%d', '%d', '%s', '%d', '%d', '%d', '%d', '%d','%d', '%d', '%d', '%d', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_tunggu = "";
$kode_ps = "";
$tahun_lulus = "";
$jumlah_lulusan = "";
$lulusan_terlacak = "";
$lulusan_dipesan = "";
$tiga_bulan = "";
$tigaenam_bulan = "";
$enam_bulan = "";
$enam_bln = "";
$enamlapan_bln = "";
$lapan_bln = "";
$tahun = "";
$msg = "updated:Data Tunggu telah disimpan";
} else {
$msg = "error:Duplikasi ID Tunggu, Silahkan coba lagi";
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
<a href="<?php echo admin_url('admin.php?page=tunggu_list')?>">

&laquo; Kembali ke Daftar Tunggu </a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Tunggu<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_tunggu" value="<?php echo $id_tunggu;?>"/>
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
</tr>
<tr>
<th>Lulusan Terlacak</th>
<td><input type="text" name="lulusan_terlacak" value="<?php echo $lulusan_terlacak;?>"/>
</td>
</tr>
<tr>
<th>Lulusan Dipesan</th>
<td><input type="text" name="lulusan_dipesan" value="<?php echo $lulusan_dipesan;?>"/>
</td>
</tr>
<tr><th>
	Jumlah Lulusan Terlacak dengan Waktu Tunggu Mendapatkan Pekerjaan
</th></tr>
<tr>
<th>WT < 3 bulan</th>
<td><input type="text" name="tiga_bulan" value="<?php echo $tinggi;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>3 ≤ WT ≤ 6 bulan</th>
<td><input type="text" name="tigaenam_bulan" value="<?php echo $tigaenam_bulan;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>WT > 6 bulan</th>
<td><input type="text" name="enam_bulan" value="<?php echo $enam_bulan;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>WT < 6 bulan</th>
<td><input type="text" name="enam_bln" value="<?php echo $enam_bln;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>6 ≤ WT ≤ 18 bulan</th>
<td><input type="text" name="enamlapan_bln" value="<?php echo $enamlapan_bln;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>WT > 18 bulan</th>
<td><input type="text" name="lapan_bln" value="<?php echo $lapan_bln;?>"/>
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
/*id_tunggu
kode_ps
tahun_lulus
jumlah_lulusan
lulusan_terlacak
lulusan_dipesan
tiga_bulan
tigaenam_bulan
enam_bulan
enam_bln
enamlapan_bln
lapan_bln
tahun*/
