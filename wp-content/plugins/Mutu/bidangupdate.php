<?php
function bidang_update () {
global $wpdb;
// Get Values
$id_bidang = sanitize_key($_GET['id_bidang']);
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

if(isset($_POST['update'])){
// Validations</strong></span>
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
$wpdb->update(
'bidang', //table
array('kode_ps' => $kode_ps, 'nama_ps' => $nama_ps, 'tahun_lulus' => $tahun_lulus, 'jumlah_lulusan' => $jumlah_lulusan, 'lulusan_terlacak' => $lulusan_terlacak, 'rendah' => $rendah, 'sedang' => $sedang, 'tinggi' => $tinggi, 'tahun' => $tahun), //data
array('id_bidang' => $id_bidang ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Bidang telah diperbaharui!";
}
}

$bidangs = $wpdb->get_row(
$wpdb->prepare("SELECT id_bidang,kode_ps,nama_ps,tahun_lulus,jumlah_lulusan,lulusan_terlacak,rendah,sedang,tinggi,tahun from bidang where id_bidang=%d",$id_bidang)
);
?>

<div class="wrap">
<h2>Edit Bidang</h2>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<p>
<a href="<?php echo admin_url('admin.php?page=bidang_list')?>">
&laquo; Kembali ke Daftar Bidang</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $bidangs->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<th>Prodi
<td><input type="text" name="nama_ps" value="<?php echo $bidangs->nama_ps;?>"/></td>
</tr>
<tr>
<th>Tahun Lulus</th>
<td><input type="text" name="tahun_lulus" value="<?php echo $bidangs->tahun_lulus;?>"/></td>
</tr>
<tr>
<th>Jumlah Lulusan</th>
<td><input type="text" name="jumlah_lulusan" value="<?php echo $bidangs->jumlah_lulusan;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Lulusan Terlacak</th>
<td><input type="text" name="lulusan_terlacak" value="<?php echo $bidangs->lulusan_terlacak;?>"/>
(berupa angka)</td>
</tr>
<tr><th>
	Jumlah lulusan Terlacak dengan Tingkat Keseuaian Bidang Kerja
</th></tr>
<tr>
<th>Rendah</th>
<td><input type="text" name="rendah" value="<?php echo $bidangs->rendah;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Sedang</th>
<td><input type="text" name="sedang" value="<?php echo $bidangs->sedang;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Tinggi</th>
<td><input type="text" name="tinggi" value="<?php echo $bidangs->tinggi;?>"/>
(berupa angka)</td>
</tr>

<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $bidangs->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu