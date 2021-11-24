<?php
function disitasi_update () {
global $wpdb;
// Get Values
$id_disitasi = sanitize_key($_GET['id_disitasi']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$nama_mhs = sanitize_text_field($_POST['nama_mhs']);
$judul = sanitize_text_field($_POST['judul']);
$jumlah = sanitize_text_field($_POST['jumlah']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

if(isset($_POST['update'])){
// Validations</strong></span>
if (!preg_match("/^[0-9]*$/",$id_disitasi) || empty($id_disitasi)) {
$msg = "error:ID Disitasi hanya berupa angka";
} elseif(!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$nama_mhs) or empty($nama_mhs)) {
$msg = "error:Nama Mahasiswa berupa huruf atau belum diisi";
} elseif (!preg_match("/^[0-9]*$/",$jumlah) || empty($jumlah)) {
$msg = "error:Jumlah Disitasi hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
$wpdb->update(
'disitasi', //table
array('kode_ps' => $kode_ps, 'nama_mhs' => $nama_mhs, 'judul' => $judul, 'jumlah' => $jumlah, 'tahun' => $tahun), //data
array('id_disitasi' => $id_disitasi ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Disitasi telah diperbaharui!";
}
}

$disitasis = $wpdb->get_row(
$wpdb->prepare("SELECT id_disitasi,kode_ps,nama_mhs,judul,jumlah,tahun from disitasi where id_disitasi=%d",$id_disitasi)
);
?>

<div class="wrap">
<h2>Edit Disitasi</h2>
<?php
if (!empty($msg)) {
$fmsg = explode(':',$msg);
echo "<div class=\"{$fmsg[0]}\"><p>{$fmsg[1]}</p></div>";
}
?>
<p>
<a href="<?php echo admin_url('admin.php?page=disitasi_list')?>">
&laquo; Kembali ke Daftar Disitasi</a>
</p>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $disitasis->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Nama Mahasiswa</th>
<td><input type="text" name="nama_mhs" value="<?php echo $disitasis->nama_mhs;?>"/></td>
</tr>
<tr>
<th>Judul Artikel yang Disitasi (Jurnal, Volume, Tahun, Nomor, Halaman)</th>
<td><input type="text" name="judul" value="<?php echo $disitasis->judul;?>"/></td>
</tr>
<tr>
<th>Jumlah Sitasi</th>
<td><input type="text" name="jumlah" value="<?php echo $disitasis->jumlah;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $disitasis->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu