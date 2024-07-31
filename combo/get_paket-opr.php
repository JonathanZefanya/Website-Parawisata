<?php
include "../config/koneksi.php";

echo "<script language=\"JavaScript\" src=\"../comboBox.js\"></script>";

echo "<select id='paket' name='paket' class='cmb'>";
echo "<option value=\"\">--Pilih Paket--</option>";
$query = "select id_paket,nama_paket,harga_paket from tbl_paket where id_kategori='$_GET[kode]'";
$result = mysqli_query($kon,$query);
while ($set=mysqli_fetch_array($result))
	{
		echo "<option value=$set[id_paket]>$set[nama_paket]</option>";
	}
echo "</select>";
?>