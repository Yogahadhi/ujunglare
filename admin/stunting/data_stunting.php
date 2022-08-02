<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Stunting
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-stunting" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Tanggal Lahir</th>
                        <th>Kategori</th>
                        <th>Indikator</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM tb_pdd as p
                    left join tb_stunting as s on p.id_pend=s.id_pdd 
                    where status='Ada' and (kategori='Stunting' or kategori='Berisiko')");
                    while ($data = $sql->fetch_assoc()) {
                    ?>

                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nik']; ?>
                            </td>
                            <td>
                                <?php echo $data['nama']; ?>
                            </td>
                            <td>
                                <?php echo $data['jekel']; ?>
                            </td>
                            <td>
                                <?php echo $data['tgl_lh']; ?>
                            </td>
                            <td>
                                <?php echo $data['kategori']; ?>
                            </td>
                            <td>
                                <?php echo $data['indikator']; ?>
                            </td>

                            <td>
                                <!-- <a href="?page=view-stunting&kode=<?php echo $data['id_stunting']; ?>" title="Detail" class="btn btn-info btn-sm">
                                    <i class="fa fa-user"></i>
                                </a> -->
                                <a href="?page=edit-stunting&kode=<?php echo $data['id_stunting']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-stunting&kode=<?php echo $data['id_stunting']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                    </>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card-body -->