<?php
function tunggu_update () {
global $wpdb;
// Get Values
$id_tunggu = sanitize_key($_GET['id_tunggu']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$tahun_lulus = sanitize_text_field($_POST['tahun_lulus']);
$jumlah_lulusan = sanitize_text_field($_POST['jumlah_lulusan']);
$lulusan_terlacak = sanitize_text_field($_POST['lulusan_terlacak']);
$lulusan_dipesan = sanitize_text_field($_POST['lulusan_dipesan']);
$tiga_bulan = sanitize_text_field($_POST['tiga_bulan']);
$tigaenam_bulan = sanitize_text_field($_POST['tigaenam_bulan']);
$enam_bulan = sanitize_text_field($_POST['enam_bulan']);
$enam_bln = sanitize_text_field($_POST['enam_bln']);
$enamlapan_bln = sanitize_text_field($_POST['enamlapan_bln']);
$lapan_bln = sanitize_text_field($_POST['lapan_bln']);
$msg = "";
$tahun = sanitize_text_field($_POST['tahun']);

if(isset($_POST['update'])){
// Validations</strong></span>
if (!preg_match("/^[0-9]*$/",$id_tunggu) || empty($id_tunggu)) {
$msg = "error:ID Tunggu hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka atau Belum diisi";
} elseif(!preg_match("/^[0-9]*$/",$tiga_bulan)) {
$msg = "error:Rendah hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$tigaenam_bulan)) {
$msg = "error:Sedang hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$enam_bulan)) {
$msg = "error:Tinggi hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$enam_bln)) {
$msg = "error:Tinggi hanya berupa angka";
}elseif(!preg_match("/^[0-9]*$/",$enamlapan_bln)) {
$msg = "error:Tinggi hanya berupa angka";
}elseif(!preg_match("/^[0-9]*$/",$lapan_bln)) {
$msg = "error:Tinggi hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
$wpdb->update(
'tunggu', //table
array('kode_ps' => $kode_ps, 'tahun_lulus' => $tahun_lulus, 'jumlah_lulusan' => $jumlah_lulusan, 'lulusan_terlacak' => $lulusan_terlacak, 'lulusan_dipesan' => $lulusan_dipesan, 'tiga_bulan' => $tiga_bulan, 'tigaenam_bulan' => $tigaenam_bulan, 'enam_bulan' => $enam_bulan, 'enam_bln' => $enam_bln,'enamlapan_bln' => $enamlapan_bln, 'lapan_bln' => $lapan_bln, 'tahun' => $tahun), //data
array('id_tunggu' => $id_tunggu ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Tunggu telah diperbaharui!";
}
}

$tunggus = $wpdb->get_row(
$wpdb->prepare("SELECT id_tunggu,kode_ps,tahun_lulus,jumlah_lulusan,lulusan_terlacak,lulusan_dipesan,tiga_bulan,tigaenam_bulan,enam_bulan,enam_bln,enamlapan_bln,lapan_bln,tahun from tunggu where id_tunggu=%d",$id_tunggu)
);
?>

<div class="wrap">
<h2>Edit Tunggu</h2>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<p>
<a href="<?php echo admin_url('admin.php?page=tunggu_list')?>">
&laquo; Kembali ke Daftar Tunggu</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $tunggus->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tahun Lulus</th>
<td><input type="text" name="tahun_lulus" value="<?php echo $tunggus->tahun_lulus;?>"/></td>
</tr>
<tr>
<th>Jumlah Lulusan</th>
<td><input type="text" name="jumlah_lulusan" value="<?php echo $tunggus->jumlah_lulusan;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Lulusan Terlacak</th>
<td><input type="text" name="lulusan_terlacak" value="<?php echo $tunggus->lulusan_terlacak;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Lulusan Dipesan</th>
<td><input type="text" name="lulusan_dipesan" value="<?php echo $tunggus->lulusan_dipesan;?>"/>
(berupa angka)</td>
</tr>
<tr><th>
	Jumlah Lulusan Terlacak dengan Waktu Tunggu Mendapatkan Pekerjaan
</th></tr>
<tr>
<th>WT < 3 bulan</th>
<td><input type="text" name="tiga_bulan" value="<?php echo $tunggus->tiga_bulan;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>3 ≤ WT ≤ 6 bulan</th>
<td><input type="text" name="tigaenam_bulan" value="<?php echo $tunggus->tigaenam_bulan;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>WT > 6 bulan</th>
<td><input type="text" name="enam_bulan" value="<?php echo $tunggus->enam_bulan;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>WT < 6 bulan</th>
<td><input type="text" name="enam_bln" value="<?php echo $tunggus->enam_bln;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>6 ≤ WT ≤ 18 bulan</th>
<td><input type="text" name="enamlapan_bln" value="<?php echo $tunggus->enamlapan_bln;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>WT > 18 bulan</th>
<td><input type="text" name="lapan_bln" value="<?php echo $tunggus->lapan_bln;?>"/>
(berupa angka)</td>
</tr>
<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $tunggus->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu
