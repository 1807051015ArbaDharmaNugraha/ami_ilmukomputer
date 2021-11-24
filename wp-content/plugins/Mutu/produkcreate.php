<?php
// Membuat prodi
function produk_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_produk = sanitize_key($_POST['id_produk']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$nama_mhs = sanitize_text_field($_POST['nama_mhs']);
$nama_produk = sanitize_text_field($_POST['nama_produk']);
$deskripsi = sanitize_text_field($_POST['deskripsi']);
$bukti = sanitize_text_field($_POST['bukti']);
$link = sanitize_text_field($_POST['link']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$id_produk) || empty($id_produk)) {
$msg = "error:ID Produk hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$nama_mhs) or empty($nama_mhs)) {
$msg = "error:Nama Mahasiswa berupa huruf atau belum diisi";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$nama_produk) or empty($nama_produk)) {
$msg = "error:Nama Produk/Jasa berupa huruf atau belum diisi";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$produk_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM produk WHERE id_produk = %d", $id_produk )
);
if ($produk_check == 0) {
$wpdb->insert(
'produk', // table</strong></span>
array('id_produk' => $id_produk, 'kode_ps' => $kode_ps, 'nama_mhs' => $nama_mhs, 'nama_produk' => $nama_produk, 'deskripsi' => $deskripsi, 'bukti' => $bukti, 'link' => $link,  'tahun' => $tahun), 
array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_produk = "";
$kode_ps = "";
$nama_mhs = "";
$nama_produk = "";
$deskripsi = "";
$bukti = "";
$link = "";
$tahun = "";
$msg = "updated:Data Produk/Jasa telah disimpan";
} else {
$msg = "error:Duplikasi ID Produk/Jasa, Silahkan coba lagi";
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
<a href="<?php echo admin_url('admin.php?page=produk_list')?>">

&laquo; Kembali ke Daftar Produk/Jasa</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Produk/Jasa<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_produk" value="<?php echo $id_produk;?>"/>
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
<td><input type="text" name="nama_mhs" ></td>
</tr>
<tr>
<th>Nama Produk/Jasa<em style="color: red;">*</em></th>
<td><input type="text" name="nama_produk" value="<?php echo $nama_produk;?>"/></td>
</tr>
<tr>
<th>Deskripsi Produk/Jasa</th>
<td><input type="text" name="deskripsi" value="<?php echo $deskripsi;?>"/></td>
</tr>
<tr>
<th>Bukti</th>
<td><input type="text" name="bukti" value="<?php echo $bukti;?>"/></td>
</tr>
<tr>
<th>Link</th>
<td><input type="text" name="link" value="<?php echo $link;?>"/></td>
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