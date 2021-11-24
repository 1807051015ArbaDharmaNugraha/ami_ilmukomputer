<?php
function prodi_update () {
global $wpdb;
// Get Values
$kode_ps = sanitize_key($_GET['kode_ps']);

$msg = "";

if(isset($_POST['update'])){

	$nama_ps = sanitize_text_field($_POST['nama_ps']);
$kaprodi = sanitize_text_field($_POST['kaprodi']);
$fakultas = sanitize_text_field($_POST['fakultas']);
$no_telpon = sanitize_text_field($_POST['no_telpon']);
// Validations</strong></span>
if (!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$nama_ps) or empty($nama_ps)) {
$msg = "error:Nama Prodi berupa huruf atau belum diisi";
} elseif (!preg_match("/^[0-9]*$/",$no_telpon) || empty($no_telpon)) {
$msg = "error:No. Telepon hanya berupa angka";
} else {
$wpdb->update(
'prodi', //table
array('nama_ps' => $nama_ps, 'kaprodi' => $kaprodi, 'fakultas' => $fakultas, 'no_telpon' => $no_telpon), //data
array('kode_ps' => $kode_ps ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Prodi telah diperbaharui!";
}
}

$Userss = $wpdb->get_row(
$wpdb->prepare("SELECT kode_ps,nama_ps,kaprodi,fakultas,no_telpon from prodi where kode_ps=%d",$kode_ps)
);
?>

<div class="wrap">
<h2>Edit Prodi</h2>
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
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Nama Prodi</th>
<td><input type="text" name="nama_ps" value="<?php echo $Userss->nama_ps;?>"/></td>
</tr>
<tr>
<th>Kepala Prodi</th>
<td><input type="text" name="kaprodi" value="<?php echo $Userss->kaprodi;?>"/></td>
</tr>
<tr>
<th>Fakultas</th>
<td><input type="text" name="fakultas" value="<?php echo $Userss->fakultas;?>"/></td>
</tr>
<tr>
<th>No. Telepon</th>
<td><input type="text" name="no_telpon" value="<?php echo $Userss->no_telpon;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu