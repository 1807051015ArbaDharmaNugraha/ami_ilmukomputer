<?php
function luaran_update () {
global $wpdb;
// Get Values
$id_luaran = sanitize_key($_GET['id_luaran']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$jenis = sanitize_text_field($_POST['jenis']);
$keterangan = sanitize_text_field($_POST['keterangan']);
$link = sanitize_text_field($_POST['link']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

if(isset($_POST['update'])){
// Validations</strong></span>
if (!preg_match("/^[0-9]*$/",$id_luaran) || empty($id_luaran)) {
$msg = "error:ID Luaran hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$jenis) or empty($jenis)) {
$msg = "error:Luaran Penelitian dan PkM berupa huruf atau belum diisi";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
$wpdb->update(
'luaran', //table
array('kode_ps' => $kode_ps, 'jenis' => $jenis, 'keterangan' => $keterangan, 'link' => $link, 'tahun' => $tahun), //data
array('id_luaran' => $id_luaran ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Luaran Penelitian telah diperbaharui!";
}
}

$luarans = $wpdb->get_row(
$wpdb->prepare("SELECT id_luaran,kode_ps,jenis,keterangan,link,tahun from luaran where id_luaran=%d",$id_luaran)
);
?>

<div class="wrap">
<h2>Edit Luaran Penelitian</h2>
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
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $luarans->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Luaran Penelitian dan PkM</th>
<td><input type="text" name="jenis" value="<?php echo $luarans->jenis;?>"/></td>
</tr>
<tr>
<th>Keterangan</th>
<td><input type="text" name="keterangan" value="<?php echo $luarans->keterangan;?>"/></td>
</tr>
<tr>
<th>Link</th>
<td><input type="text" name="link" value="<?php echo $luarans->link;?>"/></td>
</tr>
<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $luarans->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu