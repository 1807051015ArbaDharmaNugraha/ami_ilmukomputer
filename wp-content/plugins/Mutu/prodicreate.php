<?php
// Membuat prodi
function prodi_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$kode_ps = sanitize_key($_POST['kode_ps']);
$nama_ps = sanitize_text_field($_POST['nama_ps']);
$kaprodi = sanitize_text_field($_POST['kaprodi']);
$fakultas = sanitize_text_field($_POST['fakultas']);
$no_telpon = sanitize_text_field($_POST['no_telpon']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$nama_ps) or empty($nama_ps)) {
$msg = "error:Nama Prodi berupa huruf atau belum diisi";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$kaprodi) or empty($kaprodi)) {
$msg = "error:Kepala Prodi berupa huruf atau belum diisi";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$fakultas) or empty($fakultas)) {
$msg = "error:Fakultas berupa huruf atau belum diisi";
} elseif (!preg_match("/^[0-9]*$/",$no_telpon)) {
$msg = "error:No. Telepon hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$kode_pscheck = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM prodi WHERE kode_ps = %d", $kode_ps )
);
if ($kode_pscheck == 0) {
$wpdb->insert(
'prodi', // table</strong></span>
array('kode_ps' => $kode_ps, 'nama_ps' => $nama_ps, 'kaprodi' => $kaprodi, 'fakultas' => $fakultas, 'no_telpon' => $no_telpon), 
array('%d', '%s', '%s', '%s', '%s', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$kode_ps = "";
$nama_ps = "";
$kaprodi = "";
$fakultas = "";
$no_telpon = "";
$msg = "updated:Data Prodi telah disimpan";
} else {
$msg = "error:Duplikasi Kode Prodi, Silahkan coba lagi";
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
<a href="<?php echo admin_url('admin.php?page=prodi_list')?>">

&laquo; Kembali ke Daftar Prodi</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="kode_ps" >
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Nama Prodi<em style="color: red;">*</em></th>
<td><input type="text" name="nama_ps" ></td>
</tr>
<tr>
<th>Kepala Prodi<em style="color: red;">*</em></th>
<td><input type="text" name="kaprodi" ></td>
</tr>
<tr>
<th>Fakultas<em style="color: red;">*</em></th>
<td><input type="text" name="fakultas" ></td>
</tr>
<tr>
<th>No. Telepon</th>
<td><input type="text" name="no_telpon" >
<em>(berupa angka)</em></td>
</tr>
</table>
<input type="submit" name="insert" value="Save" class="button">
</form>
</div>
<?php
}

//'users' di ganti 'mutu' sesuai databases