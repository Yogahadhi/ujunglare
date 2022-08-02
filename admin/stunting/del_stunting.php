<?php
if (isset($_GET['kode'])) {
    $sql_hapus = "DELETE FROM tb_stunting WHERE id_stunting='" . $_GET['kode'] . "'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);
    $sql_ubah = "UPDATE tb_pdd SET 
                stunting='Tidak'
                WHERE id_pend='" . $_GET['kode'] . "'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_hapus && $sql_ubah) {
        echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-stunting';
                    }
                })</script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-stunting';
                    }
                })</script>";
    }
}
