<?php
function produk_update () {
global $wpdb;
// Get Values
$id_produk = sanitize_key($_GET['id_produk']);
$kode_ps = sanitize_text_field($_POST['kode_ps']);
$nama_mhs = sanitize_text_field($_POST['nama_mhs']);
$nama_produk = sanitize_text_field($_POST['nama_produk']);
$deskripsi = sanitize_text_field($_POST['deskripsi']);
$bukti = sanitize_text_field($_POST['bukti']);
$link = sanitize_text_field($_POST['link']);
$tahun = sanitize_text_field($_POST['tahun']);
$msg = "";

if(isset($_POST['update'])){
// Validations</strong></span>
if (!preg_match("/^[0-9]*$/",$id_produk) || empty($id_produk)) {
$msg = "error:ID Produk/Jasa hanya berupa angka";
} elseif (!preg_match("/^[0-9]*$/",$kode_ps) || empty($kode_ps)) {
$msg = "error:Kode Prodi hanya berupa angka";
} elseif (!preg_match("/^[a-zA-Z ]*$/",$nama_mhs) or empty($nama_mhs)) {
$msg = "error:Nama Mahasiswa berupa huruf atau belum diisi";
} elseif (!preg_match("/^[0-9]*$/",$tahun) || empty($tahun)) {
$msg = "error:Tahun hanya berupa angka";
} else {
$wpdb->update(
'produk', //table
array('kode_ps' => $kode_ps, 'nama_mhs' => $nama_mhs, 'nama_produk' => $nama_produk, 'deskripsi' => $deskripsi, 'bukti' => $bukti, 'link' => $link, 'tahun' => $tahun), //data
array('id_produk' => $id_produk ), //where
array('%s'), //data format
array('%s') //where format
);
$msg = "updated:Data Produk/Jasa telah diperbaharui!";
}
}

$produks = $wpdb->get_row(
$wpdb->prepare("SELECT id_produk,kode_ps,nama_mhs,nama_produk,deskripsi,bukti,link,tahun from produk where id_produk=%d",$id_produk)
);
?>

<div class="wrap">
<h2>Edit Produk/Jasa</h2>
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
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table class='wp-list-table widefat fixed'>
<tr>
<th>Kode Prodi
<td><input type="text" name="kode_ps" value="<?php echo $produks->kode_ps;?>"/>
<em>(berupa angka)</em></td>
</tr>
<tr>
<th>Nama Mahasiswa</th>
<td><input type="text" name="nama_mhs" value="<?php echo $produks->nama_mhs;?>"/></td>
</tr>
<tr>
<th>Nama Produk/Jasa</th>
<td><input type="text" name="nama_produk" value="<?php echo $produks->nama_produk;?>"/></td>
</tr>
<tr>
<th>Deskripsi Produk/Jasa</th>
<td><input type="text" name="deskripsi" value="<?php echo $produks->deskripsi;?>"/></td>
</tr>
<tr>
<th>Bukti</th>
<td><input type="text" name="bukti" value="<?php echo $produks->bukti;?>"/></td>
</tr>
<tr>
<th>Link</th>
<td><input type="text" name="link" value="<?php echo $produks->link;?>"/></td>
</tr>
<tr>
<th>Tahun</th>
<td><input type="text" name="tahun" value="<?php echo $produks->tahun;?>"/>
<em>(berupa angka)</em></td>
</tr>
</table>
<input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
</form>
</div>
<?php
}

// users di ganti dengan mutu