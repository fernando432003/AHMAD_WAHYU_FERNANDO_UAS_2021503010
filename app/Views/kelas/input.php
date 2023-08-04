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
                  <input type="hidden" name="param" id="param" value="<?php echo $edit_kelas['idkelas'];?>">
                  <?php
                }
                ?>    
                <div class=" form-group">
                    <label for="idkelas">Kode kelas</label>
                    <input type="text" name="idkelas" id="idkelas" value="<?php echo empty(set_value('idkelas')) ? (empty($edit_kelas['idkelas']) ? "": $edit_kelas['idkelas']) : set_value('idkelas'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="namakelas">Nama kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" value="<?php echo empty(set_value('idkelas')) ? (empty($edit_kelas['idkelas']) ? "": $edit_kelas['nama_kelas']) : set_value('nama_kelas'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="no_kelas">Kelas</label>
                    <input type="text" name="no_kelas" id="no_kelas"  value="<?php echo empty(set_value('idkelas')) ? (empty($edit_kelas['no_kelas']) ? "": $edit_kelas['no_kelas']) : set_value('no_kelas'); ?>" class="form-control">
                </div>
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
              </div>
              </form>
</div>

<?php
echo $this->endSection(); ?>