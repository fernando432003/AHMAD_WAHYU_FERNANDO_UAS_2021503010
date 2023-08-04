<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
    <div class="col-md-12">
    <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
              </div>
              <!-- /.card-header -->
                <form action="<?php echo $action; ?>"  method="post" autocomplete="off">
                <div class="card-body">
                    <?php if (validation_errors()) {
                        ?>
                        
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                          <h5><i class="icone fas fa-ban"></i>error</h5>
                          <?php echo validation_list_errors() ?>
                        </div>
              <?php 
                    }
                    ?>
                    <?php
              if(session()->getFlashdata('error')){
                ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <h5><i class="icone fas fa-warning"></i>error</h5>
                  <?php echo session()->getflashdata('error'); ?>
                </div>
              <?php
              }
              ?>
              
                <?php echo csrf_field() ?>
                <?php
                if(current_url(true)->getSegment(2) == 'edit'){
                  ?>
                  <input type="hidden" name="param" id="param" value="<?php echo $edit_jurusan['kdjurusan'];?>">
                  <?php
                }
                ?>    
                <div class=" form-group">
                    <label for="kdjurusan">Kode Jurusan</label>
                    <input type="text" name="kdjurusan" id="kdjurusan" value="<?php echo empty(set_value('kdjurusan')) ? (empty($edit_jurusan['kdjurusan']) ? "": $edit_jurusan['kdjurusan']) : set_value('kdjurusan'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="namajurusan">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" id="nama_jurusan" value="<?php echo empty(set_value('kdjurusan')) ? (empty($edit_jurusan['kdjurusan']) ? "": $edit_jurusan['nama_jurusan']) : set_value('nama_jurusan'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" name="kelas" id="kelas"  value="<?php echo empty(set_value('kdjurusan')) ? (empty($edit_jurusan['kelas']) ? "": $edit_jurusan['kelas']) : set_value('kelas'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="<?php echo empty(set_value('kdjurusan')) ? (empty($edit_jurusan['password']) ? "": $edit_jurusan['password']) : set_value('password'); ?>">
                </div>
                <div>
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
              </div>
              </form>
</div>

<?php
echo $this->endSection(); ?>