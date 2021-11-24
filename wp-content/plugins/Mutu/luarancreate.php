<?php
// Membuat prodi
function luaran_create() {
if (isset($_POST['insert'])) {

// Get Values</span></strong>
$id_luaran = sanitize_key($_POST['id_luaran']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$jenis = sanitize_text_field($_POST['jenis']);
$keterangan = sanitize_text_field($_POST['keterangan']);
$link = sanitize_text_field($_POST['link']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

// Validations
if (!preg_match("/^[0-9]*$/",$id_luaran) || empty($id_luaran)) {
$msg = "error:ID Luaran hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$jenis) or empty($jenis)) {
$msg = "error:Luaran Penelitian dan PkM berupa huruf atau belum diisi";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
global $wpdb;

// Check if the ID exists</span></strong>
$luaran_check = $wpdb->get_var(
$wpdb->prepare( "SELECT count(*) FROM luaran WHERE id_luaran = %d", $id_luaran )
);
if ($luaran_check == 0) {
$wpdb->insert(
'luaran', // table</strong></span>
array('id_luaran' => $id_luaran, 'kode_ps' => $kode_ps, 'jenis' => $jenis, 'keterangan' => $keterangan, 'link' => $link, 'tahun' => $tahun), 
array('%d', '%s', '%s', '%s', '%s', '%d') 
// %s (string), %d (integer) and %f (float)</strong></span>
);

// This should go away and be treated with an object destructor</strong></span>
// or something like that.
$id_luaran = "";
$kode_ps = "";
$jenis = "";
$keterangan = "";
$link = "";
$tahun = "";
$msg = "updated:Data Luaran Penelitian telah disimpan";
} else {
$msg = "error:Duplikasi ID Luaran, Silahkan coba lagi";
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
<a href="<?php echo admin_url('admin.php?page=luaran_list')?>">

&laquo; Kembali ke Daftar Luaran Penelitian</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>ID Luaran Penelitian<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="id_luaran" value="<?php echo $id_luaran;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Kode Prodi<em style="color: red;">*</em></th>
<!-- TODO Javascript only numbers validation -->
<td><input type="text" name="kode_ps" value="<?php echo $kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Luaran Penelitian dan PkM<em style="color: red;">*</em></th>
<td><input type="text" name="jenis" value="<?php echo $jenis;?>"/></td>
</tr>
<tr>
<th>Keterangan</th>
<td><input type="text" name="keterangan" value="<?php echo $keterangan;?>"/></td>
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