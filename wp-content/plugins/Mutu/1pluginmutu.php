<?php
/*
* Plugin Name: Plugin Audit Mutu Internal V1.0.1
* Description: Kelola Data Program Studi, Data Kelulusan, Data Publikasi Karya, dan Data Luaran Penelitian
* Version: 1.0.1
* Author: Arba Dharma Nugraha
* Author URI: -
*/

add_action('admin_menu','auditmutuinternal');
function auditmutuinternal() {



	//1. Menu Data Prodi
	add_menu_page('Data Program Studi','Data Program Studi','read','prodi_list','prodi_list','dashicons-admin-multisite');


	add_submenu_page(null,'Tambah Prodi','Tambah Prodi','read','prodi_create','prodi_create'
);

	add_submenu_page(null,'Update Prodi','Update Prodi','read','prodi_update','prodi_update' );


	include plugin_dir_path(__FILE__) . 'prodilist.php';
	include plugin_dir_path(__FILE__) . 'prodicreate.php';
	include plugin_dir_path(__FILE__) . 'prodiupdate.php';


	
	//Menu Data Kelulusan
	add_menu_page('Data Kelulusan','Data Kelulusan','','kelulusan','tunggu_list','dashicons-welcome-learn-more');


		//2. Submenu Data Waktu Tunggu Kelulusan
	add_submenu_page('kelulusan','Waktu Tunggu Lulusan','Waktu Tunggu Lulusan','read','tunggu_list','tunggu_list');

	add_submenu_page(null,'Tambah Tunggu','Tambah Tunggu','read','tunggu_create','tunggu_create');

	add_submenu_page(null,'Update Tunggu','Update Tunggu','read','tunggu_update','tunggu_update' );

	include plugin_dir_path(__FILE__) . 'tunggulist.php';
	include plugin_dir_path(__FILE__) . 'tunggucreate.php';
	include plugin_dir_path(__FILE__) . 'tungguupdate.php';



		//3. Submenu Data Kesesuaian Bidang Kerja Lulusan
	add_submenu_page('kelulusan','Kesesuaian Bidang Kerja Lulusan','Kesesuaian Bidang Kerja Lulusan','read','bidang_list','bidang_list');

	add_submenu_page(null,'Tambah Bidang','Tambah Bidang','read','bidang_create','bidang_create');

	add_submenu_page(null,'Update Bidang','Update Bidang','read','bidang_update','bidang_update' );

	include plugin_dir_path(__FILE__) . 'bidanglist.php';
	include plugin_dir_path(__FILE__) . 'bidangcreate.php';
	include plugin_dir_path(__FILE__) . 'bidangupdate.php';



		//4. Submenu Data Tempat Kerja Lulusan */
	add_submenu_page('kelulusan',' Tempat Kerja Lulusan','Tempat Kerja Lulusan','read','tempat_list','tempat_list');

	add_submenu_page(null,'Tambah Tempat','Tambah Tempat','read','tempat_create','tempat_create');

	add_submenu_page(null,'Update Tempat','Update Tempat','read','tempat_update','tempat_update' );

	include plugin_dir_path(__FILE__) . 'tempatlist.php';
	include plugin_dir_path(__FILE__) . 'tempatcreate.php';
	include plugin_dir_path(__FILE__) . 'tempatupdate.php';



		//5. Submenu Data Ref Kepuasan Pengguna Lulusan
	add_submenu_page('kelulusan','Referensi Kepuasan Pengguna Lulusan','Referensi Kepuasan Pengguna Lulusan','read','tanggapan_list','tanggapan_list');

	add_submenu_page(null,'Tambah Tanggapan','Tambah Tanggapan','read','tanggapan_create','tanggapan_create');

	add_submenu_page(null,'Update Tanggapan','Update Tanggapan','read','tanggapan_update','tanggapan_update' );

	include plugin_dir_path(__FILE__) . 'tanggapanlist.php';
	include plugin_dir_path(__FILE__) . 'tanggapancreate.php';
	include plugin_dir_path(__FILE__) . 'tanggapanupdate.php';



		//6. Submenu Data Kepuasan Pengguna Lulusan
	add_submenu_page('kelulusan','Kepuasan Pengguna Lulusan','Kepuasan Pengguna Lulusan','read','detail_list','detail_list');

	add_submenu_page(null,'Tambah Data Detail','Tambah Detail','read','detail_create','detail_create');

	add_submenu_page(null,'Update Disitasi','Update Disitasi','read','detail_update','detail_update' );

	include plugin_dir_path(__FILE__) . 'detaillist.php';
	include plugin_dir_path(__FILE__) . 'detailcreate.php';
	include plugin_dir_path(__FILE__) . 'detailupdate.php';




	//Menu Data Publikasi Karya Ilmiah Mahasiswa
	add_menu_page('Data Publikasi Karya Ilmiah','Data Publikasi Karya Ilmiah','','publikasi','publikasi_list','dashicons-book');

		//7. Submenu Data Publikasi Ilmiah Mahasiswa
	add_submenu_page('publikasi',' Publikasi Ilmiah Mahasiswa','Publikasi Ilmiah Mahasiswa','read','publikasi_list','publikasi_list');

	add_submenu_page(null,'Tambah Data Publikasi','Tambah Publikasi','read','publikasi_create','publikasi_create');

	add_submenu_page(null,'Update Disitasi','Update Disitasi','read','publikasi_update','publikasi_update' );

	include plugin_dir_path(__FILE__) . 'publikasilist.php';
	include plugin_dir_path(__FILE__) . 'publikasicreate.php';
	include plugin_dir_path(__FILE__) . 'publikasiupdate.php';




		//8. Submenu Data Karya Ilmiah Mahasiswa yang Disitasi
	add_submenu_page('publikasi',' Karya Ilmiah Mahasiswa yang Disitasi','Karya Ilmiah Mahasiswa yang Disitasi','read','disitasi_list','disitasi_list');

	add_submenu_page(null,'Tambah Data Disitasi','Tambah Disitasi','read','disitasi_create','disitasi_create');

	add_submenu_page(null,'Update Disitasi','Update Disitasi','read','disitasi_update','disitasi_update' );

	include plugin_dir_path(__FILE__) . 'disitasilist.php';
	include plugin_dir_path(__FILE__) . 'disitasicreate.php';
	include plugin_dir_path(__FILE__) . 'disitasiupdate.php';



	/* 9. Submenu Data Produk/Jasa Mahasiswa yang Diadopsi oleh Industri/Masyarakat */
	add_submenu_page('publikasi',' Produk/Jasa DTPS yang Dihasilkan Mahasiswa yang Diadopsi oleh Industri/Masyarakat','Produk/Jasa DTPS yang Dihasilkan Mahasiswa yang Diadopsi oleh Industri/Masyarakat','read','produk_list','produk_list');


	add_submenu_page(null,'Tambah Data Produk','Tambah Produk','read','produk_create','produk_create');

	add_submenu_page(null,'Update Produk','Update Produk','read','produk_update','produk_update' );

	include plugin_dir_path(__FILE__) . 'produklist.php';
	include plugin_dir_path(__FILE__) . 'produkcreate.php';
	include plugin_dir_path(__FILE__) . 'produkupdate.php';



	//10. Menu Data Luaran Penelitian yang dihasilkan Mahasiswa
	add_menu_page('Data Luaran Penelitian','Data Luaran Penelitian','read','luaran_list','luaran_list','dashicons-awards');



	add_submenu_page(null,'Tambah Luaran','Tambah Luaran','read','luaran_create','luaran_create'
);

	add_submenu_page(null,'Update Luaran','Update luaran','read','luaran_update','luaran_update' );

	include plugin_dir_path(__FILE__) . 'luaranlist.php';
	include plugin_dir_path(__FILE__) . 'luarancreate.php';
	include plugin_dir_path(__FILE__) . 'luaranupdate.php';




}


?>

