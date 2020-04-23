<?php
  echo "<option disabled selected>Pilih</option>";
  echo "<option value='semua'>Semua</option>";
  foreach ($loaddata as $key) {
    echo "<option value='".$key['id_profil']."'>".$key['nama_lengkap']."</option>";
  }
?>
