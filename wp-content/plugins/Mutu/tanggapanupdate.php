<?php
function tanggapan_update () {
global $wpdb;
// Get Values
$id_tanggapan = sanitize_key($_GET['id_tanggapan']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$tahun_lulus = sanitize_text_field($_POST['tahun_lulus']);
$jumlah_lulusan = sanitize_text_field($_POST['jumlah_lulusan']);
$jumlah_tanggapan = sanitize_text_field($_POST['jumlah_tanggapan']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

if(isset($_POST['update'])){
// Validations</strong></span>
if (!preg_match("/^[0-9]*$/",$id_tanggapan) || empty($id_tanggapan)) {
$msg = "error:ID Tanggapan hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
$wpdb->update(
'tanggapan', //table
array('kode_ps' => $kode_ps, 'tahun_lulus' => $tahun_lulus, 'jumlah_lulusan' => $jumlah_lulusan, 'jumlah_tanggapan' => $jumlah_tanggapan, 'tahun' => $tahun), //data
array('id_tanggapan' => $id_tanggapan ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Tanggapan telah diperbaharui!";
}
}

$tanggapans = $wpdb->get_row(
$wpdb->prepare("SELECT id_tanggapan,kode_ps,tahun_lulus,jumlah_lulusan,jumlah_tanggapan,tahun from tanggapan where id_tanggapan=%d",$id_tanggapan)
);
?>

<div class="wrap">
<h2>Edit Tanggapan</h2>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<p>
<a href="<?php echo admin_url('admin.php?page=tanggapan_list')?>">
&laquo; Kembali ke Daftar Tanggapan</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $tanggapans->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tahun Lulus</th>
<td><input type="text" name="tahun_lulus" value="<?php echo $tanggapans->tahun_lulus;?>"/></td>
</tr>
<tr>
<th>Jumlah Lulusan</th>
<td><input type="text" name="jumlah_lulusan" value="<?php echo $tanggapans->jumlah_lulusan;?>"/></td>
</tr>
<tr>
<th>Jumlah Tanggapan</th>
<td><input type="text" name="jumlah_tanggapan" value="<?php echo $tanggapans->jumlah_tanggapan;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $tanggapans->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu