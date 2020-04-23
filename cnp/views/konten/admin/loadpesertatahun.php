<?php
  echo "<option disabled selected>Pilih Peserta</option>";
  foreach ($loaddata as $key) {
    echo "<option value='".$key['id_profil']."'>".$key['nama_lengkap']."</option>";
  }
?>
