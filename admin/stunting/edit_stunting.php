<?php
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tb_stunting s join tb_pdd p on s.id_pdd=p.id_pend WHERE id_stunting='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Sistem</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="id_pdd" name="id_pdd" value="<?php echo $data_cek['id_pdd']; ?>" readonly />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data_cek['nama']; ?>" readonly required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-3">
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option selected disabled hidden>Default : <?php echo $data_cek['kategori']; ?></option>
                        <option>Stunting</option>
                        <option>Berisiko</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Indikator</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="indikator" name="indikator" value="<?php echo $data_cek['indikator']; ?>" required>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-stunting" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

if (isset($_POST['Ubah'])) {
    $sql_update = "UPDATE tb_stunting SET 
		kategori='" . $_POST['kategori'] . "',
		indikator='" . $_POST['indikator'] . "'
		WHERE id_pdd='" . $_POST['id_pdd'] . "'";
    $query_update = mysqli_query($koneksi, $sql_update);

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

    if ($query_update && $sql_ubah) {
        if ($_POST['kategori'] == 'Stunting') {
            echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {
            window.location = 'index.php?page=data-penyintas';
        }
      })</script>";
        } else if ($_POST['kategori'] == 'Berisiko') {
            echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {
            window.location = 'index.php?page=data-berisiko';
        }
      })</script>";
        }
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-stunting';
        }
      })</script>";
    }
}
