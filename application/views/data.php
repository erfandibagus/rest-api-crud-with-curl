<div class="row mb-3 pt-5">
    <div class="col-md">
        <h5>DATA MAHASISWA</h5>
        <a class="btn btn-primary btn-sm" href="<?=base_url('mahasiswa/insert');?>"><i class="fa fa-plus-circle"></i> Tambah Data</a>
    </div>
</div>

<?php if (!empty($this->session->flashdata('msg'))) { ?>
<div class="row">
    <div class="col-md">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?=$this->session->flashdata('msg');?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
<?php } ?>

<div class="row">
    <div class="col-md">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>JURUSAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($result->data as $mhs) { ?>
                <tr>
                    <td><?=$mhs->nrp;?></td>
                    <td><?=$mhs->nama;?></td>
                    <td><?=$mhs->email;?></td>
                    <td><?=$mhs->jurusan;?></td>
                    <td>
                        <a class="btn btn-warning btn-sm mr-1" href="<?=base_url('mahasiswa/update/'.$mhs->id);?>"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-sm" href="<?=base_url('mahasiswa/delete/'.$mhs->id);?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>