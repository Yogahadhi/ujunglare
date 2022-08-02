<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Penduduk</label>
                <div class="col-sm-6">
                    <select name="id_pdd" id="id_pdd" class="form-control select2bs4" required>
                        <option selected="selected">- Pilih Penduduk -</option>
                        <?php
                        // ambil data dari database
                        $query = "select * from tb_pdd where status='Ada' and stunting = 'Tidak'";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
                            <option value="<?php echo $row['id_pend'] ?>">
                                <?php echo $row['nik'] ?>
                                -
                                <?php echo $row['nama'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-3">
                    <select name="kategori" id="kategori" class="form-control">
                        <option>- Pilih -</option>
                        <option>Stunting</option>
                        <option>Berisiko</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Indikator</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="indikator" name="indikator" placeholder="Indikator Stunting" required>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-stunting" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

if (isset($_POST['Simpan'])) {
    //mulai proses simpan data
    $sql_simpan = "INSERT INTO tb_stunting (id_pdd, kategori, indikator) VALUES (
            '" . $_POST['id_pdd'] . "',
            '" . $_POST['kategori'] . "',
            '" . $_POST['indikator'] . "')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    if ($_POST['kategori'] == 'Stunting') {
        $sql_ubah = "UPDATE tb_pdd SET 
    		stunting='Ya'
    		WHERE id_pend='" . $_POST['id_pdd'] . "'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
        mysqli_close($koneksi);
    } else if ($_POST['kategori'] == 'Berisiko') {
        $sql_ubah = "UPDATE tb_pdd SET 
                stunting='Berisiko'
                WHERE id_pend='" . $_POST['id_pdd'] . "'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
        mysqli_close($koneksi);
    }

    if ($query_simpan && $sql_ubah) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-stunting';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-stunting';
          }
      })</script>";
    }
}
     //selesai proses simpan data
