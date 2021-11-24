<?php
// Membuat prodi
function disitasi_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_disitasi = sanitize_key($_POST['id_disitasi']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$nama_mhs = sanitize_text_field($_POST['nama_mhs']);
$judul = sanitize_text_field($_POST['judul']);
$jumlah = sanitize_text_field($_POST['jumlah']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$id_disitasi) || empty($id_disitasi)) {
$msg = "error:ID Disitasi hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$nama_mhs) or empty($nama_mhs)) {
$msg = "error:Nama Mahasiswa berupa huruf atau belum diisi";
} elseif (!preg_match("/^[0-9]*$/",$jumlah)) {
$msg = "error:Jumlah Disitasi hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$disitasi_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM disitasi WHERE id_disitasi = %d", $id_disitasi )
);
if ($disitasi_check == 0) {
$wpdb->insert(
'disitasi', // table</strong></span>
array('id_disitasi' => $id_disitasi, 'kode_ps' => $kode_ps, 'nama_mhs' => $nama_mhs, 'judul' => $judul, 'jumlah' => $jumlah, 'tahun' => $tahun), 
array('%d', '%s', '%s', '%s', '%s', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_disitasi = "";
$kode_ps = "";
$nama_mhs = "";
$judul = "";
$jumlah = "";
$tahun = "";
$msg = "updated:Data Disitasi telah disimpan";
} else {
$msg = "error:Duplikasi ID Disitasi, Silahkan coba lagi";
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
<a href="<?php echo admin_url('admin.php?page=disitasi_list')?>">

&laquo; Kembali ke Daftar Disitasi</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Disitasi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_disitasi" value="<?php echo $id_disitasi;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Kode Prodi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="kode_ps" value="<?php echo $kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Nama Mahasiswa<em style="color: red;">*</em></th>
<td><input type="text" name="nama_mhs" value="<?php echo $nama_mhs;?>"/></td>
</tr>
<tr>
<th>Judul Artikel yang Disitasi (Jurnal, Volume, Tahun, Nomor, Halaman) </th>
<td><input type="text" name="judul" value="<?php echo $judul;?>"/></td>
</tr>
<tr>
<th>Jumlah Sitasi</th>
<td><input type="text" name="jumlah" value="<?php echo $jumlah;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tahun<em style="color: red;">*</em></th>
<td><input type="text" name="tahun" value="<?php echo $tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type="submit" name="insert" value="Save" class="button">
</form>
</div>
<?php
}

//'users' di ganti 'mutu' sesuai databases