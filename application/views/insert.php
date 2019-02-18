<div class="row mb-3 pt-5">
    <div class="col-md">
        <h5>TAMBAH DATA</h5>
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
        <form method="POST" action="<?=base_url('mahasiswa/post');?>">
            <div class="form-group">
                <label for="nrp">NRP</label>
                <input class="form-control" type="number" name="nrp" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input class="form-control" type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input class="form-control" type="text" name="jurusan" required>
            </div>
            <input class="btn btn-primary" type="submit" value="Simpan">
        </form>
    </div>
</div>