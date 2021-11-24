<?php
function publikasi_update () {
global $wpdb;
// Get Values
$id_publikasi = sanitize_key($_GET['id_publikasi']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$jenis_publikasi = sanitize_text_field($_POST['jenis_publikasi']);
$ts_2 = sanitize_text_field($_POST['ts_2']);
$ts_1 = sanitize_text_field($_POST['ts_1']);
$ts = sanitize_text_field($_POST['ts']);
$jumlah = $_POST['ts_2'] + $_POST['ts_1'] + $_POST['ts'] ;
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

if(isset($_POST['update'])){
// Validations</strong></span>
if (!preg_match("/^[0-9]*$/",$id_publikasi) || empty($id_publikasi)) {
$msg = "error:ID Publikasi hanya berupa angka atau Belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka atau Belum diisi";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$jenis_publikasi) or empty($jenis_publikasi)) {
$msg = "error:Jenis Publikasi berupa huruf atau belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$ts_2)) {
$msg = "error:Jumlah Judul TS-2 hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$ts_1)) {
$msg = "error:Jumlah Judul TS-1 hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$ts)) {
$msg = "error:Jumlah Judul TS hanya berupa angka";
} /*elseif(!preg_match("/^[0-9]*$/",$jumlah)) {
$msg = "error:Jumlah hanya berupa angka";
}*/ elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
$wpdb->update(
'publikasi', //table
array('kode_ps' => $kode_ps, 'jenis_publikasi' => $jenis_publikasi, 'ts_2' => $ts_2, 'ts_1' => $ts_1, 'ts' => $ts, 'jumlah' => $jumlah, 'tahun' => $tahun), //data
array('id_publikasi' => $id_publikasi ), //where
array('%d', '%s', '%d', '%d', '%d', '%d', '%d'), //data format
array('%d') //where format
);
$msg = "updated:Data Publikasi Karya telah diperbaharui!";
}
}

$publikasis = $wpdb->get_row(
$wpdb->prepare("SELECT id_publikasi,kode_ps,jenis_publikasi,ts_2,ts_1,ts,jumlah,tahun from publikasi where id_publikasi=%d",$id_publikasi)
);
?>

<div class="wrap">
<h2>Edit Publikasi Karya</h2>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<p>
<a href="<?php echo admin_url('admin.php?page=publikasi_list')?>">
&laquo; Kembali ke Daftar Publikasi Karya</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $publikasis->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Jenis Publikasi</th>
<td><input type="text" name="jenis_publikasi" value="<?php echo $publikasis->jenis_publikasi;?>"/></td>
</tr>
<tr>
<th>Jumlah Judul TS-2</th>
<td><input type="text" name="ts_2" value="<?php echo $publikasis->ts_2;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Jumlah Judul TS-1</th>
<td><input type="text" name="ts_1" value="<?php echo $publikasis->ts_1;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Jumlah Judul TS</th>
<td><input type="text" name="ts" value="<?php echo $publikasis->ts;?>"/>
(berupa angka)</td>
</tr>

<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $publikasis->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu
/*<tr>
<th>Jumlah</th>
<td><input type="text" name="jumlah" value="<?php echo $publikasis->jumlah;?>"/>
(berupa angka)</td>
</tr>*/