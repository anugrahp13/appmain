<?php
	// Set timezone
	date_default_timezone_set('Asia/Jakarta');

	// Start date
	$date = $loaddata['periode_dari'];
	// End date
	$end_date = $loaddata['periode_sampai'];

  echo "<option disabled selected>Pilih Tanggal</option>";
	echo "<option value='semua'>Semua</option>";
	while (strtotime($date) <= strtotime($end_date)) {
                echo "<option value='".$date."'>".$date."</option>";
                $date = date ("m/d/Y", strtotime("+1 day", strtotime($date)));
	}

?>
