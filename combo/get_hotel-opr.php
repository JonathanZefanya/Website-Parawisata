<?php
include "../config/koneksi.php";

echo "<script language=\"JavaScript\" src=\"../comboBox.js\"></script>";

echo "<select name='hotel' class='cmb'>";
echo "<option value=\"\">--Pilih Hotel--</option>";
$query = "select id_hotel,hotel,harga from tbl_hotel where kd_daerah='$_GET[kode]'";
$result = mysqli_query($kon,$query);
while ($set=mysqli_fetch_array($result))
	{
		echo "<option value=$set[id_hotel]>$set[hotel] - <em>$set[harga] IDR</em></option>";
	}
echo "</select>";
?>
