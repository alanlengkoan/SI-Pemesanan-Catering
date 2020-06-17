<?php
	
	$check=mysql_query("select status_tagihan from t_tagihan where id_member=".$id_member." and id_tagihan=".$id.""); // Memanggil Tabel Tagihan Sesuai ID Member
	$rcheck=mysql_num_rows($check);
	if($rcheck<1){ // Jika Kosong Maka Muncul Peringatan
		echo "<script>alert('Tagihan Tidak Ada!');window.location=('index.php');</script>";
	}
	

if(isset($_POST['kirim']) && isset($id_member)){
		if(!empty($_FILES['foto']['name'])){		
				$list_ekstensi = array("bmp", "jpg", "gif", "png", "jpeg"); // Extension Yang Diperbolehkan //
				$list_tipe= array("image/gif","image/jpeg","image/png","image/bmp"); // Tipe Yang Diperbolehkan //
				$namaFile = $_FILES['foto']['name'];
				$tipe=$_FILES['foto']['type'];
				$pecah = explode(".", $namaFile);
				$pecah_ekstensi = $pecah[1];
				$jenis=".$pecah_ekstensi";
				$namaFileNew=$_GET['id'].$jenis;
				$namaDir = './images/konfirmasi/';
				$pathFile = $namaDir . $namaFile;
			if (in_array($pecah_ekstensi, $list_ekstensi)){
					if(in_array($tipe,$list_tipe)){   
						if (move_uploaded_file($_FILES['foto']['tmp_name'], $pathFile))	{
								$foto='./images/konfirmasi/'.$namaFileNew;
								rename($namaDir.$namaFile,$namaDir.$namaFileNew);
								$status='sukses';
						}else{
							echo "<script>alert('Tipe File tidak diperbolehkan!');</script>";
							$status='failed';
						}
					}else{
							echo "<script>alert('Tipe File tidak diperbolehkan!');</script>";
							$status='failed';
					}
			}
		
			if($status=='sukses'){
				$sql_kirim=mysql_query("update t_tagihan SET foto_faktur='".$foto."' where id_tagihan=".$id."") or die(mysql_error());
				echo "<script>alert('Terima Kasih! Pesanan Anda Segera Kami Proses');window.location=('index.php?module=tagihan');</script>";
			}
	}else{
		echo "<script>alert('Konfirmasi Gagal! Check Kembali Foto Faktur');window.location=('index.php?module=tagihan');</script>";	
	}
}
?>

