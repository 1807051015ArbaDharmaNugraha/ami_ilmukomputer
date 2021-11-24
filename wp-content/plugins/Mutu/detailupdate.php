<?php
function detail_update () {
global $wpdb;
// Get Values
$id_detail = sanitize_key($_GET['id_detail']);
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

if(isset($_POST['update'])){
// Validations</strong></span>
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
$wpdb->update(
'detail', //table
array('kode_ps' => $kode_ps,'nama_ps' => $nama_ps, 'jenis_kemampuan' => $jenis_kemampuan, 'sangat_baik' => $sangat_baik, 'baik' => $baik, 'cukup' => $cukup, 'kurang' => $kurang, 'tindak_lanjut' => $tindak_lanjut, 'tahun' => $tahun), //data
array('id_detail' => $id_detail ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Tempat telah diperbaharui!";
}
}

$tempats = $wpdb->get_row(
$wpdb->prepare("SELECT id_detail,kode_ps,nama_ps,jenis_kemampuan,sangat_baik,baik,cukup,kurang,tindak_lanjut,tahun from detail where id_detail=%d",$id_detail)
);
?>

<div class="wrap">
<h2>Edit Detail</h2>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<p>
<a href="<?php echo admin_url('admin.php?page=detail_list')?>">
&laquo; Kembali ke Daftar Tempat</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $tempats->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<th>Prodi
<td><input type="text" name="nama_ps" value="<?php echo $tempats->nama_ps;?>"/></td>
</tr>
<tr>
<th>Jenis Kemampuan</th>
<td><input type="text" name="jenis_kemampuan" value="<?php echo $tempats->jenis_kemampuan;?>"/></td>
</tr>
<tr>
<th>
Tingkat Kepuasan Pengguna (%)
</th>
</tr>
<tr>
<th>Sangat Baik</th>
<td><input type="text" name="sangat_baik" value="<?php echo $tempats->sangat_baik;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Baik</th>
<td><input type="text" name="baik" value="<?php echo $tempats->baik;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Cukup</th>
<td><input type="text" name="cukup" value="<?php echo $tempats->cukup;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Kurang</th>
<td><input type="text" name="kurang" value="<?php echo $tempats->kurang;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Tindak Lanjut</th>
<td><input type="text" name="tindak_lanjut" value="<?php echo $tempats->tindak_lanjut;?>"/>
(berupa angka)</td>
</tr>

<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $tempats->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu
/*id_detail
kode_ps
nama_ps
jenis_kemampuan
sangat_baik
baik
cukup
kurang
tindak_lanjut
tahun
*/